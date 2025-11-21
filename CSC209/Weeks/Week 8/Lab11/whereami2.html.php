<!DOCTYPE html>
<html>

<head>
    <?php
    function extractFolderNumber($folder_path) {
        $basename = basename($folder_path);
        $labNrString = substr($basename, strlen($basename) - 2, strlen($basename) - 1);
        $firstDigit = substr($labNrString, 0, 1);
        $secondDigit = substr($labNrString, 1, 2);
        $labNr = 0;
        if (is_numeric($firstDigit) and is_numeric($secondDigit)) {
            $labNr = (int) $labNrString;
        }
        return $labNrString;
    }
    ?>
</head>

<body>
    <h1>This page is for lab XX</h1>
    <p>My lab number is <?php echo extractFolderNumber(realpath("./")) ?> </p>
</body>

</html>