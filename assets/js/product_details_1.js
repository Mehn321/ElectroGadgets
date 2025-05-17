// Extracted from user\product_details.php
$(document).ready(function() {
            // Add to cart animation
            $('#addToCartBtn').on('click', function(e) {
                e.preventDefault(); // Prevent the default form submission
                
                // Get positions
                var imgElement = $('#productImage');
                var cartIcon = $('.cart-icon');
                
                if (imgElement.length && cartIcon.length) {
                    // Create a clone of the image at its current position
                    var imgClone = imgElement.clone()
                        .removeClass()
                        .addClass('flying-image')
                        .css({
                            'position': 'fixed', // Use fixed positioning
                            'top': imgElement.offset().top - $(window).scrollTop(), // Adjust for scroll position
                            'left': imgElement.offset().left,
                            'width': imgElement.width(),
                            'height': imgElement.height(),
                            'opacity': 0.75,
                            'z-index': 1000
                        })
                        .appendTo('body');
                    
                    // First scroll to top to make the header/cart visible
                    $('html, body').animate({
                        scrollTop: 0
                    }, 400, function() {
                        // After scrolling, get the new cart position
                        var cartPosition = {
                            top: cartIcon.offset().top - $(window).scrollTop(), // Adjust for new scroll position
                            left: cartIcon.offset().left
                        };
                        
                        // Now animate the clone to the cart with longer duration
                        imgClone.animate({
                            top: cartPosition.top,
                            left: cartPosition.left,
                            width: 30,
                            height: 30,
                            opacity: 0.5
                        }, {
                            duration: 1000, // Increased from 800 to 1000ms
                            complete: function() {
                                // Add bounce effect to cart icon
                                cartIcon.addClass('cart-bounce');
                                
                                // Remove the clone
                                $(this).remove();
                                
                                // Remove bounce class after animation completes
                                // Increased delay from 500ms to 1000ms
                                setTimeout(function() {
                                    cartIcon.removeClass('cart-bounce');
                                    
                                    // Add the hidden input for add_to_cart action and submit the form
                                    $('#purchaseForm').append('<input type="hidden" name="action" value="add_to_cart">');
                                    $('#purchaseForm').submit();
                                }, 1000); // Increased delay to ensure animation is visible
                            }
                        });
                    });
                } else {
                    // If elements not found, just submit the form with add_to_cart action
                    $('#purchaseForm').append('<input type="hidden" name="action" value="add_to_cart">');
                    $('#purchaseForm').submit();
                }
            });
        });