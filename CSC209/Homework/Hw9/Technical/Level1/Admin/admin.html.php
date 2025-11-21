<!DOCTYPE html>
<html>

<head>
    <script src="admin.js"></script>
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
    <script>
        users = <?php echo json_encode($obj) ?>
    </script>
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
        // 
        // for ($i = 0; $i < sizeof($obj); $i++) {
        //     if (! $obj[$i]->isAdmin) {
        //         echo "<tr>";
        //         echo "<td>" . $obj[$i]->username . "</td>";
        //         echo "<td>" . $obj[$i]->password . "</td>";
        //         echo "<td>" . $obj[$i]->loggedtimes . "</td>";
        //         echo "</tr>";
        //     }
        // }
        ?>
        <script>
            function makeTable(users) {
                var table = document.getElementById("table")
                while (table.rows.length > 1) {
                    table.deleteRow(1);
                }
                for (let i = 0; i < users.length; i++) {
                    var row = document.createElement("tr")
                    var username = document.createElement("td")
                    username.innerText = users[i].username
                    var password = document.createElement("td")
                    password.innerText = users[i].password
                    var loggedtimes = document.createElement("td")
                    loggedtimes.innerText = users[i].loggedtimes
                    row.appendChild(username)
                    row.appendChild(password)
                    row.appendChild(loggedtimes)
                    table.appendChild(row)
                }
            }
            makeTable(users)
        </script>
    </table>
    <button onclick="handleRefresh()">Refresh</button>

</body>

</html>