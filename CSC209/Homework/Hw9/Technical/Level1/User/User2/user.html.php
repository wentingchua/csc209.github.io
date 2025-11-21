<html>

<head>
    <?php
    $username = $_POST['username'];
    $loggedtimes = $_POST['loggedtimes'];
    include("../extractFolderNumber.php")
        ?>
    <script src="../handleUserAction.js"></script>
    <script>
        let loginStartTime
        let loginDuration = 0
        let folderNumber = <?php echo extractFolderNumber(realpath("./")) ?>
    </script>
</head>

<body>
    <script>startTimer()</script>
    <h1>Welcome</h1>
    <h2>
        <?php
        echo "User: " . $username . "<br>";
        echo "Logged times: " . $loggedtimes . "<br>";
        echo extractFolderNumber(realpath("./"))
            ?>
    </h2>
    <form id="logoutForm" action="../../logout.html.php" method="POST">
        <input type="hidden" id="minutesLoggedIn" name="minutesLoggedIn">
        <input type="hidden" id="folderNumber" name="folderNumber">
    </form>
    <button onclick="handleLogout()">Logout</button>
</body>

</html>