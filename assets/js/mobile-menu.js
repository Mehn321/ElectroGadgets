document.addEventListener('DOMContentLoaded', function() {
  const menuToggle = document.querySelector('.menu-toggle');
  const mobileMenu = document.querySelector('.mobile-menu');
  
  if (!menuToggle || !mobileMenu) return;
  
  menuToggle.addEventListener('click', function() {
    menuToggle.classList.toggle('active');
    mobileMenu.classList.toggle('active');
    document.body.classList.toggle('menu-open');
  });
  
  // Close menu when clicking outside
  document.addEventListener('click', function(event) {
    if (mobileMenu.classList.contains('active') && 
        !mobileMenu.contains(event.target) && 
        !menuToggle.contains(event.target)) {
      menuToggle.classList.remove('active');
      mobileMenu.classList.remove('active');
      document.body.classList.remove('menu-open');
    }
  });
});
