<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Admin Login</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .password-container {
            position: relative;
            display: flex;
            align-items: center;
        }
        .password-container input {
            width: 100%;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            cursor: pointer;
            color: #666;
            font-size: 20px;
            z-index: 10;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="../user/home.php"><i class='bx bx-home'></i><span>Home</span></a></li>
                <li><a href="../user/products.php"><i class='bx bx-box'></i><span>Products</span></a></li>
                <li><a href="../user/contacts.php"><i class='bx bx-book'></i><span>Contacts</span></a></li>
                <li><a href="login.php"><i class='bx bx-log-in'></i><span>Login</span></a></li>
            </ul>
        </div>
        <div class="rightside">
            <?php include '../components/header.php'; ?>
            <br><br><br>

            <div class="main-content">
                <h1>Admin Login</h1>
                <div class="login-form">
                    <form action="dashboard.php" method="POST">
                        <div class="form-group">
                            <label for="email"><b>Username:</b></label>
                            <input type="text" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password"><b>Password:</b></label>
                            <div class="password-container">
                                <input type="password" id="password" name="password" required>
                                <i class='bx bx-hide password-toggle' id="togglePassword"></i>
                            </div>
                        </div>
                        <button type="submit" class="login-btn">Login</button>
                    </form>
                </div>
            </div>
            <br><br><br>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php';
        ?>
        </div>
    </div>
    
    <!-- Inline JavaScript as a fallback -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    // Toggle the password visibility
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        togglePassword.classList.remove('bx-hide');
                        togglePassword.classList.add('bx-show');
                    } else {
                        passwordInput.type = 'password';
                        togglePassword.classList.remove('bx-show');
                        togglePassword.classList.add('bx-hide');
                    }
                });
            }
        });
    </script>
</body>
</html>