<html>
    <head>
        <?php
            $username = $_POST['username'];
            $loggedtimes = $_POST['loggedtimes'];
        ?>
    </head>
    <body>
        <h1>Welcome</h1>
        <h2>
            <?php
            echo "User: " . $username . "<br>";
            echo "Logged times: " . $loggedtimes
            ?>
        </h2>
    </body>
</html>