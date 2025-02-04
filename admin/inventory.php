<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management - Admin</title>
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
        <div class="alerts">
            <h3>Low Stock Alerts</h3>
            <ul>
                <li>iPhone 14 Pro (5 units remaining)</li>
                <li>Samsung Galaxy S23 (3 units remaining)</li>
            </ul>
        </div>

        <table border="1">
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Current Stock</th>
                <th>Reorder Level</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>1</td>
                <td>iPhone 14 Pro</td>
                <td>5</td>
                <td>10</td>
                <td>
                    <button>Update Stock</button>
                    <button>Order More</button>
                </td>
            </tr>
        </table>
    </main>
</body>
</html>
