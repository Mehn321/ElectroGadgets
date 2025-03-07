<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Smart TV</title>
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <?php
        require_once '../../config.php';
    ?>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="../home.php"><i class='bx bx-home'></i><span>Home</span></a></li>
                <li><a href="../products.php"><i class='bx bx-box'></i><span>Products</span></a></li>
                <li><a href="../contacts.php"><i class='bx bx-book'></i><span>Contacts</span></a></li>
                <li><a href="../../admin/login.php"><i class='bx bx-log-in'></i><span>Login</span></a></li>
            </ul>
        </div>
        <div class="rightside">
            <header class="main-header">
                <div class="logo-container">
                    <img src="../../assets/img/ElectroGadgets.png" width="70" alt="Logo">
                    <h1>ElectroGadgets</h1>
                </div>
            </header>
            <div class="main-content">
                <h1>SMART TV</h1>
                <div class="products products-category">
                    <button class="product-btn" onclick="window.location.href='product_details/nvision.php'">
                        <img src="../../assets/img/nvision.webp" alt="Nvision 32 Smart TV" height="200px" width="200px">
                        <span>Nvision 32" Smart TV</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/xiaomitv.php'">
                        <img src="../../assets/img/xiaomismarttva2025.webp" alt="Xiaomi Smart TV" height="200px" width="200px">
                        <span>Xiaomi Smart TV A 2025</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/crystaluhd.php'">
                        <img src="../../assets/img/crystaluhd.webp" alt="Crystal UHD" height="200px" width="200px">
                        <span>Crystal UHD DU7000</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/samsungqled.php'">
                        <img src="../../assets/img/samsungqled.webp" alt="Samsung QLED" height="200px" width="200px">
                        <span>Samsung QLED Q60C</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/lgoled.php'">
                        <img src="../../assets/img/lgoled.webp" alt="LG OLED" height="200px" width="200px">
                        <span>LG C3 OLED evo</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/sonytv.php'">
                        <img src="../../assets/img/sonytv.webp" alt="Sony BRAVIA" height="200px" width="200px">
                        <span>Sony BRAVIA XR A80L</span>
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
