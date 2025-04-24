<?php
    require_once '../database/database.php';
    $dataconn = new database();
    $conn = $dataconn->getConnection();
    
    // Get category from URL parameter
    $category = isset($_GET['category']) ? $_GET['category'] : '';
    
    // Fetch category details
    $stmt = $conn->prepare("SELECT category_id, category_name FROM category WHERE category_name = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $categoryResult = $stmt->get_result();
    $categoryData = $categoryResult->fetch_assoc();
    
    if (!$categoryData) {
        // Redirect to products page if category not found
        header("Location: ../products.php");
        exit;
    }
    
    $categoryId = $categoryData['category_id'];
    $categoryName = $categoryData['category_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - <?php echo $categoryName; ?></title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Add jQuery UI for additional effects -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>
<body>
    <div class="container">
        <?php include '../components/sidebar.php'; ?>
        <div class="rightside">
            <?php include '../components/header.php'; ?>

            <div class="main-content">
                <h1 class="category-title"><?php echo strtoupper($categoryName); ?></h1>
                <div class="products products-category">
                    <?php
                        // Fetch products for this category
                        $sql = "SELECT product_id, product_name, image_path 
                                FROM products 
                                WHERE category_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $categoryId);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        // Debug information
                        echo "<!-- Category ID: " . $categoryId . " -->";
                        echo "<!-- Number of products found: " . $result->num_rows . " -->";
                        
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $productId = $row['product_id'];
                                $productName = $row['product_name'];
                                $imagePath = $row['image_path'];
                                
                                // Debug information
                                echo "<!-- Product ID: " . $productId . ", Name: " . $productName . ", Image: " . $imagePath . " -->";
                                
                                // Generate a URL-friendly version of the product name
                                $productSlug = strtolower(str_replace(' ', '', $productName));
                                
                                // Link directly to the product details page with the product ID as a parameter
                                $productUrl = 'product_details.php?id=' . $productId;
                                
                                echo '<div class="product-item" data-product-id="' . $productId . '">';
                                echo '<button class="product-btn" onclick="window.location.href=\'' . $productUrl . '\'">';
                                echo '<img src="/ecommerce/' . $imagePath . '" alt="' . $productName . '" height="200px" width="200px">';
                                echo '<span>' . $productName . '</span>';
                                echo '</button>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>No products found in this category.</p>';
                        }
                    ?>
                </div>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php'; ?>
        </div>
    </div>

    <!-- Add jQuery UI script at the end of the body -->
    
    <script>
    $(document).ready(function() {
        // Add animation to category title
        $(".category-title").hide().fadeIn(1200);
        
        // Add hover effects to product items
        $(".product-item").hover(
            function() {
                $(this).find('.product-btn').addClass('hover-effect');
                $(this).animate({
                    marginTop: "-10px"
                }, 200);
            },
            function() {
                $(this).find('.product-btn').removeClass('hover-effect');
                $(this).animate({
                    marginTop: "0px"
                }, 200);
            }
        );
        
        // Add staggered animation for products appearing
        $(".product-item").each(function(index) {
            $(this).css({
                'opacity': '0',
                'transform': 'translateY(20px)'
            });
            
            $(this).delay(100 * index).animate({
                opacity: 1,
                transform: 'translateY(0)'
            }, 500);
        });
        
        // Add click effect
        $(".product-btn").click(function() {
            $(this).effect("pulsate", { times: 1 }, 200);
        });

        // Add filter animation
        let filterButtons = $('<div class="filter-buttons"></div>');
        filterButtons.append('<button class="filter-btn active" data-filter="all">All</button>');
        
        // Get unique product names first words to create filter categories
        let categories = [];
        $(".product-item").each(function() {
            let name = $(this).find('span').text();
            let firstWord = name.split(' ')[0];
            if (!categories.includes(firstWord) && firstWord) {
                categories.push(firstWord);
            }
        });
        
        // Add filter buttons
        categories.forEach(function(cat) {
            filterButtons.append('<button class="filter-btn" data-filter="' + cat.toLowerCase() + '">' + cat + '</button>');
        });
        
        // Insert filter buttons before products
        $(".products-category").before(filterButtons);
        
        // Filter functionality
        $(".filter-btn").click(function() {
            $(".filter-btn").removeClass('active');
            $(this).addClass('active');
            
            let filter = $(this).data('filter');
            
            if (filter === 'all') {
                $(".product-item").show('fade', 400);
            } else {
                $(".product-item").each(function() {
                    let name = $(this).find('span').text();
                    let firstWord = name.split(' ')[0].toLowerCase();
                    
                    if (firstWord === filter) {
                        $(this).show('fade', 400);
                    } else {
                        $(this).hide('fade', 400);
                    }
                });
            }
        });
    });
    </script>
    
    <style>
    /* Add some CSS for the jQuery effects */
    .product-item {
        transition: all 0.3s ease;
        margin: 15px;
        display: inline-block;
    }
    
    .hover-effect {
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    
    .category-title {
        position: relative;
        display: inline-block;
        padding-bottom: 10px;
        margin-bottom: 30px;
    }
    
    .category-title:after {
        content: '';
        position: absolute;
        width: 100%;
        height: 3px;
        bottom: 0;
        left: 0;
        background: linear-gradient(to right, #3498db, #2ecc71);
        transform: scaleX(0);
        transform-origin: bottom right;
        transition: transform 0.5s;
        animation: underline 1.5s forwards;
    }
    
    @keyframes underline {
        to {
            transform: scaleX(1);
            transform-origin: bottom left;
        }
    }
    
    .filter-buttons {
        margin: 20px 0;
        text-align: center;
    }
    
    .filter-btn {
        background-color: #f1f1f1;
        border: none;
        color: #333;
        padding: 8px 16px;
        margin: 0 5px;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .filter-btn:hover, .filter-btn.active {
        background-color: #3498db;
        color: white;
    }
    
    .product-btn {
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .product-btn img {
        transition: all 0.5s ease;
    }
    
    .product-btn:hover img {
        transform: scale(1.1);
    }
    </style>
</body>
</html>
