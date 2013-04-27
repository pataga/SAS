<?php

/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.1.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Patrick Farnkopf
 *
 */

$data = \Classes\Main::Server()->getMySQLData();
if (!$data) {
    header('Location: ?p=mysql&s=configure');
    exit;
}

$dbModule = new \Classes\Module\MySQL\DBHandler($data);


?>

<h3>MySQL</h3>
<fieldset>
    <legend>Import</legend>
    <form action="?p=mysql&s=console" method="post">
        <select name="database" style="margin-right: 30px;">
            <option value="0">Datenbank w&auml;hlen</option>
            <?
            $data = $dbModule->getDatabases();

            foreach ($data as $key => $value) {
                ?>
                    <option><?=$value[0]?></option>
                <?
            }
            ?>
        </select>
        <input type="file" name="file" style="margin-right: 20px;"> <input class="button black" type="submit" value="Import" style="float:right"/>
    </form>
</fieldset>

<fieldset>
    <legend>Export</legend>
    <form action="" method="get" name="mysqlSubmit" id="mysqlForm">
        <input type="hidden" name="p" value="mysql">
        <input type="hidden" name="s" value="impexp">
        <select name="database" id="database" onchange="checkDatabase()">
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
        if (isset($_GET['database']) && $_GET['database'] != '0') {
            ?>

            <select name="table" id="table" onchange="submit();">
                <option value="0">Alle Tabellen</option>
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
        <input class="button black" type="submit" value="Export" style="float:right"/>
    </form>
</fieldset>
