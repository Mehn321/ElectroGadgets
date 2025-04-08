<?php
    require_once '../database/database.php';
    $dataconn = new database();
    $conn = $dataconn->getConnection();
    
    // Get category from URL parameter
    $category = isset($_GET['category']) ? $_GET['category'] : '';
    
    // Fetch category details
    $stmt = $conn->prepare("SELECT category_id, category_name FROM category WHERE category_name = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $categoryResult = $stmt->get_result();
    $categoryData = $categoryResult->fetch_assoc();
    
    if (!$categoryData) {
        // Redirect to products page if category not found
        header("Location: ../products.php");
        exit;
    }
    
    $categoryId = $categoryData['category_id'];
    $categoryName = $categoryData['category_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - <?php echo $categoryName; ?></title>
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
                <h1><?php echo strtoupper($categoryName); ?></h1>
                <div class="products products-category">
                    <?php
                        // Fetch products for this category
                        $sql = "SELECT product_id, product_name, image_path 
                                FROM products 
                                WHERE category_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $categoryId);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        // Debug information
                        echo "<!-- Category ID: " . $categoryId . " -->";
                        echo "<!-- Number of products found: " . $result->num_rows . " -->";
                        
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $productId = $row['product_id'];
                                $productName = $row['product_name'];
                                $imagePath = $row['image_path'];
                                
                                // Debug information
                                echo "<!-- Product ID: " . $productId . ", Name: " . $productName . ", Image: " . $imagePath . " -->";
                                
                                // Generate a URL-friendly version of the product name
                                $productSlug = strtolower(str_replace(' ', '', $productName));
                                
                                // Link directly to the product details page with the product ID as a parameter
                                $productUrl = 'product_details.php?id=' . $productId;
                                
                                echo '<button class="product-btn" onclick="window.location.href=\'' . $productUrl . '\'">';
                                echo '<img src="/ecommerce/' . $imagePath . '" alt="' . $productName . '" height="200px" width="200px">';
                                echo '<span>' . $productName . '</span>';
                                echo '</button>';
                            }
                        } else {
                            echo '<p>No products found in this category.</p>';
                        }
                    ?>
                </div>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php'; ?>
        </div>
    </div>
</body>
</html>
