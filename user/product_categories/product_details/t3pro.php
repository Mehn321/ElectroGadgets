<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T3 Pro Details</title>
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
                                <img src="../../../assets/img/t3pro.webp" alt="T3 Pro" height="300px" width="300px">
                                <h2>T3 Pro</h2>
                            </td>
                            <td class="description">
                                <h3>Product Description:</h3>
                                <p>The T3 Pro sets a new standard for mobile gaming with its revolutionary display technology 
                                and AI-enhanced performance optimization.
                                <br><br>
                                <h4>Product Specifications:</h4>
                                <ul>
                                    <li>7.2-inch Mini LED Display</li>
                                    <li>Dimensity 9300 Ultra</li>
                                    <li>32GB LPDDR5X RAM</li>
                                    <li>1TB UFS 4.0 Storage</li>
                                    <li>8500mAh Battery</li>
                                    <li>RGB Gaming Triggers</li>
                                    <li>Quantum Cooling System</li>
                                </ul>
                                </p>
                                <br>
                                <h2>Price: 54,999.99</h2>
                                <p>Stock: 12</p>
                                <form action="../../orders.php">
                                    <input type="hidden" name="product" value="T3 Pro">
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