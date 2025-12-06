<?php
include 'php/helpers.php';
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : '';
$isAdmin = $user_id === "a0" ? true : false;
$user_details = $isLoggedIn ? getUserDetails($user_id) : '';
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="bootstrapCss/bootstrap.min.css">
    <link rel="stylesheet" href="css/finalProject.css">
    <script src="bootstrapJs/bootstrap.bundle.min.js"></script>
    <script src="js/homePage.js"></script>
    <?php include "php/homePage/productCategories.php" ?>
    <?php getProductsInfo() ?>
    <script>
        var productCategories = <?php echo json_encode($productCategories); ?>;
        var isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
        var isAdmin = <?php echo json_encode($isAdmin); ?>;
        var userId = <?php echo json_encode($user_id) ?>;
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="homePage.html.php">Our Products</a>
                    </li>
                    <?php if ($isAdmin): ?>
                        <li class="nav-item">
                            <a class="nav-link" id="cartIcon" href="html.php/overview.html.php">Overview</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" id="cartIcon" href="html.php/cart.html.php">Your Cart</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="html.php/profile.html.php">
                            <?php if ($isLoggedIn): ?>
                                Profile
                            <?php else: ?>
                                Log in / Register
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Additional feature for admin -->
        <?php if ($isAdmin): ?>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Add
                product</button>
        <?php else: ?>
        <?php endif; ?>
        <!-- Add Product Modal -->
        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModal">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="php/homePage/addProduct.php" method="POST" enctype="multipart/form-data">
                            <!-- Dropdown for inside new product modal -->
                            <!-- <div class="mb-3">
                                <label for="createCategoryPrompt" class="form-label">Create new category</label>
                                <input type="checkbox" name="createCategoryPrompt" id="createCategoryPrompt">
                            </div> -->
                            <div class="mb-3">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownButtonNewProduct" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select category
                                    </button>
                                    <div id="categoryDropdownNewProduct"></div>
                                </div>
                            </div>
                            <script>makeDropdownForNewProduct(<?php echo json_encode($productCategories) ?>)</script>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="category" name="category" required>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"
                                    required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" id="image" name="image">
                            </div>
                            <button type="submit" class="btn btn-success">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Category Dropdown -->
        <br>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                id="dropdownButton" aria-expanded="false">
                Select category
            </button>
            <div id="categoryDropdown"></div>
        </div>
        <br>
        <div id="productCards">
        </div>
    </div>
    <script>
        makeDropdown(<?php echo json_encode($productCategories) ?>, isAdmin, isLoggedIn)
        handleCategorySelect(<?php echo json_encode($productCategories[0]) ?>, isAdmin, isLoggedIn) //default
    </script>
</body>

</html>