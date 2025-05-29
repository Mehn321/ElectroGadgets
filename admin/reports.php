<?php
ob_start();

// Include the database connection class
require_once '../database/database.php';

// Create a database connection instance
$db = new database();
$conn = $db->getConnection();

// Initialize $result as null to avoid undefined variable warning
$result = null;

// Process individual item status update
if (isset($_POST['update_status']) && isset($_POST['item_id']) && isset($_POST['status'])) {
    $item_id = $_POST['item_id'];
    $status = $_POST['status'];
    
    $updateQuery = "UPDATE order_items SET status = ? WHERE order_item_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $status, $item_id);
    
    if ($stmt->execute()) {
        $statusMessage = "Product status updated successfully!";
    } else {
        $statusMessage = "Error updating product status: " . $conn->error;
    }
}


// Process bulk status update if submitted
if (isset($_POST['update_all_status']) && isset($_POST['order_id']) && isset($_POST['status']) && isset($_POST['bulk_update'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    
    $updateQuery = "UPDATE order_items SET status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $status, $order_id);
    
    if ($stmt->execute()) {
        $statusMessage = "All products in order updated successfully!";
    } else {
        $statusMessage = "Error updating products: " . $conn->error;
    }
}

// Fetch all order items with order, product, customer, and address details
$ordersQuery = "SELECT o.order_id, o.order_number, o.order_date, o.total_amount,
                c.firstname, c.lastname, c.address, c.country, c.zip, c.phone, c.email,
                p.product_name, p.image_path, 
                oi.order_item_id as item_id, oi.quantity, oi.price, oi.status
                FROM orders o
                JOIN customers c ON o.customer_id = c.customer_id
                JOIN order_items oi ON o.order_id = oi.order_id
                JOIN products p ON oi.product_id = p.product_id
                ORDER BY o.order_date DESC, o.order_id";

// Execute the query and check for errors
try {
    $result = $conn->query($ordersQuery);
    if (!$result) {
        throw new Exception("Database query error: " . $conn->error);
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    // Initialize $result as an empty result set
    $result = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Reports</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="/ecommerce/assets/css/reports_1.css">

</head>
<body>
<div class="container">
    <?php include '../components/admin_sidebar.php'; ?>
    <div class="rightside">
        <?php include '../components/admin_header.php'; ?>

        <div class="main-content">
            <h1 class="page-title">Order Reports</h1>
            
            <?php if (isset($statusMessage)): ?>
                <div class="status-message <?php echo strpos($statusMessage, 'Error') !== false ? 'error-message' : ''; ?>">
                    <?php echo $statusMessage; ?>
                </div>
            <?php endif; ?>
            
            <!-- <div class="filters">
                <select id="statusFilter" class="filter-select">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="shipped">Shipped</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                
                <select id="dateFilter" class="filter-select">
                    <option value="">All Time</option>
                    <option value="today">Today</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                    <option value="year">This Year</option>
                </select>
                
                <input type="text" id="searchInput" placeholder="Search orders..." class="filter-select">
            </div> -->
            <div class="products-list">
                <?php if ($result && $result->num_rows > 0): ?>
                    <table class="product-table" cellpadding="10" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Product</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $currentOrderId = null;
                            $orderData = [];
                            $itemData = [];
                            
                            // First, group items by order
                            while ($row = $result->fetch_assoc()) {
                                if (!isset($orderData[$row['order_id']])) {
                                    $orderData[$row['order_id']] = [
                                        'order_number' => $row['order_number'],
                                        'customer' => $row['firstname'] . ' ' . $row['lastname'],
                                        'date' => $row['order_date'],
                                        'total_amount' => $row['total_amount'],
                                        'address' => $row['address'],
                                        'country' => $row['country'],
                                        'zip' => $row['zip'],
                                        'phone' => $row['phone'],
                                        'email' => $row['email'],
                                        'items' => []
                                    ];
                                }
                                
                                $orderData[$row['order_id']]['items'][] = [
                                    'item_id' => $row['item_id'],
                                    'product_name' => $row['product_name'],
                                    'image_path' => $row['image_path'],
                                    'quantity' => $row['quantity'],
                                    'price' => $row['price'],
                                    'status' => $row['status']
                                ];
                                
                                // Store individual item data for modal
                                $itemData[$row['item_id']] = [
                                    'order_id' => $row['order_id'],
                                    'order_number' => $row['order_number'],
                                    'customer' => $row['firstname'] . ' ' . $row['lastname'],
                                    'date' => $row['order_date'],
                                    'address' => $row['address'],
                                    'country' => $row['country'],
                                    'zip' => $row['zip'],
                                    'phone' => $row['phone'],
                                    'email' => $row['email'],
                                    'product_name' => $row['product_name'],
                                    'quantity' => $row['quantity'],
                                    'price' => $row['price'],
                                    'status' => $row['status']
                                ];
                            }
                            
                            // Now display the data with order headers
                            foreach ($orderData as $orderId => $order):
                            ?>
                                <!-- Product rows -->
                                <?php foreach ($order['items'] as $item): ?>
                                    <tr class="product-row" data-order-id="<?php echo $orderId; ?>">
                                        <td><?php echo $order['order_number']; ?></td>
                                        <td><?php echo $order['customer']; ?></td>
                                        <td><?php echo date('M d, Y', strtotime($order['date'])); ?></td>
                                        <td><?php echo $item['product_name']; ?></td>
                                        <td>
                                            <img src="../<?php echo $item['image_path']; ?>" class="product-image" alt="Product">
                                        </td>
                                        <td><?php echo $item['quantity']; ?></td>
                                        <td>₱<?php echo number_format($item['price']*$item['quantity'], 2); ?></td>
                                        <td>
                                            <span class="status-<?php echo $item['status']; ?>">
                                                <?php echo ucfirst($item['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <form method="post" action="">
                                                <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">
                                                <select name="status" class="status-select">
                                                    <option value="pending" <?php echo $item['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                                    <option value="processing" <?php echo $item['status'] == 'processing' ? 'selected' : ''; ?>>Processing</option>
                                                    <option value="shipped" <?php echo $item['status'] == 'shipped' ? 'selected' : ''; ?>>Shipped</option>
                                                    <option value="delivered" <?php echo $item['status'] == 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                                                    <option value="cancelled" <?php echo $item['status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                                </select>
                                                <div class="button-group">
                                                    <button type="submit" name="update_status" class="update-btn">Update</button>
                                                    <button type="button" class="update-btn" onclick="showAddressModal('<?php echo $item['item_id']; ?>')">Details</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                    <!-- Address Modal -->
                    <div id="addressModal" class="address-modal">
                        <div class="address-modal-content">
                            <span class="close-modal" onclick="closeAddressModal()">&times;</span>
                            <h2>Order Details</h2>
                            <div id="customerDetails" class="customer-details">
                                <!-- Customer details will be populated here -->
                            </div>
                        </div>
                    </div>
                    
                <?php else: ?>
                    <div class="empty-state">
                        <i class='bx bx-package'></i>
                        <h3>No Orders Found</h3>
                        <p>
                            <?php 
                            if (isset($errorMessage)) {
                                echo "Error: " . htmlspecialchars($errorMessage);
                            } else {
                                echo "There are no orders in the system yet.";
                            }
                            ?>
                        </p>
                    </div>
                <?php endif; ?>            
            </div>
        </div>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php';
        ?>
    </div>
</div>
    <script>
        // Store item data in JavaScript for modal access
        const itemData = <?php echo json_encode($itemData ?? []); ?>;
    </script>
    <script src="/ecommerce/assets/js/reports_1.js"></script>
    
</body>
</html>
