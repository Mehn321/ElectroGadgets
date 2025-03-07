<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MacBook Air 15 M3 Details</title>
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
                                <img src="../../../assets/img/macbookair.webp" alt="MacBook Air 15 M3" height="300px" width="300px">
                                <h2>MacBook Air 15 M3</h2>
                            </td>
                            <td class="description">
                                <h3>Product Description:</h3>
                                <p>The MacBook Air 15 with M3 chip combines incredible performance with a stunning large display in an 
                                ultra-thin design. Perfect for everyday tasks and creative work.
                                <br><br>
                                <h4>Product Specifications:</h4>
                                <ul>
                                    <li>M3 chip with 8-core CPU</li>
                                    <li>15.3-inch Liquid Retina display</li>
                                    <li>Up to 18 hours battery life</li>
                                    <li>Up to 2TB storage</li>
                                    <li>MagSafe charging</li>
                                    <li>1080p FaceTime HD camera</li>
                                    <li>Four-speaker sound system</li>
                                </ul>
                                </p>
                                <br>
                                <h2>Price: 69,999.99</h2>
                                <p>Stock: 25</p>
                                <form action="../../orders.php">
                                    <input type="hidden" name="product" value="MacBook Air 15 M3">
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