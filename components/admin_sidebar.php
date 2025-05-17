<?php
if (ob_get_level() == 0) ob_start();
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: /ecommerce/user/home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- <link rel="stylesheet" href="../assets/css/image_animation.css"> -->
</head>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="/ecommerce/admin/dashboard.php" class="nav-link"><i class='bx bx-grid-alt'></i><span>Dashboard</span></a></li>
            <li><a href="/ecommerce/admin/products.php" class="nav-link"><i class='bx bx-box'></i><span>Products</span></a></li>
            <li><a href="/ecommerce/admin/reports.php" class="nav-link"><i class='bx bx-line-chart'></i><span>Reports</span></a></li>
            <li><a href="/ecommerce/src/logout.php" class="nav-link"><i class='bx bx-log-out'></i><span>Logout</span></a></li>
        </ul>
    </div>

    <script src="/ecommerce/assets/js/admin_sidebar_1.js"></script>
</body>
</html>
