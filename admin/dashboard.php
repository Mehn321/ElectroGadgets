<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TechGadgets Hub</title>
</head>
<body>
<header>
        <img src="ElectroGadgets.png" alt="" width="100" height="100">
        <h1>Customer Management</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="products.php">Manage Products</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="customers.php">Customers</a></li>
                <li><a href="inventory.php">Inventory</a></li>
                <li><a href="login.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <div class="quick-stats">
            <h2>Quick Statistics</h2>
            <div>Total Orders: 150</div>
            <div>Total Products: 75</div>
            <div>Active Customers: 500</div>
            <div>Monthly Revenue: $25,000</div>
        </div>

        <div class="recent-orders">
            <h2>Recent Orders</h2>
            <table border="1">
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>#12345</td>
                    <td>John Doe</td>
                    <td>$599.99</td>
                    <td>Processing</td>
                </tr>
            </table>
        </div>
    </main>
</body>
</html>
