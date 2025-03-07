<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/image_animation.css">

    <script type="text/javascript" src="../lib/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="../lib/jquery.tools.js"></script>
    <script type="text/javascript" src="../lib/jquery.custom.js"></script>
    <script type="text/javascript" src="../lib/cufon.js"></script>

    <style>
        .waveshow {
            display: flex;
            flex-direction: row;
            justify-content: center;
        }
        .waveshow img{
            width: 1000px;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <li>
                    <a href="home.html">
                        <i class='bx bx-home'></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="products.html">
                        <i class='bx bx-box'></i>
                        <span>Products</span>
                    </a>
                </li>
                <li>
                    <a href="contacts.html">
                        <i class='bx bx-book'></i>
                        <span>Contacts</span>
                    </a>
                </li>
                <li>
                    <a href="../admin/login.html">
                        <i class='bx bx-log-in'></i>
                        <span>Login</span>
                    </a>
                </li>
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
                <h1>ElectroGadgets</h1>
                <p>Premium Electronics & Gadgets Store</p>
                <p class="subtitle">Discover Tomorrow's Technology Today</p>
            </div>
            <div class="containerer">
                <div class="gallery" id="spin">
                    <span style="--i:1"><img src="../assets/img/elega1.webp" alt=""> </span>
                    <span style="--i:2"><img src="../assets/img/elega2.webp" alt=""></span>
                    <span style="--i:3"><img src="../assets/img/elega3.webp" alt=""></span>
                    <span style="--i:4"><img src="../assets/img/elega4.webp" alt=""></span>
                </div>
            </div>
            <!-- <div id="header">
                <div id="slider_bg">
                    <div class="waveshow">
                    <img src="../assets/img/elega1.webp" alt="" width="300px">
                    <img src="../assets/img/elega1.webp" alt="" width="300px">
                    <img src="../assets/img/elega1.webp" alt="" width="300px">
                    <img src="../assets/img/elega1.webp" alt="" width="300px">
                    <img src="../assets/img/elega2.webp" alt="" width="300px">
                    <img src="../assets/img/elega3.webp" alt="" width="300px">
                    <img src="../assets/img/elega4.webp" alt="" width="300px">
                    </div>
                </div>
            </div> -->

            <div class="content-section">
                <div class="about-us">
                    <h2>Your Tech Partner</h2>
                    <p>ElectroGadgets brings you the latest iPhones, laptops, smart home devices, and gaming accessories from Apple, Samsung, Sony and other premium brands. With 5+ years in the industry, we deliver quality and innovation.</p>
                    <p>Our commitment to excellence has made us the most trusted electronics retailer in the region, serving over 10,000 satisfied customers.</p>
                </div>

                <div class="service-highlights">
                    <div class="highlight-box">
                        <h3>Free Delivery</h3>
                        <p>Orders above ₱20,000</p>
                        <p class="highlight-detail">Next-day delivery available</p>
                    </div>
                    <div class="highlight-box">
                        <h3>Expert Support</h3>
                        <p>7 days a week</p>
                        <p class="highlight-detail">Live chat & phone support</p>
                    </div>
                    <div class="highlight-box">
                        <h3>Money Back</h3>
                        <p>30-day guarantee</p>
                        <p class="highlight-detail">Hassle-free returns</p>
                    </div>
                </div>

                <div class="why-choose-us">
                    <h2>Why Choose ElectroGadgets?</h2>
                    <div class="reasons-grid">
                        <div class="reason">
                            <h3>Authentic Products</h3>
                            <p>100% genuine products with manufacturer warranty</p>
                        </div>
                        <div class="reason">
                            <h3>Best Prices</h3>
                            <p>Competitive prices with regular deals and discounts</p>
                        </div>
                        <div class="reason">
                            <h3>Secure Shopping</h3>
                            <p>Protected payments and data encryption</p>
                        </div>
                        <div class="reason">
                            <h3>Expert Staff</h3>
                            <p>Trained professionals to assist your needs</p>
                        </div>
                    </div>
                </div>

                <div class="services-list">
                    <h2>What We Offer</h2>
                    <ul>
                        <li>Technical support from certified experts</li>
                        <li>Product installation services</li>
                        <li>Extended warranty packages</li>
                        <li>Price match guarantee</li>
                        <li>Same-day delivery options</li>
                        <li>Trade-in programs for old devices</li>
                        <li>Customized business solutions</li>
                        <li>Regular tech workshops and events</li>
                    </ul>
                </div>

                <div class="newsletter">
                    <h2>Stay Updated</h2>
                    <p>Subscribe to our newsletter for the latest tech news and exclusive offers!</p>
                    <form class="subscribe-form">
                        <input type="email" placeholder="Enter your email">
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- <footer class="main-footer" align="center">
            <div class="footer-content">
                <p>© 2024 ElectroGadgets by Nhem Day Aclo.</p>
            </div>
        </footer> -->
        <?php include '../components\Footer.html'; ?>
    </div>
    </div>
</body>
</html>