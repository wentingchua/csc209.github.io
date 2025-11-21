<!DOCTYPE html>
<html>

<head>
    <?php
    $path = realpath("./");
    $basename = basename($path);
    $labNrString = substr($basename, strlen($basename) - 2, strlen($basename) - 1);
    $firstDigit = substr($labNrString, 0, 1);
    $secondDigit = substr($labNrString, 1, 2);
    $labNr = 0;
    if (is_numeric($firstDigit) and is_numeric($secondDigit)) {
        $labNr = (int) $labNrString;
    }
    echo $path;
    echo "<br/>";
    echo $basename ?> <?php echo "<br/>";
    echo $labNrString;
    echo "<br/>";
    ?>
</head>

<body>
    <p>This page figures out its whereabouts.</p>
    <p>My lab number is <?php echo $labNr ?> </p>
</body>

</html>