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

namespace Classes\MySQL;

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
            throw new \Classes\MySQL\Exception("Result ist keine Resource ".mysql_error());
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
            throw new \Classes\MySQL\Exception("Result ist keine Resource ".mysql_error());
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
            throw new \Classes\MySQL\Exception("Result ist keine Resource ".mysql_error());
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
            throw new \Classes\MySQL\Exception("Result ist keine Resource ".mysql_error());
        } else {
            return mysql_num_rows($this->result);
        }
    }
}

?>
