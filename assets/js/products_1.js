// Extracted from admin\products.php
// Function to handle product search
    function searchProducts() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const categoryFilter = document.getElementById('categoryFilter').value;
        const rows = document.querySelectorAll('#productTableBody tr');
        
        rows.forEach(row => {
            const productName = row.cells[2].textContent.toLowerCase();
            const categoryName = row.cells[3].textContent.toLowerCase();
            const categoryMatch = categoryFilter === '' || categoryName.includes(categoryFilter);
            
            if (productName.includes(searchTerm) && categoryMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    // Add event listener for category filter
    document.getElementById('categoryFilter').addEventListener('change', searchProducts);
    
    // Add event listener for search input
    document.getElementById('searchInput').addEventListener('keyup', searchProducts);
    
    // Function to show delete confirmation modal
    function confirmDelete(productId, productName) {
        document.getElementById('deleteProductId').value = productId;
        document.getElementById('deleteProductName').textContent = productName;
        document.getElementById('deleteModal').style.display = 'block';
    }
    
    // Function to close delete confirmation modal
    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }
    
    // Function to show add product form
    function showAddForm() {
        document.getElementById('addContainer').style.display = 'block';
        document.getElementById('addImagePreview').style.display = 'none';
    }
    
    // Function to close add product form
    function closeAddForm() {
        document.getElementById('addContainer').style.display = 'none';
        document.getElementById('addProductForm').reset();
    }
    
    // Function to preview image for add form
    function previewAddImage(input) {
        const preview = document.getElementById('addImagePreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }
    
    // Function to show edit form with product data
    function showEditForm(productId) {
        // Fetch product data via AJAX
        fetch(`get_product.php?id=${productId}`)
            .then(response => response.json())
            .then(product => {
                // Populate form fields with product data
                document.getElementById('edit_product_id').value = product.product_id;
                document.getElementById('edit_product_name').value = product.product_name;
                document.getElementById('edit_price').value = product.price;
                document.getElementById('edit_stocks').value = product.stocks;
                document.getElementById('edit_category_id').value = product.category_id;
                document.getElementById('edit_description').value = product.description;
                document.getElementById('current_image').value = product.image_path;
                
                // Set image preview
                const imagePreview = document.getElementById('editImagePreview');
                imagePreview.src = `/ecommerce/${product.image_path}`;
                imagePreview.style.display = 'block';
                
                // Show the edit form
                document.getElementById('editContainer').style.display = 'block';
            })
            .catch(error => {
                console.error('Error fetching product data:', error);
                alert('Failed to load product data. Please try again.');
            });
    }
    
    // Function to close edit form
    function closeEditForm() {
        document.getElementById('editContainer').style.display = 'none';
        document.getElementById('editProductForm').reset();
    }
    
    // Function to preview image for edit form
    function previewEditImage(input) {
        const preview = document.getElementById('editImagePreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    // Form validation for add product form
    document.getElementById('addProductForm').addEventListener('submit', function(event) {
        let isValid = true;
        const productName = document.getElementById('add_product_name').value.trim();
        const price = document.getElementById('add_price').value.trim();
        const stocks = document.getElementById('add_stocks').value.trim();
        const category = document.getElementById('add_category_id').value;
        const description = document.getElementById('add_description').value.trim();
        const image = document.getElementById('add_product_image').files;
        
        // Validate product name (at least 3 characters)
        if (productName.length < 3) {
            alert('Product name must be at least 3 characters long');
            isValid = false;
        }
        
        // Validate price (must be greater than 0)
        if (parseFloat(price) <= 0) {
            alert('Price must be greater than 0');
            isValid = false;
        }
        
        // Validate stocks (must be a non-negative integer)
        if (parseInt(stocks) < 0 || !Number.isInteger(parseFloat(stocks))) {
            alert('Stock must be a non-negative integer');
            isValid = false;
        }
        
        // Validate category selection
        if (category === '') {
            alert('Please select a category');
            isValid = false;
        }
        
        // Validate description (at least 10 characters)
        if (description.length < 10) {
            alert('Description must be at least 10 characters long');
            isValid = false;
        }
        
        // Validate image (must be selected)
        if (image.length === 0) {
            alert('Please select a product image');
            isValid = false;
        }
        
        if (!isValid) {
            event.preventDefault();
        }
    });
    
    // Form validation for edit product form
    document.getElementById('editProductForm').addEventListener('submit', function(event) {
        let isValid = true;
        const productName = document.getElementById('edit_product_name').value.trim();
        const price = document.getElementById('edit_price').value.trim();
        const stocks = document.getElementById('edit_stocks').value.trim();
        const category = document.getElementById('edit_category_id').value;
        const description = document.getElementById('edit_description').value.trim();
        
        // Validate product name (at least 3 characters)
        if (productName.length < 3) {
            alert('Product name must be at least 3 characters long');
            isValid = false;
        }
        
        // Validate price (must be greater than 0)
        if (parseFloat(price) <= 0) {
            alert('Price must be greater than 0');
            isValid = false;
        }
        
        // Validate stocks (must be a non-negative integer)
        if (parseInt(stocks) < 0 || !Number.isInteger(parseFloat(stocks))) {
            alert('Stock must be a non-negative integer');
            isValid = false;
        }
        
        // Validate category selection
        if (category === '') {
            alert('Please select a category');
            isValid = false;
        }
        
        // Validate description (at least 10 characters)
        if (description.length < 10) {
            alert('Description must be at least 10 characters long');
            isValid = false;
        }
        
        if (!isValid) {
            event.preventDefault();
        }
    });
    
    // Close modals when clicking outside
    window.onclick = function(event) {
        const deleteModal = document.getElementById('deleteModal');
        const editContainer = document.getElementById('editContainer');
        const addContainer = document.getElementById('addContainer');
        
        if (event.target === deleteModal) {
            closeDeleteModal();
        }
        
        if (event.target === editContainer) {
            closeEditForm();
        }
        
        if (event.target === addContainer) {
            closeAddForm();
        }
    }
    
    // Auto-focus first field when opening forms
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listener for when the add form becomes visible
        const addObserver = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === 'style' && 
                    document.getElementById('addContainer').style.display === 'block') {
                    document.getElementById('add_product_name').focus();
                }
            });
        });
        
        addObserver.observe(document.getElementById('addContainer'), {
            attributes: true
        });
        
        // Add event listener for when the edit form becomes visible
        const editObserver = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === 'style' && 
                    document.getElementById('editContainer').style.display === 'block') {
                    document.getElementById('edit_product_name').focus();
                }
            });
        });
        
        editObserver.observe(document.getElementById('editContainer'), {
            attributes: true
        });
    });