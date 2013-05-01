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

$info = '';
$data = \Classes\Main::Server()->getMySQLData();
if (!$data) {
    header('Location: ?p=mysql&s=configure');
    exit;
}

$dbModule = new \Classes\Module\MySQL\DBHandler($data);

if (isset($_POST['import'])) {
    @unlink(\Classes\Singleton::getRootDir().'/tmp/mysql/import/'.session_id().'.sql');
    @move_uploaded_file($_FILES['datei']['tmp_name'], \Classes\Singleton::getRootDir().'/tmp/mysql/import/'.session_id().'.sql');

    if (isset($_GET['database']))
        $dbModule->selectDatabase($_GET['database']);

    $data = explode(';', @file_get_contents(\Classes\Singleton::getRootDir().'/tmp/mysql/import/'.session_id().'.sql'));
    foreach ($data as $query) {
        $dbModule->Query($query);
    }
    @unlink(\Classes\Singleton::getRootDir().'/tmp/mysql/import/'.session_id().'.sql');
    $info = '<span class="info">Import erfolgreich durchgef&uuml;hrt!</span>';
}

?>

<h3>MySQL</h3>
<?=$info?>
<fieldset>
    <legend>Import</legend>

    <div class="halbe-box">
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
        </form>
    </div>
    <div class="halbe-box lastbox">
        <form action="?p=mysql&s=impexp&database=<?=$_GET['database']?>" method="post" enctype="multipart/form-data">
            <input type="file" name="datei" style="margin-right: 20px;" required>
            <input class="button black" type="submit" name="import" value="Import" style="float:right"/>
        </form>
    </div>
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
