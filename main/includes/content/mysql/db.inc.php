<?php
    if (!$server->isInstalled('mysql'))
    {
        header('Location: ?p=mysql&s=configure');
        die();
    }
?>
<h2>Datenbank Verwaltung</h2>
<fieldset style="width:auto;">
<div style="height:auto;width:auto;min-width:100px;max-height:500px;max-width:800px;min-height:130px;overflow-x:scroll;overflow-y:scroll;">
<?php
    $databases = $database_remote->getMySQLDatabases();

    if ($databases != 0 && !isset($_GET['db']))
    {
        $dbcontent = "<table>";
        foreach ($databases as $db)
            $dbcontent .= "<tr><td><a href='?p=mysql&s=db&db=$db'>$db</a></td></tr>";

        $dbcontent .= "</table>";
        printf("<h5><a href='?p=mysql&s=db'>%s MySQL</a></h5>",$data[3]);
        print($dbcontent);
    }
    else if (isset($_GET['db'])&&!isset($_GET['t']))
    {
        $db = $_GET['db'];
        $tables = $database_remote->getMySQLTables($db);
        $dbcontent = "<table>";
        foreach ($tables as $tab)
            $dbcontent .= "<tr><td><a href='?p=mysql&s=db&db=$db&t=$tab'>$tab</a></td></tr>";

        $dbcontent .= "</table>";
        printf("<h5><a href='?p=mysql&s=db'>%s MySQL</a> >> <a href='?p=mysql&s=db&db=%s'>%s</a></h5>",$data[3],$db,$db);
        print($dbcontent);
    }
    else if (isset($_GET['db'])&&isset($_GET['t']))
    {
        $db = $_GET['db'];
        $table = $_GET['t'];
        $columns = $database_remote->getMySQLColumns($db,$table);
        $dbcontent = "<table><tr>";
        foreach ($columns as $col)
            $dbcontent .= "<td><a href='#' class='tooltip2'><h5>$col[0]</h5>
                                <span><b>Typ</b> $col[1]</span>
                            </a></td>";
        $dbcontent .= "</tr>";
        $result = $remote_mysql->Query("SELECT * FROM $table");
        while ($row = $result->fetchArray())
        {
            $dbcontent .= "<tr>";
            for ($i=0;$i<count($columns);$i++)
            {
                $dbcontent .= "<td>$row[$i]</td>";
            }
            $dbcontent .= "</tr>";
        }
        $dbcontent .= "</table>";
        printf("<h5>
                <a href='?p=mysql&s=db'>%s MySQL</a> >> 
                <a href='?p=mysql&s=db&db=%s'>%s</a> >>
                <a href='?p=mysql&s=db&db=%s&t=$table'>%s</a></h5>"
                ,$data[3],$db,$db,$db,$table);
        print($dbcontent);
    }
    else
    {
        print("Fehler beim Verbinden zum MySQL Server. Bitte pr&uuml;fen Sie die Verbindungsdaten.");
    }
?>
<br><br>
</fieldset>
