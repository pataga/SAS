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


class SSH {

    private $host; 
    private $port;
    private $user;
    private $pass;
    private $connection;
    private $out;

   /**
    * An diese Methode werden die SSH Zugangsdaten übergeben
    *   
    * @param Main main [Main Instanz]
    * @param String Host [Adresse zum SSH Server Host]
    * @param int Port [Port des SSH Dienstes]
    * @param String Benutzername [SSH Benutzername]
    * @param String Passwort [SSH Passwort]
    * 
    * @example $ssh = new SSH($main, '127.0.0.1', 22, 'root', 'topsecret');
    */
    public function __construct($main=null,$host='',$port=22,$user='',$pass='') {
        if (!empty($host))
            $this->host = $host;
        if (!empty($port))
            $this->port = $port;
        if (!empty($user))
            $this->user = $user;
        if (!empty($pass))
            $this->pass = $pass;
    }


   /**
    * Öffnet Verbindung zum SSH Daemon und authentifiziert sich
    * @param void
    */
    public function openConnection() {
        try {
            if (!($this->connection = ssh2_connect($this->host, $this->port)))
                throw new Exception('SSH Connection failed');
            if (!ssh2_auth_password($this->connection, $this->user, $this->pass))
                throw new Exception('SSH Autentication failed');
        } catch (Exception $e) {

        }
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
        $output = "";
        if (!($os = ssh2_exec($this->connection, $command, "bash")))
            throw new Exception('SSH command failed');

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

}
?>
