<?php
session_start();

// Check if order information exists in session
if (!isset($_SESSION['order']) || empty($_SESSION['order'])) {
    header("Location: cart.php");
    exit;
}

$order = $_SESSION['order'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Order Confirmation</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/delivery_date.css">
    <link rel="stylesheet" href="../ecommerce/assets/css/delivery_date_1.css">

    <style>
        
    </style>
</head>
<body>
    <div class="container">
        <?php include '../components/sidebar.php'; ?>

        <div class="rightside">
            <?php include '../components/header.php'; ?>

            <div class="main-content">
                <div class="delivery-container">
                    <div class="step-indicator">
                        <div class="step completed">
                            <div class="step-number">1</div>
                            <div class="step-label">Shopping Cart</div>
                        </div>
                        <div class="step completed">
                            <div class="step-number">2</div>
                            <div class="step-label">Billing Information</div>
                        </div>
                        <div class="step active">
                            <div class="step-number">3</div>
                            <div class="step-label">Delivery Date</div>
                        </div>

                    </div>
                    
                    <div class="delivery-message">
                        <h1><i class='bx bx-check-circle success-icon'></i> Thank you for your order!</h1>
                        <p>Your order has been received and is being processed. You will receive a confirmation email shortly.</p>
                        <p>Your items will be delivered within <strong>7 days</strong> to your shipping address.</p>
                        <div class="order-number">
                            Order Number: <?php echo $order['order_number']; ?>
                        </div>
                    </div>
                    
                    <div class="order-summary">
                        <h2><i class='bx bx-receipt'></i> Order Summary</h2>
                        <div class="order-details">
                            <p><strong>Order Date:</strong> <?php echo date('F j, Y, g:i a', strtotime($order['date'])); ?></p>
                            <p><strong>Customer Name:</strong> <?php echo $order['customer']['name']; ?></p>
                            <p><strong>Shipping Address:</strong> <?php echo $order['customer']['address']; ?></p>
                            <p><strong>Payment Method:</strong> <?php echo $order['payment_method']; ?></p>
                        </div>
                        
                        <div class="order-items">
                            <h3><i class='bx bx-package'></i> Items Ordered</h3>
                            <?php foreach ($order['items'] as $item): ?>
                                <div class="order-item">
                                    <div class="order-item-name">
                                        <?php echo $item['product_name']; ?>
                                        <span class="order-item-quantity">x<?php echo $item['quantity']; ?></span>
                                    </div>
                                    <div class="order-item-price">₱<?php echo number_format($item['price'] * $item['quantity'], 2); ?></div>
                                </div>
                            <?php endforeach; ?>
                            
                            <div class="order-total">
                                <div>Total Amount</div>
                                <div>₱<?php echo number_format($order['total'], 2); ?></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="button-container">
                        <button class="continue-shopping pulse-animation" onclick="window.location.href='home.php'">
                            <i class='bx bx-shopping-bag'></i> Continue Shopping
                        </button>
                    </div>
                </div>
            </div>
            
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php'; ?>
        </div>
    </div>
</body>
</html>
