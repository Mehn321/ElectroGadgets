<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - ElectroGadgets</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
    <div class="container">
        <!-- Sidebar remains the same -->
        <div class="sidebar">
            <ul>
                <li><a href="home.php"><i class='bx bx-home'></i><span>Home</span></a></li>
                <li><a href="products.php"><i class='bx bx-box'></i><span>Products</span></a></li>
                <li><a href="contacts.php"><i class='bx bx-book'></i><span>Contacts</span></a></li>
                <li><a href="../admin/login.php"><i class='bx bx-log-in'></i><span>Login</span></a></li>
            </ul>
        </div>
        <div class="rightside">
            <header class="main-header">
                <div class="logo-container">
                    <img src="../assets/img/ElectroGadgets.png" width="70" alt="Logo">
                    <h1>ElectroGadgets</h1>
                </div>
            </header>
            <div class="main-content">
                <div class="welcome-banner">
                    <h1>Contact Us</h1>
                    <p>We're here to help!</p>
                </div>

                <div class="content-section">
                    <div class="about-us">
                        <img src="../assets/img/nhem.jpg" alt="Nhem Day Aclo" width="200" class="profile-image">
                        <h2>Nhem Day Aclo</h2>
                        <p>Lead Developer</p>
                    </div>

                    <div class="service-highlights">
                        <div class="highlight-box">
                            <i class='bx bx-phone'></i>
                            <p>📞 09674185880</p>
                        </div>
                        <div class="highlight-box">
                            <i class='bx bxl-facebook'></i>
                            <p>Nhem Day G. Aclo</p>
                        </div>
                        <div class="highlight-box">
                            <i class='bx bx-envelope'></i>
                            <p>support@electrogadgets.com</p>
                        </div>
                    </div>
                    <div class="contact-flex">
                        <div class="login-form">
                            <h3>Send us a message</h3>
                            <form>
                                <div class="form-group">
                                    <input type="text" placeholder="Your Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" placeholder="Your Email" required>
                                </div>
                                <div class="form-group">
                                    <select>
                                        <option value="">Select Topic</option>
                                        <option value="support">Technical Support</option>
                                        <option value="sales">Sales Inquiry</option>
                                        <option value="feedback">Feedback</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <textarea placeholder="Your Message" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="login-btn">Send Message</button>
                            </form>
                        </div>

                        <div class="services-list">
                            <h3>Business Hours</h3>
                            <ul>
                                <li>Monday - Friday: 9:00 AM - 6:00 PM</li>
                                <li>Saturday: 10:00 AM - 4:00 PM</li>
                                <li>Sunday: Closed</li>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php';
        ?>
    </div>
</div>
</body>
</html>