<?php
session_start();
include("../helpers.php");
$category = $_POST["category"];
$title = $_POST["title"] ?? '';
$price = $_POST["price"] ?? '';
$stock = $_POST["stock"] ?? '';
$description = $_POST["description"] ?? '';
$image = $_FILES['image'] ?? '';
error_log($image) ?>