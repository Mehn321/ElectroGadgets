<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Shopping Orders</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script>
        function updatePrice() {
            const quantities = document.querySelectorAll('input[name="quantity"]');
            const price = document.querySelectorAll('td:nth-child(4)');
            const subtotals = document.querySelectorAll('td:nth-child(5)');
            const totalElement = document.querySelector('#total');
            let total = 0;

            quantities.forEach((quantity, index) => {
                const newQuantity = parseInt(quantity.value);
                const unitPrice = parseFloat(price[index].textContent.replace(/[^\d.]/g, ''));
                const newSubtotal = newQuantity * unitPrice;
                subtotals[index].textContent = `₱ ${newSubtotal.toLocaleString()}`;
                total += newSubtotal;
            });

            totalElement.textContent = `₱ ${total.toLocaleString()}`;
        }
    </script>

</head>
<body>
    <div class="container">
        <?php include '../components/sidebar.php'; ?>

        <div class="rightside">
            <?php include '../components/header.php'; ?>
            <div class="main-content">
                <h2>Shopping Orders</h2>
                <div class="products-list">
                    <table border="1" align="center" cellspacing="0" class="product-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll"></th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox" class="checkbox"></td>
                                <td><img src="../assets/img/macbookpro.webp" alt="MacBook Pro" width="50" height="50"> Apple MacBook Pro (14-inch, M3)</td>
                                <td align="center"><input type="number" name="quantity" value="1" onchange="updatePrice()"></td>
                                <td>₱ 100,790</td>
                                <td>₱ 100,790</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox"></td>
                                <td><img src="../assets/img/iphone16Pro.webp" alt="iPhone 16 Pro" width="50" height="50"> Apple iPhone 16 Pro</td>
                                <td align="center"><input type="number" name="quantity" value="2" onchange="updatePrice()"></td>
                                <td>₱ 61,890</td>
                                <td>₱ 123,780</td>
                            </tr>
                            <tr>
                                <td colspan="4">Total</td>
                                <td id="total">₱ 224,570</td>
                            </tr>
                            <tr>
                                <td colspan="5" align="center">
                                    <button class="blue-btn" onclick="window.location.href='billing.php'">Checkout</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php';
        ?>
        </div>
    </div>
</body>
</html>
<?php
session_start();
require_once '../database/database.php';
$dataconn = new database();
$conn = $dataconn->getConnection();

// Check if user is logged in (assuming you have a user_id in session)
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get product information
    $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    
    // Process based on action
    if ($action === 'add_to_cart') {
        // Check if the product already exists in the user's cart
        $checkStmt = $conn->prepare("SELECT cart_id, quantity FROM cart WHERE user_id = ? AND product_id = ?");
        $checkStmt->bind_param("ii", $user_id, $productId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        
        if ($checkResult->num_rows > 0) {
            // Product already in cart, update quantity
            $cartItem = $checkResult->fetch_assoc();
            $newQuantity = $cartItem['quantity'] + $quantity;
            
            $updateStmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE cart_id = ?");
            $updateStmt->bind_param("ii", $newQuantity, $cartItem['cart_id']);
            $updateStmt->execute();
        } else {
            // Product not in cart, insert new record
            $insertStmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
            $insertStmt->bind_param("iii", $user_id, $productId, $quantity);
            $insertStmt->execute();
        }
        
        // Redirect to cart page
        header("Location: cart.php");
        exit;
    } 
    else if ($action === 'buy_now') {
        // For buy now, we can either:
        // 1. Add to cart and redirect to checkout
        // 2. Skip cart and go directly to checkout with this item
        
        // Option 1: Add to cart first
        $checkStmt = $conn->prepare("SELECT cart_id, quantity FROM cart WHERE user_id = ? AND product_id = ?");
        $checkStmt->bind_param("ii", $user_id, $productId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        
        if ($checkResult->num_rows > 0) {
            // Product already in cart, update quantity
            $cartItem = $checkResult->fetch_assoc();
            $newQuantity = $cartItem['quantity'] + $quantity;
            
            $updateStmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE cart_id = ?");
            $updateStmt->bind_param("ii", $newQuantity, $cartItem['cart_id']);
            $updateStmt->execute();
        } else {
            // Product not in cart, insert new record
            $insertStmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
            $insertStmt->bind_param("iii", $user_id, $productId, $quantity);
            $insertStmt->execute();
        }
        
        // Redirect to checkout
        header("Location: checkout.php");
        exit;
    }
}

// If we get here, redirect to products page
header("Location: products.php");
exit;
?>
