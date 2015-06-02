<!DOCTYPE HTML>
<html>
<head></head>

<h2>Ultra image comparator</h2>

<!--<form method="post" action="--><?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?><!--">-->
<!--<form method="get" action="--><?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?><!--">-->
    <?php

    $conn = mysql_connect('localhost', 'root', 'root');
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

    $result = mysql_query("SELECT image_id, image_name, status, full_path FROM mydb.model_images");
    if (!$result) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }

    echo "<table border='1'> <tr><th>name</th><th>status</th></tr>";

    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_row($result)) {
            echo"<tr>";
            $huj = $row[0];
//            echo"<td> $row[0] </td>";
//            echo"<td> $row[1] <img src = \"$row[3]\" > </td>";
            echo"<td> <input type=\"button\" onclick=\"location.href='$row[3]'\" value = '$row[1]'> </td>";
//            echo "<img src = \"$row[3]\" >";
//            echo"<td> <a href='$row[3]'>Accept</a> </td>";
            echo"<td> $row[2] </td>";
//            echo"<td> <a href='accept.php?Accept={$row[0]}'>Accept</a> </td>";
            echo"<td> <input type=\"button\" onclick=\"location.href='accept.php?Accept={$row[0]}'\" value = 'Accept'> </td>";
//            echo"<td> <a href='reject.php?Reject={$row[0]}'>Reject</a> </td>";
            echo"<td> <input type=\"button\" onclick=\"location.href='reject.php?Reject={$row[0]}'\" value = 'Reject'> </td>";
            echo"</tr>\n";
        }
        echo "</table>";
    }

    ?>

<!--</form>-->


</body>
</html>