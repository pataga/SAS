<?php
class Result {
    private $result;

    public function __construct($result) {
        $this->result = $result;
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
}

?>
