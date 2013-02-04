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

namespace Classes\Module\MySQL;

class DBHandler {

    private $main, $connection, $errorLog, $database, $table;

    public function __construct($main) {
        $this->main = $main;
        $this->createDatabaseLink();
    }


    private function createDatabaseLink() {
        $data = $this->main->Server()->getMySQLData();
        try {
            if (!is_array($data)) {
                throw new \Exception('Fehler in DBHandler::createDatabaseLink() - Variable data ist kein Array');
            } else {
                if (!($this->mysql = new MySQL($this->main,$data[0],$data[1],$data[2],$data[3]))) {
                    throw new \Exception('Fehler in DBHandler::createDatabaseLink() - Verbindungsinformationen nicht korrekt');
                }
            }
        } catch (\MySQL\Exception $e) {
            $this->main->Debug()->error($e);
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
        return $this->mysql->Query('SHOW DATABASES');
    }


    public function getTables() {
        return $this->mysql->Query('SHOW TABLES FROM '.$this->database);
    }


    public function getColumns() {
        return $this->mysql->Query('SHOW FIELDS FROM '.$this->table);
    }


    public function getTableContent() {
        return $this->mysql->Query('SELECT * FROM '.$this->table);
    }


    public static function buildLinkTree($sname, $db, $table) {
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
        $dataTable = '<tr>';
        $counter = 0;
        while ($col = $res->fetchArray()) {
            $dataTable .= sprintf('<td><a href="#" class="tooltip2"><h5>%s</h5><span><b>Typ</b>%s</span></a></td>',
                          $col[0],$col[1]);
            $counter++;
        }
        $dataTable .= '</tr>';
        $res = $this->getTableContent();
        while ($d = $res->fetchArray()) {
            $dataTable .= '<tr>';
            for ($i=0;$i<$counter;$i++) {
                $dataTable .= sprintf('<td>%s</td>',$d[$i]);
            }
            $dataTable .= '</tr>';
        }
        return $dataTable;
    }


    public function DatabaseToTable() {
        $content = '';
        $res = $this->getDatabases();
        while ($row = $res->fetchArray()) {
            $content .= sprintf('<tr><td><a href="?p=mysql&s=db&db=%s">%s</a></td></tr>',$row[0],$row[0]);
        }
        return $content;
    }


    public function TableToTable() {
        $content = '';
        $res = $this->getTables();
        while ($row = $res->fetchArray()) {
            $content .= sprintf('<tr><td><a href="?p=mysql&s=db&db=%s&t=%s">%s</td></tr>',$this->database,$row[0],$row[0]);
        }
        return $content;
    }
}

?>