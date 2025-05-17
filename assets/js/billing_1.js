// Extracted from user\billing.php
$(document).ready(function() {
    $('.form-group input').after('<div class="validation-message"></div>');
    $('head').append(`
        <style>
            .form-group {
                position: relative;
            }
            .validation-message {
                position: absolute;
                background: #ff4444;
                color: white;
                padding: 8px 15px;
                border-radius: 15px;
                font-size: 12px;
                display: none;
                bottom: 60%;
                right: 0;
                margin-bottom: 5px;
                z-index: 100;
                box-shadow: 0 2px 5px rgba(0,0,0,0.2);
                max-width: 200px;
                animation: fadeIn 0.3s ease-in;
            }
    
            .validation-message:before {
                content: '';
                position: absolute;
                bottom: -10px;
                left: 15px;
                border-left: 10px solid transparent;
                border-right: 10px solid transparent;
                border-top: 10px solid #ff4444;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
    `);

    function validateInput(input) {        const value = input.val();
        const id = input.attr('id');
        
        switch(id) {
            case 'firstname':
            case 'lastname':
                if(!/^[a-zA-Z\s]{2,30}$/.test(value)) {
                    showError(input, "Letters only, 2-30 characters");
                }
                break;
            case 'phone':
                if(!/^09\d{9}$/.test(value)) {
                    showError(input, "Format: 09XXXXXXXXX");
                }
                break;
            case 'email':
                if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                    showError(input, "Enter valid email");
                }
                break;
            case 'zip':
                if(!/^\d{4}$/.test(value)) {
                    showError(input, "Enter 4-digit code");
                }
                break;
        }
    }

    function showError(input, message) {
        input.addClass('error');
        input.next('.validation-message').text(message).show();
    }

    $('input').on('input', function() {
        $(this).removeClass('error');
        $(this).next('.validation-message').hide();
    });

    $('input').blur(function() {
        validateInput($(this));
    });

    $('#cardnumber').on('input', function() {
        let value = $(this).val().replace(/\s/g, '');
        if (!/^\d{16}$/.test(value)) {
            showError($(this), "Enter valid 16-digit card number");
        } else {
            $(this).removeClass('error');
            $(this).next('.validation-message').hide();
        }
        // Format with spaces after every 4 digits
        $(this).val(value.replace(/(\d{4})/g, '$1 ').trim());
    });

    $('#transaction_num').on('input', function() {
        if (!/^\d{10}$/.test($(this).val())) {
            showError($(this), "Enter 10-digit transaction number");
        } else {
            $(this).removeClass('error');
            $(this).next('.validation-message').hide();
        }
    });

    $('#total').on('input', function() {
        if (!/^\d+(\.\d{2})?$/.test($(this).val())) {
            showError($(this), "Enter valid amount (e.g., 1000.00)");
        } else {
            $(this).removeClass('error');
            $(this).next('.validation-message').hide();
        }
    });

    $('#expdate').on('change', function() {
        let selected = new Date($(this).val());
        let today = new Date();
        if (selected < today) {
            showError($(this), "Card has expired");
        } else {
            $(this).removeClass('error');
            $(this).next('.validation-message').hide();
        }
    });

    $('#country').on('change', function() {
        if ($(this).val() === '') {
            showError($(this), "Select a country");
        } else {
            $(this).removeClass('error');
            $(this).next('.validation-message').hide();
        }
    });

        // Add this to your existing jQuery validation code
    $('#address').on('input', function() {
        if ($(this).val().length < 10) {
            showError($(this), "Enter complete address with house number and street name");
        } else if (!/^[a-zA-Z0-9\s,.-]+$/.test($(this).val())) {
            showError($(this), "Use only letters, numbers, and basic punctuation");
        } else {
            $(this).removeClass('error');
            $(this).next('.validation-message').hide();
        }
    });

});