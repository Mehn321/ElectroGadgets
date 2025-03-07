<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <li>
                    <a href="home.php">
                        <i class='bx bx-home'></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="products.php">
                        <i class='bx bx-box'></i>
                        <span>Products</span>
                    </a>
                </li>
                <li>
                    <a href="contacts.php">
                        <i class='bx bx-book'></i>
                        <span>Contacts</span>
                    </a>
                </li>
                <li>
                    <a href="../admin/login.php">
                        <i class='bx bx-log-in'></i>
                        <span>Login</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="rightside">
            <header class="main-header">
                <div class="logo-container">
                    <img src="../assets/img/ElectroGadgets.png" width="70" alt="Logo">
                    <h1>ElectroGadgets</h1>
                </div>
            </header>
            <div class="main-content">
                <h1>PRODUCTS</h1>
                <div class="products">

                    <button class="product-btn" onclick="window.location.href='product_categories/gamingconsole.php'">
                        <img src="../assets/img/ps5slim.webp" alt="PSP Console" height="200px" width="200px">
                        <span>Console</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_categories/projector.php'">
                        <img src="../assets/img/projector.webp" alt="Projector" height="200px" width="200px">
                        <span>Projector</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_categories/smarttv.php'">
                        <img src="../assets/img/crystaluhd.webp" alt="Smart TV" height="200px" width="200px">
                        <span>Smart TV</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_categories/ipad.php'">
                        <img src="../assets/img/ipad.webp" alt="iPad" height="200px" width="200px">
                        <span>iPad</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_categories/earbuds.php'">
                        <img src="../assets/img/airpods.webp" alt="AirPods" height="200px" width="200px">
                        <span>Earbuds</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_categories/applewatch.php'">
                        <img src="../assets/img/apple_watch.webp" alt="Apple Watch" height="200px" width="200px">
                        <span>Apple Watch</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_categories/iphones.php'">
                        <img src="../assets/img/iphones.webp" alt="iPhones" height="200px" width="200px">
                        <span>iPhones</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_categories/mac.php'">
                        <img src="../assets/img/macbook.webp" alt="MacBook" height="200px" width="200px">
                        <span>Mac</span>
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