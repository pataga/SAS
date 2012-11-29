<?php

class Database {

    private $mysql;
    private $server;

    function __construct($mysql, $server) {
        $this->mysql = $mysql;
        $this->server = $server;
    }

    public function getMySQLDatabases() {
        $result = $this->mysql->Query("SHOW DATABASES");
        $database = array();

        for ($itr = 0; ($row = $result->fetchObject()); $itr++)
            $database[$itr] = $row->Database;

        return $database;
    }

    public function getMySQLTables($db) {
        $result = $this->mysql->Query("SHOW TABLES FROM $db");
        $tables = array();
        for ($itr = 0; ($row = $result->fetchArray()); $itr++)
            $tables[$itr] = $row[0];

        return $tables;
    }

    public function getMySQLColumns($db, $table) {
        if ($this->mysql->selectDB($db)) {
            $result = $this->mysql->Query("SHOW COLUMNS FROM $table");
            $colums = array();
            for ($i = 0; $row = $result->fetchArray(); $i++) {
                $colums[$i][0] = $row[0];
                $colums[$i][1] = $row[1];
            }
            return $colums;
        } else
            return 0;
    }

    public function addServer($name, $host, $port, $user, $pass) {
        $this->mysql->Query("INSERT INTO sas_server_data (host,port,user,pass,name) VALUES ('$host','$port','$user','$pass','$name')");
    }

    public function addMySQL($host, $user, $pass) {
        $server = $this->server;
        $this->mysql->Query("INSERT INTO sas_server_mysql (sid,host,username,password) VALUES ('$server->getID()','$host','$user','$pass')");
        $this->mysql->Query("UPDATE sas_server_data SET mysql = 1 WHERE id = " . $server->getID());
    }

}
?>