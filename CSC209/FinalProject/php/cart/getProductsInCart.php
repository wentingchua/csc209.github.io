<?php
$user_id = $_GET["user_id"] ?? "";
$json_path = "../../json/users.json";
$users = json_decode(file_get_contents($json_path), true);
$cart = $users[$user_id]["cart"];
$fullCart = [];

foreach ($cart as $category => $items) {
    $category_json_path = "../../json/products/$category.json";
    $category_products = json_decode(file_get_contents($category_json_path), true);
    foreach ($items as $product_id => $quantity) {
        $product_info = $category_products[$product_id];
        $cart_product = [
            "quantity" => $quantity,
            "stock" => $product_info["stock"],
            "category" => $category,
            "title" => $product_info["title"],
            "price" => $product_info["price"],
            "description" => $product_info["description"],
        ];
        $fullCart[$product_id] = $cart_product;
    }
}

echo json_encode($fullCart);
?>