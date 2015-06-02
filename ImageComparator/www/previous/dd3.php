<head>
    <title>dd3</title>
</head>

<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php

    function multi_dropdown( $name, array $options, array $selected=null, $size=5 )
    {
        /*** begin the select ***/
        $dropdown = '<select name="'.$name.'" id="'.$name.'" size="'.$size.'" multiple>'."\n";

        /*** loop over the options ***/
        foreach( $options as $key=>$option )
        {
            /*** assign a selected value ***/
            $select = in_array( $option, $selected ) ? ' selected' : null;

            /*** add each option to the dropdown ***/
            $dropdown .= '<option value="'.$key.'"'.$select.'>'.$option.'</option>'."\n";
        }

        /*** close the select ***/
        $dropdown .= '</select>'."\n";

        /*** and return the completed dropdown ***/
        return $dropdown;
    }
    ?>

    <form>

        <?php
        $name = 'multi_dropdown';
        $options = array( 'All Statuses', 'Accepted', 'Rejected', 'NEW', 'DIFFERENT' );
        $selected = array( 'All Statuses' );

        echo multi_dropdown( $name, $options, $selected );
        echo "<input type=\"submit\" value=\" Filter By Status  \" />";
        ?>
    </form>
</form>