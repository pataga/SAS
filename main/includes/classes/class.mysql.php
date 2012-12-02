<?php

class MySQL {

    private $mysql_host,$mysql_port,$mysql_user,$mysql_pass,$mysql_db,$result,$con_res,$mode;

    public function __construct($host, $port, $user, $pass, $db=false) {
        $this->mysql_host = $host;
        $this->mysql_port = $port;
        $this->mysql_user = $user;
        $this->mysql_pass = $pass;
        $this->connect();
        if ($db) $this->selectDB($db);
    }

    function  __clone() {
        
    }

   /**
    *   Verbindet zu MySQL Server
    */
    private function connect() {
        $this->con_res = mysql_connect($this->mysql_host, $this->mysql_user, $this->mysql_pass);
        if (!empty($this->mysql_db))
            mysql_select_db($this->db, $this->con_res);
    }


   /**
    *   Selektiert eine Datenbank
    *   @param Datenbankname
    */
    public function selectDB($db) {
        if (!($this->database_res = mysql_select_db($db, $this->con_res))) {
            throw new Exception("Fehler beim Verbinden der Datenbank ". mysql_error());
        } else {
            $this->mysql_db = $db;
        }
    }


   /**
    *   Führt Query aus und gibt einen Klon von $this zurück
    *   @param (String) Query
    *   @return MySQL Instanz
    */
    public function Query($query) {
        if (!($result = mysql_query($query, $this->con_res))) {
            return 0;
        } else {
            $this->result = $result;
            return clone $this;
        }
    }


    /**
    *   Führt Query aus und gibt den ersten Datensatz als Array zurück
    *   @param (String) Query
    *   @return (Array) Row
    */
    public function QueryFirst($query) {
        if (!($result = mysql_query($query, $this->con_res))) {
            return 0;
        } else {
            if (!is_resource($result)) {
                return 0;
            } else {
                return mysql_fetch_array($result);
            }
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
        if (!$this->con_res) {
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
