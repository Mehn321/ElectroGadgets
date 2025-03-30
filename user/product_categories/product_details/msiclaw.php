<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSI Claw A1M Details</title>
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
                                <img src="../../../assets/img/msiclaw.webp" alt="MSI Claw A1M" height="300px" width="300px">
                                <h2>MSI Claw A1M</h2>
                            </td>
                            <td class="description">
                                <h3>Product Description:</h3>
                                <p>The MSI Claw A1M is a powerful handheld gaming PC featuring Intel Core Ultra processors. 
                                Experience PC gaming on the go with exceptional performance and versatility.
                                <br><br>
                                <h4>Product Specifications:</h4>
                                <ul>
                                    <li>Intel Core Ultra 7 155H processor</li>
                                    <li>7-inch 1920x1080 120Hz display</li>
                                    <li>16GB LPDDR5 RAM</li>
                                    <li>1TB NVMe SSD</li>
                                    <li>Intel Arc Graphics</li>
                                    <li>Windows 11 Home</li>
                                    <li>53Whr battery</li>
                                </ul>
                                </p>
                                <br>
                                <h2>Price: 49,999.99</h2>
                                <p>Stock: 20</p>
                                <form action="../../orders.php">
                                    <input type="hidden" name="product" value="MSI Claw A1M">
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