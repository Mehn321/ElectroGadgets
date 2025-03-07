<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xbox Series X Details</title>
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
                                <img src="../../../assets/img/xboxseriesx.webp" alt="Xbox Series X" height="300px" width="300px">
                                <h2>Xbox Series X</h2>
                            </td>
                            <td class="description">
                                <h3>Product Description:</h3>
                                <p>The Xbox Series X is the most powerful Xbox ever, delivering true 4K gaming and 
                                incredible performance with Xbox Velocity Architecture.
                                <br><br>
                                <h4>Product Specifications:</h4>
                                <ul>
                                    <li>Custom AMD Zen 2 CPU</li>
                                    <li>True 4K Gaming</li>
                                    <li>1TB Custom NVMe SSD</li>
                                    <li>Up to 120 FPS</li>
                                    <li>DirectX Ray Tracing</li>
                                    <li>Quick Resume</li>
                                    <li>Dolby Vision and Atmos</li>
                                </ul>
                                </p>
                                <br>
                                <h2>Price: 29,999.99</h2>
                                <p>Stock: 25</p>
                                <form action="../../orders.php">
                                    <input type="hidden" name="product" value="Xbox Series X">
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