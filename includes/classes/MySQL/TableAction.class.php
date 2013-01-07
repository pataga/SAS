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

class tableAction {

	private $mysql, $table;

	public function __construct($mysql, $table) {
		$this->mysql = $mysql;
		$this->table = $table;
	}


   /**
    *   Fügt mit einen Datensatz hinzu
    *   @param Array Dateninhalte
    *   @return MySQL
    */
    public function insert($content) {
        $query = self::buildInsertQuery($content);
        return $this->mysql->Query($query);
    }


   /**
    *   Fügt mit einen Datensatz hinzu
    *   @param Array Dateninhalte
    *   @return MySQL
    */
    public function update($content, $where) {
        $query = self::buildUpdateQuery($content, $where);
        return $this->mysql->Query($query);
    }

   /**
    *   Fügt mit einen Datensatz hinzu
    *   @param Array Dateninhalte
    *   @return MySQL
    */
    public function select($content, $where) {
        $query = self::buildSelectQuery($content, $where);
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
    protected function buildSelectQuery($content, $where) {
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

        if (is_array($where)) {
            $key = array_keys($where);
            $data = array_values($where);
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
    protected function buildInsertQuery($content) {
        if (!is_array($content)) {
            throw new Exception("Kein g&uuml;ltiger Parameter in tableAction::buildInsertQueryArray");
        } else {
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
    }

    /**
    *   Erstellt aus einem Array einen UPDATE Query
    *   @param Array Dateninhalte
    *   @param Array Bedingung
    *   @return String Query
    */
    protected function buildUpdateQuery($content, $where) {
    	if (!is_array($content)) {
    		throw new Exception("Kein g&uuml;ltiger Parameter in tableAction::buildUpdateQueryString");
    	} else {
    		$key = array_keys($content);
    		$data = array_values($content);
    		$amount = count($key)-1;
    		$query = "UPDATE $this->table SET ";

    		for ($i = 0; $i <= $amount; $i++) {
    			$query .= "$key[$i] = '$data[$i]'";
    			if ($i < $amount) $query .= ",";
    		}

    		$key = array_keys($where);
    		$data = array_values($where);
    		$amount = count($key)-1;

    		$query .= " WHERE ";

    		for ($i = 0; $i <= $amount; $i++) {
    			$query .= "$key[$i] = '$data[$i]'";
    			if ($i < $amount) $query .= " AND ";
    		}

    		return $query;
    	}
    }
}
?>
