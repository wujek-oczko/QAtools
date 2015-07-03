<!DOCTYPE HTML>
<html>
<head></head>

<h2>Ultra image comparator</h2>

<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php

    $conn = mysql_connect('msdidev9.thlab.s3', 'root', 'root');
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

    $result = mysql_query("SELECT image_name, status, full_path, image_id
                            FROM mydb.model_images");
    if (!$result) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }

    echo "<table border='1'><h3>Model Images</h3>";
    echo "<tr><th>name</th><th>status</th></tr>";

    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_row($result)) {
            echo"<tr>";
            echo"<td> $row[0] </td>";
            echo"<td> $row[1] </td>";
            echo '<td><a href="preview2.php?image=' . $row[3] . '">image</a></td>';
            echo"</tr>\n";
        }
        echo "</table>";
    }

    ?>

</form>

<table border='1'><h3>Loaded Images</h3>
    <tr><th>name</th><th>Miniature</th><th>Run number

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
                echo"<option value=''> All Runs </option>";
                if (mysql_num_rows($result) > 0) {
                    while ($row = mysql_fetch_row($result)) {
                        echo"<option value='$row[0]'> $row[0] </option>";
                    }
                    echo "</select>";
                    echo "<input type=\"submit\" value=\" Filter Run  \" />";
                }

                ?>

        </th>
        <th>Status

                <?php

                    echo "<select name=\"order2[]\" multiple>";
                    echo "<option value=''> All Statuses </option>";
                    echo "<option value='Accepted'> Accepted </option>";
                    echo "<option value='Rejected'> Rejected </option>";
                    echo "<option value='NEW'> NEW </option>";
                    echo "<option value='DIFFERENT'> DIFFERENT </option>";
                    echo "</select>";
                    echo "<input type=\"submit\" value=\" Filter By Status  \" />";

                ?>

            </form>

        </th><th>Preview</th>
    </tr>

    <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php

            $conn = mysql_connect('msdidev9.thlab.s3', 'root', 'root');
            if (!$conn) {
                die('Could not connect: ' . mysql_error());
            }

            $sort = @$_GET['order'];
            $sort2 = @$_GET['order2'];

            if (!empty($sort)) { // Marked sorting by RUN

                if(!empty($sort2)){ // Marked sorting by STATUS and by RUN

                    $tyryry =  "'". implode("', '", (array)$sort2) ."'";

                        $result = mysql_query("SELECT l.image_name, r.run_number, l.status, l.full_path, l.image_id
                                    FROM mydb.run r JOIN mydb.loaded_images l ON r.id_Run = l.Run_id_Run
                                    WHERE r.run_number = '$sort' AND l.status IN ($tyryry)
                                    ORDER BY r.run_number DESC ");

                        if (!$result) {
                            echo 'Could not run query: ' . mysql_error();
                            exit;
                        }

                        if (mysql_num_rows($result) > 0) {
                            while ($row = mysql_fetch_row($result)) {
                                echo"<tr>";
                                echo"<td> $row[0] </td>";
                                echo"<td><img src=\"image.php?image={$row['3']}\" style=\"width:120px;\"></td>";
                                echo"<td> $row[1] </td>";
                                echo"<td> $row[2] </td>";
                                echo '<td><a href="preview.php?image=' . $row[4] . '">image</a></td>';
                                echo"</tr>\n";
                            }
                        }
                    echo "</table>";

                }else{ // No sorting by STATUS but sorted by RUN
                    $result = mysql_query("SELECT l.image_name, r.run_number, l.status, l.full_path, l.image_id
                                    FROM mydb.run r JOIN mydb.loaded_images l ON r.id_Run = l.Run_id_Run
                                    WHERE r.run_number = '$sort'
                                    ORDER BY r.run_number DESC ");
                    if (!$result) {
                        echo 'Could not run query: ' . mysql_error();
                        exit;
                    }

                    if (mysql_num_rows($result) > 0) {
                        while ($row = mysql_fetch_row($result)) {
                            echo"<tr>";
                            echo"<td> $row[0] </td>";
                            echo"<td><img src=\"image.php?image={$row['3']}\" style=\"width:120px;\"></td>";
                            echo"<td> $row[1] </td>";
                            echo"<td> $row[2] </td>";
                            echo '<td><a href="preview.php?image=' . $row[4] . '">image</a></td>';
                            echo"</tr>\n";
                        }
                    }
                    echo "</table>";
                }

            } else { // No sorting by RUN
                if (!empty($sort2)) { // Marked sorting by STATUS
                    $tyryry =  "'". implode("', '", (array)$sort2) ."'";

                        $result = mysql_query("SELECT l.image_name, r.run_number, l.status, l.full_path, l.image_id
                                        FROM mydb.run r JOIN mydb.loaded_images l ON r.id_Run = l.Run_id_Run
                                        WHERE l.status IN ($tyryry)
                                        ORDER BY r.run_number DESC ");
                        if (!$result) {
                            echo 'Could not run query: ' . mysql_error();
                            exit;
                        }

                        if (mysql_num_rows($result) > 0) {
                            while ($row = mysql_fetch_row($result)) {
                                echo "<tr>";
                                echo "<td> $row[0] </td>";
                                echo "<td><img src=\"image.php?image={$row['3']}\" style=\"width:120px;\"></td>";
                                echo "<td> $row[1] </td>";
                                echo "<td> $row[2] </td>";
                                echo '<td><a href="preview.php?image=' . $row[4] . '">image</a></td>';
                                echo "</tr>\n";
                            }
                        }
//                    }
                    echo "</table>";

                } else { // No sorting
                    $result = mysql_query("SELECT l.image_name, r.run_number, l.status, l.full_path, l.image_id
                                        FROM mydb.run r JOIN mydb.loaded_images l ON r.id_Run = l.Run_id_Run
                                        ORDER BY r.run_number DESC ");
                    if (!$result) {
                        echo 'Could not run query: ' . mysql_error();
                        exit;
                    }

                    if (mysql_num_rows($result) > 0) {
                        while ($row = mysql_fetch_row($result)) {
                            echo "<tr>";
                            echo "<td> $row[0] </td>";
                            echo "<td><img src=\"image.php?image={$row['3']}\" style=\"width:120px;\"></td>";
                            echo "<td> $row[1] </td>";
                            echo "<td> $row[2] </td>";
                            echo '<td><a href="preview.php?image=' . $row[4] . '">image</a></td>';
                            echo "</tr>\n";
                        }
                    }
                    echo "</table>";
                }
            }

        ?>

    </form>

    </body>
</html>