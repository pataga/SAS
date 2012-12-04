<?php

class DBHandler {

    private $main, $connection, $errorLog, $database, $table;

    public function __construct($main) {
        $this->main = $main;
        $this->createDatabaseLink();
    }


    private function logError($error = null) {
        $this->errorLog .= $error;
    }


    public function getError() {
        return $this->errorLog;
    }


    private function createDatabaseLink() {
        $data = $this->main->getServerInstance()->getMySQLData();
        if (!is_array($data)) {
            $this->logError('Fehler in DBHandler::createDatabaseLink() - Variable data ist kein Array<br>');
        } else {
            if (!($this->mysql = new MySQL($data[0],$data[1],$data[2],$data[3]))) {
                $this->logError('Fehler in DBHandler::createDatabaseLink() - Verbindungsinformationen nicht korrekt<br>');
            }
        }
    }


    public function setDatabase($db) {
        $this->mysql->selectDB($db);
        $this->database = $db;
    }


    public function setTable($table) {
        $this->table = $table;
    }


    public function getDatabases() {
        return $this->mysql->Query("SHOW DATABASES");
    }


    public function getTables() {
        return $this->mysql->Query("SHOW TABLES FROM ".$this->database);
    }


    public function getColumns() {
        return $this->mysql->Query("SHOW FIELDS FROM $this->table");
    }


    public function getTableContent() {
        return $this->mysql->Query("SELECT * FROM $this->table");
    }


    public function buildLinkTree($sname, $db, $table) {
        if ($db&&$table) return "<h5>
        <a href='?p=mysql&s=db'>$sname MySQL</a> >>
        <a href='?p=mysql&s=db&db=$db'>$db</a> >>
        <a href='?p=mysql&s=db&db=%s&t=$table'>$table</a></h5>";
        if ($db&&!$table) return "<h5>
        <a href='?p=mysql&s=db'>$sname MySQL</a> >>
        <a href='?p=mysql&s=db&db=$db'>$db</a>
        </h5>";
        else return "<h5><a href='?p=mysql&s=db'>$sname MySQL</a></h5>";
    }


    public function buildDataTable() {
        $res = $this->getColumns();
        $dataTable = "<tr>";
        $counter = 0;
        while ($col = $res->fetchArray()) {
            $dataTable .= "<td><a href='#' class='tooltip2'><h5>$col[0]</h5><span><b>Typ</b> $col[1]</span></a></td>";
            $counter++;
        }
        $dataTable .= "</tr>";
        $res = $this->getTableContent();
        while ($d = $res->fetchArray()) {
            $dataTable .= "<tr>";
            for ($i=0;$i<$counter;$i++) {
                $dataTable .= "<td>$d[$i]</td>";
            }
            $dataTable .= "</tr>";
        }
        return $dataTable;
    }


    public function DatabaseToTable() {
        $content = "";
        $res = $this->getDatabases();
        while ($row = $res->fetchArray()) {
            $content .= "<tr>";
            $content .= "<td><a href='?p=mysql&s=db&db=$row[0]'> $row[0] </a></td>";
            $content .= "</tr>";
        }
        return $content;
    }


    public function TableToTable() {
        $content = "";
        $res = $this->getTables();
        while ($row = $res->fetchArray()) {
            $content .= "<tr>";
            $content .= "<td><a href='?p=mysql&s=db&db=$this->database&t=$row[0]'> $row[0] </td>";
            $content .= "</tr>";
        }
        return $content;
    }
}

?>