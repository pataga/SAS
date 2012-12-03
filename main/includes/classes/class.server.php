<?php

class Server {

    private $server_id;
    private $mysql;

    public function __construct($main) {
        $this->mysql = $main->getMySQLInstance();
        $this->server_id = isset($_SESSION['server_id']) ? $_SESSION['server_id'] : 0;
    }

   /**
    * Gibt Server ID zurück
    * @return (int) ServerID
    */
    public function getID() {
        return $this->server_id;
    }


   /**
    * Gibt einen Array mit den SSH Daten zurück
    * @param (int) ServerID
    * @return (array) SSH Daten
    */
    public function getServerData($id = 1) {
        $this->server_id = $id;
        $result = $this->mysql->Query("SELECT * FROM sas_server_data WHERE id = $this->server_id");

        if ($result->getRowsCount() > 0) {
            $row = $result->fetchObject();
            $data = array();

            $data[0] = $row->host;
            $data[1] = $row->user;
            $data[2] = $row->pass;
            $data[3] = $row->name;

            return $data;
        }
    }


   /**
    * Überprüft, ob ein Modul installiert wurde.
    * @param (String) Modul Name
    * @return (Bool)
    */
    public function isInstalled($package) {
        $result = $this->mysql->Query("SELECT * FROM sas_server_data WHERE id = $this->server_id");

        if ($result->getRowsCount() > 0) {
            $row = $result->fetchObject();

            switch ($package) {
                case 'mysql': if ($row->mysql == "1")
                        return true;
                case 'postfix': if ($row->postfix == "1")
                        return true;
                case 'ftp': if ($row->ftp == "1")
                        return true;
                case 'samba': if ($row->samba == "1")
                        return true;
                case 'apache': if ($row->apache == "1")
                        return true;
                default: return false;
            }
        } else
            return false;
    }


   /**
    * Gibt MySQL Daten des Servers zurück
    * @return (array) MySQL Daten
    */
    public function getMySQLData() {
        if ($this->isInstalled("mysql")) {
            $result = $this->mysql->Query("SELECT * FROM sas_server_mysql WHERE sid = $this->server_id");

            if ($result->getRowsCount() > 0) {
                $data = array();
                $row = $result->fetchObject();
                $data[0] = $row->host;
                $data[1] = $row->port;
                $data[2] = $row->username;
                $data[3] = $row->password;
                return $data;
            }
        }

        return false;
    }


   /**
    * Gibt den Status der Modul Dienste zurück
    * @param (SSH) SSH Verbindung
    * @return (Bool Array) Status
    */
    public function serviceStatus($ssh) {
        $data = array();
        $data[0] = $this->getServiceStatus($ssh, 'smbd');
        $data[1] = $this->getServiceStatus($ssh, 'apache2');
        $data[2] = $this->getServiceStatus($ssh, 'postfix');
        $data[3] = $this->getServiceStatus($ssh, 'proftpd');
        $data[4] = $this->getServiceStatus($ssh, 'mysql');
        return $data;
    }


   /**
    * Gibt den Status eines Dienstes zurück
    * @param (SSH) SSH Verbindung
    * @param (String) Dienst Name
    * @return (Bool) Status
    */
    public function getServiceStatus($ssh, $service) {
        $line = $ssh->execute('service ' . $service . ' status');
        $exp = explode(" ", $line);

        if ($exp[1] == "start/running," || $exp[1] == "is" && $exp[2] == "running")
            return true;
        else
            return false;
    }


   /**
    * Fügt einen String an eine Datei auf dem Server an.
    * Die empfiehlt sich für das Erweitern von Konfigs.
    * @param (SSH) SSH Verbindung
    * @param (String) Datei Name
    * @param (String) Inhalt
    */
    public function addToFile($ssh, $file, $content) {
        $ssh->openConnection();
        $ssh->execute('echo -e "' . $content . '" >> ' . $file);
    }

}
?>
