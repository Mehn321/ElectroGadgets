<?php
    session_start();
    require_once '../database/database.php';
    $dataconn = new database();
    $conn = $dataconn->getConnection();
    
    // Initialize cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    // Handle cart actions
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        
        if ($action == 'update') {
            // Update quantity
            $productId = $_POST['product_id'];
            $quantity = $_POST['quantity'];
            
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['product_id'] == $productId) {
                    $item['quantity'] = $quantity;
                    break;
                }
            }
        } 
        else if ($action == 'remove') {
            // Remove item from cart
            $productId = $_POST['product_id'];
            
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['product_id'] == $productId) {
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
            // Reindex the array
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
        else if ($action == 'clear') {
            // Clear the entire cart
            $_SESSION['cart'] = array();
        }
        
        // Redirect to prevent form resubmission
        header("Location: cart.php");
        exit;
    }
    
    // Calculate cart totals
    $subtotal = 0;
    foreach ($_SESSION['cart'] as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    
    // Apply tax (e.g., 10%)
    $tax = $subtotal * 0.10;
    $total = $subtotal + $tax;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Shopping Cart</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .cart-container {
            width: 100%;
            padding: 20px;
        }
        
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .cart-table th, .cart-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .cart-table th {
            background-color: #f2f2f2;
        }
        
        .cart-image {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
        
        .quantity-input {
            width: 60px;
            padding: 5px;
        }
        
        .cart-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        
        .cart-summary {
            width: 300px;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            margin-top: 20px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .checkout-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 10px;
        }
        
        .checkout-btn:hover {
            background-color: #45a049;
        }
        
        .continue-shopping {
            background-color: #2196F3;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        
        .continue-shopping:hover {
            background-color: #0b7dda;
        }
        
        .remove-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .remove-btn:hover {
            background-color: #d32f2f;
        }
        
        .empty-cart {
            text-align: center;
            padding: 50px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include '../components/sidebar.php'; ?>
        <div class="rightside">
            <?php include '../components/header.php'; ?>

            <div class="main-content">
                <h1>Shopping Cart</h1>
                
                <div class="cart-container">
                    <?php if (empty($_SESSION['cart'])): ?>
                        <div class="empty-cart">
                            <h2>Your cart is empty</h2>
                            <p>Looks like you haven't added any products to your cart yet.</p>
                            <a href="products.php" class="continue-shopping">Continue Shopping</a>
                        </div>
                    <?php else: ?>
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($_SESSION['cart'] as $item): ?>
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center;">
                                                <img src="/ecommerce/<?php echo $item['image']; ?>" alt="<?php echo $item['product_name']; ?>" class="cart-image">
                                                <span style="margin-left: 10px;"><?php echo $item['product_name']; ?></span>
                                            </div>
                                        </td>
                                        <td>₱<?php echo number_format($item['price'], 2); ?></td>
                                        <td>
                                            <form method="post" style="display: flex; align-items: center;">
                                                <input type="hidden" name="action" value="update">
                                                <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="quantity-input">
                                                <button type="submit" style="margin-left: 5px; background-color: #4CAF50; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">Update</button>
                                            </form>
                                        </td>
                                        <td>₱<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                                        <td>
                                            <form method="post">
                                                <input type="hidden" name="action" value="remove">
                                                <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                                <button type="submit" class="remove-btn">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        
                        <div class="cart-actions">
                            <a href="products.php" class="continue-shopping">Continue Shopping</a>
                            
                            <form method="post">
                                <input type="hidden" name="action" value="clear">
                                <button type="submit" style="background-color: #f44336; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;">Clear Cart</button>
                            </form>
                        </div>
                        
                        <div class="cart-summary">
                            <h3>Order Summary</h3>
                            <div class="summary-row">
                                <span>Subtotal:</span>
                                <span>₱<?php echo number_format($subtotal, 2); ?></span>
                            </div>
                            <div class="summary-row">
                                <span>Tax (10%):</span>
                                <span>₱<?php echo number_format($tax, 2); ?></span>
                            </div>
                            <div class="summary-row" style="font-weight: bold; margin-top: 10px; padding-top: 10px; border-top: 1px solid #ddd;">
                                <span>Total:</span>
                                <span>₱<?php echo number_format($total, 2); ?></span>
                            </div>
                            <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php'; ?>
        </div>
    </div>
</body>
</html>
