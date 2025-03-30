<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Earbuds</title>
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
                <h1>EARBUDS</h1>
                <div class="products products-category">
                    <button class="product-btn" onclick="window.location.href='product_details/airpods4.php'">
                        <img src="../../assets/img/airpods4.webp" alt="AirPods 4" height="200px" width="200px">
                        <span>AirPods 4</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/airpodspro2.php'">
                        <img src="../../assets/img/airpods2pro.webp" alt="AirPods Pro 2" height="200px" width="200px">
                        <span>AirPods Pro 2</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/beatssolobuds.php'">
                        <img src="../../assets/img/beatssolobuds.webp" alt="Beats Solo Buds" height="200px" width="200px">
                        <span>Beats Solo Buds</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/galaxybuds2pro.php'">
                        <img src="../../assets/img/galaxybuds2pro.webp" alt="Galaxy Buds2 Pro" height="200px" width="200px">
                        <span>Galaxy Buds2 Pro</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/jabra85t.php'">
                        <img src="../../assets/img/jabra85t.webp" alt="Jabra Elite 85t" height="200px" width="200px">
                        <span>Jabra Elite 85t</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/sonyxm4.php'">
                        <img src="../../assets/img/sonyxm4.webp" alt="Sony WF-1000XM4" height="200px" width="200px">
                        <span>Sony WF-1000XM4</span>
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
