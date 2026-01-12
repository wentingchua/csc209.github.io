<?php
$category = $_GET["category"] ?? "";
$path = "../../json/products/$category.json";
echo file_get_contents($path);
?>