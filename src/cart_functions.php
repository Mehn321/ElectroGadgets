<?php
session_start();

// Database connection
require_once $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/database/database.php';

// Initialize the database connection
function getDbConnection() {
    $db = new database();
    return $db->getConnection();
}

// Get cart session ID
function getCartSessionId() {
    if (!isset($_SESSION['cart_session_id'])) {
        $_SESSION['cart_session_id'] = session_id();
    }
    return $_SESSION['cart_session_id'];
}

// Add item to cart
function addToCart($product_id, $product_name, $price, $image, $quantity) {
    $conn = getDbConnection();
    $session_id = getCartSessionId();
    
    // Check if product already exists in cart
    $stmt = $conn->prepare("SELECT * FROM cart WHERE session_id = ? AND product_id = ?");
    $stmt->bind_param("si", $session_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Update quantity if product exists
        $row = $result->fetch_assoc();
        $new_quantity = $row['quantity'] + $quantity;
        
        $update_stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE cart_id = ?");
        $update_stmt->bind_param("ii", $new_quantity, $row['cart_id']);
        $update_stmt->execute();
        $update_stmt->close();
    } else {
        // Add new item if not found
        $insert_stmt = $conn->prepare("INSERT INTO cart (session_id, product_id, quantity) VALUES (?, ?, ?)");
        $insert_stmt->bind_param("sii", $session_id, $product_id, $quantity);
        $insert_stmt->execute();
        $insert_stmt->close();
    }
    
    $stmt->close();
    return true;
}

// Get cart items with product details using JOIN
function getCartItems() {
    $conn = getDbConnection();
    $session_id = getCartSessionId();
    
    $stmt = $conn->prepare("
        SELECT c.cart_id, c.product_id, c.quantity, 
               p.product_name, p.price, p.image_path as image, p.stocks
        FROM cart c
        JOIN products p ON c.product_id = p.product_id
        WHERE c.session_id = ?
    ");
    $stmt->bind_param("s", $session_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    
    $stmt->close();
    return $items;
}

// Get cart total
function getCartTotal() {
    $conn = getDbConnection();
    $session_id = getCartSessionId();
    
    $stmt = $conn->prepare("
        SELECT SUM(p.price * c.quantity) as total
        FROM cart c
        JOIN products p ON c.product_id = p.product_id
        WHERE c.session_id = ?
    ");
    $stmt->bind_param("s", $session_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $stmt->close();
    return $row['total'] ?? 0;
}

// Remove item from cart
function removeFromCart($product_id) {
    $conn = getDbConnection();
    $session_id = getCartSessionId();
    
    $stmt = $conn->prepare("DELETE FROM cart WHERE session_id = ? AND product_id = ?");
    $stmt->bind_param("si", $session_id, $product_id);
    $stmt->execute();
    $result = $stmt->affected_rows > 0;
    
    $stmt->close();
    return $result;
}

// Update cart item quantity
function updateCartItemQuantity($product_id, $quantity) {
    $conn = getDbConnection();
    $session_id = getCartSessionId();
    
    $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE session_id = ? AND product_id = ?");
    $stmt->bind_param("isi", $quantity, $session_id, $product_id);
    $stmt->execute();
    $result = $stmt->affected_rows > 0;
    
    $stmt->close();
    return $result;
}

// Clear cart
function clearCart() {
    $conn = getDbConnection();
    $session_id = getCartSessionId();
    
    $stmt = $conn->prepare("DELETE FROM cart WHERE session_id = ?");
    $stmt->bind_param("s", $session_id);
    $stmt->execute();
    
    $stmt->close();
    return true;
}

// Check if a product is in the cart
function isProductInCart($product_id) {
    $conn = getDbConnection();
    $session_id = getCartSessionId();
    
    $stmt = $conn->prepare("SELECT * FROM cart WHERE session_id = ? AND product_id = ?");
    $stmt->bind_param("si", $session_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $isInCart = $result->num_rows > 0;
    
    $stmt->close();
    return $isInCart;
}

// Get cart item count
function getCartItemCount() {
    $conn = getDbConnection();
    $session_id = getCartSessionId();
    
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM cart WHERE session_id = ?");
    $stmt->bind_param("s", $session_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $stmt->close();
    return $row['count'] ?? 0;
}
?>
