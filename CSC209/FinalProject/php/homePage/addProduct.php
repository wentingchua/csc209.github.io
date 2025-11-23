<?php
session_start();
include "../helpers.php";
$category = $_POST["category"];
$title = $_POST["title"] ?? '';
$price = $_POST["price"] ?? '';
$stock = $_POST["stock"] ?? '';
$description = $_POST["description"] ?? '';
$product_id = generateIDandIncrementCount("products");

$json_path = "../../json/products/$category.json";
$json_data = file_get_contents($json_path);
$products = json_decode($json_data, true);
$new_product = [
    "title" => $title,
    "price" => $price,
    "stock" => $stock,
    "description" => $description,
    "reviews" => []
];
$products[$product_id] = $new_product;
$updated_json_data = json_encode($products);
file_put_contents($json_path, $updated_json_data);
//Upload image
$target_dir = "../../products/$category/";
$ext = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
$target_file = $target_dir . $product_id . "." . $ext;
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    header("Location: ../../homePage.html.php");
    exit;
} else {
    echo "Upload failed";
    var_dump($_FILES);
}
?>