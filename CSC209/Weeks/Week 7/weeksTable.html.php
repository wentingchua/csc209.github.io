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
        <table>
            <tr>
                <th>Date</th>
                <th>Topics</th>
                <th>Remarks</th>
            </tr>
        <?php
            for ($i = 1; $i <= $NRWEEKS; $i++) {
                echo("<tr>\n");
                echo("<td>". $LISTDATES[$i - 1]." </td>\n");
                echo("<td>". $LISTTOPICS[$i - 1]." </td>\n");
                echo("<td>". $LISTREMARKS[$i - 1]." </td>\n");
                echo("</tr>\n");
            }
        ?>
        </table>
    </body>
</html>