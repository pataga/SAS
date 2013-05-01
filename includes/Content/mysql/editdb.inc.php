<?php

/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.0.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Patrick Farnkopf
 *
 */

?>

<fieldset>
    <legend>Datensatz bearbeiten</legend>
    <span class="error">Dieser Bereich funktioniert noch nicht vollständig</span>
    <form action="?p=mysql&s=db" method="post">
        <?php
        if (isset($_GET['database']) && isset($_GET['table'])) {
            $p = $_POST;
            foreach ($p as $key => $val) {
                if ($val == 'action')
                    continue;
                echo '<p><label>'.$key.'</label><input type="text" class="text-long" name="'.$key.'" value="'.$val.'"></p>';
            }
        }
        ?>
        <input class="button green" name="save" type="submit" value="Speichern"/>
    </form>
</fieldset>