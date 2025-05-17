<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Delivery Date</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="/ecommerce/assets/css/delivery_date_1.css">
</head>
<body>
    <div class="container">
        <?php include '../components/sidebar.php'; ?>

        <div class="rightside">
            <?php include '../components/header.php'; ?>

            <div class="main-content height">
                <div class="delivery-message">
                    <h1 cla>Thank you for your order!</h1>
                    <p>Your order will be delivered within <strong>7 days</strong>.</p>
                </div>
            </div>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php';
        ?>
        </div>
    </div>
</body>
</html>