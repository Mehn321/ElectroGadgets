<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirPods Pro 2 Details</title>
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
                                <img src="../../../assets/img/airpods2pro.webp" alt="AirPods Pro 2" height="300px" width="300px">
                                <h2>AirPods Pro 2</h2>
                            </td>
                            <td class="description">
                                <h3>Product Description:</h3>
                                <p>The AirPods Pro 2 deliver an unrivaled wireless audio experience with personalized Spatial Audio 
                                and next-level Active Noise Cancellation. Enhanced by the H2 chip for exceptional sound quality.
                                <br><br>
                                <h4>Product Specifications:</h4>
                                <ul>
                                    <li>Personalized Spatial Audio</li>
                                    <li>2x stronger Active Noise Cancellation</li>
                                    <li>Adaptive Transparency mode</li>
                                    <li>Touch control with volume adjustment</li>
                                    <li>Up to 6 hours listening time with ANC</li>
                                    <li>MagSafe Charging Case with speaker</li>
                                    <li>Precision Finding with U1 chip</li>
                                </ul>
                                </p>
                                <br>
                                <h2>Price: 16,999.99</h2>
                                <p>Stock: 35</p>
                                <form action="../../orders.php">
                                    <input type="hidden" name="product" value="AirPods Pro 2">
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