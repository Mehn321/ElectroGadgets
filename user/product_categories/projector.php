<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Projectors</title>
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
                <h1>PROJECTOR</h1>
                <div class="products products-category">
                    <button class="product-btn" onclick="window.location.href='product_details/wanbodali1.php'">
                        <img src="../../assets/img/dali1.webp" alt="Wanbo Dali 1" height="200px" width="200px">
                        <span>Wanbo Dali 1</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/t2max.php'">
                        <img src="../../assets/img/t2max.webp" alt="Wanbo T2 Max" height="200px" width="200px">
                        <span>Wanbo T2 Max</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/t2ultra.php'">
                        <img src="../../assets/img/t2ultra.webp" alt="Wanbo T2 Ultra" height="200px" width="200px">
                        <span>Wanbo T2 Ultra</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/t3pro.php'">
                        <img src="../../assets/img/t3pro.webp" alt="Wanbo T3 Pro" height="200px" width="200px">
                        <span>Wanbo T3 Pro</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/t6max.php'">
                        <img src="../../assets/img/t6max.webp" alt="Wanbo T6 Max" height="200px" width="200px">
                        <span>Wanbo T6 Max</span>
                    </button>

                    <button class="product-btn" onclick="window.location.href='product_details/x1promax.php'">
                        <img src="../../assets/img/x1.webp" alt="Wanbo X1 Pro Max" height="200px" width="200px">
                        <span>Wanbo X1 Pro Max</span>
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
