<?php
require_once '../src/cart_functions.php';

// Check if checkout items exist in session
if (!isset($_SESSION['checkout_items']) || empty($_SESSION['checkout_items'])) {
    // Redirect to cart if no items are selected for checkout
    header("Location: cart.php?error=no_checkout_items");
    exit;
}

// Calculate total from checkout items
$checkoutItems = $_SESSION['checkout_items'];
$totalAmount = 0;
foreach ($checkoutItems as $item) {
    $totalAmount += $item['price'] * $item['quantity'];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process billing information
    // You would typically validate and store this information in a database
    
    // For now, just store in session and redirect to delivery_date.php
    $_SESSION['billing_info'] = [
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'suffix' => $_POST['suffix'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'country' => $_POST['country'],
        'address' => $_POST['address'],
        'zip' => $_POST['zip'],
        'payment_method' => $_POST['payment_method'],
        'cardtype' => isset($_POST['cardtype']) ? $_POST['cardtype'] : '',
        'cardnumber' => isset($_POST['cardnumber']) ? $_POST['cardnumber'] : '',
        'expdate' => isset($_POST['expdate']) ? $_POST['expdate'] : '',
        'total_amount' => $totalAmount
    ];
    
    header("Location: delivery_date.php");
    exit;
}
?>
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
                        <div>₱<?php echo number_format($totalAmount, 2); ?></div>
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
                            <div class="form-group">
                                <label for="zip">ZIP/Postal Code:</label>
                                <input type="text" id="zip" name="zip" placeholder="1234" required>
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
                                <input type="text" id="transaction_num" name="transaction_num" value="">
                            </div>
                            <div class="form-group">
                                <label for="total">Total Purchase:</label>
                                <input type="text" id="total" name="total" value="">
                            </div>
                            <div class="form-group">
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
<script>
$(document).ready(function() {
    $('.form-group input').after('<div class="validation-message"></div>');
    $('head').append(`
        <style>
            .form-group {
                position: relative;
            }
            .validation-message {
                position: absolute;
                background: #ff4444;
                color: white;
                padding: 8px 15px;
                border-radius: 15px;
                font-size: 12px;
                display: none;
                bottom: 60%;
                right: 0;
                margin-bottom: 5px;
                z-index: 100;
                box-shadow: 0 2px 5px rgba(0,0,0,0.2);
                max-width: 200px;
                animation: fadeIn 0.3s ease-in;
            }
    
            .validation-message:before {
                content: '';
                position: absolute;
                bottom: -10px;
                left: 15px;
                border-left: 10px solid transparent;
                border-right: 10px solid transparent;
                border-top: 10px solid #ff4444;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
    `);

    function validateInput(input) {        const value = input.val();
        const id = input.attr('id');
        
        switch(id) {
            case 'firstname':
            case 'lastname':
                if(!/^[a-zA-Z\s]{2,30}$/.test(value)) {
                    showError(input, "Letters only, 2-30 characters");
                }
                break;
            case 'phone':
                if(!/^09\d{9}$/.test(value)) {
                    showError(input, "Format: 09XXXXXXXXX");
                }
                break;
            case 'email':
                if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                    showError(input, "Enter valid email");
                }
                break;
            case 'zip':
                if(!/^\d{4}$/.test(value)) {
                    showError(input, "Enter 4-digit code");
                }
                break;
        }
    }

    function showError(input, message) {
        input.addClass('error');
        input.next('.validation-message').text(message).show();
    }

    $('input').on('input', function() {
        $(this).removeClass('error');
        $(this).next('.validation-message').hide();
    });

    $('input').blur(function() {
        validateInput($(this));
    });

    $('#cardnumber').on('input', function() {
        let value = $(this).val().replace(/\s/g, '');
        if (!/^\d{16}$/.test(value)) {
            showError($(this), "Enter valid 16-digit card number");
        } else {
            $(this).removeClass('error');
            $(this).next('.validation-message').hide();
        }
        // Format with spaces after every 4 digits
        $(this).val(value.replace(/(\d{4})/g, '$1 ').trim());
    });

    $('#transaction_num').on('input', function() {
        if (!/^\d{10}$/.test($(this).val())) {
            showError($(this), "Enter 10-digit transaction number");
        } else {
            $(this).removeClass('error');
            $(this).next('.validation-message').hide();
        }
    });

    $('#total').on('input', function() {
        if (!/^\d+(\.\d{2})?$/.test($(this).val())) {
            showError($(this), "Enter valid amount (e.g., 1000.00)");
        } else {
            $(this).removeClass('error');
            $(this).next('.validation-message').hide();
        }
    });

    $('#expdate').on('change', function() {
        let selected = new Date($(this).val());
        let today = new Date();
        if (selected < today) {
            showError($(this), "Card has expired");
        } else {
            $(this).removeClass('error');
            $(this).next('.validation-message').hide();
        }
    });

    $('#country').on('change', function() {
        if ($(this).val() === '') {
            showError($(this), "Select a country");
        } else {
            $(this).removeClass('error');
            $(this).next('.validation-message').hide();
        }
    });

        // Add this to your existing jQuery validation code
    $('#address').on('input', function() {
        if ($(this).val().length < 10) {
            showError($(this), "Enter complete address with house number and street name");
        } else if (!/^[a-zA-Z0-9\s,.-]+$/.test($(this).val())) {
            showError($(this), "Use only letters, numbers, and basic punctuation");
        } else {
            $(this).removeClass('error');
            $(this).next('.validation-message').hide();
        }
    });

});


</script>
</html>