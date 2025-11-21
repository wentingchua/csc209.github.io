<?php
session_start();
$username = $_POST["username"] ?? '';
$password = $_POST["password"] ?? '';

function registerUser($username, $password)
{
    $json_path = "../users.json";
    $json_data = file_get_contents($json_path);
    $obj = json_decode($json_data);

    foreach ($obj as $index => $user) {
        if ($user->username === $username) {
            echo "<script>
            alert('Username already exist.');
            window.history.back();
          </script>";
            return null;
        }
    }

    $newUser = [
        "username" => $username,
        "isAdmin" => false,
        "password" => $password,
        "loggedtimes" => 0,
        "minuteslogged" => []
    ];

    $obj[] = $newUser;

    $updated_json_data = json_encode($obj);
    file_put_contents($json_path, $updated_json_data);
    mkdir("../Users/{$username}");

    $_SESSION['username'] = $username;
    $_SESSION['loggedtimes'] = 0;
    $_SESSION['isAdmin'] = false;
    $_SESSION['userIndex'] = sizeof($obj) - 1;

    header("Location: ../html/user.html.php");
}

registerUser($username, $password);
?>