<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.html.php");
    exit;
}
$username = $_SESSION['username'];
$loggedtimes = $_SESSION['loggedtimes'];
$userIndex = $_SESSION['userIndex'];
include("../php/extractFolderNumber.php")
    ?>
<html>

<head>
    <script src="../js/handleUserAction.js"></script>
    <script>
        let loginStartTime
        let loginDuration = 0
        let userIndex = <?php echo $userIndex ?>
    </script>
</head>

<body>
    <script>startTimer()</script>
    <h1>Welcome</h1>
    <h2>
        <?php
        echo "User: " . $username . "<br>";
        echo "Logged times: " . $loggedtimes . "<br>";
        ?>
    </h2>
    <form id="logoutForm" action="logout.html.php" method="POST">
        <input type="hidden" id="minutesLoggedIn" name="minutesLoggedIn">
    </form>
    <button onclick="handleLogout()">Logout</button>
</body>

</html>