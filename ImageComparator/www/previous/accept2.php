<?php
/**
 * Created by PhpStorm.
 * User: Marcin
 * Date: 2014-12-19
 * Time: 10:05
 */

function accept($Accept){
    $conn = mysql_connect('localhost', 'root', 'root');
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

    $sql = "UPDATE mydb.model_images SET status = 'Accepted' WHERE full_path = '$Accept' ";
    mysql_query($sql);
    echo "<td> <a href='../index.php?hello=true'>Back to index</a> </td>";
}

if (isset($_GET['Accept'])) {
//    echo $_GET['Accept'];
    $Accept = accept($_GET['Accept']);
}
