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
class SSH {

    private $host,$port,$user,$pass,$connection,$con;

   /**
    * An diese Methode werden die SSH Zugangsdaten übergeben
    *
    * @param String Host [Adresse zum SSH Server Host]
    * @param int Port [Port des SSH Dienstes]
    * @param String Benutzername [SSH Benutzername]
    * @param String Passwort [SSH Passwort]
    * 
    * @example $ssh = new SSH('127.0.0.1', 22, 'root', 'topsecret');
    */
    public function __construct($host='',$port=22,$user='',$pass='') {
        if (!empty($host))
            $this->host = $host;
        if (!empty($port))
            $this->port = $port;
        if (!empty($user))
            $this->user = $user;
        if (!empty($pass))
            $this->pass = $pass;
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
                throw new \Classes\SSH\Exception('SSH Connection failed', 1010);
            if (!ssh2_auth_password($this->connection, $this->user, $this->pass))
                throw new \Classes\SSH\Exception('SSH Autentication failed', 1011);
        } catch (\Classes\SSH\Exception $e) {
            $this->con = false;
            \Classes\Main::Session()->unselectServer();
            \Classes\Main::Loader()->reload();
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
            throw new \Classes\SSH\Exception('SSH command failed', 0xA1);

        stream_set_blocking($os, true);
        $data = array();
        if ($type == 2) {
            for ($i = 0; $line = fgets($os); $i++) {
                flush();
                $data[$i] = $line;
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
