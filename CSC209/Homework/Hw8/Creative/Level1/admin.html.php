<!DOCTYPE html>
<html>

<head>
    <?php
    include 'users.php';
    $obj = getUserObj();
    $username = array_column($obj, 'username');
    $password = array_column($obj, 'password');
    $loggedtimes = array_column($obj, 'loggedtimes');
    //handle sorting in server
    //change first argument to change "sort by" value
    array_multisort($password, SORT_ASC, $obj);
    ?>
</head>

<body>
    <h1>Admin table</h1>
    <table id="table">
        <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Logged times</th>
        </tr>
        <?php
        for ($i = 0; $i < sizeof($obj); $i++) {
            echo "<tr>";
            echo "<td>" . $obj[$i]->username . "</td>";
            echo "<td>" . $obj[$i]->password . "</td>";
            echo "<td>" . $obj[$i]->loggedtimes . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>

</html>