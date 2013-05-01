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

echo '<h3>MySQL</h3>';

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
} else if (isset($_POST['action']) && $_POST['action'] == 2) {
    require_once \Classes\Singleton::getRootDir().'/includes/Content/mysql/editdb.inc.php';
}

if (isset($_POST['save'])) {
    //Edit Algorithmus
}

?>


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

<fieldset>
    <legend>Datens&auml;tze</legend>
    <?php
    $dbModule->setTable($_GET['table']);
    $dbModule->setDatabase($_GET['database']);
    $dbModule->setMaxRows(isset($_GET['maxrows']) ? $_GET['maxrows'] : 30);
    $dbModule->setPageNumber(isset($_GET['pnr']) ? $_GET['pnr'] : 1);
    $data = $dbModule->getData();
    echo "<div style='width:100px;text-align:left;float:right;'><span style='margin:60px 0px;'>Seite ".(isset($_GET['pnr'])?$_GET['pnr']:1)." / ".ceil($dbModule->getDataCount()/$dbModule->getMaxRows())."</span></div>";
    echo "<b>Seite</b>";
    for ($i=1; $i<=ceil($dbModule->getDataCount()/$dbModule->getMaxRows()); $i++) {
        echo "<a style='margin:5px 5px;' href='?p=mysql&s=db&database=".$_GET['database']."&table=".$_GET['table']."&pnr=".$i."'>".$i."</a>";
    }

    ?>
    <hr>
    <div class="scroll">
    <table id="sortable" class="s">
        <thead>
        <tr>
            <td></td>
    <?

    $cols = $dbModule->getColumns();
    foreach ($cols as $key => $col) {
        ?>
        <th><?=$col[0]?></th>
        <?
    }
    ?>
        </tr>
        </thead>
        <tbody>
    <?


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
                    <span style="margin:15px; 0px;"><?=$val?></span>
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
    </tbody>
    </table>
    </div>
</fieldset>

<?}?>
