<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sony BRAVIA XR A80L Details</title>
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
                                <img src="../../../assets/img/sonytv.webp" alt="Sony BRAVIA XR A80L" height="300px" width="300px">
                                <h2>Sony BRAVIA XR A80L</h2>
                            </td>
                            <td class="description">
                                <h3>Product Description:</h3>
                                <p>The Sony BRAVIA XR A80L delivers revolutionary cognitive processing and immersive sound. 
                                Experience true-to-life picture quality with XR OLED technology.
                                <br><br>
                                <h4>Product Specifications:</h4>
                                <ul>
                                    <li>83-inch OLED Display</li>
                                    <li>Cognitive Processor XR</li>
                                    <li>XR OLED Contrast Pro</li>
                                    <li>Acoustic Surface Audio+</li>
                                    <li>BRAVIA CORE Calibrated</li>
                                    <li>Perfect for PlayStation 5</li>
                                    <li>Google TV OS</li>
                                </ul>
                                </p>
                                <br>
                                <h2>Price: 149,999.99</h2>
                                <p>Stock: 8</p>
                                <form action="../../orders.php">
                                    <input type="hidden" name="product" value="Sony BRAVIA XR A80L">
                                    <label for="quantity">Quantity:</label>
                                    <input type="number" id="quantity" name="quantity" min="1" max="5" value="1"><br><br>
                                    <button class="blue-btn" type="submit">Order Now</button>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php';
        ?>
        </div>
    </div>
</body>
</html>