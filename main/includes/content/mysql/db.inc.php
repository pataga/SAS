<?php
    if (!$server->isInstalled('mysql'))
    {
        header('Location: ?p=mysql&s=configure');
        die();
    }
?>
<h2>Datenbank Verwaltung</h2>
<fieldset>
<?php
    $databases = $server->getMySQLDatabases();
    if ($databases != 0 && !isset($_GET['db']))
    {
        $dbcontent = "<table>";
        foreach ($databases as $db)
            $dbcontent .= "<tr><td><a href='?p=mysql&s=db&db=$db'>$db</a></td></tr>";

        $dbcontent .= "</table>";
        print($dbcontent);
    }
    else if (isset($_GET['db']))
    {
        $db = $_GET['db'];
        $tables = $server->getMySQLTables($db);
        $dbcontent = "<table>";
        foreach ($tables as $tab)
            $dbcontent .= "<tr><td><a href='?p=mysql&s=db&db=$db&table=$tab'>$tab</a></td></tr>";

        $dbcontent .= "</table>";
        print($dbcontent);
    }
    else
    {
        print("Fehler beim Verbinden zum MySQL Server. Bitte pr&uuml;fen Sie die Verbindungsdaten.");
    }
?>
</fieldset>
