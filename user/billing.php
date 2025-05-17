<?php
session_start();
require_once '../src/cart_functions.php';

// Check if checkout items exist in session
if (!isset($_SESSION['checkout_items']) || empty($_SESSION['checkout_items'])) {
    header("Location: cart.php?error=no_items_selected");
    exit;
}

$checkoutItems = $_SESSION['checkout_items'];
$total = 0;
foreach ($checkoutItems as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Process the order when form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect customer information
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $suffix = $_POST['suffix'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $country = $_POST['country'] ?? '';
    $zip = $_POST['zip'] ?? '';
    $transaction_num = $_POST['transaction_num'] ?? '';
    $cardtype = $_POST['cardtype'] ?? '';
    $cardnumber = $_POST['cardnumber'] ?? '';
    $expdate = $_POST['expdate'] ?? '';
    
    // Validate required fields
    $errors = [];
    if (empty($firstname)) $errors[] = "First name is required";
    if (empty($lastname)) $errors[] = "Last name is required";
    if (empty($email)) $errors[] = "Email is required";
    if (empty($phone)) $errors[] = "Phone is required";
    if (empty($address)) $errors[] = "Address is required";
    if (empty($country)) $errors[] = "Country is required";
    if (empty($zip)) $errors[] = "ZIP code is required";
    if (empty($cardtype)) $errors[] = "Card type is required";
    if (empty($cardnumber)) $errors[] = "Card number is required";
    if (empty($expdate)) $errors[] = "Expiration date is required";
    
    // If no errors, process the order
    if (empty($errors)) {
        // Database connection
        $conn = new mysqli("localhost", "root", "", "electrogadgets");
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Start transaction
        $conn->begin_transaction();
        
        try {
            // Insert customer data
            $stmt = $conn->prepare("INSERT INTO customers (firstname, lastname, suffix, email, phone, address, country, zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $firstname, $lastname, $suffix, $email, $phone, $address, $country, $zip);
            $stmt->execute();
            $customer_id = $conn->insert_id;
            
            // Generate a unique order number
            $order_number = 'ORD-' . time() . '-' . rand(1000, 9999);
            
            // Insert order data
            $stmt = $conn->prepare("INSERT INTO orders (order_number, customer_id, total_amount, order_date, status) VALUES (?, ?, ?, NOW(), 'pending')");
            $stmt->bind_param("sid", $order_number, $customer_id, $total);
            $stmt->execute();
            $order_id = $conn->insert_id;
            
            // Insert order items
            $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            
            foreach ($checkoutItems as $item) {
                $product_id = $item['product_id'];
                $quantity = $item['quantity'];
                $price = $item['price'];
                $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price);
                $stmt->execute();
                
                // Update product stock
                $update_stock = $conn->prepare("UPDATE products SET stocks = stocks - ? WHERE product_id = ?");
                $update_stock->bind_param("ii", $quantity, $product_id);
                $update_stock->execute();
            }
            
            // Insert payment details
            $masked_card = substr(str_replace(' ', '', $cardnumber), -4);
            $masked_card = "XXXX-XXXX-XXXX-" . $masked_card;
            
            $stmt = $conn->prepare("INSERT INTO payment_details (order_id, transaction_number, card_type, card_number, expiration_date) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $order_id, $transaction_num, $cardtype, $masked_card, $expdate);
            $stmt->execute();
            
            // Insert delivery info (default values)
            $stmt = $conn->prepare("INSERT INTO delivery_info (order_id, delivery_status) VALUES (?, 'pending')");
            $stmt->bind_param("i", $order_id);
            $stmt->execute();
            
            // Commit transaction
            $conn->commit();
            
            // Store order information in session
            $_SESSION['order'] = [
                'order_id' => $order_id,
                'order_number' => $order_number,
                'customer' => [
                    'name' => $firstname . ' ' . $lastname,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address
                ],
                'payment_method' => $cardtype,
                'items' => $checkoutItems,
                'total' => $total,
                'date' => date('Y-m-d H:i:s')
            ];
            
            // Clear the cart after successful order
            clearCart();
            
            header("Location: delivery_date.php");
            exit;
        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollback();
            $errors[] = "Database error: " . $e->getMessage();
        }
        
        // Close connection
        $conn->close();
    }
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Billing Information</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
    <div class="container">
        <?php include '../components/sidebar.php'; ?>

        <div class="rightside">
            <?php include '../components/header.php'; ?>

            <div class="main-content">
                <h1 class="page-title">Checkout</h1>
                
                <div class="step-indicator">
                    <div class="step completed">
                        <div class="step-number">1</div>
                        <div class="step-label">Shopping Cart</div>
                    </div>
                    <div class="step active">
                        <div class="step-number">2</div>
                        <div class="step-label">Billing Information</div>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <div class="step-label">Delivery Date</div>
                    </div>
                    <div class="step">
                        <div class="step-number">4</div>
                        <div class="step-label">Confirmation</div>
                    </div>
                </div>
                
                <div class="order-summary">
                    <h3>Order Summary</h3>
                    <div class="order-items">
                        <?php foreach ($checkoutItems as $item): ?>
                            <div class="order-item">
                                <div class="item-name"><?php echo $item['product_name']; ?></div>
                                <div class="item-quantity">x<?php echo $item['quantity']; ?></div>
                                <div class="item-price">₱<?php echo number_format($item['price'] * $item['quantity'], 2); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                        <div class="order-total">
                        <div>Total</div>
                        <div>₱<?php echo number_format($total, 2); ?></div>
                    </div>
                    </div>


                <form action="billing.php" method="post" id="billingForm">
                    <div class="billing-form">
                        <!-- Section 1: Personal Information -->
                        <div class="billing-section">
                            <h3 class="section-title">Personal Information</h3>
                            <div class="form-group">
                                <label for="firstname">First Name:</label>
                                <input type="text" id="firstname" name="firstname" placeholder="Enter your first name" required>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name:</label>
                                <input type="text" id="lastname" name="lastname" placeholder="Enter your last name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="suffix">Suffix:</label>
                                <select class="form-select" id="suffix" name="suffix">
                                    <option value="">Select suffix (optional)</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" placeholder="example@email.com" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number:</label>
                                <input type="tel" id="phone" name="phone" placeholder="09123456789" required>
                            </div>
                            
                        </div>
                        <!-- Section 2: Location Information -->
                        <div class="billing-section">
                            <h3 class="section-title">Location Information</h3>
                            <div class="form-group">
                                <label for="country">Country:</label>
                                <select id="country" name="country" required>
                                    <option value="">Select a country</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benin">Benin</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Brunei">Brunei</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Central African Republic">Central African Republic</option>
                                    <option value="Chad">Chad</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo (Brazzaville)">Congo (Brazzaville)</option>
                                    <option value="Congo (Kinshasa)">Congo (Kinshasa)</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="C te d'Ivoire">C te d'Ivoire</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czech Republic">Czech Republic</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Dominican Republic">Dominican Republic</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="Eritrea">Eritrea</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambia">Gambia</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Grenada">Grenada</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guinea">Guinea</option>
                                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Iran">Iran</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="North Korea">North Korea</option>
                                    <option value="South Korea">South Korea</option>
                                    <option value="Kosovo">Kosovo</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="Laos">Laos</option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lebanon">Lebanon</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libya">Libya</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Macedonia (FYROM)">Macedonia (FYROM)</option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Marshall Islands">Marshall Islands</option>
                                    <option value="Mauritania">Mauritania</option>
                                    <option value="Mauritius">Mauritius</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Micronesia">Micronesia</option>
                                    <option value="Moldova">Moldova</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montenegro">Montenegro</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Myanmar (Burma)">Myanmar (Burma)</option>
                                    <option value="Namibia">Namibia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palau">Palau</option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russia">Russia</option>
                                    <option value="Rwanda">Rwanda</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" id="address" name="address" required>
                            </div>
                            <div class="form-group">
                                <label for="zip">ZIP/Postal Code:</label>
                                <input type="text" id="zip" name="zip" required>
                            </div>
                        </div>
                        <!-- Section 3: Payment Information -->
                        <div class="billing-section">
                            <h3 class="section-title">Payment Information</h3>
                            <div class="form-group">
                                <label for="transaction_num">Transaction Number:</label>
                                <input type="text" id="transaction_num" name="transaction_num" value="<?php echo 'TXN-'.time().'-'.rand(1000,9999); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="total">Total Purchase:</label>
                                <input type="text" id="total" name="total" value="₱<?php echo number_format($total, 2); ?>" readonly>
                            </div>                            <div class="form-group">
                                <label for="cardtype">Card Type:</label>
                                <select id="cardtype" name="cardtype" required>
                                    <option value="">Select a card type</option>
                                    <option value="BDO">BDO</option>
                                    <option value="BPI">BPI</option>
                                    <option value="EastWest">EastWest</option>
                                    <option value="Metrobank">Metrobank</option>
                                    <option value="PNB">PNB</option>
                                    <option value="RCBC">RCBC</option>
                                    <option value="Security Bank">Security Bank</option>
                                    <option value="UnionBank">UnionBank</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cardnumber">Credit Card Number:</label>
                                <input type="text" id="cardnumber" name="cardnumber" required>
                            </div>
                            <div class="form-group">
                                <label for="expdate">Expiration Date:</label>
                                <input type="date" id="expdate" name="expdate" required>
                            </div>
                        </div>
                    </div>

                    <div class="button-group">
                        <button type="button" onclick="window.location.href='cart.php'" class="cancel-btn">Cancel</button>
                        <button type="submit" class="blue-btn">Submit</button>
                    </div>
                </form>
            </div>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php';
        ?>
        </div>
    </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="/ecommerce/assets/js/billing_1.js"></script>
</html>