<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Steam Deck Details</title>
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
                                <img src="../../../assets/img/steamdeck.webp" alt="Steam Deck" height="300px" width="300px">
                                <h2>Steam Deck</h2>
                            </td>
                            <td class="description">
                                <h3>Product Description:</h3>
                                <p>The Steam Deck is a powerful handheld gaming PC that lets you take your Steam library on the go. 
                                Features custom AMD APU optimized for handheld gaming.
                                <br><br>
                                <h4>Product Specifications:</h4>
                                <ul>
                                    <li>Custom AMD APU with RDNA 2</li>
                                    <li>7-inch 1280x800 LCD touchscreen</li>
                                    <li>16GB LPDDR5 RAM</li>
                                    <li>512GB NVMe SSD</li>
                                    <li>Steam OS 3.0</li>
                                    <li>Customizable controls</li>
                                    <li>40Whr battery</li>
                                </ul>
                                </p>
                                <br>
                                <h2>Price: 39,999.99</h2>
                                <p>Stock: 15</p>
                                <form action="../../orders.php">
                                    <input type="hidden" name="product" value="Steam Deck">
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