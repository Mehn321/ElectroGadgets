<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Gaming Consoles</title>
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
                <h1>GAMING CONSOLES</h1>
                <div class="products products-category">
                    <button class="product-btn" onclick="window.location.href='product_details/msiclaw.php'">
                        <img src="../../assets/img/msiclaw.webp" alt="MSI Claw A1M" height="200px" width="200px">
                        <span>MSI Claw A1M</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/ps5slim.php'">
                        <img src="../../assets/img/ps5slim.webp" alt="PS5 Slim" height="200px" width="200px">
                        <span>PS5 Slim</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/steamdeck.php'">
                        <img src="../../assets/img/steamdeck.webp" alt="Steam Deck" height="200px" width="200px">
                        <span>Steam Deck</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/switcholed.php'">
                        <img src="../../assets/img/switch.webp" alt="Nintendo Switch OLED" height="200px" width="200px">
                        <span>Nintendo Switch OLED</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/xboxseriess.php'">
                        <img src="../../assets/img/xboxseriess.webp" alt="Xbox Series S" height="200px" width="200px">
                        <span>Xbox Series S</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/xboxseriesx.php'">
                        <img src="../../assets/img/xboxseriesx.webp" alt="Xbox Series X" height="200px" width="200px">
                        <span>Xbox Series X</span>
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
