<?php
session_start();
$category = $_POST["category"];
$product_id = $_POST["product_id"];
$user_id = $_POST["user_id"];

$json_path = "../../json/users.json";
$json_data = file_get_contents($json_path);
$users = json_decode($json_data, true);
if (isset($users[$user_id]["cart"][$category][$product_id])) {
    $users[$user_id]["cart"][$category][$product_id] += 1;
} else {
    $users[$user_id]["cart"][$category][$product_id] = 1;
}
$updated_json_data = json_encode($users);
file_put_contents($json_path, $updated_json_data);
header("Location: ../../homePage.html.php");
?>