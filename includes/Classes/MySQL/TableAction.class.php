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

namespace Classes\MySQL;

class tableAction {

	private $mysql, $table;

	public function __construct($mysql, $table) {
		$this->mysql = $mysql;
		$this->table = $table;
	}


   /**
    *   Fügt einen Datensatz hinzu
    *   @param Array Dateninhalte
    *   @return Result
    */
    public function insert($content) {
        $query = self::buildInsertQuery($content);
        return $this->mysql->Query($query);
    }


   /**
    *   Aktualisiert einen Datensatz
    *   @param Array Änderungen
    *   @param Array Condition
    *   @return Result
    */
    public function update($content, $condition) {
        $query = self::buildUpdateQuery($content, $condition);
        return $this->mysql->Query($query);
    }

    /**
    *   Aktualisiert einen Datensatz
    *   @param Array Änderungen
    *   @param Array Condition
    *   @return Result
    */
    public function replace($content, $condition) {
        $query = self::buildReplaceQuery($content, $condition);
        return $this->mysql->Query($query);
    }

   /**
    *   Fügt mit einen Datensatz hinzu
    *   @param Array Dateninhalte
    *   @return Result
    */
    public function select($content = null, $condition = null) {
        $query = self::buildSelectQuery($content, $condition);
        return $this->mysql->Query($query);
    }

    /**
    *   Fügt mit einen Datensatz hinzu
    *   @param Array Dateninhalte
    *   @return Result
    */
    public function delete($condition) {
        $query = self::buildDeleteQuery($condition);
        return $this->mysql->Query($query);
    }

   /**
    *   Gibt Tabellenname zurück
    *   @return String Tabellenname
    */
    public function getTable() {
        return $this->table;
    }


   /**
    *   Erstellt aus einem Array einen UPDATE Query
    *   @param Array Dateninhalte
    *   @param Array Bedingung
    *   @return String Query
    */
    protected function buildSelectQuery($content = null, $condition = null) {
        $query = "SELECT ";

        if (is_array($content)) {
            $data = array_values($content);
            $amount = count($data)-1;
            
            for ($i = 0; $i <= $amount; $i++) {
                $query .= $data[$i];
                if ($i < $amount) $query .= ",";
            }
        } else {
            $query .= "* FROM $this->table ";
        }

        if (is_array($condition)) {
            $key = array_keys($condition);
            $data = array_values($condition);
            $amount = count($key)-1;

            $query .= " WHERE ";

            for ($i = 0; $i <= $amount; $i++) {
                $query .= "$key[$i] = '$data[$i]'";
                if ($i < $amount) $query .= " AND ";
            }
        }

        return $query;
    }


   /**
    *   Erstellt aus einem Array einen INSERT Query
    *   @param Array Dateninhalte
    *   @return String Query
    */
    protected function buildInsertQuery(array $content) {
        $key_ = array_keys($content);
        $data_ = array_values($content);
        $amount = count($key_)-1;
        $i = 0;
        $query = "INSERT INTO $this->table (";
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

    /**
    *   Erstellt aus einem Array einen UPDATE Query
    *   @param Array Dateninhalte
    *   @param Array Bedingung
    *   @return String Query
    */
    protected function buildUpdateQuery(array $content, array $condition) {
        $key = array_keys($content);
        $data = array_values($content);
        $amount = count($key)-1;
        $query = "UPDATE $this->table SET ";

        for ($i = 0; $i <= $amount; $i++) {
            $query .= "$key[$i] = '$data[$i]'";
            if ($i < $amount) $query .= ",";
        }

        $key = array_keys($condition);
        $data = array_values($condition);
        $amount = count($key)-1;

        $query .= " WHERE ";
        for ($i = 0; $i <= $amount; $i++) {
            $query .= "$key[$i] = '$data[$i]'";
            if ($i < $amount) $query .= " AND ";
        }

        return $query;
    }

    /**
    *   Erstellt aus einem Array einen REPLACE Query
    *   @param Array Dateninhalte
    *   @param Array Bedingung
    *   @return String Query
    */
    protected function buildReplaceQuery(array $content, array $condition) {
        $key = array_keys($content);
        $data = array_values($content);
        $amount = count($key)-1;
        $query = "REPLACE $this->table SET ";

        for ($i = 0; $i <= $amount; $i++) {
            $query .= "$key[$i] = '$data[$i]'";
            if ($i < $amount) $query .= ",";
        }

        $key = array_keys($condition);
        $data = array_values($condition);
        $amount = count($key)-1;

        $query .= " WHERE ";
        for ($i = 0; $i <= $amount; $i++) {
            $query .= "$key[$i] = '$data[$i]'";
            if ($i < $amount) $query .= " AND ";
        }

        return $query;
    }

    /**
    *   Erstellt aus einem Array einen DELETE Query
    *   @param Array Bedingung
    *   @return String Query
    */
    protected function buildDeleteQuery(array $condition) {
        $query = 'DELETE FROM '.$this->table.' WHERE ';

        $key = array_keys($condition);
        $data = array_values($condition);
        $amount = count($key)-1;

        for ($i = 0; $i <= $amount; $i++) {
            $query .= $key[$i]." = '".$data[$i]."'";
            if ($i < $amount) $query .= " AND ";
        }

        return $query;
    }
}
?>
