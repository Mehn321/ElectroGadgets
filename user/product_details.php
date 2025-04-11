<?php
    require_once '../database/database.php';
    require_once '../src/cart_functions.php'; // Include the cart functions
    
    $dataconn = new database();
    $conn = $dataconn->getConnection();
    
    // Get product ID from URL parameter
    $productId = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
    // Handle form submissions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product'];
            $price = $_POST['price'];
            $image = $_POST['image'];
            $quantity = intval($_POST['quantity']);
            
            if ($_POST['action'] === 'add_to_cart') {
                // Add to cart
                addToCart($product_id, $product_name, $price, $image, $quantity);
                
                // Redirect back to the product page with a success message
                header("Location: product_details.php?id=$productId&added=1");
                exit;
            } elseif ($_POST['action'] === 'buy_now') {
                // Add to cart and redirect to billing page
                addToCart($product_id, $product_name, $price, $image, $quantity);
                
                // Create a temporary checkout item array with just this product
                $checkoutItem = [
                    'product_id' => $product_id,
                    'product_name' => $product_name,
                    'price' => $price,
                    'image' => $image,
                    'quantity' => $quantity
                ];

                // Store in session for checkout
                $_SESSION['checkout_items'] = [$checkoutItem];

                // Redirect to billing page
                header("Location: billing.php");
                exit;
            }
        }
    }
    
    // Fetch product details
    $stmt = $conn->prepare("SELECT p.product_id, p.product_name, p.image_path, p.description, p.price, p.stocks, c.category_name 
                           FROM products p
                           JOIN category c ON p.category_id = c.category_id
                           WHERE p.product_id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    
    // Redirect to products page if product not found
    if (!$product) {
        header("Location: products.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['product_name']; ?> Details</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .alert {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #4CAF50;
        }
        .close-btn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include '../components/sidebar.php'; ?>
        <div class="rightside">
            <?php include '../components/header.php'; ?>
            <div class="main-content">
                <?php if (isset($_GET['added']) && $_GET['added'] == 1): ?>
                <div class="alert alert-success">
                    <span class="close-btn" onclick="this.parentElement.style.display='none';">×</span>
                    Product added to cart successfully!
                </div>
                <?php endif; ?>
                
                <div class="product-details">
                    <table border="1" cellspacing="0" align="center" bgcolor="white" class="mtb product-details">
                        <tr>
                            <td class="product-img" align="center">
                                <img src="/ecommerce/<?php echo $product['image_path']; ?>" alt="<?php echo $product['product_name']; ?>" height="300px" width="300px">
                                <h2><?php echo $product['product_name']; ?></h2>
                            </td>
                            <td class="description">
                                <h3>Product Description:</h3>
                                <p><?php echo $product['description']; ?></p>
                                <br>
                                <h2>Price: <?php echo number_format($product['price'], 2); ?></h2>
                                <p>Stock: <?php echo $product['stocks']; ?></p>
                                <form action="product_details.php?id=<?php echo $productId; ?>" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <input type="hidden" name="product" value="<?php echo $product['product_name']; ?>">
                                    <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                                    <input type="hidden" name="image" value="<?php echo $product['image_path']; ?>">
                                    <label for="quantity">Quantity:</label>
                                    <input type="number" id="quantity" name="quantity" min="1" max="<?php echo $product['stocks']; ?>" value="1"><br><br>
                                    
                                    <div class="button-group">
                                        <button class="blue-btn" type="submit" name="action" value="add_to_cart">Add to Cart</button>
                                        <button class="green-btn" type="submit" name="action" value="buy_now">Buy Now</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php'; ?>
        </div>
    </div>
</body>
</html>