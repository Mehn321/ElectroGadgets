<?php
    require_once '../database/database.php';
    $dataconn = new database();
    $conn = $dataconn->getConnection();
?>
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
    <?php include '../components/sidebar.php'; ?>
        <div class="rightside">
            <?php include '../components/header.php'; ?>

            <div class="main-content">
                <h1>PRODUCTS</h1>
                <div class="products">
                    <?php
                        $sql = "SELECT 
                                category.category_name, 
                                MIN(products.image_path) AS image_path
                                FROM products
                                INNER JOIN category ON products.category_id = category.category_id
                                GROUP BY category.category_id, category.category_name;";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            $category_name = $row['category_name'];
                            $image_path = $row['image_path'];

                            echo '<button class="product-btn" onclick="window.location.href=\'product_category.php?category=' . urlencode($category_name) . '\'">';
                            echo '<img src="/ecommerce/'.$image_path.'" alt="' . $category_name . '" height="200px" width="200px">';
                            echo '<span>' . $category_name . '</span>';
                            echo '</button>';
                        }
                    ?>
                    
                </div>
            </div>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php';
        ?>
        </div>
    </div>
</body>
</html>