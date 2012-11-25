<?php
    if (!$server->isInstalled('mysql'))
    {
        header('Location: ?p=mysql&s=configure');
        die();
    }
?>
<h2>Datenbank Verwaltung</h2>
<fieldset style="width:900px;">
<div style="width: 900px;height: 500px; overflow-x:scroll;overflow-y:scroll;">
<?php
    $data = $server->getServerData($server->server_id);
    $databases = $server->getMySQLDatabases();

    if ($databases != 0 && !isset($_GET['db']))
    {
        $dbcontent = "<table>";
        foreach ($databases as $db)
            $dbcontent .= "<tr><td><a href='?p=mysql&s=db&db=$db'>$db</a></td></tr>";

        $dbcontent .= "</table>";
        printf("<h4><a href='?p=mysql&s=db'>%s MySQL</a></h4>",$data[3]);
        print($dbcontent);
    }
    else if (isset($_GET['db'])&&!isset($_GET['t']))
    {
        $db = $_GET['db'];
        $tables = $server->getMySQLTables($db);
        $dbcontent = "<table>";
        foreach ($tables as $tab)
            $dbcontent .= "<tr><td><a href='?p=mysql&s=db&db=$db&t=$tab'>$tab</a></td></tr>";

        $dbcontent .= "</table>";
        printf("<h4><a href='?p=mysql&s=db'>%s MySQL</a> >> <a href='?p=mysql&s=db&db=%s'>%s</a></h4>",$data[3],$db,$db);
        print($dbcontent);
    }
    else if (isset($_GET['db'])&&isset($_GET['t']))
    {
        $db = $_GET['db'];
        $table = $_GET['t'];
        $columns = $server->getMySQLColumns($db,$table);
        $dbcontent = "<table><tr>";
        foreach ($columns as $col)
            $dbcontent .= "<td><h4>$col[0]</h4></td>";
        $dbcontent .= "</tr>";
        $result = mysql_query("SELECT * FROM $table");
        while ($row = mysql_fetch_array($result))
        {
            $dbcontent .= "<tr>";
            for ($i=0;$i<count($columns);$i++)
            {
                $dbcontent .= "<td>$row[$i]</td>";
            }
            $dbcontent .= "</tr>";
        }
        $dbcontent .= "</table>";
        printf("<h4>
                <a href='?p=mysql&s=db'>%s MySQL</a> >> 
                <a href='?p=mysql&s=db&db=%s'>%s</a> >>
                <a href='?p=mysql&s=db&db=%s&t=$table'>%s</a></h4>"
                ,$data[3],$db,$db,$db,$table);
        print($dbcontent);
    }
    else
    {
        print("Fehler beim Verbinden zum MySQL Server. Bitte pr&uuml;fen Sie die Verbindungsdaten.");
    }
?>
</fieldset>
