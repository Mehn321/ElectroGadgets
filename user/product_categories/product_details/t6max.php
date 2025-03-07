<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T6 Max Details</title>
    <link rel="stylesheet" href="../../../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="../../home.php"><i class='bx bx-home'></i><span>Home</span></a></li>
                <li><a href="../../products.php"><i class='bx bx-box'></i><span>Products</span></a></li>
                <li><a href="../../contacts.php"><i class='bx bx-book'></i><span>Contacts</span></a></li>
                <li><a href="../../../admin/login.php"><i class='bx bx-log-in'></i><span>Login</span></a></li>
            </ul>
        </div>
        <div class="rightside">
            <header class="main-header">
                <div class="logo-container">
                    <img src="../../../assets/img/ElectroGadgets.png" width="70" alt="Logo">
                    <h1>ElectroGadgets</h1>
                </div>
            </header>
            <div class="main-content">
                <div class="product-details">
                    <table border="1" cellspacing="0" align="center" bgcolor="white" class="mtb product-details">
                        <tr>
                            <td class="product-image" align="center">
                                <img src="../../../assets/img/t6max.webp" alt="T6 Max" height="300px" width="300px">
                                <h2>T6 Max</h2>
                            </td>
                            <td class="description">
                                <h3>Product Description:</h3>
                                <p>The T6 Max represents the pinnacle of mobile gaming technology with its revolutionary 
                                display and unmatched processing power.
                                <br><br>
                                <h4>Product Specifications:</h4>
                                <ul>
                                    <li>7.5-inch Quantum Display</li>
                                    <li>Snapdragon 8 Gen 4</li>
                                    <li>32GB LPDDR6 RAM</li>
                                    <li>1TB UFS 5.0 Storage</li>
                                    <li>9000mAh Battery</li>
                                    <li>Pro Gaming Controls</li>
                                    <li>Cryo Cooling System</li>
                                </ul>
                                </p>
                                <br>
                                <h2>Price: 64,999.99</h2>
                                <p>Stock: 8</p>
                                <form action="../../orders.php">
                                    <input type="hidden" name="product" value="T6 Max">
                                    <label for="quantity">Quantity:</label>
                                    <input type="number" id="quantity" name="quantity" min="1" max="5" value="1"><br><br>
                                    <button class="blue-btn" type="submit">Order Now</button>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <footer class="main-footer" align="center">
                <p>© 2024 ElectroGadgets by Nhem Day Aclo.</p>
            </footer>
        </div>
    </div>
</body>
</html>
