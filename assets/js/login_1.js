// Extracted from admin\login.php
document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    // Toggle the password visibility
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        togglePassword.classList.remove('bx-hide');
                        togglePassword.classList.add('bx-show');
                    } else {
                        passwordInput.type = 'password';
                        togglePassword.classList.remove('bx-show');
                        togglePassword.classList.add('bx-hide');
                    }
                });
            }
        });