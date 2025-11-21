<?php
session_start();
$username = $_SESSION['username'];
$loggedtimes = $_SESSION['loggedtimes'];
$userIndex = $_SESSION['userIndex'];
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/slideshow.css">
    <link rel="stylesheet" href="../css/user.css">
    <?php
    include "../php/slideshow.php";
    $folders = glob("../Users/*");
    $selectedFolder = $username;
    ?>
    <script>
        let loginStartTime
        let loginDuration = 0
        let userIndex = <?php echo $userIndex ?>
        // initial slide to show
        var slideIndex = 1;
        // initial folder to show
        var currentFolder = "<?php echo $selectedFolder; ?>";
    </script>
    <script src="../js/slideshow.js"></script>
    <script src="../js/handleUserAction.js"></script>
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
    <div class="slideshow-container">
        <?php
        displaySlides($selectedFolder, True);
        ?>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

    </div>
    <br>
    <div id="dots" style="text-align:center">
        <?php
        displayDots($selectedFolder, True);
        ?>
    </div>
    <form id="logoutForm" action="logout.html.php" method="POST">
        <input type="hidden" id="minutesLoggedIn" name="minutesLoggedIn">
    </form>
    <button onclick="handleLogout()">Logout</button>
    <form action="../php/upload.php" method="post" enctype="multipart/form-data">
        <input type="file" id="fileToUpload" name="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
    <script>
        showSlides(1);
    </script>
</body>

</html>