<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Mac</title>
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">

</head>
<body>
    <div class="container">
                <?php include '../../components/sidebar.php'; ?>
        <div class="rightside">
            <?php include '../../components/header.php'; ?>

            <div class="main-content">
                <h1>MAC</h1>
                <div class="products products-category">
                    <button class="product-btn" onclick="window.location.href='product_details/imac24.php'">
                        <img src="../../assets/img/imac.webp" alt="iMac 24 M3" height="200px" width="200px">
                        <span>iMac 24 M3</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/macbookair15.php'">
                        <img src="../../assets/img/macbookair.webp" alt="MacBook Air 15 M3" height="200px" width="200px">
                        <span>MacBook Air 15 M3</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/macbookpro14.php'">
                        <img src="../../assets/img/macbookpro.webp" alt="MacBook Pro 14 M3" height="200px" width="200px">
                        <span>MacBook Pro 14 M3</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/macmini.php'">
                        <img src="../../assets/img/macmini.webp" alt="Mac mini M2 Pro" height="200px" width="200px">
                        <span>Mac mini M2 Pro</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/macpro.php'">
                        <img src="../../assets/img/macpro.webp" alt="Mac Pro M2 Ultra" height="200px" width="200px">
                        <span>Mac Pro M2 Ultra</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/macstudio.php'">
                        <img src="../../assets/img/macstudio.webp" alt="Mac Studio M2 Ultra" height="200px" width="200px">
                        <span>Mac Studio M2 Ultra</span>
                    </button>
                </div>
            </div>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php';
        ?>
        </div>
    </div>
</body>
</html>