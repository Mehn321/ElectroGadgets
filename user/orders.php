<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Shopping Orders</title>
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
                                <td align="center"><input type="number" name="quantity" value="1"></td>
                                <td>₱ 100,790</td>
                                <td>₱ 100,790</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox"></td>
                                <td><img src="../assets/img/iphone16Pro.webp" alt="iPhone 16 Pro" width="50" height="50"> Apple iPhone 16 Pro</td>
                                <td align="center"><input type="number" name="quantity" value="2"></td>
                                <td>₱ 61,890</td>
                                <td>₱ 123,780</td>
                            </tr>
                            <tr>
                                <td colspan="4">Total</td>
                                <td>₱ 224,570</td>
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