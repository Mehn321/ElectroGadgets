<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/image_animation.css">

</head>
<body>
            <header class="main-header">
                <div class="header-container">
                    <div class="top-header">
                        <div class="logo-container">
                            <img src="/ecommerce/assets/img/ElectroGadgets.png" width="70" alt="Logo">
                            <h1>ElectroGadgets</h1>
                        </div>
                    </div>
                    <div class="bottom-header">
                        <div class="search-container">
                            <form action="/ecommerce/user/search_results.php" method="GET">
                                <input type="text" name="query" placeholder="Search products..." required>
                                <button type="submit"><i class='bx bx-search'></i></button>
                            </form>
                        </div>
                        <a href="/ecommerce/user/cart.php" class="cart-icon">
                            <i class='bx bx-cart'></i>
                        </a>
                    </div>
                </div>
            </header>
</body>
</html>