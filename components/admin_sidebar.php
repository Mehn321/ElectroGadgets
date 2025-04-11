<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/image_animation.css">
</head>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="/ecommerce/admin/dashboard.php" class="nav-link"><i class='bx bx-grid-alt'></i><span>Dashboard</span></a></li>
            <li><a href="/ecommerce/admin/products.php" class="nav-link"><i class='bx bx-box'></i><span>Products</span></a></li>
            <li><a href="/ecommerce/admin/reports.php" class="nav-link"><i class='bx bx-line-chart'></i><span>Reports</span></a></li>
            <li><a href="/ecommerce/user/home.php" class="nav-link"><i class='bx bx-log-out'></i><span>Logout</span></a></li>
        </ul>
    </div>

    <script>
        // Function to highlight active menu item
        document.addEventListener('DOMContentLoaded', function() {
            // Get current page path
            const currentPath = window.location.pathname;
            
            // Get all navigation links
            const navLinks = document.querySelectorAll('.nav-link');
            
            // Loop through each link
            navLinks.forEach(link => {
                // Get the href attribute
                const linkPath = link.getAttribute('href');
                
                // Check if current path includes the link path
                if (currentPath === linkPath || 
                    (currentPath.includes('/product_categories/') && linkPath.includes('products.php')) ||
                    (currentPath.endsWith('/products.php') && linkPath.includes('products.php'))) {
                    
                    // Add active class to the parent li element
                    link.parentElement.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
