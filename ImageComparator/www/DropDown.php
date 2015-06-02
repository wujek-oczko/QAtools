<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php

    $conn = mysql_connect('msdidev9.thlab.s3', 'root', 'root');
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

    $sort = @$_GET['order'];
    if (!empty($sort)) { // If you Sort it with value of your  select options

        $result = mysql_query("SELECT l.image_name, r.run_number, l.status, full_path FROM mydb.run r JOIN mydb.loaded_images l ON r.id_Run = l.Run_id_Run WHERE r.run_number = '$sort'");
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
                echo '<td><a target="_blank" href="previous/image2.php?image=' . urlencode($row[3]) . '">image</a></td>';
//                echo '<td><a href="image2.php?image=' . urlencode($row[3]) . '">image</a></td>';
                echo"</tr>\n";
            }
            echo "</table>";
        }

    } else { // else if you do not pass any value from select option will return this
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
                echo '<td><a target="_blank" href="previous/image2.php?image=' . urlencode($row[3]) . '">image</a></td>';
//                echo '<td><a href="image2.php?image=' . urlencode($row[3]) . '">image</a></td>';
                echo"</tr>\n";
            }
            echo "</table>";
        }
    }

    ?>

</form>

<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php

    $conn = mysql_connect('msdidev9.thlab.s3', 'root', 'root');
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

    $result = mysql_query("SELECT run_number from mydb.run");
    if (!$result) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }

    echo "<select name=\"order\">";
    echo"<option value=''> Jebaj wszystkie! </option>";
    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_row($result)) {
            echo"<option value='$row[0]'> $row[0] </option>";
        }
        echo "</select>";
        echo "<input type=\"submit\" value=\" Jebaj Kurwa! \" />";
    }

    ?>

</form>