<?php
include '../php/helpers.php';
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : '';
$isAdmin = $user_id === "a0" ? true : false;
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
        var userId = <?php echo $isLoggedIn ? json_encode($user_id) : "" ?>;
        console.log("test")
        console.log(userId)
    </script>
    <script src="../js/profile.js"></script>
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
                            <a class="nav-link" id="cartIcon" href="overview.html.php">Overview</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" id="cartIcon" href="cart.html.php">Your Cart</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="profile.html.php">
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
        <?php if ($isLoggedIn): ?>
            <button onclick="handleLogout()" type="button" class="btn btn-danger mt-3">Log out</button>
            <h1>Welcome to your page, <?php echo htmlspecialchars($user_details["username"]) ?></h1>
            <?php if (!$isAdmin): ?>
                <h4>Your information</h4>
                <table class="table table-bordered">
                    <tbody id="userInformationTable">
                        <tr>
                            <th style="width: 20%">Username</th>
                            <td id="usernameRow"></td>
                        </tr>
                        <tr>
                            <th style="width: 20%">Password</th>
                            <td id="passwordRow"></td>
                        </tr>
                        <tr>
                            <th style="width: 20%">Shipping Address</th>
                            <td id="addressRow"></td>
                        </tr>
                        <tr>
                            <th style="width: 20%">Email</th>
                            <td id="emailRow"></td>
                        </tr>
                        <tr>
                            <th style="width: 20%">Contact</th>
                            <td id="contactRow"></td>
                        </tr>
                    </tbody>
                </table>
                <script>updateUserDetailsTable(userDetails)</script>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" onclick="fillEditModal(userDetails, userId)"
                    data-bs-target="#editUserModal">Edit</button>
            <?php endif; ?>
        <?php else: ?>
            <h2>Click on the Login button or Register if you do not have an account</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#registerModal">Register</button>
        <?php endif; ?>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../php/auth/login.php" method="POST">
                        <div class="mb-3">
                            <label for="loginUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="loginUsername" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Register</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../php/auth/register.php" method="POST">
                        <div class="mb-3">
                            <label for="registerUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="registerUsername" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="registerPassword" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="registerEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerContact" class="form-label">Contact</label>
                            <input type="text" class="form-control" id="registerContact" name="contact" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerAddress" class="form-label">Shipping Address</label>
                            <textarea class="form-control" id="registerAddress" name="shipping_address" rows="3"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <form id="logoutForm" action="../php/auth/logout.php" method="POST"></form>

    <!-- Edit Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Update information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../php/auth/update.php" method="POST">
                        <input type="hidden" id="userId" name="userId">
                        <div class="mb-3">
                            <label for="updateUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="updateUsername" name="username" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="updatePassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="updatePassword" name="password" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="updateEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateContact" class="form-label">Contact</label>
                            <input type="text" class="form-control" id="updateContact" name="contact" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateAddress" class="form-label">Shipping Address</label>
                            <textarea class="form-control" id="updateAddress" name="shipping_address" rows="3"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Update information</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>