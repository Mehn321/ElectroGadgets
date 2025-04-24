<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Rest of your cart functions...

/**
 * Initialize the cart in session if it doesn't exist
 */
function initCart() {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
}

/**
 * Add a product to the cart
 * 
 * @param array $product Product data to add to cart
 * @param int $quantity Quantity to add
 * @return bool Success status
 */
function addToCart($product, $quantity = 1) {
    initCart();
    
    $productId = $product['product_id'];
    
    // Check if product already exists in cart
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $productId) {
            // Update quantity
            $item['quantity'] += $quantity;
            return true;
        }
    }
    
    // Product not in cart, add it
    $product['quantity'] = $quantity;
    $_SESSION['cart'][] = $product;
    return true;
}

/**
 * Remove a product from the cart
 * 
 * @param int $productId ID of product to remove
 * @return bool Success status
 */
function removeFromCart($productId) {
    initCart();
    
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['product_id'] == $productId) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
            return true;
        }
    }
    
    return false;
}

/**
 * Update the quantity of a product in the cart
 * 
 * @param int $productId ID of product to update
 * @param int $quantity New quantity
 * @return bool Success status
 */
function updateCartItemQuantity($productId, $quantity) {
    initCart();
    
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $productId) {
            $item['quantity'] = $quantity;
            return true;
        }
    }
    
    return false;
}

/**
 * Get all items in the cart
 * 
 * @return array Cart items
 */
function getCartItems() {
    initCart();
    return $_SESSION['cart'];
}

/**
 * Get the total number of items in the cart
 * 
 * @return int Total items
 */
function getCartItemCount() {
    initCart();
    
    $count = 0;
    foreach ($_SESSION['cart'] as $item) {
        $count += $item['quantity'];
    }
    
    return $count;
}

/**
 * Get the total price of all items in the cart
 * 
 * @return float Total price
 */
function getCartTotal() {
    initCart();
    
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    
    return $total;
}

/**
 * Clear all items from the cart
 * 
 * @return bool Success status
 */
function clearCart() {
    $_SESSION['cart'] = [];
    return true;
}
