<?php
$username = $_POST['username'];
$field = $_POST['field'];
$value = $_POST['value'];
function editUser($username, $field, $value)
{
    $json_path = "../users.json";
    $json_data = file_get_contents($json_path);
    $obj = json_decode($json_data);
    foreach ($obj as $index => $user) {
        if ($user->username === $username) {
            $user->$field = $value;
            if ($field == 'username') {
                rename("../Users/$username" , "../Users/$value");
            }
            break;
        }
    }
    $updated_json_data = json_encode($obj);
    file_put_contents($json_path, $updated_json_data);
    echo "Edit Success";
}
editUser($username, $field, $value);
?>