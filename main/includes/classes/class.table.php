<?php
class tableAction {

	private $mysql, $table;

	public function __construct($mysql, $table) {
		$this->mysql = $mysql;
		$this->table = $table;
	}


   /**
    *   Fügt mit einen Datensatz hinzu
    *   @param (String) Tabellenname
    *   @param (Array) Dateninhalte
    */
    public function insert($content) {
        $query = self::buildInsertQuery($this->table, $content);
        $this->Query($query);
    }

    public function update($content) {
    	$query = self::buildUpdateQuery($this->table, $content);
    	$this->Query($query);
    }


   /**
    *   Erstellt einen Query zum hinzufügen von Datensätzen
    *   und gibt einen fertigen Query zurück
    *   @param (String) Tabellenname
    *   @param (Array) Dateninhalte
    *   @return (String) Query
    */
    protected function buildInsertQuery($content) {
        if (!is_array($content)) {
            throw new Exception("Kein g&uuml;ltiger Parameter in MySQL::buildInsertQuery(String)");
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

    protected function buildUpdateQuery($content, $where) {
    	if (!is_array($content)) {
    		throw new Exception("Kein g&uuml;ltiger Parameter in MySQL::buildInsertQuery(String)");
    	} else {
    		$key = array_keys($content);
    		$data = array_values($content);
    		$amount = count($key_)-1;
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