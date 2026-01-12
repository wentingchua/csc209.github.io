<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : '';

$category = $_GET["category"] ?? "";
$product_id = $_GET["product_id"] ?? "";

$json_path = "../../json/users.json";
$users = json_decode(file_get_contents($json_path), true);

if (isset($users[$user_id]["cart"][$category][$product_id])) {
    unset($users[$user_id]["cart"][$category][$product_id]);
    file_put_contents($json_path, json_encode($users));
    echo json_encode("Success");
} else {
    echo json_encode("Fail");
}
?>