<?php
// Include the database connection class
require_once '../database/database.php';

// Create a database connection instance
$db = new database();
$conn = $db->getConnection();

// Initialize variables with default values
$totalProducts = 0;
$totalOrders = 0;
$monthlyRevenue = 0;
$lowStockProducts = 0;

// Get total products count
$productQuery = "SELECT COUNT(*) as total_products FROM products";
$productResult = $conn->query($productQuery);
if ($productResult) {
    $productRow = $productResult->fetch_assoc();
    $totalProducts = $productRow['total_products'];
}

// Get total orders count
$orderQuery = "SELECT COUNT(*) as total_orders FROM order_items";
$orderResult = $conn->query($orderQuery);
if ($orderResult) {
    $orderRow = $orderResult->fetch_assoc();
    $totalOrders = $orderRow['total_orders'];
}

// Get monthly revenue - Fixed to use total_amount from the orders table
$revenueQuery = "SELECT SUM(total_amount) as monthly_revenue FROM orders";
$revenueResult = $conn->query($revenueQuery);
if ($revenueResult) {
    $revenueRow = $revenueResult->fetch_assoc();
    $monthlyRevenue = $revenueRow['monthly_revenue'] ? $revenueRow['monthly_revenue'] : 0;
}

// Get low stock products (less than 20 items)
$lowStockQuery = "SELECT COUNT(*) as low_stock FROM products WHERE stocks < 10";
$lowStockResult = $conn->query($lowStockQuery);
if ($lowStockResult) {
    $lowStockRow = $lowStockResult->fetch_assoc();
    $lowStockProducts = $lowStockRow['low_stock'];
}

// Get recent orders with product details in a single query - Fixed to use the new schema with order_items table
$recentOrdersQuery = "SELECT o.order_id, p.product_name, oi.quantity, oi.price 
                     FROM orders o 
                     JOIN order_items oi ON o.order_id = oi.order_id
                     JOIN products p ON oi.product_id = p.product_id 
                     ORDER BY o.order_id DESC LIMIT 5";
$recentOrdersResult = $conn->query($recentOrdersQuery);

// Get top selling products with a complex query that handles NULL values properly - Fixed to use order_items table
$topProductsQuery = "SELECT p.product_name, 
                           COALESCE(SUM(oi.quantity), 0) as total_sold, 
                           COALESCE(SUM(oi.price * oi.quantity), 0) as revenue
                    FROM products p
                    LEFT JOIN order_items oi ON p.product_id = oi.product_id
                    GROUP BY p.product_id, p.product_name
                    ORDER BY total_sold DESC, revenue DESC
                    LIMIT 5";
$topProductsResult = $conn->query($topProductsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .stats-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }
        
        .stat-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            flex: 1;
            min-width: 200px;
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card i {
            font-size: 2.5rem;
            color: #4361ee;
            margin-bottom: 10px;
        }
        
        .stat-card h3 {
            font-size: 1rem;
            color: #555;
            margin-bottom: 10px;
        }
        
        .stat-card p {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .stat-card span {
            font-size: 0.8rem;
            color: #28a745;
        }
        
        .welcome-banner {
            background-color: #4361ee;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        .welcome-banner h1 {
            margin-bottom: 5px;
        }
        
        .recent-orders-container {
            display: flex;
            flex-wrap: wrap;
            gap: 50px;
        }
        .recent-orders {
            margin-top: 30px;
        }
        
        .section-title {
            margin-bottom: 15px;
            font-size: 1.2rem;
            color: #333;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .data-table th, .data-table td {
            padding: 12px 15px;
            text-align: left;
        }
        
        .data-table thead {
            background-color: #4361ee;
            color: white;
        }
        
        .data-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .data-table tbody tr:hover {
            background-color: #e9ecef;
        }
        
        .empty-state {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin-top: 10px;
        }
        
        .empty-state i {
            font-size: 3rem;
            color: #6c757d;
        }
        
        .empty-state p {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include '../components/admin_sidebar.php'; ?>
        <div class="rightside">
            <?php include '../components/admin_header.php'; ?>

            <div class="main-content">
                <div class="welcome-banner">
                    <h1>Welcome Back, Admin!</h1>
                    <p>Here's your business overview for today</p>
                </div>

                <div class="stats-container">
                    <div class="stat-card">
                        <i class='bx bx-shopping-bag'></i>
                        <h3>Total Orders</h3>
                        <p><?php echo $totalOrders; ?></p>
                        <span><?php echo ($totalOrders > 0) ? "↑ Active orders" : "No orders yet"; ?></span>
                    </div>
                    <div class="stat-card">
                        <i class='bx bx-package'></i>
                        <h3>Total Products</h3>
                        <p><?php echo $totalProducts; ?></p>
                        <span>Products in inventory</span>
                    </div>
                    <div class="stat-card">
                        <i class='bx bx-error-circle'></i>
                        <h3>Low Stock Items</h3>
                        <p><?php echo $lowStockProducts; ?></p>
                        <span><?php echo ($lowStockProducts > 0) ? "⚠️ Need attention" : "All stocks healthy"; ?></span>
                    </div>
                    <div class="stat-card">
                        <i class='bx bx-money'></i>
                        <h3>Total Revenue</h3>
                        <p>₱<?php echo number_format($monthlyRevenue, 2); ?></p>
                        <span>Overall earnings</span>
                    </div>
                </div>

                <div class="recent-orders-container">
                    <div class="recent-orders" style="flex: 1; min-width: 300px;">
                        <h2 class="section-title">Recent Orders</h2>
                        <?php if ($recentOrdersResult && $recentOrdersResult->num_rows > 0): ?>
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = $recentOrdersResult->fetch_assoc()): ?>
                                        <tr>
                                            <td>#<?php echo $row["order_id"]; ?></td>
                                            <td><?php echo $row["product_name"]; ?></td>
                                            <td><?php echo $row["quantity"]; ?></td>
                                            <td>₱<?php echo number_format($row["price"], 2); ?></td>
                                        </tr>
                                    <?php endwhile; ?>                            
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="bx bx-package"></i>
                                <p>No orders have been placed yet.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="recent-orders" style="flex: 1; min-width: 300px;">
                        <h2 class="section-title">Top Selling Products</h2>
                        <?php if ($topProductsResult && $topProductsResult->num_rows > 0): ?>
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Units Sold</th>
                                        <th>Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = $topProductsResult->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $row["product_name"]; ?></td>
                                            <td><?php echo $row["total_sold"]; ?></td>
                                            <td>₱<?php echo number_format($row["revenue"], 2); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="bx bx-line-chart"></i>
                                <p>No sales data available yet.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>            </div>
            
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php';
            ?>
        </div>
    </div>
</body>
</html>