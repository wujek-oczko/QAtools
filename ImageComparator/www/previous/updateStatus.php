<?php
/**
 * Created by PhpStorm.
 * User: marcinja
 * Date: 15/12/2014
 * Time: 13:13
 */

function updateStatus(){
    $conn = mysql_connect('localhost', 'root', 'root');
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

    $sql = "UPDATE mydb.model_images SET status = 'Accepted' WHERE image_name = 'obrazek' ";
    mysql_query($sql);
}

if (isset($_GET['Accepted'])) {
    updateStatus();
}

?>