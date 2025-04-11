<?php
// Include database connection
require_once $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/database/database.php';

// Initialize database connection
$db = new database();
$conn = $db->getConnection();

// Get search query
$search_query = isset($_GET['query']) ? trim($_GET['query']) : '';

// Initialize products array
$products = [];

if (!empty($search_query)) {
    // Prepare the search query with wildcards for partial matches
    $search_term = "%" . $conn->real_escape_string($search_query) . "%";
    
    // SQL query to search for products with category join
    $sql = "SELECT p.*, c.category_name 
            FROM products p
            JOIN category c ON p.category_id = c.category_id
            WHERE p.product_name LIKE ? 
            OR p.description LIKE ? 
            OR c.category_name LIKE ?
            ORDER BY p.product_name";
    
    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $search_term, $search_term, $search_term);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Fetch all products that match the search query
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Search Results</title>
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
                <h1>Search Results for "<?php echo htmlspecialchars($search_query); ?>"</h1>
                
                <?php if (empty($search_query)): ?>
                    <p>Please enter a search term.</p>
                <?php elseif (empty($products)): ?>
                    <p>No products found matching your search.</p>
                <?php else: ?>
                    <p>Found <?php echo count($products); ?> result(s).</p>
                    
                    <div class="products products-category">
                        <?php foreach ($products as $product): ?>
                            <?php
                                $productId = $product['product_id'];
                                $productName = $product['product_name'];
                                $imagePath = $product['image_path'];
                                
                                // Link directly to the product details page with the product ID as a parameter
                                $productUrl = 'product_details.php?id=' . $productId;
                            ?>
                            <button class="product-btn" onclick="window.location.href='<?php echo $productUrl; ?>'">
                                <img src="/ecommerce/<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($productName); ?>" height="200px" width="200px">
                                <span><?php echo htmlspecialchars($productName); ?></span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php'; ?>
        </div>
    </div>
</body>
</html>