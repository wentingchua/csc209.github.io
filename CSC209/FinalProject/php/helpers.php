<?php

function generateIDandIncrementCount($type)
{
    $path = "../../json/couns.json";
    $data = file_get_contents($path);
    $counts = json_decode($data, true);
    $current_count = $counts[$type] + 1;
    switch ($type) {
        case "user":
            $counts["user_count"] = $current_count;
            return "u" . $current_count;
        case "product":
            $counts["product_count"] = $current_count;
            return "p" . $current_count;
        case "review":
            $counts["review_count"] = $current_count;
            return "r" . $current_count;
    }
}