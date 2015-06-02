<?php
/**
 * Created by PhpStorm.
 * User: Marcin
 * Date: 2014-12-19
 * Time: 10:05
 */

function accept($Accept){
    $conn = mysql_connect('msdidev9.thlab.s3', 'root', 'root');
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

    $sql = "UPDATE mydb.loaded_images SET status = 'Accepted' WHERE image_id = '$Accept' ";
    mysql_query($sql);
    echo"<td> <a href='loadedImages.php?hello=accepted'>Back to index</a> </td>";
}

if (isset($_GET['Accept'])) {
    $Accept = accept($_GET['Accept']);
}


