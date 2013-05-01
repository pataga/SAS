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

    if (isset($_GET['db']))
        $dbModule->selectDatabase($_GET['db']);

    $data = explode(';', @file_get_contents(\Classes\Singleton::getRootDir().'/tmp/mysql/import/'.session_id().'.sql'));
    foreach ($data as $query) {
        $dbModule->Query($query);
    }
    @unlink(\Classes\Singleton::getRootDir().'/tmp/mysql/import/'.session_id().'.sql');
    $info = '<span class="info">Import erfolgreich durchgef&uuml;hrt!</span>';
}

if (isset($_GET['export'])) {
    $query = "-- SAS MySQL Exporter --\n";
    if ($_GET['table'] == '0') {
        $dbModule->selectDatabase($_GET['database']);
        $result = $dbModule->Query('SHOW TABLES');
        while ($row = $result->fetch(\Classes\MySQL\Result::FETCH_BOTH)) {
            $data = $dbModule->Query('SHOW FIELDS FROM '.$row[0]);
            $query .= 'CREATE TABLE '.$row[0]." (\n";
            $first = true;
            while ($field = $data->fetch()) {
                if (!$first)
                    $query .= ",\n";
                $query .= '`'.$field->Field.'` '.$field->Type.' '.($field->Key=='PRI'?'PRIMARY KEY':'').' '.$field->Extra;
                $first = false;
            }
            $query .= "\n);\n\n";
            $res = $dbModule->Query('SELECT * FROM '.$row[0]);
            while ($content = $res->fetch(\Classes\MySQL\Result::FETCH_ASSOC)) {
                $key_ = array_keys($content);
                $data_ = array_values($content);
                $amount = count($key_)-1;
                $i = 0;
                $query .= "INSERT INTO ".$row[0]." (";
                foreach ($key_ as $key) {
                    $query .= "$key";
                    if ($i < $amount) $query .= ",";
                    $i++;
                }

                $query .= ") VALUES (";
                $i = 0;
                foreach ($data_ as $data) {
                    $query .= "'$data'";
                    if ($i < $amount) $query .= ",";
                    $i++;
                }
                $query .= ");\n\n";
            }
        }
    } else {
        $dbModule->selectDatabase($_GET['database']);
        $data = $dbModule->Query('SHOW FIELDS FROM '.$_GET['table']);
        $query .= 'CREATE TABLE '.$_GET['table']." (\n";
        $first = true;
        while ($field = $data->fetch()) {
            if (!$first)
                $query .= ",\n";
            $query .= '`'.$field->Field.'` '.$field->Type.' '.($field->Key=='PRI'?'PRIMARY KEY':'').' '.$field->Extra;
            $first = false;
        }
        $query .= "\n);\n\n";
        $res = $dbModule->Query('SELECT * FROM '.$_GET['table']);
        while ($content = $res->fetch(\Classes\MySQL\Result::FETCH_ASSOC)) {
            $key_ = array_keys($content);
            $data_ = array_values($content);
            $amount = count($key_)-1;
            $i = 0;
            $query .= "INSERT INTO ".$_GET['table']." (";
            foreach ($key_ as $key) {
                $query .= "$key";
                if ($i < $amount) $query .= ",";
                $i++;
            }

            $query .= ") VALUES (";
            $i = 0;
            foreach ($data_ as $data) {
                $query .= "'$data'";
                if ($i < $amount) $query .= ",";
                $i++;
            }
            $query .= ");\n\n";
        }
    }

    file_put_contents(\Classes\Singleton::getRootDir().'/tmp/mysql/export/'.session_id().'.sql', $query);
    header('Location: includes/Content/mysql/downloader.php');
}

?>

<h3>MySQL</h3>
<?=$info?>
<fieldset>
    <legend>Import</legend>

    <div class="halbe-box">
        <form action="" method="get" name="mysqlSubmit" id="mysqlFormImp">
            <input type="hidden" name="p" value="mysql">
            <input type="hidden" name="s" value="impexp">
            <select name="db" id="db" onchange="checkDatabaseImp()">
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
        <input class="button black" type="submit" name="export" value="Export" style="float:right"/>
    </form>
</fieldset>
