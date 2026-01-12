<?php
session_start();
$username = $_POST["username"] ?? '';
$password = $_POST["password"] ?? '';

function validateUserAndPassword($username, $password)
{
    $json_path = "../../json/users.json";
    $json_data = file_get_contents($json_path);
    $users = json_decode($json_data,true);

    foreach ($users as $user_id => $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            return ['user_id' => $user_id, 'isAdmin' => $user_id === "a0000"];
        }
    }
    return null;
}

$item = validateUserAndPassword($username, $password);

if ($item) {
    $user_id = $item['user_id'];
    $isAdmin = $item['isAdmin'];

    $_SESSION['user_id'] = $user_id;
    $_SESSION['isAdmin'] = $isAdmin;
    
    $target_path = "Location: ../../homePage.html.php";
    header($target_path);

    exit;
} else {
    echo "<script>
            alert('Invalid username or password.');
            window.history.back();
          </script>";
    exit;
}
?>