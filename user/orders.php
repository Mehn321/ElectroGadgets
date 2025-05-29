<?php
session_start();
require_once '../src/cart_functions.php';

// Check if checkout items exist in session
if (!isset($_SESSION['checkout_items']) || empty($_SESSION['checkout_items'])) {
    // If no checkout items, redirect back to cart
    header("Location: cart.php?error=no_items_selected");
    exit;
}

$checkoutItems = $_SESSION['checkout_items'];

// Handle form submission to proceed to billing
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'proceed_to_billing') {
    // Redirect to billing page
    header("Location: billing.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Order Review</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/price.css">
</head>
<body>
    <div class="container">
        <?php include '../components/sidebar.php'; ?>

        <div class="rightside">
            <?php include '../components/header.php'; ?>
            <div class="main-content">
                <h2>Order Review</h2>
                <div class="products-list">
                    <form method="post" action="orders.php">
                        <table border="1" align="center" cellspacing="0" class="product-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $total = 0;
                                foreach ($checkoutItems as $item): 
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $total += $subtotal;
                                ?>
                                <tr>
                                    <td>
                                        <div class="product-info">
                                            <img src="/ecommerce/<?php echo $item['image']; ?>" alt="<?php echo $item['product_name']; ?>" width="50" height="50">
                                            <?php echo $item['product_name']; ?>
                                        </div>
                                    </td>
                                    <td align="center">
                                        <?php echo $item['quantity']; ?>
                                    </td>
                                    <td class="price-cell"> 
                                        <p>₱ <?php echo number_format($item['price'], 2); ?></p>
                                    </td>
                                    <td class="price-cell">
                                        ₱ <?php echo number_format($subtotal, 2); ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="3"><strong>Total</strong></td>
                                    <td id="total" class="price-cell">₱ <?php echo number_format($total, 2); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="center">
                                        <a href="cart.php" class="blue-btn">Back to Cart</a>
                                        <input type="hidden" name="action" value="proceed_to_billing">
                                        <button type="submit" class="green-btn">Proceed to Billing</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php'; ?>
        </div>
    </div>
</body>
</html>