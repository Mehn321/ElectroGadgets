// Extracted from user\product_category.php
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
        // let filterButtons = $('<div class="filter-buttons"></div>');
        // filterButtons.append('<button class="filter-btn active" data-filter="all">All</button>');
        
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
        //categories.forEach(function(cat) {
        //    filterButtons.append('<button class="filter-btn" data-filter="' + cat.toLowerCase() + '">' + cat + '</button>');
        //});
        
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