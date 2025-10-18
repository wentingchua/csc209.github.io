<!DOCTYPE html>
<html>

<body>
    <h3>Using readfile()</h3>
    <?php
    echo readfile("information.txt");
    ?>
    <h3>Using fopen()</h3>
    <?php
    $myfile = fopen("information.txt", "r") or die("Unable to open file!");
    echo fread($myfile, filesize("information.txt"));
    fclose($myfile);
    ?>


</body>

</html>