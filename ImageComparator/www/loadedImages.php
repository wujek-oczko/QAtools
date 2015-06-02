<!DOCTYPE HTML>
<html>
<head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="site-wrapper"></div>
<h1>
    <p align="center"><span class = "label label-primary">Loaded Images</span></p>
    <input type="button" onclick="location.href='index.php'" value = 'Back to the index' class='btn btn-xs btn-primary'>
    <input type="button" onclick="location.href='modelImages.php'" value = 'Go to Model Images' class='btn btn-xs btn-primary'>
</h1>

<table class="table table-bordered table-striped">
    <tr class="panel-heading">
        <th class="panel-title">Class name</th><th class="panel-title">Image name</th>
        <th class="panel-title">Run number
            <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <?php
                $conn = mysql_connect('msdidev9.thlab.s3', 'root', 'root');
                if (!$conn) {
                    die('Could not connect: ' . mysql_error());
                }

                $result = mysql_query("SELECT run_number FROM mydb.run ORDER BY cast(run_number AS SIGNED) DESC");
                if (!$result) {
                    echo 'Could not run query: ' . mysql_error();
                    exit;
                }

                echo "<select name='order' class='dropdown' role='menu' aria-labelledby='dropdownMenu1'>";
                echo"<option value=''> All Runs </option>";
                if (mysql_num_rows($result) > 0) {
                    while ($row = mysql_fetch_row($result)) {
                        echo"<option value='$row[0]'> $row[0] </option>";
                    }
                    echo "</select>";
                    echo "<input type='submit' value='Filter Run' class='btn btn-xs btn-primary' />";
                }
                ?>
        </th>
        <th class="panel-title"><p>Status</p>
            <?php
            echo "<select name='order2[]' class='dropdown' multiple>";
            echo "<option value=''> All Statuses </option>";
            echo "<option value='Accepted'> Accepted </option>";
            echo "<option value='Rejected'> Rejected </option>";
            echo "<option value='NEW'> NEW </option>";
            echo "<option value='DIFFERENT'> DIFFERENT </option>";
            echo "</select>";
            echo "<input type='submit' value='Filter By Status' class='btn btn-xs btn-primary' />";
            ?>

            </form>
        </th><th class="panel-title">Preview</th>
    </tr>

    <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php

        $conn = mysql_connect('msdidev9.thlab.s3', 'root', 'root');
        if (!$conn) {
            die('Could not connect: ' . mysql_error());
        }

        $sort = @$_GET['order'];
        $sort2 = @$_GET['order2'];
        $status;

        if (!empty($sort)) { // Marked sorting by RUN

            if(!empty($sort2)){ // Marked sorting by STATUS and by RUN

                $tyryry =  "'". implode("', '", (array)$sort2) ."'";

                $result = mysql_query("SELECT l.image_name, r.run_number, l.status, l.full_path, l.image_id, l.class_name
                                    FROM mydb.run r JOIN mydb.loaded_images l ON r.id_Run = l.Run_id_Run
                                    WHERE r.run_number = '$sort' AND l.status IN ($tyryry)
                                    ORDER BY cast(r.run_number AS SIGNED) DESC ");

                if (!$result) {
                    echo 'Could not run query: ' . mysql_error();
                    exit;
                }

                if (mysql_num_rows($result) > 0) {
                    while ($row = mysql_fetch_row($result)) {
                        if ($row[2] == 'Accepted') $status = "class='label label-primary'";
                        if ($row[2] == 'Rejected') $status = "class='label label-danger'";
                        if ($row[2] == 'NEW') $status = "class='label label-default'";
                        if ($row[2] == 'DIFFERENT') $status = "class='label label-warning'";
                        echo"<tr>";
                        echo"<td> $row[5] </td>";
                        echo"<td> $row[0] </td>";
//                        echo"<td><img src=\"image.php?image={$row['3']}\" style=\"width:120px;\"></td>";
                        echo"<td> $row[1] </td>";
                        echo "<td><label $status align='center'>$row[2]</label> </td>";
                        echo '<td><a href="preview.php?image=' . $row[4] . '" class="btn btn-lg btn-link"><img src=\'image.php?image={$row[\'3\']}\' style=\"width:120px;\"></a></td>';
                        echo"</tr>\n";
                    }
                }
                echo "</table>";

            }else{ // No sorting by STATUS but sorted by RUN
                $result = mysql_query("SELECT l.image_name, r.run_number, l.status, l.full_path, l.image_id, l.class_name
                                    FROM mydb.run r JOIN mydb.loaded_images l ON r.id_Run = l.Run_id_Run
                                    WHERE r.run_number = '$sort'
                                    ORDER BY cast(r.run_number AS SIGNED) DESC ");
                if (!$result) {
                    echo 'Could not run query: ' . mysql_error();
                    exit;
                }

                if (mysql_num_rows($result) > 0) {
                    while ($row = mysql_fetch_row($result)) {
                        if ($row[2] == 'Accepted') $status = "class='label label-primary'";
                        if ($row[2] == 'Rejected') $status = "class='label label-danger'";
                        if ($row[2] == 'NEW') $status = "class='label label-default'";
                        if ($row[2] == 'DIFFERENT') $status = "class='label label-warning'";
                        echo"<tr>";
                        echo"<td> $row[5] </td>";
                        echo"<td> $row[0] </td>";
//                        echo"<td><img src=\"image.php?image={$row['3']}\" style=\"width:120px;\"></td>";
                        echo"<td> $row[1] </td>";
                        echo "<td><label $status align='center'>$row[2]</label> </td>";
                        echo '<td><a href="preview.php?image=' . $row[4] . '" class="btn btn-lg btn-link"><img src=\'image.php?image={$row[\'3\']}\' style=\"width:120px;\"></a></td>';
                        echo"</tr>\n";
                    }
                }
                echo "</table>";
            }

        } else { // No sorting by RUN
            if (!empty($sort2)) { // Marked sorting by STATUS
                $tyryry =  "'". implode("', '", (array)$sort2) ."'";

                $result = mysql_query("SELECT l.image_name, r.run_number, l.status, l.full_path, l.image_id, l.class_name
                                        FROM mydb.run r JOIN mydb.loaded_images l ON r.id_Run = l.Run_id_Run
                                        WHERE l.status IN ($tyryry)
                                        ORDER BY cast(r.run_number AS INT ) DESC ");
                if (!$result) {
                    echo 'Could not run query: ' . mysql_error();
                    exit;
                }

                if (mysql_num_rows($result) > 0) {
                    while ($row = mysql_fetch_row($result)) {
                        if ($row[2] == 'Accepted') $status = "class='label label-primary'";
                        if ($row[2] == 'Rejected') $status = "class='label label-danger'";
                        if ($row[2] == 'NEW') $status = "class='label label-default'";
                        if ($row[2] == 'DIFFERENT') $status = "class='label label-warning'";
                        echo"<tr>";
                        echo"<td> $row[5] </td>";
                        echo"<td> $row[0] </td>";
//                        echo"<td><img src=\"image.php?image={$row['3']}\" style=\"width:120px;\"></td>";
                        echo"<td> $row[1] </td>";
                        echo "<td><label $status align='center'>$row[2]</label> </td>";
                        echo '<td><a href="preview.php?image=' . $row[4] . '" class="btn btn-lg btn-link"><img src=\'image.php?image={$row[\'3\']}\' style=\"width:120px;\"></a></td>';
                        echo"</tr>\n";
                    }
                }
//                    }
                echo "</table>";

            } else { // No sorting
                $result = mysql_query("SELECT l.image_name, r.run_number, l.status, l.full_path, l.image_id, l.class_name
                                        FROM mydb.run r JOIN mydb.loaded_images l ON r.id_Run = l.Run_id_Run
                                        ORDER BY cast(r.run_number AS SIGNED) DESC ");
                if (!$result) {
                    echo 'Could not run query: ' . mysql_error();
                    exit;
                }

                if (mysql_num_rows($result) > 0) {
                    while ($row = mysql_fetch_row($result)) {
                        if ($row[2] == 'Accepted') $status = "class='label label-primary'";
                        if ($row[2] == 'Rejected') $status = "class='label label-danger'";
                        if ($row[2] == 'NEW') $status = "class='label label-default'";
                        if ($row[2] == 'DIFFERENT') $status = "class='label label-warning'";
                        echo "<tr>";
                        echo "<td> $row[5] </td>";
                        echo "<td> $row[0] </td>";
//                        echo "<td><img src=\"image.php?image={$row['3']}\" style=\"width:120px;\"></td>";
                        echo "<td> $row[1] </td>";
                        echo "<td><label $status align='center'>$row[2]</label> </td>";
                        echo '<td><a href="preview.php?image=' . $row[4] . '" class="btn btn-lg btn-link"><img src=\'image.php?image={$row[\'3\']}\' style=\"width:120px;\"></a></td>';
                        echo "</tr>\n";
                    }
                }
            }
        }

        ?>

    </form>

</body>
</html>