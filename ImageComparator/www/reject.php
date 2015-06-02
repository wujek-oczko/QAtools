<?php
/**
 * Created by PhpStorm.
 * User: Marcin
 * Date: 2014-12-19
 * Time: 10:05
 */

function reject($Reject){
    $conn = mysql_connect('msdidev9.thlab.s3', 'root', 'root');
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

    $sql = "UPDATE mydb.loaded_images SET status = 'Rejected' WHERE image_id = '$Reject' ";
    mysql_query($sql);
    echo"<td> <a href='loadedImages.php?hello=rejected'>Back to index</a> </td>";
}

if (isset($_GET['Reject'])) {
    $Reject = reject($_GET['Reject']);
}
