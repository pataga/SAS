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
    <legend>Datenbank/Tabelle</legend>
    <form action="" method="get">
        <input type="hidden" name="p" value="mysql">
        <input type="hidden" name="s" value="db">
        <select name="database" onchange="submit();">
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

        <?
        if (isset($_GET['database'])) {
            ?>

            <select name="table" onchange="submit();">
            <option value="0">Tabelle w&auml;hlen</option>
            <?
            $dbModule->setDatabase($_GET['database']);
            $data = $dbModule->getTables();

            foreach ($data as $key => $value) {
                if (isset($_GET['table']) && $_GET['table'] == $value[0]) {
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
            <?
        }
        ?>
    </form>
</fieldset>
