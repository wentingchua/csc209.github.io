<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : '';

//get product ids
$json_path = "../../json/users.json";
$users = json_decode(file_get_contents($json_path), true);
$cart = $users[$user_id]["cart"];

foreach ($cart as $category => $items) {
    $category_json_path = "../../json/products/$category.json";
    $category_products = json_decode(file_get_contents($category_json_path), true);
    foreach ($items as $product_id => $quantity) {
        $product_info = $category_products[$product_id];
        //check if quantitiy > stock
        if ($quantity > $product_info["stock"]) {
            continue;
        }
        //minus quantity
        $category_products[$product_id]["stock"] -= $quantity;
        //remove product id from cart 
        unset($users[$user_id]["cart"][$category][$product_id]);
    }
    file_put_contents($category_json_path, json_encode($category_products));
}
file_put_contents($json_path, json_encode($users));
echo json_encode("Success");
?>