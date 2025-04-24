<?php
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
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
            $stocks = intval($_POST['stocks']);
            
            // Create product array for cart functions
            $product = [
                'product_id' => $product_id,
                'product_name' => $product_name,
                'price' => $price,
                'image' => $image,
                'stocks' => $stocks
            ];
            
            if ($_POST['action'] === 'add_to_cart') {
                // Add to cart using the session-based function
                $added = addToCart($product, $quantity);
                
                // Redirect back to the product page with a success message
                header("Location: product_details.php?id=$productId&added=1");
                exit;
            } elseif ($_POST['action'] === 'buy_now') {
                // Add to cart and redirect to billing page
                $added = addToCart($product, $quantity);
                
                // Create a temporary checkout item array with just this product
                $checkoutItem = [
                    'product_id' => $product_id,
                    'product_name' => $product_name,
                    'price' => $price,
                    'image' => $image,
                    'quantity' => $quantity,
                    'stocks' => $stocks
                ];

                // Store in session for checkout
                $_SESSION['checkout_items'] = [$checkoutItem];

                // Redirect to orders page
                header("Location: orders.php");
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
        
        /* Animation styles */
        .flying-image {
            position: absolute;
            z-index: 9999;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            pointer-events: none;
        }
        
        @keyframes cartBounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-10px);}
            60% {transform: translateY(-5px);}
        }
        
        .cart-bounce {
            animation: cartBounce 0.5s ease;
        }
        
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ff4757;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: scale(0);
            transition: all 0.3s ease;
        }
        
        .cart-badge.show {
            opacity: 1;
            transform: scale(1);
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
                                <img id="productImage" src="/ecommerce/<?php echo $product['image_path']; ?>" alt="<?php echo $product['product_name']; ?>" height="300px" width="300px">
                                <h2><?php echo $product['product_name']; ?></h2>
                            </td>
                            <td class="description">
                                <h3>Product Description:</h3>
                                <p><?php echo $product['description']; ?></p>
                                <br>
                                <h2>Price: ₱<?php echo number_format($product['price'], 2); ?></h2>
                                <p>Stock: <?php echo $product['stocks']; ?></p>
                                <form action="product_details.php?id=<?php echo $productId; ?>" method="post" id="purchaseForm">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <input type="hidden" name="product" value="<?php echo $product['product_name']; ?>">
                                    <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                                    <input type="hidden" name="image" value="<?php echo $product['image_path']; ?>">
                                    <input type="hidden" name="stocks" value="<?php echo $product['stocks']; ?>">
                                    <label for="quantity">Quantity:</label>
                                    <input type="number" id="quantity" name="quantity" min="1" max="<?php echo $product['stocks']; ?>" value="1"><br><br>
                                    
                                    <div class="button-group">
                                        <button class="blue-btn" type="button" id="addToCartBtn">
                                            <i class='bx bx-cart-add'></i> Add to Cart
                                        </button>
                                        <button class="green-btn" type="submit" name="action" value="buy_now">
                                            <i class='bx bx-purchase-tag'></i> Buy Now
                                        </button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add to cart animation
            $('#addToCartBtn').on('click', function(e) {
                e.preventDefault(); // Prevent the default form submission
                
                // Get positions
                var imgElement = $('#productImage');
                var cartIcon = $('.cart-icon');
                
                if (imgElement.length && cartIcon.length) {
                    // Create a clone of the image at its current position
                    var imgClone = imgElement.clone()
                        .removeClass()
                        .addClass('flying-image')
                        .css({
                            'position': 'fixed', // Use fixed positioning
                            'top': imgElement.offset().top - $(window).scrollTop(), // Adjust for scroll position
                            'left': imgElement.offset().left,
                            'width': imgElement.width(),
                            'height': imgElement.height(),
                            'opacity': 0.75,
                            'z-index': 1000
                        })
                        .appendTo('body');
                    
                    // First scroll to top to make the header/cart visible
                    $('html, body').animate({
                        scrollTop: 0
                    }, 400, function() {
                        // After scrolling, get the new cart position
                        var cartPosition = {
                            top: cartIcon.offset().top - $(window).scrollTop(), // Adjust for new scroll position
                            left: cartIcon.offset().left
                        };
                        
                        // Now animate the clone to the cart with longer duration
                        imgClone.animate({
                            top: cartPosition.top,
                            left: cartPosition.left,
                            width: 30,
                            height: 30,
                            opacity: 0.5
                        }, {
                            duration: 1000, // Increased from 800 to 1000ms
                            complete: function() {
                                // Add bounce effect to cart icon
                                cartIcon.addClass('cart-bounce');
                                
                                // Remove the clone
                                $(this).remove();
                                
                                // Remove bounce class after animation completes
                                // Increased delay from 500ms to 1000ms
                                setTimeout(function() {
                                    cartIcon.removeClass('cart-bounce');
                                    
                                    // Add the hidden input for add_to_cart action and submit the form
                                    $('#purchaseForm').append('<input type="hidden" name="action" value="add_to_cart">');
                                    $('#purchaseForm').submit();
                                }, 1000); // Increased delay to ensure animation is visible
                            }
                        });
                    });
                } else {
                    // If elements not found, just submit the form with add_to_cart action
                    $('#purchaseForm').append('<input type="hidden" name="action" value="add_to_cart">');
                    $('#purchaseForm').submit();
                }
            });
        });
        </script>
</body>
</html>