<?php
include '../php/helpers.php';
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : '';
$user_details = $isLoggedIn ? getUserDetails($user_id) : '';
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../bootstrapCss/bootstrap.min.css">
    <script src="../bootstrapJs/bootstrap.bundle.min.js"></script>
    <script src="../js/cart.js"></script>
    <script>
        var user_id = <?php echo json_encode($user_id) ?>
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../homePage.html.php">Our Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="cart.html.php">Your Cart</a>
                    </li>
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
    <?php if (!$isLoggedIn): ?>
        <section class="h-100">
            <h1>Please log in to view your cart.</h1>
        </section>
    <?php else: ?>
        <section class="h-100">
            <div class="container h-100 py-5">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-10">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="fw-normal mb-0">Shopping Cart</h3>
                            <!-- <div>
                                <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!"
                                        class="text-body">price <i class="fas fa-angle-down mt-1"></i></a></p>
                            </div> -->
                        </div>
                    </div>
                    <div id="cart-section" class="col-10">
                    </div>
                    <div class="col-10">
                        <div class="card">
                            <div class="card-body">
                                <button type="button" data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-warning btn-block btn-lg">Proceed to Pay</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <script>
        getCartInfo(user_id)
    </script>
</body>

</html>