<?php
session_start();

$username = $_SESSION['username'] ?? null;
$target_dir = "../Users/" . $username . "/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}$

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
    header("Location: ../html/user.html.php");
    exit;
} else {
    echo "Sorry, there was an error uploading your file.";
}
?>