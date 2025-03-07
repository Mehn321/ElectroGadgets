<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Admin</title>

</head>
<body>
    <table>
        <tr>
            <td width="130" height="700" valign="top" bgcolor="#f0f0f0">
                <br><br><br><br><br><br><br><br>
                <nav>
                    <a href="dashboard.php">📊 Dashboard</a><br>
                    <a href="products.php">🛍️Products</a><br>
                    <a href="reports.php">📈Reports</a><br>
                    <a href="../user/home.php"><button>Logout</button></a>
                </nav>
            </td>
            <td width='1500' align="center" valign="top">
                <header>
                    <table>
                        
                        <tr>
                            <td><img src="../assets/img/ElectroGadgets.png" alt="Logo" width="100" height="100"></td>
                            <td><h1>ElectroGadgets</h1></td>
                        </tr>
                    </table>
                </header>
                <br>
    <h2>Add Product</h2>
    <form action="process_add_product.php" method="POST">
        <table>
            <tr>
                <td><label for="name">Product Name:</label></td>
                <td><input type="text" id="name" name="name" required></td>
            </tr>
            <tr>
                <td><label for="price">Price:</label></td>
                <td><input type="number" id="price" name="price" required></td>
            </tr>
            <tr>
                <td><label for="stock">Stock:</label></td>
                <td><input type="number" id="stock" name="stock" required></td>
            </tr>
            <tr>
                <td><label for="category">Category:</label></td>
                <td>
                    <select id="category" name="category" required>
                        <option value="earbuds">Earbuds</option>
                        <option value="smartwatch">Smartwatch</option>
                        <option value="iphone">iPhones</option>
                        <option value="headphone">Headphones</option>
                        <option value="mac">Mac</option>
                        <option value="ipad">iPad</option>
                        <option value="projector">Projector</option>
                        <option value="gaming_console">Gaming Console</option>
                        <option value="smarttv">Smart TV</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="image">Image:</label></td>
                <td><input type="file" id="image_url" name="image_url" required></td>
            </tr>
        </table>
        <br>
        <input type="submit" value="Add Product">

    </form>
        </td>
    </tr>
</table>
</body>
