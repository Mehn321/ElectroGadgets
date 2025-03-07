<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - iPad</title>
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
                <h1>iPAD</h1>
                <div class="products products-category">
                    <button class="product-btn" onclick="window.location.href='product_details/ipad9th.php'">
                        <img src="../../assets/img/ipad9th.webp" alt="iPad 9th Gen" height="200px" width="200px">
                        <span>iPad 9th Gen</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/ipad10th.php'">
                        <img src="../../assets/img/ipad10th.webp" alt="iPad 10th Gen" height="200px" width="200px">
                        <span>iPad 10th Gen</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/ipadair4th.php'">
                        <img src="../../assets/img/ipadair4th.webp" alt="iPad Air 4th Gen" height="200px" width="200px">
                        <span>iPad Air 4th Gen</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/ipadair13.php'">
                        <img src="../../assets/img/ipadair13inch.webp" alt="iPad Air 13" height="200px" width="200px">
                        <span>iPad Air 13</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/ipadmini.php'">
                        <img src="../../assets/img/ipadmini7th.webp" alt="iPad Mini" height="200px" width="200px">
                        <span>iPad Mini</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/ipadpro11.php'">
                        <img src="../../assets/img/ipadpro11inch.webp" alt="iPad Pro 11 M4" height="200px" width="200px">
                        <span>iPad Pro 11 M4</span>
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
