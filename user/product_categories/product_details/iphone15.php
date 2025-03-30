<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iPhone 15 Details</title>
    <link rel="stylesheet" href="../../../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">

</head>
<body>
    <div class="container">
                <?php include '../../../components/sidebar.php'; ?>
        <div class="rightside">
            <?php include '../../../components/header.php'; ?>
            <div class="main-content">
                <div class="product-details">
                    <table border="1" cellspacing="0" align="center" bgcolor="white" class="mtb product-details">
                        <tr>
                            <td class="product-image" align="center">
                                <img src="../../../assets/img/iphone15.webp" alt="iPhone 15" height="300px" width="300px">
                                <h2>iPhone 15</h2>
                            </td>
                            <td class="description">
                                <h3>Product Description:</h3>
                                <p>The iPhone 15 features the powerful A16 Bionic chip and an advanced camera system with a 48MP main camera. 
                                Experience Dynamic Island, USB-C, and stunning photography capabilities.
                                <br><br>
                                <h4>Product Specifications:</h4>
                                <ul>
                                    <li>A16 Bionic chip</li>
                                    <li>6.1-inch Super Retina XDR display</li>
                                    <li>48MP main camera</li>
                                    <li>Up to 512GB storage</li>
                                    <li>Dynamic Island</li>
                                    <li>USB-C connector</li>
                                    <li>Emergency SOS via satellite</li>
                                </ul>
                                </p>
                                <br>
                                <h2>Price: 64,999.99</h2>
                                <p>Stock: 40</p>
                                <form action="../../orders.php">
                                    <input type="hidden" name="product" value="iPhone 15">
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
