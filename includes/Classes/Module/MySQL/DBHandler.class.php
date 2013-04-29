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

namespace Classes\Module\MySQL;

class DBHandler extends \Classes\MySQL {
    public function __construct(array $data) {
        parent::__construct($data);
    }

    public function setDatabase($dbName) {
        $this->selectedDatabase = $dbName;
        $this->selectDatabase($dbName);
    }

    public function setTable($tableName) {
        $this->selectedTable = $tableName;
    }

    public function setPageNumber($nr) {
        $this->pageNumber = $nr;
    }

    public function setMaxRows($maxRows) {
        $this->maxRows = $maxRows;
    }

    public function getDatabases() {
        return $this->Query("SHOW DATABASES")->fetchAll();
    }

    public function getTables() {
        if (!isset($this->selectedDatabase))
            return false;

        if (!$this->selectDatabase($this->selectedDatabase))
            return false;

        return $this->Query("SHOW TABLES")->fetchAll();
    }

    public function getColumns() {
        return $this->Query("SHOW COLUMNS FROM ".$this->selectedTable)->fetchAll();
    }

    public function getData() {
        $from = $this->maxRows*($this->pageNumber-1);
        return $this->Query("SELECT * FROM ".$this->selectedTable." LIMIT ".$from.", ".$this->maxRows)->fetchAll();
    }

    public function getMaxRows() {
        return $this->maxRows;
    }

    public function getDataCount() {
        return $this->Query('SELECT * FROM '.$this->selectedTable)->getRowsCount();
    }
    
    public function exec($sql) {
        return $this->Query($sql);
    }

    public function getVersion() {
        $result = $this->Query("SELECT VERSION()");
        if ($row = $result->fetch(\Classes\MySQL\Result::FETCH_ASSOC))
            return $row['VERSION()'];
    }

    public function getConnectionId() {
        $result = $this->Query("SELECT CONNECTION_ID()");
        if ($row = $result->fetch(\Classes\MySQL\Result::FETCH_ASSOC))
            return $row['CONNECTION_ID()'];
    }

    public function getUserCount() {
        $this->Query('USE mysql');
        return count($this->Query("SELECT * FROM user")->fetchAll());
    }

    public function getDatabaseCount() {
        return count($this->getDatabases());
    }

    private $selectedDatabase, $selectedTable, $maxRows, $pageNumber;
}

?>