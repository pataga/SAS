<?php

class SSH {

    private $_host;
    private $_port;
    private $_user;
    private $_pass;
    private $_connection;
    private $_out;

    public function __construct($host = '', $port = '', $user = '', $pass = '') {
        if (!empty($host))
            $this->_host = $host;
        if (!empty($port))
            $this->_port = $port;
        if (!empty($user))
            $this->_user = $user;
        if (!empty($pass))
            $this->_pass = $pass;
    }


   /**
    * Öffnet Verbindung zum SSH Daemon und Authentifiziert sich
    */
    public function openConnection() {
        $this->_connection = ssh2_connect($this->_host, $this->_port);
        if (!$this->_connection)
            throw new Exception('SSH Connection failed');
        if (!ssh2_auth_password($this->_connection, $this->_user, $this->_pass))
            throw new Exception('SSH Autentication failed');
    }


   /**
    * Führt einen Befehl über die SSH Verbindung aus
    * @param (String) Befehl
    * @param (int) Typ => 0 = keine Formatierung - 1 = <br> nach jeder Zeile - 2 = Ausgabe als Array
    * @return String/Array
    */
    public function execute($command, $type = 0) {
        $output = "";
        if (!($os = ssh2_exec($this->_connection, $command, "bash")))
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
