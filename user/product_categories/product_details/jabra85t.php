<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jabra Elite 85t Details</title>
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
                                <img src="../../../assets/img/jabra85t.webp" alt="Jabra Elite 85t" height="300px" width="300px">
                                <h2>Jabra Elite 85t</h2>
                            </td>
                            <td class="description">
                                <h3>Product Description:</h3>
                                <p>The Jabra Elite 85t delivers premium sound and adjustable noise cancellation with 
                                advanced 6-microphone technology for crystal-clear calls and superior ANC performance.
                                <br><br>
                                <h4>Product Specifications:</h4>
                                <ul>
                                    <li>Advanced ANC with HearThrough</li>
                                    <li>12mm speakers for powerful sound</li>
                                    <li>6-microphone call technology</li>
                                    <li>Semi-open design for comfort</li>
                                    <li>Up to 25 hours total battery life</li>
                                    <li>Wireless charging capability</li>
                                    <li>IPX4 water resistance</li>
                                </ul>
                                </p>
                                <br>
                                <h2>Price: 11,999.99</h2>
                                <p>Stock: 28</p>
                                <form action="../../orders.php">
                                    <input type="hidden" name="product" value="Jabra Elite 85t">
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