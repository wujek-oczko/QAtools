<!DOCTYPE HTML>
<html>
<head></head>

<h2>Ultra image comparator</h2>

<!--<form method="post" action="--><?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?><!--">-->
<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php

    $conn = mysql_connect('localhost', 'root', 'root');
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

    $result = mysql_query("SELECT image_name, status, full_path FROM mydb.model_images");
    if (!$result) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }

    echo "<table border='1'><h3>Model Images</h3>";
    echo "<tr><th>name</th><th>status</th></tr>";

    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_row($result)) {
            echo"<tr>";
            $huj = $row[0];
            echo"<td> $row[0] </td>";
            echo"<td> $row[1] </td>";
//            echo"<td> <a href='accept.php?Accept={$row[0]}'>Accept</a> </td>";
            echo"<td> <input type=\"button\" onclick=\"location.href='accept.php?Accept={$row[0]}'\" value = 'Accept'> </td>";
//            echo"<td> <a href='reject.php?Reject={$row[0]}'>Reject</a> </td>";
            echo"<td> <input type=\"button\" onclick=\"location.href='reject.php?Reject={$row[0]}'\" value = 'Reject'> </td>";
            echo '<td><a target="_blank" href="image.php?image=' . urlencode($row[2]) . '">image</a></td>';
            echo"</tr>\n";
        }
        echo "</table>";
    }

    ?>

</form>


<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php

    $conn = mysql_connect('localhost', 'root', 'root');
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

    $result = mysql_query("SELECT l.image_name, r.run_number, l.status, full_path FROM mydb.run r JOIN mydb.loaded_images l ON r.id_Run = l.Run_id_Run");
    if (!$result) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }

    echo "<table border='1'><h3>Loaded Images</h3>";
    echo "<tr><th>name</th><th>Run</th><th>status</th></tr>";

    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_row($result)) {
            echo"<tr>";
            $huj = $row[0];
            echo"<td> $row[0] </td>";
            echo"<td> $row[1] </td>";
            echo"<td> $row[2] </td>";
//            echo"<td> <a href='accept.php?Accept={$row[0]}'>Accept</a> </td>";
            echo"<td> <input type=\"button\" onclick=\"location.href='accept.php?Accept={$row[0]}'\" value = 'Accept'> </td>";
//            echo"<td> <a href='reject.php?Reject={$row[0]}'>Reject</a> </td>";
            echo"<td> <input type=\"button\" onclick=\"location.href='reject.php?Reject={$row[0]}'\" value = 'Reject'> </td>";
            echo '<td><a target="_blank" href="image.php?image=' . urlencode($row[3]) . '">image</a></td>';
            echo"</tr>\n";
        }
        echo "</table>";
    }

    ?>

</form>


</body>
</html>