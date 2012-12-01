<?php

class Database {

    private $mysql;
    private $server;

    public function __construct($mysql, $server) {
        $this->mysql = $mysql;
        $this->server = $server;
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
