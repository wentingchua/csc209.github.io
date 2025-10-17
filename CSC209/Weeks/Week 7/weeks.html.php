<?php
//Global constants:

$NRWEEKS = 6;

$LISTDATES = array("Sep 1-7", "Sep 8-14", "Sep 15-20", "Sep 21-27", "Oct 1-7", "Oct 8-14");
$LISTTOPICS = array("Installation", "Html", "Css", "Javascript 1", "", "");
$LISTREMARKS = array("We install software", "We make our first Html", "We style pages with Css", "Get started on Javascript", "", "");
?>

<html>
    <head>

    </head>
    <body>
        <?php
            for ($i = 1; $i <= $NRWEEKS; $i++) {
                echo("<h1>Week ". $i." </h1>\n");
                echo("<h2>". $LISTDATES[$i - 1]." </h2>\n");
                echo("<h3>". $LISTTOPICS[$i - 1]." </h3>\n");
                echo("<p>". $LISTREMARKS[$i - 1]." </p>\n");
            }
        ?>
    </body>
</html>