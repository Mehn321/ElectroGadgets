<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beats Solo Buds Details</title>
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
                                <img src="../../../assets/img/beatssolobuds.webp" alt="Beats Solo Buds" height="300px" width="300px">
                                <h2>Beats Solo Buds</h2>
                            </td>
                            <td class="description">
                                <h3>Product Description:</h3>
                                <p>Beats Solo Buds deliver powerful, balanced sound in a sleek wireless design. 
                                Perfect for workouts and daily use with sweat resistance and secure-fit wingtips.
                                <br><br>
                                <h4>Product Specifications:</h4>
                                <ul>
                                    <li>Custom acoustic platform</li>
                                    <li>Class 1 Bluetooth connectivity</li>
                                    <li>Up to 8 hours of listening time</li>
                                    <li>Secure-fit wingtips</li>
                                    <li>One-touch pairing</li>
                                    <li>Built-in microphones</li>
                                    <li>IPX4 sweat and water resistant</li>
                                </ul>
                                </p>
                                <br>
                                <h2>Price: 12,999.99</h2>
                                <p>Stock: 40</p>
                                <form action="../../orders.php">
                                    <input type="hidden" name="product" value="Beats Solo Buds">
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