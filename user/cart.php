<?php
require_once '../src/cart_functions.php';

// Handle cart actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'remove') {
            // Remove item from cart
            $product_id = $_POST['product_id'];
            removeFromCart($product_id);
            
            // Redirect to avoid form resubmission
            header("Location: cart.php?removed=1");
            exit;
        } elseif ($_POST['action'] === 'checkout') {
            // Process checkout for selected items
            if (isset($_POST['selected_items']) && is_array($_POST['selected_items'])) {
                $selectedItems = $_POST['selected_items'];
                $quantities = $_POST['quantity'];
                
                // Create a temporary cart with only selected items
                $checkoutItems = [];
                $cartItems = getCartItems();
                
                foreach ($cartItems as $item) {
                    if (in_array($item['product_id'], $selectedItems)) {
                        $item['quantity'] = $quantities[$item['product_id']];
                        $checkoutItems[] = $item;
                    }
                }
                
                // Store selected items in session for checkout
                $_SESSION['checkout_items'] = $checkoutItems;
                
                // Redirect to orders.php instead of billing.php
                header("Location: orders.php");
                exit;
            } else {
                // No items selected, redirect back with error
                header("Location: cart.php?error=no_items_selected");
                exit;
            }
        } elseif ($_POST['action'] === 'update_quantity') {
            // Update quantity for a specific item
            $product_id = $_POST['product_id'];
            $quantity = intval($_POST['quantity']);
            
            if ($quantity > 0) {
                updateCartItemQuantity($product_id, $quantity);
            }
            
            // Redirect to avoid form resubmission
            header("Location: cart.php?updated=1");
            exit;
        }
    }
}

require_once '../src/cart_functions.php';

// Handle cart actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'remove') {
            // Remove item from cart
            $product_id = $_POST['product_id'];
            removeFromCart($product_id);
            
            // Redirect to avoid form resubmission
            header("Location: cart.php?removed=1");
            exit;
        } elseif ($_POST['action'] === 'checkout') {
            // Process checkout for selected items
            if (isset($_POST['selected_items']) && is_array($_POST['selected_items'])) {
                $selectedItems = $_POST['selected_items'];
                $quantities = $_POST['quantity'];
                
                // Create a temporary cart with only selected items
                $checkoutItems = [];
                $cartItems = getCartItems();
                
                foreach ($cartItems as $item) {
                    if (in_array($item['product_id'], $selectedItems)) {
                        $item['quantity'] = $quantities[$item['product_id']];
                        $checkoutItems[] = $item;
                    }
                }
                
                // Store selected items in session for checkout
                $_SESSION['checkout_items'] = $checkoutItems;
                
                // Redirect to orders.php instead of billing.php
                header("Location: orders.php");
                exit;
            } else {
                // No items selected, redirect back with error
                header("Location: cart.php?error=no_items_selected");
                exit;
            }
        } elseif ($_POST['action'] === 'update_quantity') {
            // Update quantity for a specific item
            $product_id = $_POST['product_id'];
            $quantity = intval($_POST['quantity']);
            
            if ($quantity > 0) {
                updateCartItemQuantity($product_id, $quantity);
            }
            
            // Redirect to avoid form resubmission
            header("Location: cart.php?updated=1");
            exit;
        }
    }
}

// Get cart items
$cartItems = getCartItems();

