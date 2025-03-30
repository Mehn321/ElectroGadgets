<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mac Pro M2 Ultra Details</title>
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
                                <img src="../../../assets/img/macpro.webp" alt="Mac Pro M2 Ultra" height="300px" width="300px">
                                <h2>Mac Pro M2 Ultra</h2>
                            </td>
                            <td class="description">
                                <h3>Product Description:</h3>
                                <p>The Mac Pro with M2 Ultra represents the pinnacle of Apple silicon performance. 
                                Engineered for extreme workflows and unprecedented expandability.
                                <br><br>
                                <h4>Product Specifications:</h4>
                                <ul>
                                    <li>M2 Ultra chip with up to 24-core CPU</li>
                                    <li>Up to 192GB unified memory</li>
                                    <li>Up to 8TB SSD storage</li>
                                    <li>8 Thunderbolt 4 ports</li>
                                    <li>PCIe expansion slots</li>
                                    <li>Afterburner acceleration card</li>
                                    <li>Rack-mountable design option</li>
                                </ul>
                                </p>
                                <br>
                                <h2>Price: 249,999.99</h2>
                                <p>Stock: 5</p>
                                <form action="../../orders.php">
                                    <input type="hidden" name="product" value="Mac Pro M2 Ultra">
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