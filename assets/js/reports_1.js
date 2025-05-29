// Extracted from admin\reports.php
document.addEventListener('DOMContentLoaded', function() {
        const statusFilter = document.getElementById('statusFilter');
        const dateFilter = document.getElementById('dateFilter');
        const searchInput = document.getElementById('searchInput');
        const orderRows = document.querySelectorAll('.product-row');
        const orderHeaders = document.querySelectorAll('.order-header');
    
        function filterTable() {
            // Get filter values
            const statusValue = statusFilter.value.toLowerCase();
            const dateValue = dateFilter.value;
            const searchValue = searchInput.value.toLowerCase();
        
            // Track which orders have visible products
            const visibleOrders = new Set();
        
            // Filter product rows
            orderRows.forEach(row => {
                const orderId = row.dataset.orderId;
            
                // Get values to filter by
                const status = row.querySelector('.status-pending, .status-processing, .status-shipped, .status-delivered, .status-cancelled')?.textContent.toLowerCase() || '';
                const date = row.cells[2]?.textContent || ''; // Date column
                const orderNumber = row.cells[0]?.textContent.toLowerCase() || '';
                const customer = row.cells[1]?.textContent.toLowerCase() || '';
                const productName = row.cells[3]?.textContent.toLowerCase() || '';
            
                // Status filter
                const statusMatch = statusValue === '' || status.includes(statusValue);
            
                // Date filter
                let dateMatch = true;
                if (dateValue !== '' && date) {
                    const orderDate = new Date(date);
                    const today = new Date();
                
                    if (dateValue === 'today') {
                        dateMatch = orderDate.toDateString() === today.toDateString();
                    } else if (dateValue === 'week') {
                        const last7Days = new Date(today);
                        last7Days.setDate(today.getDate() - 7);
                        dateMatch = orderDate >= last7Days;

                        // else if (dateValue === 'week') {
                        // const weekStart = new Date(today);
                        // weekStart.setDate(today.getDate() - today.getDay());
                        // dateMatch = orderDate >= weekStart;

                    } else if (dateValue === 'month') {
                        dateMatch = orderDate.getMonth() === today.getMonth() && 
                                 orderDate.getFullYear() === today.getFullYear();
                    } else if (dateValue === 'year') {
                        dateMatch = orderDate.getFullYear() === today.getFullYear();
                    }
                }
            
                // Search filter
                const searchMatch = searchValue === '' || 
                                 orderNumber.includes(searchValue) || 
                                 customer.includes(searchValue) || 
                                 productName.includes(searchValue);
            
                // Show/hide row based on all filters
                const shouldShow = statusMatch && dateMatch && searchMatch;
                row.style.display = shouldShow ? '' : 'none';
            
                // If this product is visible, mark its order as visible
                if (shouldShow && orderId) {
                    visibleOrders.add(orderId);
                }
            });
        
            // Show/hide order headers based on whether they have visible products
            orderHeaders.forEach(header => {
                const orderId = header.dataset.orderId;
                header.style.display = visibleOrders.has(orderId) ? '' : 'none';
            });
        }
    
        // Add event listeners to filters
        statusFilter.addEventListener('change', filterTable);
        dateFilter.addEventListener('change', filterTable);
        searchInput.addEventListener('input', filterTable);
    
        // Initial filter application (in case of page reload with values)
        filterTable();
    });
            // Store item data in JavaScript for modal access
        
        // Function to show address modal
        function showAddressModal(itemId) {
            const modal = document.getElementById('addressModal');
            const customerDetails = document.getElementById('customerDetails');
            
            if (itemData[itemId]) {
                const item = itemData[itemId];
                
                // Create HTML content for order details
                let detailsHTML = `
                    <h3>Order #${item.order_number}</h3>
                    <p><span class="detail-label">Name:</span> ${item.customer}</p>
                    <p><span class="detail-label">Email:</span> ${item.email}</p>
                    <p><span class="detail-label">Phone:</span> ${item.phone}</p>
                    <p><span class="detail-label">Address:</span> ${item.address}</p>
                    <p><span class="detail-label">Country:</span> ${item.country}</p>
                    <p><span class="detail-label">ZIP Code:</span> ${item.zip}</p>
                    <p><span class="detail-label">Order Date:</span> ${new Date(item.date).toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    })}</p>
                    <h3>Product Details</h3>
                    <p><span class="detail-label">Product:</span> ${item.product_name}</p>
                    <p><span class="detail-label">Quantity:</span> ${item.quantity}</p>
                    <p><span class="detail-label">Price:</span> ₱${parseFloat(item.price).toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    })}</p>
                    <p><span class="detail-label">Total:</span> ₱${(parseFloat(item.price) * item.quantity).toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    })}</p>

                    <p><span class="detail-label">Status:</span> ${item.status.charAt(0).toUpperCase() + item.status.slice(1)}</p>
                `;
                
                customerDetails.innerHTML = detailsHTML;
            } else {
                customerDetails.innerHTML = '<p>Order details not found.</p>';
            }
            
            modal.style.display = 'block';
        }
        
        // Function to close address modal
        function closeAddressModal() {
            const modal = document.getElementById('addressModal');
            modal.style.display = 'none';
        }
        
        // Close modal when clicking outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('addressModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }
        
        // Close modal when pressing Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeAddressModal();
            }
        });