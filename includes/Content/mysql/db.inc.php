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

$data = \Classes\Main::Server()->getMySQLData();

if (!$data) {
    header('Location: ?p=mysql&s=configure');
    exit;
}

$dbModule = new \Classes\Module\MySQL\DBHandler($data);

if (isset($_POST['action']) && $_POST['action'] == 1) {
    $post = $_POST;
    $get = $_GET;
    $dbModule->setDatabase($get['database']);
    $query = 'DELETE FROM '.$get['table'].' WHERE ';
    foreach ($post as $key => $value) {
        if ($key == 'action') continue;
        $query .= '`'.$key.'` = \''.$value.'\' AND ';
    }
    $query .= ' 1=1 LIMIT 1';
    $dbModule->Query($query);
    echo '<span class="info">'.$query.' ausgef&uuml;hrt</span>';
}

?>

<h3>MySQL</h3>
<fieldset>
    <legend>Datenbank/Tabelle</legend>
    <form action="" method="get" name="mysqlSubmit" id="mysqlForm">
        <input type="hidden" name="p" value="mysql">
        <input type="hidden" name="s" value="db">
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

<? if (isset($_GET['database']) && isset($_GET['table']) && $_GET['table'] != '0') { ?>

<fieldset style="">
    <legend>Datens&auml;tze</legend>
    <div class="scroll">
    <table>
        <tr>
            <th></th>
    <?
    $dbModule->setTable($_GET['table']);
    $dbModule->setDatabase($_GET['database']);
    $cols = $dbModule->getColumns();
    foreach ($cols as $key => $col) {
        ?>
        <th><?=$col[0]?></th>
        <?
    }
    ?>
        </tr>
    <?
    $dbModule->setMaxRows(50);
    $data = $dbModule->getData();
    foreach ($data as $key => $row) {
        ?>
        <tr>
            <form action="?p=mysql&s=db&database=<?=$_GET['database']?>&table=<?=$_GET['table']?>" method="post" id="mysqlAction">
            <td>
                
                    <select name="action" id="mysqlActionSelection" onchange="checkRowAction()">
                        <option value="0">Aktion</option>
                        <option value="1">L&ouml;schen</option>
                        <option value="2">Bearbeiten</option>
                    </select>
            </td>
        <?
        foreach ($row as $k => $val) {
            if (!is_numeric($k) || !is_int($k)) {
            ?>
                <td>
                    <?=$val?>
                    <input type="hidden" name="<?=$k?>" value="<?=$val?>">
                </td>
            <?
            }
        }
        ?>
            </form>
        </tr>
        <?
    }
    ?>
    </table>
    </div>
</fieldset>

<?}?>
