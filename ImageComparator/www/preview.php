<?php
    $conn = mysql_connect('msdidev9.thlab.s3', 'root', 'root');
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

    $result = mysql_query("SELECT image_name, status, full_path, image_id FROM mydb.loaded_images WHERE image_id = ".$_GET['image']);
    if (!$result) {
        echo 'Could not run query: ' . mysql_error();
    }
    $image = mysql_fetch_assoc($result);

    $modelResults = mysql_query("SELECT * FROM mydb.model_images WHERE image_name = '{$image['image_name']}'");
?>
<html>

<head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<table class="table table-bordered table-striped">
    <tr class="panel-heading">
        <?php
            $status;
            if ($image['status'] == 'Accepted') $status = "class='label label-primary'";
            if ($image['status'] == 'Rejected') $status = "class='label label-danger'";
            if ($image['status'] == 'NEW') $status = "class='label label-default'";
            if ($image['status'] == 'DIFFERENT') $status = "class='label label-warning'";
        ?>
        <td>Actual status of this image is: <label <?= ($status);?> > <?= ($image['status']);?></label></td><td></td>
    </tr>
    <tr>
        <td class="col-md-1">Image for acceptance: </td><td class="col-md-1">Model image/images: </td>
    </tr>
    <tr>
        <td>
            <tr>
                <td>
                    <a href="image.php?image=<?= urlencode($image['full_path']);?>" target="_blank"><img src="image.php?image=<?= urlencode($image['full_path']);?>" style="width: 600px;"></a>
                </td>
                <td>
                    <?php
                    while ($modelImage = mysql_fetch_assoc($modelResults)) {
                        echo '<a href="image.php?image='.urlencode($modelImage['full_path']).'" target="_blank"><img src="image.php?image='.urlencode($modelImage['full_path']).'" style="width: 600px;"></a><br/>';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="panel-title">
                    <input type="button" onclick="myAccept()" value = 'Accept' class='btn btn-xs btn-primary'>
                    <input type="button" onclick="myReject()" value = 'Reject' class='btn btn-xs btn-primary'>
                    <input type="button" onclick="myIgnore()" value = 'Ignore' class='btn btn-xs btn-primary'>
                    <input type="button" onclick="location.href='loadedImages.php'" value = 'Back' class='btn btn-xs btn-primary'>
                </td>
            </tr>
        </td>
    </tr>
</table>

<script>
    function myAccept() {
        var x;
        if (confirm("You attempt to set status \"Accept\" for this picture. Please confirm this action") == true) {
            location.href='accept.php?Accept=<?= $image['image_id']?>';
        } else {
            x = "You pressed Cancel!";
        }
        document.getElementById("demo").innerHTML = x;
    }
</script>

<script>
    function myReject() {
        var x;
        if (confirm("You attempt to set status \"Rejected\" for this picture. Please confirm this action") == true) {
            location.href='reject.php?Reject=<?= $image['image_id']?>';
        } else {
            x = "You pressed Cancel!";
        }
        document.getElementById("demo").innerHTML = x;
    }
</script>

<script>
    function myIgnore() {
        var x;
        if (confirm("You attempt to set status \"Ignore\" for this picture. Pictures with the same name as the picture " +
            "ignored now will not be presented on Loaded Images page. Please confirm this action") == true) {
            location.href='ignore.php?Ignore=<?= $image['image_id']?>';
        } else {
            x = "You pressed Cancel!";
        }
        document.getElementById("demo").innerHTML = x;
    }
</script>

</body>
</html>


