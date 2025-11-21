<?php
$username = $_POST['username'];
function deleteUser($username)
{
    $json_path = "../users.json";
    $json_data = file_get_contents($json_path);
    $obj = json_decode($json_data);
    foreach ($obj as $index => $user) {
        if ($user->username === $username) {
            unset($obj[$index]);
            break;
        }
    }
    $updated_json_data = json_encode($obj);
    file_put_contents($json_path, $updated_json_data);
    rmdir("../Users/$username");
    echo "Delete Success";
}
deleteUser($username);
?>