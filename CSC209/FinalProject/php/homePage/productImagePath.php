<?php
$category = $_GET["category"] ?? "";
$product_id = $_GET["product_id"] ?? "";
$path = "../../products/$category/";
$image_paths = scandir($path);
foreach ($image_paths as $path) {
    if (str_contains($path, $product_id)) {
        echo json_encode($path);
        exit();
    }
}
echo json_encode("File not found.");
?>