<?php
function getUserObj()
{
    $json_path = "users.json";
    $json_data = file_get_contents($json_path);
    $obj = json_decode($json_data);
    return $obj;
}
?>