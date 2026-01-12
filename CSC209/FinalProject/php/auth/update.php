<?php
session_start();
$user_id = $_POST["userId"] ?? '';
$username = $_POST["username"] ?? '';
$password = $_POST["password"] ?? '';
$email = $_POST["email"] ?? '';
$contact = $_POST["contact"] ?? '';
$shipping_address = $_POST["shipping_address"] ?? '';

function updateUser($user_id, $username, $password, $email, $contact, $shipping_address)
{
    $json_path = "../../json/users.json";
    $json_data = file_get_contents($json_path);
    $users = json_decode($json_data, true);
    $new_user = [
        "username" => $username,
        "password" => $password,
        "email" => $email,
        "contact" => $contact,
        "shipping_address" => $shipping_address,
        "cart" => [],
    ];
    if (array_key_exists($user_id, $users)) {
        $users[$user_id] = $new_user;
    }
    $updated_json_data = json_encode($users);
    file_put_contents($json_path, $updated_json_data);
    header("Location: ../../html.php/profile.html.php");
}
updateUser($user_id, $username, $password, $email, $contact, $shipping_address);
?>