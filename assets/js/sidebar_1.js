// Extracted from components\sidebar.php
// Function to highlight active menu item
        // Simple active menu highlighting without animations
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