<!DOCTYPE HTML>
<html>

<head>
    <?php
    $minutesLoggedIn = $_POST["minutesLoggedIn"];
    $folderNumber = $_POST["folderNumber"];
    $json_path = "users.json";
    $json_data = file_get_contents($json_path);
    $users = json_decode($json_data);
    $users[$folderNumber - 1]->minuteslogged[] = (int) $minutesLoggedIn;
    $updated_json_data = json_encode($users);
    file_put_contents($json_path, $updated_json_data);
    ?>
</head>

<body>
    <h1>Bye bye</h1>

</body>

</html>