// Reverse the order of cart items to show the latest first
$cartItems = array_reverse($cartItems);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shopping Cart - ElectroGadgets</title>
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
            <h1 class="page-title">Shopping Cart</h1>
            
            <?php if (isset($_GET['error']) && $_GET['error'] == 'no_items_selected'): ?>
            <div class="error-message">
                <i class='bx bx-error-circle'></i> Please select at least one item to checkout.
            </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['removed']) && $_GET['removed'] == 1): ?>
            <div class="alert alert-success">
                <span class="close-btn" onclick="this.parentElement.style.display='none';">×</span>
                Item removed from cart successfully!
            </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['updated']) && $_GET['updated'] == 1): ?>
            <div class="alert alert-info">
                <span class="close-btn" onclick="this.parentElement.style.display='none';">×</span>
                Cart updated successfully!
            </div>
            <?php endif; ?>
            
            <div class="cart-container">
                <?php if (empty($cartItems)): ?>
                    <div class="empty-cart">
                        <i class='bx bx-cart'></i>
                        <p>Your cart is empty.</p>
                        <a href="products.php" class="blue-btn">Continue Shopping</a>
                    </div>
                <?php else: ?>
                    <form action="cart.php" method="post" id="cartForm">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAll" onclick="toggleAllCheckboxes()"></th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $totalPrice = 0;
                                foreach ($cartItems as $item): 
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $totalPrice += $subtotal;
                                ?>
                                    <tr class="cart-item" data-price="<?php echo $item['price']; ?>" data-id="<?php echo $item['product_id']; ?>">
                                        <td>
                                            <input type="checkbox" name="selected_items[]" value="<?php echo $item['product_id']; ?>" class="item-checkbox" onchange="updateTotal()">
                                        </td>
                                        <td>
                                            <div class="product-info">
                                                <img src="/ecommerce/<?php echo $item['image']; ?>" alt="<?php echo $item['product_name']; ?>" class="cart-image">
                                                <div class="product-details">
                                                    <a href="product_details.php?id=<?php echo $item['product_id']; ?>" class="product-name"><?php echo $item['product_name']; ?></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="item-price">₱<?php echo number_format($item['price'], 2); ?></td>
                                        <td>
                                            <div class="quantity-control">
                                                <input type="number" name="quantity[<?php echo $item['product_id']; ?>]" value="<?php echo $item['quantity']; ?>" min="1" class="quantity-input" onchange="updateItemSubtotal(this)">
                                            </div>
                                        </td>

                                        <td class="item-subtotal">₱<?php echo number_format($subtotal, 2); ?></td>
                                        <td>
                                            <!-- Direct remove button - no checkbox needed -->
                                            <button type="button" class="red-btn" onclick="removeItem(<?php echo $item['product_id']; ?>)">Remove</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        
                        <div class="cart-total">
                            Total: <span id="cartTotal">₱0.00</span>
                        </div>
                        
                        <div class="cart-actions">
                            <a href="products.php" class="blue-btn">Continue Shopping</a>
                            <input type="hidden" name="action" value="checkout">
                            <button type="submit" class="green-btn">Proceed to Order Review</button>
                        </div>
                    </form>
                    
                    <!-- Hidden form for removing items -->
                    <form id="removeForm" action="cart.php" method="post" style="display: none;">
                        <input type="hidden" name="action" value="remove">
                        <input type="hidden" id="remove_product_id" name="product_id" value="">
                    </form>
                <?php endif; ?>
            </div>
        </div>
        
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php'; ?>
    </div>
</div>


<script>
    // Function to format number with commas for thousands
    function formatNumber(number) {
        return number.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    // Function to update subtotal when quantity changes
    function updateItemSubtotal(quantityInput) {
        const row = quantityInput.closest('tr');
        const price = parseFloat(row.dataset.price);
        const quantity = parseInt(quantityInput.value);
        const subtotal = price * quantity;
        
        // Update the subtotal display with formatted number
        const subtotalCell = row.querySelector('.item-subtotal');
        subtotalCell.textContent = '₱' + formatNumber(subtotal);
        
        // Update the total for selected items
        updateTotal();
    }

    // Function to update the total based on checked items
    function updateTotal() {
        let total = 0;
        const rows = document.querySelectorAll('.cart-item');
    
        rows.forEach(row => {
            const checkbox = row.querySelector('.item-checkbox');
            if (checkbox.checked) {
                const price = parseFloat(row.dataset.price);
                const quantity = parseInt(row.querySelector('.quantity-input').value);
                total += price * quantity;
            }
        });
    
        // Update the total display with formatted number
        document.getElementById('cartTotal').textContent = '₱' + formatNumber(total);
    }

    // Function to toggle all checkboxes
    function toggleAllCheckboxes() {
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.item-checkbox');
    
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAll.checked;
        });
    
        updateTotal();
    }

    // Function to remove an item directly
    function removeItem(productId) {
        if (confirm('Are you sure you want to remove this item from your cart?')) {
            document.getElementById('remove_product_id').value = productId;
            document.getElementById('removeForm').submit();
        }
    }

    // Initialize the total on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateTotal();
    });
</script>
</body>
</html>
