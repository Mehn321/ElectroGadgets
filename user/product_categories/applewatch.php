<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Apple Watch</title>
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/image-zoom.css">

</head>
<body>
    <div class="container">
                <?php include '../../components/sidebar.php'; ?>
        <div class="rightside">
            <?php include '../../components/header.php'; ?>

            <div class="main-content">
                <h1>APPLE WATCH</h1>
                <div class="products products-category">
                    <button class="product-btn" onclick="window.location.href='product_details/applewatchse2nd.php'">
                        <img src="../../assets/img/appleWatchSE2nd.webp" alt="Apple Watch SE 2nd Gen" height="200px" width="200px">
                        <span>Apple Watch SE 2nd Gen</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/applewatchseries10.php'">
                        <img src="../../assets/img/appleWatchSeries10.webp" alt="Apple Watch Series 10" height="200px" width="200px">
                        <span>Apple Watch Series 10</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/applewatchultra2.php'">
                        <img src="../../assets/img/appleWatchultra2.webp" alt="Apple Watch Ultra 2" height="200px" width="200px">
                        <span>Apple Watch Ultra 2</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/applewatchnike.php'">
                        <img src="../../assets/img/appleWatchNike.webp" alt="Apple Watch Nike Series" height="200px" width="200px">
                        <span>Apple Watch Nike Series</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/applewatchhermes.php'">
                        <img src="../../assets/img/appleWatchHermes.webp" alt="Apple Watch Hermès" height="200px" width="200px">
                        <span>Apple Watch Hermès</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/applewatchtitanium.php'">
                        <img src="../../assets/img/appleWatchTitanium.webp" alt="Apple Watch Series 9" height="200px" width="200px">
                        <span>Apple Watch Series 9</span>
                    </button>
                </div>
            </div>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php';
        ?>
        </div>
    </div>

    <!-- Add the image zoom JavaScript -->
    <script src="../../assets/js/image-zoom.js"></script>
</body>
</html>