<?php
$productCategories = [];
function getProductsInfo()
{
    global $productCategories;
    $products_json_paths = glob(__DIR__ . "/../../json/products/*.json");
    for ($i = 0; $i < count($products_json_paths); $i++) {
        $category = basename($products_json_paths[$i], ".json");
        $productCategories[$i] = $category;
    }
}
?>