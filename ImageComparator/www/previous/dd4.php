<?php
$sort = @$_POST['order'];
if (!empty($sort)) { // If you Sort it with value of your  select options
    echo $query = "SELECT bookname, bookauthor, bookpub, bookisbn
                FROM booktable
                ORDER BY '".$sort."' ASC";

} else { // else if you do not pass any value from select option will return this
    echo    $query = "SELECT bookname, bookauthor, bookpub, bookisbn
                FROM booktable
                ORDER BY bookname ASC";
}
?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php

    $conn = mysql_connect('localhost', 'root', 'root');
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

    $result = mysql_query("SELECT run_number from mydb.run");
    if (!$result) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }

    echo "<select name=\"order\">";
    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_row($result)) {
            echo"<option value='$row[0]'> $row[0] </option>";
        }
        echo "</select>";
        echo "<input type=\"submit\" value=\" Jebaj Kurwa! \" />";
    }

    ?>

</form>