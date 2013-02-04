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

namespace Classes;
class MySQL implements \Config\MySQL {

    private $mysql_host,$mysql_port,$mysql_user,$mysql_pass,$mysql_db,$result,$con_res,$mode;

    public function __construct($main, $data = false) {
        if (!$data) {
            $this->mysql_host = \Config\MySQL::HOST_ADDRESS;
            $this->mysql_port = \Config\MySQL::HOST_PORT;
            $this->mysql_user = \Config\MySQL::USERNAME;
            $this->mysql_pass = \Config\MySQL::PASSWORD;
        } else {
            $this->mysql_host = $data[0];
            $this->mysql_port = $data[1];
            $this->mysql_user = $data[2];
            $this->mysql_pass = $data[3];
        }
        
        try {
            $this->connect();
        } catch (\Classes\MySQL\Exception $e) {
            $this->main->Debug()->error($e);
        }
        
        if ($data[4]) {
            $this->selectDB($db);
        } elseif (!$data) {
            $this->selectDB(\Config\MySQL::DATABASE);
        }
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
            throw new \Classes\MySQL\Exception("Fehler beim Verbinden der Datenbank ". mysql_error());
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
            return false;
        } else {
            $this->result = $result;
            return new \Classes\MySQL\Result($this->result);
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
    *   Erstellt eine neue Datenbank
    *   @param String
    *   @return bool
    */
    public function createDatabase($db) {
        if (!$this->con_res) {
            throw new \Classes\MySQL\Exception("Keine Verbindung zum MySQL Server".mysql_error());
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
        return new \Classes\MySQL\TableAction($this, $table);
    }
}

?>
