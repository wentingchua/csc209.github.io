<!DOCTYPE html>
<html>

<head>
    <script src="../js/admin.js"></script>
    <link rel="stylesheet" id="stylesheet" href="../css/admin.css">
    <?php
    include '../php/users.php';
    $obj = getUserObj();
    $username = array_column($obj, 'username');
    $password = array_column($obj, 'password');
    $loggedtimes = array_column($obj, 'loggedtimes');
    //handle sorting in server
    //change first argument to change "sort by" value
    // array_multisort($password, SORT_ASC, $obj);
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
            <th>Delete ?</th>
            <th>Edit username?</th>
            <th>Edit password?</th>
        </tr>
        <script>
            function makeTable(users) {
                var table = document.getElementById("table")
                while (table.rows.length > 1) {
                    table.deleteRow(1);
                }
                for (let i = 0; i < users.length; i++) {
                    if (users[i].isAdmin) {
                        continue;
                    }
                    var row = document.createElement("tr")
                    var username = document.createElement("td")
                    username.innerText = users[i].username
                    var password = document.createElement("td")
                    password.innerText = users[i].password
                    var loggedtimes = document.createElement("td")
                    loggedtimes.innerText = users[i].loggedtimes
                    var deleteCol = document.createElement("td")
                    var deleteButton = document.createElement("button")
                    var usernameRaw = users[i].username
                    var passwordRaw = users[i].password
                    deleteButton.setAttribute("onclick", `handleDeleteButtonPressed('${usernameRaw}')`)
                    deleteButton.innerText = "Delete"
                    deleteCol.appendChild(deleteButton)
                    var editUsernameCol = document.createElement("td")
                    var editUsernameButton = document.createElement("button")
                    editUsernameButton.innerText = "Edit"
                    editUsernameButton.setAttribute("onclick", `handleEditButtonPressed('${usernameRaw}', '${passwordRaw}', 'username')`)
                    editUsernameCol.appendChild(editUsernameButton)
                    var editPasswordCol = document.createElement("td")
                    var editPasswordButton = document.createElement("button")
                    editPasswordButton.innerText = "Edit"
                    editPasswordButton.setAttribute("onclick", `handleEditButtonPressed('${usernameRaw}', '${passwordRaw}', 'password')`)
                    editPasswordCol.appendChild(editPasswordButton)
                    row.appendChild(username)
                    row.appendChild(password)
                    row.appendChild(loggedtimes)
                    row.appendChild(deleteCol)
                    row.appendChild(editUsernameCol)
                    row.appendChild(editPasswordCol)
                    table.appendChild(row)
                }
            }
            makeTable(users)
        </script>
    </table>
    <button onclick="handleRefresh()">Refresh</button>

</body>

</html>