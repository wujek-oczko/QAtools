<head>
    <title>dd2</title>
</head>

<?php
function dropdown( $name, array $options, $selected=null )
{
    /*** begin the select ***/
    $dropdown = '<select name="'.$name.'" id="'.$name.'">'."\n";

    $selected = $selected;
    /*** loop over the options ***/
    foreach( $options as $key=>$option )
    {
        /*** assign a selected value ***/
        $select = $selected==$key ? ' selected' : null;

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
    $name = 'my_dropdown';
    $options = array( 'dingo', 'wombat', 'kangaroo' );
    $selected = 1;

    echo dropdown( $name, $options, $selected );
    ?>
</form>