<?php

$username = $_POST["username"] ?? '';
$password = $_POST["password"] ?? '';

function validateUserAndPassword($username, $password)
{
    $json_path = "users.json";
    $json_data = file_get_contents($json_path);
    $obj = json_decode($json_data);

    foreach ($obj as $user) {
        if ($user->username === $username && $user->password === $password) {
            $user->loggedtimes++;
            $updated_json_data = json_encode($obj);
            file_put_contents($json_path, $updated_json_data);
            return $user;
        }
    }
    return null;
}

$user = validateUserAndPassword($username, $password);

if ($user) {

    echo '
        <!DOCTYPE html>
        <html>
        <body>
        <form id="redirectForm" action="user.html.php" method="POST">
            <input type="hidden" name="username" value="' . $username . '">
            <input type="hidden" name="loggedtimes" value="' . $user->loggedtimes . '">
        </form>
        <script>
            document.getElementById("redirectForm").submit();
        </script>
        </body>
        </html>
    ';
    exit;
} else {
    echo "<script>
            alert('Invalid username or password.');
            window.history.back();
          </script>";
    exit;
}
?>