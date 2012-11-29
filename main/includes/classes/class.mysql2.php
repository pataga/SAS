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

    public function insert($table, $content) {
        $query = MySQL::buildQuery($table, $content);
        $this->Query($query);
    }

    protected function buildQuery($table, $content) {
        if (!is_array($content)) {
            throw new Exeption("Kein g&uuml;ltiger Parameter in MySQL::buildQuery(String)");
        } else {
            $key_ = array_keys($content);
            $data_ = array_values($content);
            $amount = count($key_)-1;
            $i = 0;
            $query = "INSERT INTO $table (";
            foreach ($key_ as $key) {
                $query .= "$key";
                if ($i < $amount) $query .= ",";
                $i++;
            }

            $query .= ") VALUES (";
            $i = 0;
            foreach ($data_ as $data) {
                $query .= "'$data'";
                if ($i < $amount) $query .= ",";
                $i++;
            }
            $query .= ")";

            return $query;
        }
    }
}

?>
