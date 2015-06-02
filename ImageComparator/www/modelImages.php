<!DOCTYPE HTML>
<html>
<head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="site-wrapper"></div>
<h1>
    <p align="center"><span class = "label label-primary">Model Images</span></p>
    <input type="button" onclick="location.href='index.php'" value = 'Back to the index' class='btn btn-xs btn-primary'>
    <input type="button" onclick="location.href='loadedImages.php'" value = 'Go to Loaded Images' class='btn btn-xs btn-primary'>
</h1>


<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php
    $conn = mysql_connect('msdidev9.thlab.s3', 'root', 'root');
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

    $result = mysql_query("SELECT image_name, status, full_path, image_id, class_name
                                    FROM mydb.model_images");
    if (!$result) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }

    echo "<table class='table table-bordered table-striped'>";
    echo "<tr><th class='panel-title'>Class name</th><th class='panel-title'>Image name</th>";
    echo "<th class='panel-title'>Status</th><th class='panel-title'>Preview</th></tr>";

    if (mysql_num_rows($result) > 0) {
        $status;
        while ($row = mysql_fetch_row($result)) {
            if ($row[1] == 'Accepted') $status = "class='label label-primary'";
            if ($row[1] == 'Rejected') $status = "class='label label-danger'";
            if ($row[1] == 'NEW') $status = "class='label label-default'";
            if ($row[1] == 'DIFFERENT') $status = "class='label label-warning'";
            echo"<tr>";
            echo"<td> $row[4] </td>";
            echo"<td> $row[0] </td>";
            echo"<td><label $status align='center'>$row[1]</label> </td>";
            echo'<td><a href="preview2.php?image=' . $row[3] . '" class="btn btn-lg btn-link"><img src=\'image.php?image={$row[\'2\']}\' style=\"width:120px;\"></a></td>';
            echo"</tr>\n";
        }
        echo "</table>";
    }
    ?>
</form>

</body>
</html>