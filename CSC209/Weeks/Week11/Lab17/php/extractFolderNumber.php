<?php
function extractFolderNumber($folder_path)
{
    $basename = basename($folder_path);
    $nrString = substr($basename, strlen($basename) - 1, strlen($basename) - 1);
    $nrInt = (int) $nrString;
    return $nrInt;
}

?>