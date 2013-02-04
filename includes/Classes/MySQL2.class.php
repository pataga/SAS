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

namespace Classes;
class MySQL2 extends PDO implements \Config\MySQL {
    public function __construct($data = false) {
        if (!$data) {
            $dsn = 'mysql:dbname='.\Config\MySQL::DATABASE.';host='.\Config\MySQL::HOST_ADDRESS;
            parent::_construct($dsn, \Config\MySQL::USERNAME, \Config\MySQL::PASSWORD);
        } else {
            $dsn = 'mysql:dbname='.$data[1].';host='.$data[0];
            parent::_construct($dsn, $data[2], $data[3]);
        }
    }

    public function preparedStatement($stmt = false) {
        if (!$stmt) return false;
        $this->prepStmt = $this->prepare($stmt);
    }

    public function setData($data, $id) {
        $stmtData[$id] = $data;
    }

    public function execute() {
        $this->prepStmt->execute($this->stmtData);
    }

    public function Query($stmt) {
        parent::query($stmt);
    }

    private $prepStmt, $stmtData = [];
}

?>
