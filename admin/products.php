<?php
require_once '../database/database.php';
$dataconn = new database();
$conn = $dataconn->getConnection();

// Handle product actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        // Delete product
        if ($_POST['action'] === 'delete') {
            $product_id = $_POST['product_id'];
            $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            
            // Redirect to avoid form resubmission
            header("Location: products.php?message=Product deleted successfully");
            exit;
        }
        // Update product
        else if ($_POST['action'] === 'update') {
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $price = $_POST['price'];
            $stocks = $_POST['stocks'];
            $category_id = $_POST['category_id'];
            $description = $_POST['description'];
            
            // Handle image upload if a new image is provided
            $image_path = $_POST['current_image'];
            if (isset($_FILES['product_image']) && $_FILES['product_image']['size'] > 0) {
                $target_dir = "../assets/img/";
                $file_extension = pathinfo($_FILES["product_image"]["name"], PATHINFO_EXTENSION);
                $new_filename = uniqid() . '.' . $file_extension;
                $target_file = $target_dir . $new_filename;
                
                if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                    $image_path = "assets/img/" . $new_filename;
                }
            }
            
            // Update product in database
            $stmt = $conn->prepare("UPDATE products SET product_name = ?, price = ?, stocks = ?, category_id = ?, description = ?, image_path = ? WHERE product_id = ?");
            $stmt->bind_param("sdisssi", $product_name, $price, $stocks, $category_id, $description, $image_path, $product_id);
            $stmt->execute();
            
            // Redirect to avoid form resubmission
            header("Location: products.php?message=Product updated successfully");
            exit;
        }
        // Add new product
        else if ($_POST['action'] === 'add') {
            $product_name = $_POST['product_name'];
            $price = $_POST['price'];
            $stocks = $_POST['stocks'];
            $category_id = $_POST['category_id'];
            $description = $_POST['description'];
            
            // Handle image upload
            $image_path = '';
            if (isset($_FILES['product_image']) && $_FILES['product_image']['size'] > 0) {
                $target_dir = "../assets/img/";
                $file_extension = pathinfo($_FILES["product_image"]["name"], PATHINFO_EXTENSION);
                $new_filename = uniqid() . '.' . $file_extension;
                $target_file = $target_dir . $new_filename;
                
                // Check if image file is a valid image
                $check = getimagesize($_FILES["product_image"]["tmp_name"]);
                if ($check !== false) {
                    // Try to upload file
                    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                        $image_path = "assets/img/" . $new_filename;
                    } else {
                        $error = "Sorry, there was an error uploading your file.";
                    }
                } else {
                    $error = "File is not an image.";
                }
            } else {
                $error = "Product image is required.";
            }
            
            // If no errors, insert product into database
            if (empty($error)) {
                $stmt = $conn->prepare("INSERT INTO products (product_name, price, stocks, category_id, description, image_path) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sdisss", $product_name, $price, $stocks, $category_id, $description, $image_path);
                
                if ($stmt->execute()) {
                    // Redirect to products page with success message
                    header("Location: products.php?message=Product added successfully");
                    exit;
                } else {
                    $error = "Error: " . $stmt->error;
                }
            }
        }
    }
}

// Get all products with category names
$query = "SELECT p.product_id, p.product_name, p.image_path, p.price, p.stocks, p.description, p.category_id, c.category_name 
          FROM products p
          JOIN category c ON p.category_id = c.category_id
          ORDER BY p.product_id";
$result = $conn->query($query);
$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Get product count
$productCount = count($products);

// Get all categories for dropdown
$categoryQuery = "SELECT * FROM category ORDER BY category_name";
$categoryResult = $conn->query($categoryQuery);
$categories = [];

