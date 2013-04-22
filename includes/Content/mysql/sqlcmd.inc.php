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

$data = $main->Server()->getMySQLData();
if (!$data) {
    header('Location: ?p=mysql&s=configure');
    exit;
}

$dbModule = new \Classes\Module\MySQL\DBHandler($data);


?>

<h3>MySQL</h3>
<fieldset>
    <legend>Datenbank</legend>
    <?
    if (isset($_POST['exec'])) {
        $dbModule->setDatabase($_POST['database']);
        $data = explode(';', $_POST['query']);
        if (!is_array($data))
            $dbModule->exec($_POST['query']);
        else
            foreach ($data as $key => $value) 
                $dbModule->exec($value);
            
        echo '<span class="info">Query wurde ausgef&uuml;hrt!</span><br>';
    }
    ?>
    <form action="?p=mysql&s=console" method="post">
        <select name="database" id="database">
            <option value="0">Datenbank w&auml;hlen</option>
            <?
            $data = $dbModule->getDatabases();

            foreach ($data as $key => $value) {
                if (isset($_GET['database']) && $_GET['database'] == $value[0]) {
                ?>
                    <option selected="selected"><?=$value[0]?></option>
                <?
                } else {
                ?>
                    <option><?=$value[0]?></option>
                <?
                }
            }
            ?>
        </select>
        <input type="submit" name="exec" value="Ausf&uuml;hren" class="button black"><br><br>
        <textarea style="width:400px;height:300px;" name="query"></textarea>
    </form>
</fieldset>


