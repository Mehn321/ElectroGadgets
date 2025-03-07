<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PS5 Slim Details</title>
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
                                <img src="../../../assets/img/ps5slim.webp" alt="PS5 Slim" height="300px" width="300px">
                                <h2>PS5 Slim</h2>
                            </td>
                            <td class="description">
                                <h3>Product Description:</h3>
                                <p>The PS5 Slim delivers next-gen gaming in a more compact design. Experience lightning-fast loading, 
                                stunning 4K graphics, and immersive DualSense controller features.
                                <br><br>
                                <h4>Product Specifications:</h4>
                                <ul>
                                    <li>AMD Zen 2 CPU</li>
                                    <li>AMD RDNA 2 GPU</li>
                                    <li>1TB SSD storage</li>
                                    <li>4K resolution support</li>
                                    <li>Ray tracing capability</li>
                                    <li>3D Audio</li>
                                    <li>DualSense controller included</li>
                                </ul>
                                </p>
                                <br>
                                <h2>Price: 29,999.99</h2>
                                <p>Stock: 35</p>
                                <form action="../../orders.php">
                                    <input type="hidden" name="product" value="PS5 Slim">
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