<?php
function dispayDropdown($folders)
{
    for ($i = 0; $i < sizeof($folders); $i++) {
        echo "<option value='" . basename($folders[$i]) . "'>" . basename($folders[$i]) . "</option>";
    }
}
function displaySlides($folderBaseName, $isFirst)
{
    $images = glob("../Users/$folderBaseName/*.jpg");
    $num_images = sizeof($images);

    $displayStyle = $isFirst ? "block" : "none";
    //wrap using another div to control visibility
    // echo "<div class='folder-slides' id='$folderBaseName' style='display: $displayStyle;'>";

    for ($i = 0; $i < $num_images; $i++) {
        $displaySlide = ($i == 0) ? "block" : "none";
        echo "<div class='mySlides' style='display: $displaySlide;'>" .
            "<div class='numbertext'>" . ($i + 1) . " / " . $num_images . "</div>" .
            "<img src='" . $images[$i] . "' style='width:100%'>" .
            "<div class='text'>" . basename($images[$i], ".jpg") . "</div>" .
            "</div>";
    }

    // echo "</div>";
}
function displayDots($folderBaseName, $isFirst)
{
    $images = glob("../Users/$folderBaseName/*.jpg");
    $num_images = sizeof($images);

    for ($i = 0; $i < $num_images; $i++) {
        // Add quotes around the style attribute value
        $activeClass = ($i == 0) ? " active" : "";
        echo "<span class='dot$activeClass' style='display: inline-block;' onclick='currentSlide(" . ($i + 1) . ")'></span>";
    }
}
?>