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
    <h3>Using fwrite()</h3>
    <?php
    $myfile = fopen("information.txt", "w") or die("Unable to open file!");
    $txt = "John Doe\n";
    fwrite($myfile, $txt);
    $txt = "Jane Doe\n";
    fwrite($myfile, $txt);
    fclose($myfile);
    ?>



</body>

</html>