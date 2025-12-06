<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : '';

//get product ids
$json_path = "../../json/users.json";
$users = json_decode(file_get_contents($json_path), true);
$cart = json_decode(file_get_contents("php://input"), true);

$out_of_stock_products = [];

$product_sales_json_path = "../../json/productSales.json";
$product_sales = json_decode(file_get_contents($product_sales_json_path), true);

foreach ($cart as $category => $items) {
    $category_json_path = "../../json/products/$category.json";
    $category_products = json_decode(file_get_contents($category_json_path), true);
    
    foreach ($items as $product_id => $quantity) {
        $product_info = $category_products[$product_id];
        //check if quantitiy > stock
        if ($quantity > $product_info["stock"]) {
            array_push($out_of_stock_products, $product_info["title"]);
            continue;
        }
        //minus quantity
        $category_products[$product_id]["stock"] -= $quantity;
        //remove product id from cart 
        unset($users[$user_id]["cart"][$category][$product_id]);
        //update product sales
        if (isset($product_sales[$product_id])) {
            $product_sales[$product_id]["count"] += $quantity;
            $product_sales[$product_id]["amount"] += $quantity*$product_info["price"];
        } else {
            $newEntry = [];
            $newEntry["title"] = $product_info["title"];
            $newEntry["count"] = $quantity;
            $newEntry["amount"] = $quantity*$product_info["price"];
            $newEntry["category"] = $category;
            $product_sales[$product_id] = $newEntry;
        }
    }
    file_put_contents($category_json_path, json_encode($category_products));
}
file_put_contents($json_path, json_encode($users));
file_put_contents($product_sales_json_path, json_encode($product_sales));

if ($out_of_stock_products == []) {
    echo json_encode("Success");
} else {
    echo json_encode($out_of_stock_products);
}
?>