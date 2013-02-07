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

class Result {
    private $result;

    const FETCH_OBJECT  = 0;
    const FETCH_ASSOC   = 1;
    const FETCH_BOTH    = 2;
    const FETCH_LAZY    = 3;

    public function __construct($result) {
        $this->result = $result;
    }

    public function fetch($type = 0) {
        switch ($type) {
            case Result::FETCH_OBJECT: 
                return $this->result->fetch(\PDO::FETCH_OBJ);
            case Result::FETCH_ASSOC:
                return $this->result->fetch(\PDO::FETCH_ASSOC);
            case Result::FETCH_BOTH:
                return $this->result->fetch(\PDO::FETCH_BOTH);
            case Result::FETCH_LAZY:
                return $this->result->fetch(\PDO::FETCH_LAZY);
            default:
                return false;
        }
    }

    // Temporäre Methode, bis alle Module und Klassen abgeändert wurden
    public function fetchObject() {
        return $this->fetch(Result::FETCH_OBJECT);
    }

    public function getRowsCount() {
        return $this->result->rowCount();
    }
}

?>
