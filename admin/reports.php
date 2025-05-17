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
}// Fetch all order items with order, product, and customer details
$ordersQuery = "SELECT o.order_id, o.order_number, o.order_date, o.total_amount,
                c.firstname, c.lastname, 
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
    <style>
        .status-message {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
        }
        
        .error-message {
            background-color: #f44336;
        }
        
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .product-table th {
            background-color: #4361ee;
            color: white;
            padding: 12px;
            text-align: left;
        }
        
        .product-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
        }
        
        .product-table tr:last-child td {
            border-bottom: none;
        }
        
        .product-table tr:hover {
            background-color: #f5f5f5;
        }
        
        .status-select {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            width: 100%;
        }
        
        .status-select option {
            padding: 8px;
        }
        
        .status-pending {
            background-color: #FFC107;
            color: #000;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }
        
        .status-processing {
            background-color: #2196F3;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }
        
        .status-shipped {
            background-color: #9C27B0;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }
        
        .status-delivered {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }
        
        .status-cancelled {
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }
        
        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }
        
        .update-btn {
            background-color: #4361ee;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }
        
        .update-btn:hover {
            background-color: #3651d4;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px;
            background-color: #f8f9fa;
            border-radius: 8px;
            margin-top: 20px;
        }
        
        .empty-state i {
            font-size: 3rem;
            color: #6c757d;
            margin-bottom: 15px;
        }
        
        .filters {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .filter-select {
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid #ddd;
            min-width: 150px;
        }
        
        /* Style for merged cells */
        .order-row {
            background-color: #f9f9f9;
        }
        
        .order-row td {
            border-bottom: none;
        }
        
        .product-row td {
            border-top: none;
            
        }
        
        .order-info {
            font-weight: bold;
        }
        
        .order-header {
            background-color: #e9ecef;
            font-weight: bold;
        }
        
        .order-header td {
            padding: 15px 12px;
        }
    </style>
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
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $currentOrderId = null;
                            $orderData = [];
                            
                            // First, group items by order
                            while ($row = $result->fetch_assoc()) {
                                if (!isset($orderData[$row['order_id']])) {
                                    $orderData[$row['order_id']] = [
                                        'order_number' => $row['order_number'],
                                        'customer' => $row['firstname'] . ' ' . $row['lastname'],
                                        'date' => $row['order_date'],
                                        'total_amount' => $row['total_amount'],
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
                            }
                            
                            // Now display the data with order headers
                            foreach ($orderData as $orderId => $order):
                            ?>
                                <!-- Order header row -->
                                
                                <!-- <tr class="order-header" data-order-id="<?php echo $orderId; ?>">
                                    <td colspan="9">
                                        Order #<?php echo $order['order_number']; ?> - 
                                        <?php echo $order['customer']; ?> - 
                                        <?php echo date('M d, Y', strtotime($order['date'])); ?> - 
                                        Total: ₱<?php echo number_format($order['total_amount'], 2); ?>
                                        
                                        
                                        <form method="post" action="" style="display: inline-block; margin-left: 15px;">
                                            <input type="hidden" name="order_id" value="<?php echo $orderId; ?>">
                                            <input type="hidden" name="bulk_update" value="1">
                                            <select name="status" class="status-select" style="width: auto; margin-right: 5px;">
                                                <option value="pending">Pending</option>
                                                <option value="processing">Processing</option>
                                                <option value="shipped">Shipped</option>
                                                <option value="delivered">Delivered</option>
                                                <option value="cancelled">Cancelled</option>
                                            </select>
                                            <button type="submit" name="update_all_status" class="update-btn">Update All Items</button>
                                        </form>
                                    </td>
                                </tr> -->
                                
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
                                        <td>₱<?php echo number_format($item['price'], 2); ?></td>
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
                                                <button type="submit" name="update_status" class="update-btn">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
    document.addEventListener('DOMContentLoaded', function() {
        const statusFilter = document.getElementById('statusFilter');
        const dateFilter = document.getElementById('dateFilter');
        const searchInput = document.getElementById('searchInput');
        const orderRows = document.querySelectorAll('.product-row');
        const orderHeaders = document.querySelectorAll('.order-header');
    
        function filterTable() {
            // Get filter values
            const statusValue = statusFilter.value.toLowerCase();
            const dateValue = dateFilter.value;
            const searchValue = searchInput.value.toLowerCase();
        
            // Track which orders have visible products
            const visibleOrders = new Set();
        
            // Filter product rows
            orderRows.forEach(row => {
                const orderId = row.dataset.orderId;
            
                // Get values to filter by
                const status = row.querySelector('.status-pending, .status-processing, .status-shipped, .status-delivered, .status-cancelled')?.textContent.toLowerCase() || '';
                const date = row.cells[2]?.textContent || ''; // Date column
                const orderNumber = row.cells[0]?.textContent.toLowerCase() || '';
                const customer = row.cells[1]?.textContent.toLowerCase() || '';
                const productName = row.cells[3]?.textContent.toLowerCase() || '';
            
                // Status filter
                const statusMatch = statusValue === '' || status.includes(statusValue);
            
                // Date filter
                let dateMatch = true;
                if (dateValue !== '' && date) {
                    const orderDate = new Date(date);
                    const today = new Date();
                
                    if (dateValue === 'today') {
                        dateMatch = orderDate.toDateString() === today.toDateString();
                    } else if (dateValue === 'week') {
                        const last7Days = new Date(today);
                        last7Days.setDate(today.getDate() - 7);
                        dateMatch = orderDate >= last7Days;

                        // else if (dateValue === 'week') {
                        // const weekStart = new Date(today);
                        // weekStart.setDate(today.getDate() - today.getDay());
                        // dateMatch = orderDate >= weekStart;

                    } else if (dateValue === 'month') {
                        dateMatch = orderDate.getMonth() === today.getMonth() && 
                                 orderDate.getFullYear() === today.getFullYear();
                    } else if (dateValue === 'year') {
                        dateMatch = orderDate.getFullYear() === today.getFullYear();
                    }
                }
            
                // Search filter
                const searchMatch = searchValue === '' || 
                                 orderNumber.includes(searchValue) || 
                                 customer.includes(searchValue) || 
                                 productName.includes(searchValue);
            
                // Show/hide row based on all filters
                const shouldShow = statusMatch && dateMatch && searchMatch;
                row.style.display = shouldShow ? '' : 'none';
            
                // If this product is visible, mark its order as visible
                if (shouldShow && orderId) {
                    visibleOrders.add(orderId);
                }
            });
        
            // Show/hide order headers based on whether they have visible products
            orderHeaders.forEach(header => {
                const orderId = header.dataset.orderId;
                header.style.display = visibleOrders.has(orderId) ? '' : 'none';
            });
        }
    
        // Add event listeners to filters
        statusFilter.addEventListener('change', filterTable);
        dateFilter.addEventListener('change', filterTable);
        searchInput.addEventListener('input', filterTable);
    
        // Initial filter application (in case of page reload with values)
        filterTable();
    });
    </script>
</body>
</html>