if ($categoryResult->num_rows > 0) {
    while ($row = $categoryResult->fetch_assoc()) {
        $categories[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroGadgets - Admin Products</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
    <?php include '../components/admin_sidebar.php'; ?>
    <div class="rightside">
        <?php include '../components/admin_header.php'; ?>

        <div class="main-content">
            <h1>Product Management</h1>
            
            <?php if (isset($_GET['message'])): ?>
                <div class="message success">
                    <?php echo htmlspecialchars($_GET['message']); ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($error)): ?>
                <div class="message error">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <div class="search-filter">
                <div class="search-box">
                    <input type="text" id="searchInput" class="search-input" placeholder="Search products...">
                    <button class="blue-btn" onclick="searchProducts()"><i class='bx bx-search'></i> Search</button>
                </div>
                <div>
                    <select class="filter-dropdown" id="categoryFilter">
                        <option value="">All Categories</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['category_name']; ?>"><?php echo $category['category_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="add-product">
                <button class="green-btn" onclick="showAddForm()"><i class='bx bx-plus'></i> Add New Product</button>
            </div>
            
            <div class="product-count">
                Showing <?php echo $productCount; ?> products
            </div>
            
            <div class="products-list">
                <section class="product-section">
                    <table class="product-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="productTableBody">
                            <?php if (empty($products)): ?>
                                <tr>
                                    <td colspan="7" style="text-align: center;">No products found</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td><?php echo $product['product_id']; ?></td>
                                        <td>
                                            <img src="/ecommerce/<?php echo $product['image_path']; ?>" alt="<?php echo $product['product_name']; ?>" class="product-image">
                                        </td>
                                        <td><?php echo $product['product_name']; ?></td>
                                        <td><span class="category-badge"><?php echo $product['category_name']; ?></span></td>
                                        <td>₱<?php echo number_format($product['price'], 2); ?></td>
                                        <td><?php echo $product['stocks']; ?></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="blue-btn" onclick="showEditForm(<?php echo $product['product_id']; ?>)">Edit</button>
                                                <button class="red-btn" onclick="confirmDelete(<?php echo $product['product_id']; ?>, '<?php echo addslashes($product['product_name']); ?>')">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </section>
                
                <!-- Pagination - can be implemented if needed -->
                <!-- <div class="pagination">
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">Next</a>
                </div> -->
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/components/Footer.php'; ?>
    </div>
</div>

<!-- Add Product Form Container -->
<div id="addContainer" class="modal-container">
    <div class="modal-form">
        <button type="button" class="close-btn" onclick="closeAddForm()">×</button>
        <h2>Add New Product</h2>
        <form id="addProductForm" method="post" action="products.php" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">
            
            <div class="form-row">
                <div class="form-group">
                    <label for="add_product_name" class="required-field">Product Name</label>
                    <input type="text" class="form-control" id="add_product_name" name="product_name" required>
                </div>
                <div class="form-group">
                    <label for="add_category_id" class="required-field">Category</label>
                    <select class="form-control" id="add_category_id" name="category_id" required>
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['category_id']; ?>">
                                <?php echo $category['category_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="add_price" class="required-field">Price (₱)</label>
                    <input type="number" class="form-control" id="add_price" name="price" step="0.01" min="0" required>
                </div>
                <div class="form-group">
                    <label for="add_stocks" class="required-field">Stock</label>
                    <input type="number" class="form-control" id="add_stocks" name="stocks" min="0" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group full-width">
                    <label for="add_description" class="required-field">Description</label>
                    <textarea class="form-control" id="add_description" name="description" rows="4" required></textarea>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="add_product_image" class="required-field">Product Image</label>
                    <input type="file" class="form-control" id="add_product_image" name="product_image" accept="image/*" onchange="previewAddImage(this)" required>
                    <div id="addImagePreviewContainer">
                        <img id="addImagePreview" class="preview-image" src="" alt="Product Image Preview">
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="button" class="red-btn" onclick="closeAddForm()">Cancel</button>
                <button type="submit" class="green-btn">Add Product</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Product Form Container -->
<div id="editContainer" class="modal-container">
    <div class="modal-form">
        <button type="button" class="close-btn" onclick="closeEditForm()">×</button>
        <h2>Edit Product</h2>
        <form id="editProductForm" method="post" action="products.php" enctype="multipart/form-data">
            <input type="hidden" name="action" value="update">
            <input type="hidden" id="edit_product_id" name="product_id" value="">
            <input type="hidden" id="current_image" name="current_image" value="">
            
            <div class="form-row">
                <div class="form-group">
                    <label for="edit_product_name">Product Name</label>
                    <input type="text" class="form-control" id="edit_product_name" name="product_name" required>
                </div>
                <div class="form-group">
                    <label for="edit_category_id">Category</label>
                    <select class="form-control" id="edit_category_id" name="category_id" required>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="edit_price">Price (₱)</label>
                    <input type="number" class="form-control" id="edit_price" name="price" step="0.01" min="0" required>
                </div>
                <div class="form-group">
                    <label for="edit_stocks">Stock</label>
                    <input type="number" class="form-control" id="edit_stocks" name="stocks" min="0" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group full-width">
                    <label for="edit_description">Description</label>
                    <textarea class="form-control" id="edit_description" name="description" rows="4" required></textarea>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="edit_product_image">Product Image</label>
                    <input type="file" class="form-control" id="edit_product_image" name="product_image" accept="image/*" onchange="previewEditImage(this)">
                    <p class="help-text" style="font-size: 0.8rem; color: #666; margin-top: 5px;">Leave empty to keep current image</p>
                    <div id="editImagePreviewContainer">
                        <img id="editImagePreview" class="preview-image" src="" alt="Product Image Preview">
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="button" class="red-btn" onclick="closeEditForm()">Cancel</button>
                <button type="submit" class="blue-btn">Update Product</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1000;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 5px; width: 400px; max-width: 90%;">
        <h3>Confirm Delete</h3>
        <p>Are you sure you want to delete the product: <span id="deleteProductName"></span>?</p>
        <p style="color: #e74c3c; font-size: 0.9rem;">This action cannot be undone.</p>
        <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
            <button onclick="closeDeleteModal()" style="padding: 8px 15px; background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 4px; cursor: pointer;">Cancel</button>
            <form id="deleteForm" method="post" action="products.php" style="margin: 0;">
                <input type="hidden" name="product_id" id="deleteProductId">
                <input type="hidden" name="action" value="delete">
                <button type="submit" style="padding: 8px 15px; background-color: #e74c3c; color: white; border: none; border-radius: 4px; cursor: pointer;">Delete</button>
            </form>
        </div>
    </div>
</div>

<script src="/ecommerce/assets/js/products_1.js"></script>
</body>
</html>
