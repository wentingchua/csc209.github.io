<?php
function generateIDandIncrementCount($type)
{
    $path = "../json/counts.json";
    $data = file_get_contents($path);
    $counts = json_decode($data, true);
    $current_count = $counts[$type] + 1;
    $counts[$type] = $current_count;
    switch ($type) {
        case "users":
            return "u" . $current_count;
        case "products":
            return "p" . $current_count;
        case "reviews":
            return "r" . $current_count;
    }
}

function getUserDetails($user_id)
{
    $path = "../json/users.json";
    $data = file_get_contents($path);
    $users = json_decode($data, true);
    $target_user = $users[$user_id];
    return $target_user;
}
?>