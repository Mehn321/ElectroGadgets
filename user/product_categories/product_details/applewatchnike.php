<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apple Watch Nike Series Details</title>
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
                                <img src="../../../assets/img/appleWatchNike.webp" alt="Apple Watch Nike Series" height="300px" width="300px">
                                <h2>Apple Watch Nike Series</h2>
                            </td>
                            <td class="description">
                                <h3>Product Description:</h3>
                                <p>The Apple Watch Nike Series combines style and performance for fitness enthusiasts. 
                                Featuring exclusive Nike watch faces, specialized workout features, and the Nike Run Club integration.
                                <br><br>
                                <h4>Product Specifications:</h4>
                                <ul>
                                    <li>Nike Sport Band or Nike Sport Loop</li>
                                    <li>Exclusive Nike watch faces</li>
                                    <li>Advanced running metrics</li>
                                    <li>Nike Run Club integration</li>
                                    <li>Customizable workout views</li>
                                    <li>Water resistant to 50m</li>
                                    <li>GPS + Cellular connectivity</li>
                                </ul>
                                </p>
                                <br>
                                <h2>Price: 22,999.99</h2>
                                <p>Stock: 25</p>
                                <form action="../../orders.php">
                                    <input type="hidden" name="product" value="Apple Watch Nike Series">
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
