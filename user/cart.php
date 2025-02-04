<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Shopping Cart</h1>
    <table>
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAll"></th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="checkbox" class="checkbox"></td>
                <td><img src="assets/img/macbookpro.webp" alt="MacBook Pro" width="50" height="50"> Apple MacBook Pro (14-inch, M3)</td>
                <td>1</td>
                <td>&#8369; 100,790</td>
                <td>&#8369; 100,790</td>
            </tr>
            <tr>
                <td><input type="checkbox" class="checkbox"></td>
                <td><img src="assets/img/iphone16Pro.webp" alt="iPhone 16 Pro" width="50" height="50"> Apple iPhone 16 Pro</td>
                <td>2</td>
                <td>&#8369; 61,890</td>
                <td>&#8369; 123,780</td>
            </tr>
            <tr>
                <td colspan="3">Total</td>
                <td>&#8369; 224,570</td>
            </tr>
        </tbody>
    </table>
    <button>Checkout</button>
</body>
</html>