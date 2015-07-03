<!DOCTYPE HTML>
<html>
    <head>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
    <div class="site-wrapper"></div>
    <h1>
        <p align="center"><span class = "label label-primary">Loaded Images</span></p>
        <input type="button" onclick="location.href='index.php'" value = 'Back to the index' class='btn btn-xs btn-primary'>
        <input type="button" onclick="location.href='modelImages.php'" value = 'Go to Model Images' class='btn btn-xs btn-primary'>
    </h1>

    <table class="table table-bordered table-striped">
        <tr class="panel-heading">
            <th class="panel-title">Class name</th><th class="panel-title">Image name</th>
            <th class="panel-title">Run number
                <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <?php
                        $conn = mysql_connect('msdidev9.thlab.s3', 'root', 'root');
                        if (!$conn) {
                            die('Could not connect: ' . mysql_error());
                        }

                        $result = mysql_query("SELECT run_number FROM mydb.run ORDER BY cast(run_number AS SIGNED) DESC");
                        if (!$result) {
                            echo 'Could not run query: ' . mysql_error();
                            exit;
                        }

                        echo "<select name='order' class='dropdown' role='menu' aria-labelledby='dropdownMenu1'>";
                        echo"<option value=''> All Runs </option>";
                        if (mysql_num_rows($result) > 0) {
                            while ($row = mysql_fetch_row($result)) {
                                echo"<option value='$row[0]'> $row[0] </option>";
                            }
                            echo "</select>";
                            echo "<input type='submit' value='Filter Run' class='btn btn-xs btn-primary' />";
                        }
                    ?>
            </th>
            <th class="panel-title"><p>Status</p>
                <?php
                    echo "<select name='order2' class='dropdown' role='menu' aria-labelledby='dropdownMenu1'>";
                    echo "<option value=''> All Statuses </option>";
                    echo "<option value='Accepted'> Accepted </option>";
                    echo "<option value='Rejected'> Rejected </option>";
                    echo "<option value='NEW'> NEW </option>";
                    echo "<option value='DIFFERENT'> DIFFERENT </option>";
                    echo "</select>";
                    echo "<input type='submit' value='Filter By Status' class='btn btn-xs btn-primary' />";
                ?>

                </form>
            </th><th class="panel-title">Preview</th>
        </tr>

        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <?php
            mysql_connect('msdidev9.thlab.s3', 'root', 'root') or die (mysql_error());
            mysql_select_db("mydb") or die (mysql_error());

            $sort = @$_GET['order'];
            $sort2 = @$_GET['order2'];
            $status_color;

            if (!empty($sort)) { // Marked sorting by RUN

                if(!empty($sort2)){ // Marked sorting by STATUS and by RUN

//                    $statusArray =  "'". implode("', '", (array)$sort2) ."'";

                    $result = "SELECT l.image_name, r.run_number, l.status, l.full_path, l.image_id, l.class_name
                                        FROM mydb.run r JOIN mydb.loaded_images l ON r.id_Run = l.Run_id_Run
                                        WHERE r.run_number = '$sort' AND l.status = '$sort2'
                                        ORDER BY cast(r.run_number AS SIGNED) DESC ";
                    pejdzing($result);

                }else{ // No sorting by STATUS but sorted by RUN
                    $result = "SELECT l.image_name, r.run_number, l.status, l.full_path, l.image_id, l.class_name
                                        FROM mydb.run r JOIN mydb.loaded_images l ON r.id_Run = l.Run_id_Run
                                        WHERE r.run_number = '$sort' AND l.status != 'Ignored'
                                        ORDER BY cast(r.run_number AS SIGNED) DESC ";
                    pejdzing($result);
                }

            } else { // No sorting by RUN
                if (!empty($sort2)) { // Marked sorting by STATUS
//                    $statusArray =  "'". implode("', '", (array)$sort2) ."'";

                    $result = "SELECT l.image_name, r.run_number, l.status, l.full_path, l.image_id, l.class_name
                                            FROM mydb.run r JOIN mydb.loaded_images l ON r.id_Run = l.Run_id_Run
                                            WHERE l.status = '$sort2'
                                            ORDER BY cast(r.run_number AS SIGNED) DESC ";
                    pejdzing($result);

                } else { // No sorting

                    $result = "SELECT l.image_name, r.run_number, l.status, l.full_path, l.image_id, l.class_name
                                            FROM mydb.run r JOIN mydb.loaded_images l ON r.id_Run = l.Run_id_Run
                                            WHERE l.status != 'Ignored'
                                            ORDER BY cast(r.run_number AS SIGNED) DESC ";
                    pejdzing($result);
                }
            }

            function pejdzing($query)
            {
                $sort = @$_GET['order'];
                $sort2 = @$_GET['order2'];
//                if (isset($_GET['order2'])) {
//                    $arraySort = http_build_query(array('order2' => $sort2));
//                }
//                else $arraySort = null;

//                $arraySort = http_build_query(array('order2' => $sort2));
//                $statusArray =  "'". implode("', '", (array)$sort2) ."'";
                //////////////  QUERY THE MEMBER DATA INITIALLY LIKE YOU NORMALLY WOULD
                $sql = mysql_query($query);
                //////////////////////////////////// Pagination Logic ////////////////////////////////////////////////////////////////////////
                $nr = mysql_num_rows($sql); // Get total of Num rows from the database query
                if (isset($_GET['pn'])) { // Get pn from URL vars if it is present
                    $pn = preg_replace('#[^0-9]#i', '', $_GET['pn']); // filter everything but numbers for security(new)
                    //$pn = ereg_replace("[^0-9]", "", $_GET['pn']); // filter everything but numbers for security(deprecated)
                } else { // If the pn URL variable is not present force it to be value of page number 1
                    $pn = 1;
                }
                echo "<tr><td>" . $pn ."</td></tr>";
                //This is where we set how many database items to show on each page
                $itemsPerPage = 10;
                // Get the value of the last page in the pagination result set
                $lastPage = ceil($nr / $itemsPerPage);
                if ($lastPage < 1){
                    $lastPage = 1;
                }
                // Be sure URL variable $pn(page number) is no lower than page 1 and no higher than $lastpage
                if ($pn < 1) { // If it is less than 1
                    $pn = 1; // force if to be 1
                } else if ($pn > $lastPage) { // if it is greater than $lastpage
                    $pn = $lastPage; // force it to be $lastpage's value
                }
                echo "<tr><td>" . $pn ."</td></tr>";
                // This creates the numbers to click in between the next and back buttons
                // This section is explained well in the video that accompanies this script
                $centerPages = "";
                $sub1 = $pn - 1;
                $sub2 = $pn - 2;
                $add1 = $pn + 1;
                $add2 = $pn + 2;
                if ($pn == 1) {
                    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
                    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '&order=' . $sort . '&order2=' . $sort2 . '">' . $add1 . '</a> &nbsp;';
                } else if ($pn == $lastPage) {
                    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '&order=' . $sort . '&order2=' . $sort2 . '">' . $sub1 . '</a> &nbsp;';
                    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
                } else if ($pn > 2 && $pn < ($lastPage - 1)) {
                    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub2 . '&order=' . $sort . '&order2=' . $sort2 . '">' . $sub2 . '</a> &nbsp;';
                    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '&order=' . $sort . '&order2=' . $sort2 . '">' . $sub1 . '</a> &nbsp;';
                    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
                    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '&order=' . $sort . '&order2=' . $sort2 . '">' . $add1 . '</a> &nbsp;';
                    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add2 . '&order=' . $sort . '&order2=' . $sort2 . '">' . $add2 . '</a> &nbsp;';
                } else if ($pn > 1 && $pn < $lastPage) {
                    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '&order=' . $sort . '&order2=' . $sort2 . '">' . $sub1 . '</a> &nbsp;';
                    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
                    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '&order=' . $sort . '&order2=' . $sort2 . '">' . $add1 . '</a> &nbsp;';
                }
                // This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query
                echo "<tr><td>" . $pn ."</td></tr>";
                $limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage;
                // Now we are going to run the same query as above but this time add $limit onto the end of the SQL syntax
                // $sql2 is what we will use to fuel our while loop statement below
                $sql2 = mysql_query($query . $limit);
                if (false === $sql2){
                    echo "<tr><td>";
                    echo mysql_error();
                    echo "</td></tr>";
                }
                echo "<tr><td>" . $query . $limit ."</td></tr>";
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
                        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '&order=' . $sort . '&order2=' . $sort2 . '"> Back</a> ';
                    }
                    // Lay in the clickable numbers display here between the Back and Next links
                    $paginationDisplay .= '<span class="paginationNumbers">' . $centerPages . '</span>';
                    // If we are not on the very last page we can place the Next button
                    if ($pn != $lastPage) {
                        $nextPage = $pn + 1;
                        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $nextPage . '&order=' . $sort . '&order2=' . $sort2 . '"> Next</a> ';
                    }
                }
                ///////////////////////////////////// END Pagination Display Setup ///////////////////////////////////////////////////////////////////////////
                // Build the Output Section Here
                $outputList = '';

                while($row = mysql_fetch_array($sql2)){

                    $status_color = '';
                    $image_id = $row["image_id"];
                    $image_name = $row["image_name"];
                    $status = $row["status"];
                    $class_name = $row["class_name"];
                    $full_path = $row["full_path"];
                    $run_number = $row["run_number"];

                    if ($status == 'Accepted') $status_color = "class='label label-primary'";
                    if ($status == 'Rejected') $status_color = "class='label label-danger'";
                    if ($status == 'NEW') $status_color = "class='label label-default'";
                    if ($status == 'DIFFERENT') $status_color = "class='label label-warning'";

                    $outputList .= "<tr><td>". $class_name . "</td><td>" . $image_name . "</td><td>" . $run_number . "</td><td><label " . $status_color . "align ='center'>"
                        . $status . "</label></td>
                        <td><a href=\"preview2.php?image=' . $image_id . '\" class=\"btn btn-lg btn-link\"><img src=\'image.php?image={ . $full_path . style=\"width:120px;\"></a></td></tr>";

                } // close while loop
                echo $outputList;
                echo "</table>";
                echo $paginationDisplay;
            }
            ?>
        </form>
    </body>
</html>