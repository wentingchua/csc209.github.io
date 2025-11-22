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
    <script>
        var isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false' ?>;
        var userDetails = <?php echo $isLoggedIn ? json_encode(getUserDetails($user_id)) : 'null' ?>;
        console.log(userDetails);
    </script>
    <script src="../js/profile.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../homePage.html">Our Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.html.php">Your Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="profile.html.php">Sign in / Register</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <?php if ($isLoggedIn): ?>
        <div id="loggedin">
            <h1>Welcome to your page, <?php echo $user_details["username"] ?></h1>
        </div>
        <button onclick="handleLogout()" type="button" class="btn">Log out</button>
    <?php else: ?>
        <div id="notloggedin">
            <h2>Click on the Login button or Register if you do not have an account</h2>
        </div>
        <button type="button" class="btn">Register</button>
        <button type="button" class="btn">Login</button>
        <div id="login">
            <form action="../php/auth/login.php" method="POST">
                Username: <input type="text" name="username"><br>
                Password: <input type="text" name="password"><br>
                <input type="submit">
            </form>
        </div>
        <div id="register">
            <form action="../php/auth/register.php" method="POST">
                Username: <input type="text" name="username"><br>
                Password: <input type="text" name="password"><br>
                Email: <input type="text" name="email"><br>
                Contact: <input type="text" name="contact"><br>
                Shipping address: <input type="text" name="shipping_address"><br>
                <input type="submit">
            </form>
        </div>
    <?php endif; ?>
    <form id="logoutForm" action="../php/auth/logout.php" method="POST">
    </form>

</body>

</html>