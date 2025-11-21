<?php
session_start();

$username = $_SESSION['username'] ?? null;
$userIndex = $_SESSION['userIndex'] ?? null;
$minutesLoggedIn = $_POST['minutesLoggedIn'] ?? 0;

if ($username !== null && $userIndex !== null) {
    $json_path = "../users.json";
    $json_data = file_get_contents($json_path);
    $users = json_decode($json_data);
    $users[$userIndex]->minuteslogged[] = (int) $minutesLoggedIn;
    $updated_json_data = json_encode($users);
    file_put_contents($json_path, $updated_json_data);
}
session_unset();
session_destroy();
header("Location: ../login.html.php");
exit;
?>