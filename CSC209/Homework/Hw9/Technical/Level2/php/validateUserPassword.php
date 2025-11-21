<?php
session_start();
$username = $_POST["username"] ?? '';
$password = $_POST["password"] ?? '';

function validateUserAndPassword($username, $password)
{
    $json_path = "../users.json";
    $json_data = file_get_contents($json_path);
    $obj = json_decode($json_data);

    foreach ($obj as $index => $user) {
        if ($user->username === $username && $user->password === $password) {
            $user->loggedtimes++;
            $obj[$index] = $user;
            $updated_json_data = json_encode($obj);
            file_put_contents($json_path, $updated_json_data);
            return ['user' => $user, 'index' => $index];
        }
    }
    return null;
}

$item = validateUserAndPassword($username, $password);

if ($item) {
    $user = $item['user'];
    $index = $item['index'];

    $_SESSION['username'] = $user->username;
    $_SESSION['loggedtimes'] = $user->loggedtimes;
    $_SESSION['isAdmin'] = $user->isAdmin;
    $_SESSION['userIndex'] = $user->userIndex;

    if ($user->isAdmin) {
        $target_path = "Location: ../html/admin.html.php";
        header($target_path);
    } else {
        $target_path = "Location: ../html/user.html.php";
        header($target_path);
    }
    exit;
} else {
    echo "<script>
            alert('Invalid username or password.');
            window.history.back();
          </script>";
    exit;
}
?>