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
    
    
    <!-- Nivo Slider CSS -->
         <link rel="stylesheet" href="../assets/css/nivo-slider/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../assets/css/nivo-slider/nivo-slider.css" type="text/css" media="screen" />

    


    <style>
        .waveshow {
            display: flex;
            flex-direction: row;
            justify-content: center;
        }
        .waveshow img{
            width: 1000px;
        }
        
        /* Nivo Slider Custom Styles */
        .slider-container {
            width: 80%;
            max-width: 1000px;
            margin: 30px auto;
            position: relative;
        }
        
        .nivoSlider {
            position: relative;
            width: 100%;
            height: auto;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .nivo-caption {
            background: rgba(0,0,0,0.7);
            color: #fff;
            padding: 15px;
            font-size: 16px;
        }
        
        .nivo-controlNav {
            text-align: center;
            padding: 15px 0;
        }
        
        .nivo-controlNav a {
            display: inline-block;
            width: 12px;
            height: 12px;
            background: #ccc;
            border-radius: 50%;
            text-indent: -9999px;
            border: 0;
            margin: 0 5px;
            cursor: pointer;
        }
        
        .nivo-controlNav a.active {
            background: #4299e1;
        }
        
        .nivo-directionNav a {
            position: absolute;
            top: 45%;
            z-index: 9;
            cursor: pointer;
            background: rgba(255,255,255,0.7);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            color: #333;
            font-size: 20px;
            transition: all 0.3s ease;
        }
        
        .nivo-directionNav a:hover {
            background: rgba(255,255,255,0.9);
        }
        
        .nivo-prevNav {
            left: 15px;
        }
        
        .nivo-nextNav {
            right: 15px;
        }
        
        .nivo-html-caption {
            display: none;
        }
    </style>

</head>
<body>
    <div class="container">
        <?php include '../components/sidebar.php'; ?>
        <div class="rightside">
        <?php include '../components/header.php'; ?>
        <div class="main-content">
            <div class="welcome-banner">
                <h1>ElectroGadgets</h1>
                <p>Premium Electronics & Gadgets Store</p>
                <p class="subtitle">Discover Tomorrow's Technology Today</p>
            </div>
            
            <!-- Nivo Slider Implementation -->
            <div class="slider-container">
                <div id="slider" class="nivoSlider">
                    <img src="../assets/img/elega1.webp" height="500px" data-thumb="../assets/img/elega1.webp" alt="ElectroGadgets Product 1" />
                    <img src="../assets/img/elega2.webp" height="500px" data-thumb="../assets/img/elega2.webp" alt="ElectroGadgets Product 2" title="Latest Electronics and Gadgets" />
                    <img src="../assets/img/elega3.webp" height="500px" data-thumb="../assets/img/elega3.webp" alt="ElectroGadgets Product 3" title="#htmlcaption" />
                    <img src="../assets/img/elega4.webp" height="500px" data-thumb="../assets/img/elega4.webp" alt="ElectroGadgets Product 4" title="#htmlcaption" />
                </div>
                <div id="htmlcaption" class="nivo-html-caption">
                    <strong>Premium</strong> electronics and gadgets at <em>competitive</em> prices.
                </div>
            </div>
            
            <?php
            // Connect to database
            $conn = new mysqli("localhost", "root", "", "electrogadgets");
            
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // Get featured products from database - selecting premium products
            $sql = "SELECT p.product_id, p.product_name, p.description, p.price, p.image_path, c.category_name 
                    FROM products p 
                    JOIN category c ON p.category_id = c.category_id 
                    WHERE p.product_id IN (24, 27, 36, 30) 
                    LIMIT 4";
            
            $result = $conn->query($sql);
            ?>

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

        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php';
        ?>
    </div>
    </div>

    
    <!-- jQuery and Nivo Slider JS -->
    <script type="text/javascript" src="../lib/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="../lib/jquery.tools.js"></script>
    <script type="text/javascript" src="../lib/jquery.custom.js"></script>
    <script type="text/javascript" src="../lib/cufon.js"></script>
     
    <script src="../assets/js/jquery-1.10.2.min.js"></script>
    <script src="../assets/js/nivo-slider/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $('#slider').nivoSlider({
                effect: 'fold',              // Specify sets like: 'fold,fade,sliceDown'
                slices: 15,                    // For slice animations
                boxCols: 8,                    // For box animations
                boxRows: 4,                    // For box animations
                animSpeed: 500,                // Slide transition speed
                pauseTime: 3000,               // How long each slide will show
                startSlide: 0,                 // Set starting Slide (0 index)
                directionNav: false,            // Next & Prev navigation
                controlNav: true,              // 1,2,3... navigation
                controlNavThumbs: false,       // Use thumbnails for Control Nav
                pauseOnHover: true,            // Stop animation while hovering
                manualAdvance: false,          // Force manual transitions
                prevText: 'Prev',              // Prev directionNav text
                nextText: 'Next',              // Next directionNav text
                randomStart: false,            // Start on a random slide
                beforeChange: function(){},    // Triggers before a slide transition
                afterChange: function(){},     // Triggers after a slide transition
                slideshowEnd: function(){},    // Triggers after all slides have been shown
                lastSlide: function(){},       // Triggers when last slide is shown
                afterLoad: function(){}        // Triggers when slider has loaded
            });
        });
    </script>
</body>
</html>
