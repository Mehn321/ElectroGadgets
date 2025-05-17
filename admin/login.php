<?php
session_start();
require_once '../database/database.php';

// Check if admin is already logged in
if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit;
}

// Initialize variables
$error = '';
$username = '';

// Process login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    // Validate input
    if (empty($username)) {
        $error = "Please enter your username.";
    } elseif (empty($password)) {
        $error = "Please enter your password.";
    } else {
        // Connect to database
        $db = new database();
        $conn = $db->getConnection();
        
        // Prepare statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT admin_id, username, password, full_name FROM admin WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $admin['password'])) {
                // Password is correct, start a new session
                session_regenerate_id();
                
                // Store admin data in session
                $_SESSION['admin_id'] = $admin['admin_id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_name'] = $admin['full_name'];
                
                // Update last login time
                $updateStmt = $conn->prepare("UPDATE admin SET last_login = NOW() WHERE admin_id = ?");
                $updateStmt->bind_param("i", $admin['admin_id']);
                $updateStmt->execute();
                $updateStmt->close();
                
                // Redirect to dashboard
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Incorrect password. Please try again.";
            }
        } else {
            $error = "Username not found. Please check your username.";
        }
        
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Admin Login</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="/ecommerce/assets/css/login_1.css">
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

            <div class="main-content">
                <div class="login-container">
                    <h1 class="login-title">Admin Login</h1>
                    
                    <?php if (!empty($error)): ?>
                    <div class="error-message">
                        <i class='bx bx-error-circle'></i> <?php echo $error; ?>
                    </div>
                    <?php endif; ?>
                    
                    <div class="login-form">
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="password-container">
                                    <input type="password" id="password" name="password" required>
                                    <i class='bx bx-hide password-toggle' id="togglePassword"></i>
                                </div>
                            </div>
                            <button type="submit" class="login-btn">Login</button>
                        </form>
                    </div>
                    
                    <div class="login-footer">
                        <p>Admin Panel - ElectroGadgets</p>
                    </div>
                </div>
            </div>
            
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php'; ?>
        </div>
    </div>

    <?php
// Generate a password hash for 'admin123'
    $password = 'admin123';
    $hash = password_hash($password, PASSWORD_DEFAULT);
    echo "Password hash for 'admin123': " . $hash;
    ?>

    
    <script src="/ecommerce/assets/js/login_1.js"></script>
</body>
</html>