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


namespace MySQL;

class Database {

    private $mysql;
    private $server;

    public function __construct($main) {
        $this->mysql = $main->getMySQLInstance();
        $this->server = $main->getServerInstance();
    }

    public function addServer($name, $host, $port, $user, $pass) {
        $this->mysql->Query("INSERT INTO sas_server_data (host,port,user,pass,name) VALUES ('$host','$port','$user','$pass','$name')");
    }

    public function addMySQL($host, $user, $pass) {
        $server = $this->server;
        $this->mysql->Query("INSERT INTO sas_server_mysql (sid,host,username,password) VALUES ('".$server->getID()."','$host','$user','$pass')");
        $this->mysql->Query("UPDATE sas_server_data SET mysql = 1 WHERE id = " . $server->getID());
    }

}
?>
