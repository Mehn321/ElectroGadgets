<?php
require_once '../database/database.php';
$dataconn = new database();
$conn = $dataconn->getConnection();

// Get product ID from URL parameter
$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($productId > 0) {
    // Fetch product details
    $stmt = $conn->prepare("SELECT p.product_id, p.product_name, p.image_path, p.price, p.stocks, p.description, p.category_id, c.category_name 
                           FROM products p
                           JOIN category c ON p.category_id = c.category_id
                           WHERE p.product_id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    
    // Return product data as JSON
    header('Content-Type: application/json');
    echo json_encode($product);
} else {
    // Return error if no product ID provided
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'Invalid product ID']);
}
?>
