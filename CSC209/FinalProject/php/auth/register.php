<?php
session_start();
include("../helpers.php");
$username = $_POST["username"] ?? '';
$password = $_POST["password"] ?? '';
$email = $_POST["email"] ?? '';
$contact = $_POST["contact"] ?? '';
$shipping_address = $_POST["shipping_address"] ?? '';

function registerUser($username, $password, $email, $contact, $shipping_address)
{
    $user_id = generateIDandIncrementCount("users");
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
    $users[$user_id] = $new_user;
    $updated_json_data = json_encode($users);
    file_put_contents($json_path, $updated_json_data);
    header("Location: ../../homePage.html.php");
}
registerUser($username, $password, $email, $contact, $shipping_address);
?>