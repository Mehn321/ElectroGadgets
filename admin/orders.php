<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - Admin</title>
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
        <div class="filters">
            <select name="status">
                <option value="">All Orders</option>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
            </select>
        </div>

        <table border="1">
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>#12345</td>
                <td>John Doe</td>
                <td>2023-11-15</td>
                <td>$599.99</td>
                <td>Processing</td>
                <td>
                    <button>View Details</button>
                    <button>Update Status</button>
                </td>
            </tr>
        </table>
    </main>
</body>
</html>
