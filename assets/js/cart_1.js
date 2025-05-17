// Extracted from user\cart.php
// Function to format number with commas for thousands
    function formatNumber(number) {
        return number.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    // Function to update subtotal when quantity changes
    function updateItemSubtotal(quantityInput) {
        const row = quantityInput.closest('tr');
        const price = parseFloat(row.dataset.price);
        const quantity = parseInt(quantityInput.value);
        const subtotal = price * quantity;
        
        // Update the subtotal display with formatted number
        const subtotalCell = row.querySelector('.item-subtotal');
        subtotalCell.textContent = '₱' + formatNumber(subtotal);
        
        // Update the total for selected items
        updateTotal();
    }

    // Function to update the total based on checked items
    function updateTotal() {
        let total = 0;
        const rows = document.querySelectorAll('.cart-item');
    
        rows.forEach(row => {
            const checkbox = row.querySelector('.item-checkbox');
            if (checkbox.checked) {
                const price = parseFloat(row.dataset.price);
                const quantity = parseInt(row.querySelector('.quantity-input').value);
                total += price * quantity;
            }
        });
    
        // Update the total display with formatted number
        document.getElementById('cartTotal').textContent = '₱' + formatNumber(total);
    }

    // Function to toggle all checkboxes
    function toggleAllCheckboxes() {
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.item-checkbox');
    
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAll.checked;
        });
    
        updateTotal();
    }

    // Function to remove an item directly
    function removeItem(productId) {
        if (confirm('Are you sure you want to remove this item from your cart?')) {
            document.getElementById('remove_product_id').value = productId;
            document.getElementById('removeForm').submit();
        }
    }

    // Initialize the total on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateTotal();
    });