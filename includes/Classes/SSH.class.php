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
class SSH extends \Classes\Singleton {

    private $host,$port,$user,$pass,$connection,$out,$con;

   /**
    * An diese Methode werden die SSH Zugangsdaten übergeben
    * 
    * @example $ssh = new SSH();
    */
    public function __construct($main=null,$host='',$port=22,$user='',$pass='') {
        $db = self::getInstance('\Classes\MySQL');
        $result = $db->tableAction('sas_server_data')->select(NULL, 
                                ['id' => self::getInstance('\Classes\Server')->getID()]);
        
        if ($data = $result->fetch()) {
            $this->user = $data->user;
            $this->pass = $data->pass;
            $this->host = $data->host;
            $this->port = $data->port;
        }

        $this->con = false;
    }

   /**
    * Öffnet Verbindung zum SSH Daemon und authentifiziert sich
    * @param void
    */
    private function openConnection() {
        if ($this->con) return true;
        try {
            if (!($this->connection = ssh2_connect($this->host, $this->port)))
                throw new \Classes\SSH\Exception('SSH Connection failed');
            if (!ssh2_auth_password($this->connection, $this->user, $this->pass))
                throw new \Classes\SSH\Exception('SSH Autentication failed');
        } catch (\Classes\SSH\Exception $e) {
            $this->con = false;
            return false;
        }
        $this->con = true;
        return true;
    }

   /**
    * Führt einen Befehl über die SSH Verbindung aus
    * @param String 
    * @param int
    * @return mixed[]
    * 
    * @example $result = $ssh->execute('ls -la /',0); //Einfache Rückgabe
    * @example $result = $ssh->execute('ls -la /',1); //Nach jeder Zeile ein <br>
    * @example $result = $ssh->execute('ls -la /',2); //Rückgabe als Array
    */
    public function execute($command, $type = 0) {
        if (!$this->con) {
            if (!$this->openConnection()) {
                return false;
            }
        }

        $output = '';

        if (!($os = ssh2_exec($this->connection, $command, "bash")))
            throw new \Classes\SSH\Exception('SSH command failed');

        stream_set_blocking($os, true);
        $data = [];

        if ($type == 2) {
            while ($line = fgets($os)) {
                flush();
                $data[] = $line;
            }
            return $data;
        } else {
            while ($line = fgets($os)) {
                flush();
                $output .= $line . ($type == 1 ? '<br>' : '');
            }
        }

        return $output;
    }

    public function getStatus() {
        return $this->con;
    }
}
?>
