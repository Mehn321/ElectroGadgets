<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apple AirPods 4 Details</title>
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
                                <img src="../../../assets/img/airpods4.webp" alt="AirPods 4" height="300px" width="300px">
                                <h2>AirPods 4</h2>
                            </td>
                            <td class="description">
                                <h3>Product Description:</h3>
                                <p>Experience immersive sound with the all-new Apple AirPods 4. Featuring advanced Active Noise Cancellation, 
                                these earbuds deliver crystal-clear audio while blocking out unwanted external noise.
                                <br><br>
                                <h4>Product Specifications:</h4>
                                <ul>
                                    <li>Active Noise Cancellation technology</li>
                                    <li>Up to 6 hours of listening time with ANC on</li>
                                    <li>Spatial Audio with dynamic head tracking</li>
                                    <li>Sweat and water resistant (IPX4)</li>
                                    <li>Force sensor controls</li>
                                    <li>Adaptive EQ</li>
                                    <li>H1 chip for seamless device switching</li>
                                </ul>
                                </p>
                                <br>
                                <h2>Price: 14,499.99</h2>
                                <p>Stock: 50</p>
                                <form action="../../orders.php">
                                    <input type="hidden" name="product" value="Apple AirPods 4 with Active Noise Cancellation">
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