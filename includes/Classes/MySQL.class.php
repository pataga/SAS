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
class MySQL implements \Config\MySQL {
    public function __construct($data = false) {
        try {
            if (!$data) {
                $dsn = 'mysql:host='.\Config\MySQL::HOST_ADDRESS;
                $this->pdoInstance = new \PDO($dsn, \Config\MySQL::USERNAME, \Config\MySQL::PASSWORD);
            } else {
                $dsn = 'mysql:host='.$data[\Classes\Server::MYSQL_HOST];
                $this->pdoInstance = new \PDO($dsn, $data[\Classes\Server::MYSQL_USER], $data[\Classes\Server::MYSQL_PASS]);
                if ($data[\Classes\Server::MYSQL_DB]) $this->selectDatabase($data[\Classes\Server::MYSQL_DB]);
            }
            $this->pdoInstance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            unset($this);
        }
    }

    public function selectDatabase($db) {
        try {
            $this->Query('USE '.$db);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

   /**
    *   Führt Query aus und gibt einen Klon von $this zurück
    *   @param (String) Query
    *   @return Result Instanz
    */
    public function Query($query) {
        try {
            $result = $this->pdoInstance->query($query);
            return new \Classes\MySQL\Result($result);
        } catch (\Exception $e) {
            return false;
        }
    }

   /**
    *   Neue Instanz zum Bearbeiten von Tabellen
    *   @param String Tabellenname
    *   @return TableAction
    */
    public function tableAction($table) {
        try {
            return new \Classes\MySQL\TableAction($this, $table);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    private $prepStmt, $stmtData = [], $pdoInstance;
}

?>
