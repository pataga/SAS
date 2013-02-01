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

class Server {

    private $server_id;
    private $mysql;
    private $server_address;
    private $soapActive;
    private $soap_port, $soap_key;
    private $soap;
    private $m;

    public function __construct($main) {
        $this->m = $main;
        $this->mysql = $main->MySQL();
        $session = $main->Session();
        $this->server_id = $session->getServerID();
        $data = $this->getServerData();
        $this->server_address = $data[0];
        $result = $this->mysql->tableAction('sas_server_data')->select(NULL, ['id' => $this->server_id]);
        
        if ($result->getRowsCount() > 0) {
            $r = $result->fetchObject();
            $this->soapActive = ($r->soap == 1);
            $this->soap_port = $r->soapPort;
            $this->soap_key = $r->soapKey;
            try {
                $this->soap = new SOAP($this);
            } catch (Exception $e) {
                $this->soapActive = false;
                $this->soap_port = 0;
                $this->soap_key = 0;
                $this->soap = false;
                $this->debug->error($e);
            }   
        }
        $this->updateNotices();
    }

   /**
    * Gibt Server ID zurück
    * @return (int) ServerID
    */
    public function getID() {
        return $this->server_id;
    }

    /**
     * Gibt Server Adresse zurück
     * @return (String) Adresse
     */
    public function getAddress() {
        return $this->server_address;
    }

    /**
     * Gibt SOAP Port zurück
     * @return (Integer) Port
     */
    public function getSoapPort() {
        return $this->soap_port;
    }

    /**
     * Gibt SOAP Key zurück
     * @return (String) Key
     */
    public function getSoapKey() {
        return $this->soap_key;
    }

    /**
     * Gibt die SOAP Verbindung zurück
     * @return SOAP
     */
    public function getSoap() {
        return $this->soapActive ? $this->soap : false;
    }

    /**
     * Setzt Server ID
     * @param (int) ID 
     */
    public function setID($id) {
        $this->server_id = $id;
    }

   /**
    * Gibt einen Array mit den SSH Daten zurück
    * @param (int) ServerID
    * @return (array) SSH Daten
    */
    public function getServerData() {
        $result = $this->mysql->tableAction('sas_server_data')->select(NULL, ['id' => $this->server_id]);

        if ($result->getRowsCount() > 0) {
            $row = $result->fetchObject();
            $data = array();

            $data[0] = $row->host;
            $data[1] = $row->user;
            $data[2] = $row->pass;
            $data[3] = $row->name;

            $this->server_address = $row->host;

            return $data;
        }
    }

   /**
    * Überprüft, ob ein Modul installiert wurde.
    * @param (String) Modul Name
    * @return (Bool)
    */
    public function isInstalled($package) {
        $result = $this->mysql->tableAction('sas_server_data')->select(NULL, ['id' => $this->server_id]);

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
            $result = $this->mysql->tableAction('sas_server_mysql')->select(NULL, ['id' => $this->server_id]);

            if ($result->getRowsCount() > 0) {
                $data = [];
                $row = $result->fetchObject();
                $data[] = $row->host;
                $data[] = $row->port;
                $data[] = $row->username;
                $data[] = $row->password;
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
        $data[0] = $this->getServiceStatus('smbd');
        $data[1] = $this->getServiceStatus('apache2');
        $data[2] = $this->getServiceStatus('postfix');
        $data[3] = $this->getServiceStatus('proftpd');
        $data[4] = $this->getServiceStatus('mysql');
        return $data;
    }


   /**
    * Gibt den Status eines Dienstes zurück
    * @param (SSH) SSH Verbindung
    * @param (String) Dienst Name
    * @return (Bool) Status
    */
    public function getServiceStatus($service) {
        $line = $this->execute('service ' . $service . ' status');
        $exp = explode(" ", $line);
        if (count($exp)<3) return false;
        if ($exp[1] == "start/running," || $exp[1] == "is" && $exp[2] == "running")
            return true;
        else
            return false;
    }

   /**
    * Gibt den Status des ProFTPD Dienstes zurück / könnte in getServiceStatus implementiert werden
    * @return (Bool) ProFTPD Status (An/Aus)
    * @author Gabriel Wanzek
    */

    public function getProFTPDStatus() {
        try {
            $status = $this->execute('service proftpd status');
            $exp = explode(",", $status);
            if (!isset($exp[1])) return false;
            $exp2 = explode(".", $exp[1]);
            if (!isset($exp2[0])) return false;
            $exp3 = explode(" ", $exp2[0]);
        
            if ($exp3[1] == "currently" && $exp3[2] == "running")
                return true;
            else
                return false;
        } catch (\Server\Exception $e) {
            return false;
        }
}


   /**
    * Fügt einen String an eine Datei auf dem Server an.
    * Die empfiehlt sich für das Erweitern von Konfigs.
    * @param (String) Datei Name
    * @param (String) Inhalt
    */
    public function addToFile($file, $content) {
        $this->execute('echo -e "' . $content . '" >> ' . $file);
    }

    public function execute($cmd, $format = 0, $type = 0) {
        $m = $this->m;
        if (!$this->soap->isAlive()) {
            return $m->SSH()->execute($cmd,$format);
        }
        if ($type == 0) {
            if ($this->soapActive) 
                return $this->soap->execute($cmd);
            else 
                return $m->SSH()->execute($cmd,$format);
        } elseif ($type == 1) {
            return $this->soap->execute($cmd);
        } elseif ($type == 2) {
            return $m->SSH()->execute($cmd,$format);
        }
    }

    private function updateNotices() {
        if (!$this->soap) {
            return false;
        }

        if (!$this->soap->isAlive()) {
            return false;
        }

        $news = $this->soap->giveNotices();
        if ($news) {
            foreach ($news as $value) {
                $value = explode('#>:<#', $value);
                if (count($value) > 1)
                    $this->mysql->Query("INSERT INTO sas_notifications (type,body,datum,zeit) VALUES ('$value[0]','$value[1]',CURDATE(),CURTIME())");
            }
        }
    }
}
?>
