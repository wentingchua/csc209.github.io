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
    <script>
        var user_id = <?php echo json_encode($user_id) ?>;
        var selected_products = {};
        var nr_selected = 0;
        var total = 0;
    </script>
    <script src="../js/cart.js"></script>
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
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link active" id="cartIcon" href="cart.html.php">Your Cart</a>
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
                        </div>
                    </div>
                    <div id="cartAlert" class="col-10">
                    </div>
                    <div id="cart-section" class="col-10">
                    </div>
                    <div class="col-10">
                        <div class="card">
                            <div class="card-body">
                                <button type="button" onclick="handlePaymentButtonPressed()"
                                    class="btn btn-success btn-block btn-lg mb-3">
                                    Proceed to Pay
                                </button>
                                <div class="d-flex justify-content-end">
                                    <h5 id="totalAmount">Total amount: $0</h5>
                                </div>
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