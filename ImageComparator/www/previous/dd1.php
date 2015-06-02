<head>
    <title>dd1</title>
</head>

<form>
    <dl>
        <dt>Name</dt>
        <dd>
            <input type="text" name="my_text" />
        </dd>

        <dt>Favorite Element</dt>
        <dd>
            <select name="element">
                <?php

                try
                {
                    /*** query the database ***/
                    $result = DB::getInstance()->query("SELECT atomicnumber, english FROM element");

                    /*** loop over the results ***/
                    foreach($result as $row)
                    {
                        /*** create the options ***/
                        echo '<option value="'.$row['atomicnumber'].'"';
                        if($row['atomicnumber']==42)
                        {
                            echo ' selected';
                        }
                        echo '>'. $row['english'] . '</option>'."\n";
                    }
                }
                catch(PDOException $e)
                {
                    echo 'No Results';
                }
                ?>
            </select>
        </dd>
    </dl>
</form>