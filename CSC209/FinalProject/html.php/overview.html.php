<?php
include '../php/helpers.php';
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : '';
$isAdmin = $user_id === "a0" ? true : false;
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../bootstrapCss/bootstrap.min.css">
    <script src="../bootstrapJs/bootstrap.bundle.min.js"></script>
    <script src="../chartJs/chart.umd.min.js"></script>
    <script src="../js/overview.js"></script>
    <?php include '../php/overview/totalSales.php' ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../homePage.html.php">Our Products</a>
                    </li>
                    <?php if ($isAdmin): ?>
                        <li class="nav-item">
                            <a class="nav-link active" id="cartIcon" href="overview.html.php">Overview</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" id="cartIcon" href="cart.html.php">Your Cart</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.html.php">
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
    <div class="container mt-5">
        <h1>Sales Summary</h1>
        <h2>Total profits: $<?php totalSales() ?></h2>
    </div>
    <div class="container mt-5">
        <canvas id="productSalesByQuantity"></canvas>
        <script>generateBarChartSalesByQuantity()</script>
    </div>
    <!-- <div class="container mt-5">
        <canvas id="pieChart" width="400" height="400"></canvas>
        <script></script>
    </div> -->
</body>

</html>