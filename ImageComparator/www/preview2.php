<?php
$conn = mysql_connect('msdidev9.thlab.s3', 'root', 'root');
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}

$result = mysql_query("SELECT image_name, status, full_path, image_id FROM mydb.model_images WHERE image_id = ".$_GET['image']);
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}

//$result = mysql_query("SELECT * FROM mydb.model_images WHERE image_id = ".$_GET['image']);
$image = mysql_fetch_assoc($result);


?>
<html>

<head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<table class="table table-bordered table-striped">

    <tr>
        <?php
        $status;
        if ($image['status'] == 'Accepted') $status = "class='label label-primary'";
        if ($image['status'] == 'Rejected') $status = "class='label label-danger'";
        if ($image['status'] == 'NEW') $status = "class='label label-default'";
        if ($image['status'] == 'Ignored') $status = "class='label label-warning'";
        ?>
        <td>Actual status of this image is: <label <?= ($status);?> > <?= ($image['status']);?></label></td>
    </tr>
    <tr>
        <td><a href="image.php?image=<?= urlencode($image['full_path']);?>" target="_blank"><img src="image.php?image=<?= urlencode($image['full_path']);?>" style="width: 600px;"></a></td>
    </tr>
    <tr class="panel-heading">
        <td class="panel-title">
            <input type="button" onclick="myAccept()" value = 'Accept' class='btn btn-xs btn-primary'>
            <input type="button" onclick="myReject()" value = 'Reject' class='btn btn-xs btn-primary'>
            <input type="button" onclick="location.href='modelImages.php'" value = 'Back' class='btn btn-xs btn-primary'>
        </td>
    </tr>
</table>

<script>
    function myAccept() {
        var x;
        if (confirm("Please confirm") == true) {
            location.href='accept2.php?Accept=<?= $image['image_id']?>';
        } else {
            x = "You pressed Cancel!";
        }
        document.getElementById("demo").innerHTML = x;
    }
</script>

<script>
    function myReject() {
        var x;
        if (confirm("Please confirm") == true) {
            location.href='reject2.php?Reject=<?= $image['image_id']?>';
        } else {
            x = "You pressed Cancel!";
        }
        document.getElementById("demo").innerHTML = x;
    }
</script>

</body>
</html>


