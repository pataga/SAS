<?php

class MySQL {

    private $mysql_host;
    private $mysql_port;
    private $mysql_user;
    private $mysql_pass;
    private $mysql_db;
    private $result;
    private $connection_res;

    public function __construct($host, $port, $user, $pass, $db=false) {
        $this->mysql_host = $host;
        $this->mysql_port = $port;
        $this->mysql_user = $user;
        $this->mysql_pass = $pass;
        $this->connect();
        if ($db) $this->selectDB($db);
    }


   /**
    *   Verbindet zu MySQL Server
    */
    private function connect() {
        $this->connection_res = mysql_connect($this->mysql_host, $this->mysql_user, $this->mysql_pass);
        if (!empty($this->mysql_db))
            mysql_select_db($this->db, $this->connection_res);
    }


   /**
    *   Selektiert eine Datenbank
    *   @param Datenbankname
    */
    public function selectDB($db) {
        if (!($this->database_res = mysql_select_db($db, $this->connection_res))) {
            throw new Exception("Fehler beim Verbinden der Datenbank ". mysql_error());
        } else {
            $this->mysql_db = $db;
        }
    }


   /**
    *   Führt Query aus und gibt einen Klon von $this zurück
    *   @param MySQL Query
    *   @return MySQL Instanz
    */
    public function Query($query) {
        if (!($result = mysql_query($query, $this->connection_res))) {
            throw new Exception("Fehler beim Ausf&uuml;hren des Querys ". mysql_error());
        } else {
            $this->result = $result;
            return clone $this;
        }
    }


   /**
    *   Fetcht Query Result zu einem assoziativen Array
    *   @return Array
    */
    public function fetchAssoc() {
        if (!is_resource($this->result)) {
            throw new Exception("Result ist keine Resource ".mysql_error());
        } else {
            return mysql_fetch_assoc($this->result);
        }
    }


   /**
    *   Fetcht Query Result zu einem Array
    *   @return Array
    */
    public function fetchArray() {
        if (!is_resource($this->result)) {
            throw new Exception("Result ist keine Resource ".mysql_error());
        } else {
            return mysql_fetch_array($this->result);
        }
    }


   /**
    *   Fetcht Query Result zu einem Objekt
    *   @return Object
    */
    public function fetchObject() {
        if (!is_resource($this->result)) {
            throw new Exception("Result ist keine Resource ".mysql_error());
        } else {
            return mysql_fetch_object($this->result);
        }
    }


    /**
    *   Gibt die Anzahl der Rows zurück
    *   @return Integer
    */
    public function getRowsCount() {
        if (!is_resource($this->result)) {
            throw new Exception("Result ist keine Resource ".mysql_error());
        } else {
            return mysql_num_rows($this->result);
        }
    }


   /**
    *   Erstellt eine neue Datenbank
    *   @param String
    *   @return bool
    */
    public function createDatabase($db) {
        if (!$this->connection_res) {
            throw new Exception("Keine Verbindung zum MySQL Server".mysql_error());
        } else {
            $this->Query("CREATE DATABASE $db");
            return true;
        }
    }

   /**
    *   Neue Instanz zum Bearbeiten von Tabellen
    *   @param String Tabellenname
    *   @return TableAction
    */
    public function tableAction($table) {
        return new TableAction($this, $table);
    }
}

?>
