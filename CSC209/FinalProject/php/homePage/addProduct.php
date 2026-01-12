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

//Upload image
$target_dir = "../../products/$category/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}
$ext = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
$target_file = $target_dir . $product_id . "." . $ext;
$file_name = $product_id . "." . $ext;
$new_product = [
    "title" => $title,
    "price" => $price,
    "stock" => $stock,
    "description" => $description,
    "image_path" => $file_name
];
$products[$product_id] = $new_product;
$updated_json_data = json_encode($products);
file_put_contents($json_path, $updated_json_data);
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    header("Location: ../../homePage.html.php");
    exit;
} else {
    echo "Upload failed";
    var_dump($_FILES);
}
?>