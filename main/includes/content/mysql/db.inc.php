<?php
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
            print($dbhandler->buildLinkTree($data[1], 
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
