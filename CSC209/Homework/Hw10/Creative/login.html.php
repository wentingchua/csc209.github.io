<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" id="stylesheet" href="css/login.css">
</head>

<body>
    <h1>Login</h1>
    <form action="php/validateUserPassword.php" method="post">
        Username: <input type="text" name="username"><br>
        Password: <input type="text" name="password"><br>
        <input type="submit">
        <p>No account? Register instead:</p>
    </form>
    <div id="registerModal" class="modal">
        <form action="php/registerUser.php" method="post" class="modal-content">
            Username: <input type="text" name="username"><br>
            Password: <input type="text" name="password"><br>
            <input type="submit">
        </form>
    </div>
    <button onclick="document.getElementById('registerModal').style.display='block'">Register</button>

</body>

</html>