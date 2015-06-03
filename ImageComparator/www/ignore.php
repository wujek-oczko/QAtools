<?php
/**
 * Created by PhpStorm.
 * User: marcinja
 * Date: 03-Jun-15
 * Time: 10:02 AM
 */
function ignore($Ignore){
    $conn = mysql_connect('msdidev9.thlab.s3', 'root', 'root');
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

    $sql = "UPDATE mydb.loaded_images SET status = 'Ignored' WHERE image_id = '$Ignore' ";
    mysql_query($sql);
    echo"<td> <a href='loadedImages.php?hello=ignored'>Back to index</a> </td>";
}

if (isset($_GET['Ignore'])) {
    $Ignore = ignore($_GET['Ignore']);
}