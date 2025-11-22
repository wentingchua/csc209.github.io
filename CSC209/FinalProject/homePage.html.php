<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="bootstrapCss/bootstrap.min.css">
    <script src="bootstrapJs/bootstrap.bundle.min.js"></script>
    <script src="js/homePage.js"></script>
    <?php include "php/homePage/productCategories.php" ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="homePage.html.php">Our Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="html.php/cart.html.php">Your Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="html.php/profile.html.php">Sign in / Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php getProductsInfo() ?>
        <!-- Product Category Dropdown -->
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Select category
            </button>
            <div id="categoryDropdown"></div>
        </div>
        <div id="productCards">
        </div>
    </div>
    <script>
        makeDropdown(<?php echo json_encode($productCategories) ?>)
        handleCategorySelect("skincare") //default
    </script>
</body>

</html>