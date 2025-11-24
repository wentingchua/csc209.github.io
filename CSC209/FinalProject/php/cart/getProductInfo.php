<?php
$products = $_GET["productsInCart"] ?? "";

$json_path = "../../json/products/$category.json";
$products = json_decode(file_get_contents($json_path), true);
$product = $products[$product_id];
echo json_encode($product);
?>