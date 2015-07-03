<?php
/**
 * Created by PhpStorm.
 * User: marcinja
 * Date: 03-Jun-15
 * Time: 3:37 PM
 */

mysql_connect('msdidev9.thlab.s3', 'root', 'root') or die (mysql_error());
mysql_select_db("mydb") or die (mysql_error());
//////////////  QUERY THE MEMBER DATA INITIALLY LIKE YOU NORMALLY WOULD
$sql = mysql_query("SELECT m.image_name, m.status, m.full_path, m.image_id, m.class_name
                                    FROM mydb.run r JOIN mydb.model_images m ON r.id_Run = m.Run_id_Run
                                    ORDER BY cast(r.run_number AS SIGNED) DESC");
//////////////////////////////////// Pagination Logic ////////////////////////////////////////////////////////////////////////
$nr = mysql_num_rows($sql); // Get total of Num rows from the database query
if (isset($_GET['pn'])) { // Get pn from URL vars if it is present
    $pn = preg_replace('#[^0-9]#i', '', $_GET['pn']); // filter everything but numbers for security(new)
    //$pn = ereg_replace("[^0-9]", "", $_GET['pn']); // filter everything but numbers for security(deprecated)
} else { // If the pn URL variable is not present force it to be value of page number 1
    $pn = 1;
}
//This is where we set how many database items to show on each page
$itemsPerPage = 10;
// Get the value of the last page in the pagination result set
$lastPage = ceil($nr / $itemsPerPage);
// Be sure URL variable $pn(page number) is no lower than page 1 and no higher than $lastpage
if ($pn < 1) { // If it is less than 1
    $pn = 1; // force if to be 1
} else if ($pn > $lastPage) { // if it is greater than $lastpage
    $pn = $lastPage; // force it to be $lastpage's value
}
// This creates the numbers to click in between the next and back buttons
// This section is explained well in the video that accompanies this script
$centerPages = "";
$sub1 = $pn - 1;
$sub2 = $pn - 2;
$add1 = $pn + 1;
$add2 = $pn + 2;
if ($pn == 1) {
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
} else if ($pn == $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
} else if ($pn > 2 && $pn < ($lastPage - 1)) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub2 . '">' . $sub2 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add2 . '">' . $add2 . '</a> &nbsp;';
} else if ($pn > 1 && $pn < $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
}
// This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query
$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage;
// Now we are going to run the same query as above but this time add $limit onto the end of the SQL syntax
// $sql2 is what we will use to fuel our while loop statement below
$sql2 = mysql_query("SELECT m.image_name, m.status, m.full_path, m.image_id, m.class_name
                                    FROM mydb.run r JOIN mydb.model_images m ON r.id_Run = m.Run_id_Run
                                    ORDER BY cast(r.run_number AS SIGNED) DESC $limit");
//////////////////////////////// END Pagination Logic ////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////// Pagination Display Setup /////////////////////////////////////////////////////////////////////
$paginationDisplay = ""; // Initialize the pagination output variable
// This code runs only if the last page variable is ot equal to 1, if it is only 1 page we require no paginated links to display
if ($lastPage != "1"){
    // This shows the user what page they are on, and the total number of pages
    $paginationDisplay .= 'Page <strong>' . $pn . '</strong> of ' . $lastPage. '&nbsp;  &nbsp;  &nbsp; ';
    // If we are not on page 1 we can place the Back button
    if ($pn != 1) {
        $previous = $pn - 1;
        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '"> Back</a> ';
    }
    // Lay in the clickable numbers display here between the Back and Next links
    $paginationDisplay .= '<span class="paginationNumbers">' . $centerPages . '</span>';
    // If we are not on the very last page we can place the Next button
    if ($pn != $lastPage) {
        $nextPage = $pn + 1;
        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $nextPage . '"> Next</a> ';
    }
}
///////////////////////////////////// END Pagination Display Setup ///////////////////////////////////////////////////////////////////////////
// Build the Output Section Here
$outputList = '';
while($row = mysql_fetch_array($sql2)){

    $status_color;
    $image_id = $row["image_id"];
    $image_name = $row["image_name"];
    $status = $row["status"];
    $class_name = $row["class_name"];
    $full_path = $row["full_path"];

    $query_string = 'image=' . urlencode($image_id);

    if ($status == 'Accepted') $status_color = "class='label label-primary'";
    if ($status == 'Rejected') $status_color = "class='label label-danger'";
    if ($status == 'NEW') $status_color = "class='label label-default'";
    if ($status == 'Ignored') $status_color = "class='label label-warning'";

    $outputList .= "<tr><td>". $class_name . "</td><td>" . $image_name . "</td><td><label " . $status_color . "align ='center'>"
        . $status . "</label></td>
        <td><a href=\"preview2.php? $query_string \" class=\"btn btn-lg btn-link\"><img src=\'image.php?image={$full_path} style=\"width:120px;\"></a></td></tr>";

} // close while loop

?>
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

        <div style="margin-left:64px; margin-right:64px;">
            <h2>Total Items: <?php echo $nr; ?></h2>
        </div>


        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <?php

                echo $paginationDisplay;

                echo "<table class='table table-bordered table-striped'>";
                echo "<tr><th class='panel-title'>Class name</th><th class='panel-title'>Image name</th>";
                echo "<th class='panel-title'>Status</th><th class='panel-title'>Preview</th></tr>";

                echo $outputList;
                echo "</table>";
                echo $paginationDisplay;

            ?>
        </form>

    </body>
</html>