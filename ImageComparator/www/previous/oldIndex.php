<?php
/**
 * Created by PhpStorm.
 * User: Marcin
 * Date: 2014-12-19
 * Time: 11:18
 */

$conn = mysql_connect('localhost', 'root', 'root');
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}

$result = mysql_query("SELECT image_name, status FROM mydb.model_images");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}

echo "<table border='1'> <tr><th>name</th><th>status</th></tr>";

if (mysql_num_rows($result) > 0) {
    while ($row = mysql_fetch_row($result)) {
        $imageName = $row[0];
        echo"<tr>";
        echo"<td> $imageName </td>";
        echo"<td> $row[1] </td>";
        echo"<td> <a href='accept.php?Accept=true'>Accept</a> </td>";
        echo"<td> <a href='reject.php?Reject=true'>Reject</a> </td>";
//        echo"<td> <button type=\"button\" onclick=\"updateStatus($imageName, 'Rejected')\" >Reject!</button> </td>";
        echo"</tr>\n";
//		echo '<pre>';
//        print_r($row);
//		echo '</pre>';
    }
    echo "</table>";
}

?>