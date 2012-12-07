<?php


    /**
    * Licensed under The Apache License
    *
    * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
    * @link https://github.com/pataga/SAS
    * @since SAS v1.0.0
    * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
    * @author Patrick Farnkopf
    *
    */


    if (!$server->isInstalled('mysql')) {
        header('Location: ?p=mysql&s=configure');
        die();
    } else {
        $data = $server->getServerData($server->getID());
        $dbhandler = new DBHandler($main);
    }
?>
<h2>Datenbank Verwaltung</h2>
<fieldset style="width:auto;">
    <div style="height:auto;width:auto;min-width:100px;max-height:500px;max-width:800px;min-height:130px;overflow-x:scroll;overflow-y:scroll;">
        <?php
            print(DBHandler::buildLinkTree($data[1], 
                 (isset($_GET['db']) ? $_GET['db'] : false), 
                 (isset($_GET['t']) ? $_GET['t'] : false)));
        ?>
        <table><br>
            <?php
                

                if (!isset($_GET['db'])) {
                    print($dbhandler->DatabaseToTable());
                } elseif (isset($_GET['db'])&&!isset($_GET['t'])) {
                    $dbhandler->setDatabase($_GET['db']);
                    print($dbhandler->TableToTable());
                } else if (isset($_GET['db'])&&isset($_GET['t'])) {
                    $dbhandler->setDatabase($_GET['db']);
                    $dbhandler->setTable($_GET['t']);
                    print($dbhandler->buildDataTable());
                }
            ?>
        </table>
    </div>
<br><br>
</fieldset>
