<?php

class MySQL {

    private $mysql_host;
    private $mysql_port;
    private $mysql_user;
    private $mysql_pass;
    private $mysql_db;

    function __construct($host, $port, $user, $pass) {
        $this->mysql_host = $host;
        $this->mysql_port = $port;
        $this->mysql_user = $user;
        $this->mysql_pass = $pass;

        if (!mysql_connect($this->mysql_host, $this->mysql_user, $this->mysql_pass)) {
            throw new Exeption("Fehler beim Verbinden zum MySQL Server " . mysql_error());
        }
    }

    public function selectDB($db) {
        if (!mysql_select_db($db)) {
            throw new Exeption("Fehler beim Verbinden der Datenbank ". mysql_error());
        }
    }
}

?>
