<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - ElectroGadgets Hub</title>
</head>
<body background="images/tech-background.jpg">
    <div>
        <h2>Create Your ElectroGadgets Account</h2>
    
        <form action="process_signup.php" method="POST">
            <div>
                <label for="fullname">Full Name:</label><br>
                <input type="text" id="fullname" name="fullname" required>
            </div>

            <div>
                <label for="email">Email Address:</label><br>
                <input type="email" id="email" name="email" required>
            </div>

            <div>
                <label for="phone">Phone Number:</label><br>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <div>
                <label for="street">Street Address:</label><br>
                <input type="text" id="street" name="street" required>
            </div>

            <div>
                <label for="city">City:</label><br>
                <input type="text" id="city" name="city" required>
            </div>

            <div>
                <label for="state">State/Province:</label><br>
                <input type="text" id="state" name="state" required>
            </div>

            <div>
                <label for="zipcode">ZIP/Postal Code:</label><br>
                <input type="text" id="zipcode" name="zipcode" required>
            </div>

            <div>
                <label for="country">Country:</label><br>
                <input type="text" id="country" name="country" required>
            </div>

            <div>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required>
            </div>

            <div>
                <label for="confirm_password">Confirm Password:</label><br>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <div>
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">I agree to the Terms and Conditions</label>
            </div>

            <button type="submit">Create Account</button>
        </form>

        <div>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>

    <div>
        <a href="home.php">Back to Home</a>
    </div>
</body>
</html>