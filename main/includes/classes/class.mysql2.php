<?php

class MySQL {

    private $mysql_host;
    private $mysql_port;
    private $mysql_user;
    private $mysql_pass;
    private $mysql_db;
    private $result;

    function __construct($host, $port, $user, $pass) {
        $this->mysql_host = $host;
        $this->mysql_port = $port;
        $this->mysql_user = $user;
        $this->mysql_pass = $pass;

        if (!mysql_connect($this->mysql_host, $this->mysql_user, $this->mysql_pass)) {
            throw new Exeption("Fehler beim Verbinden zum MySQL Server " . mysql_error());
        }
    }

    function __clone() {

    }

    public function selectDB($db) {
        if (!mysql_select_db($db)) {
            throw new Exeption("Fehler beim Verbinden der Datenbank ". mysql_error());
        }
    }

    public function Query($query) {
        if (!($result = mysql_query($query))) {
            throw new Exeption("Fehler beim Ausf&uuml;hren des Querys ". mysql_error());
        } else {
            $this->result = $result;
            return clone $this;
        }
    }

    public function fetchAssoc() {
        if (!is_resource($this->result)) {
            throw new Exeption("Result ist keine Resource ".mysql_error());
        } else {
            return mysql_fetch_assoc($this->result);
        }
    }

    public function fetchArray() {
        if (!is_resource($this->result)) {
            throw new Exeption("Result ist keine Resource ".mysql_error());
        } else {
            return mysql_fetch_array($this->result);
        }
    }

    public function fetchObject() {
        if (!is_resource($this->result)) {
            throw new Exeption("Result ist keine Resource ".mysql_error());
        } else {
            return mysql_fetch_object($this->result);
        }
    }
}

?>
