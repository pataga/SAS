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

class SOAP {
    private $server,$key,$soap;

    //Package Installer Status
    const STATUS_ALREADY_INSTALLED      =   1;
    const STATUS_PROCESS_INSTALLATION   =   2;
    const STATUS_PACKAGE_INQUEUE        =   3;
    const STATUS_INSTALLATION_FAILED    =   4;
    const STATUS_UNKNOWS_PACKAGE        =   5;

    /**
     * SOAP Verbindung aufbauen
     * @param Object Main
     */
    public function __construct($s) {
        $this->server = $s;
        $this->key = $s->getSoapKey();
        try {
            $this->soap = new SoapClient(NULL,[
                        'location'  =>    'http://'.$s->getAddress().':'.$s->getSoapPort().'',
                        'uri'       =>    'urn:SASSoap',
                        'style'     =>     SOAP_RPC,
                        'use'       =>     SOAP_ENCODED 
                    ]);
        } catch (Exception $e) {
            $this->soap = false;
        }
    }

    /**
     * Installiert ein Programm auf dem Server (apt)
     * @param String package
     * @return Integer status
     */
    public function install($package) {
        if ($this->soap) {
            return $this->soap->Install($this->key, $package);
        } else {
            return false;
        }
    }

    /**
     * Führt einen Befehl auf der Kommandoebene des Servers aus
     * @param String Command
     * @return String Output
     */
    public function execute($cmd) {
        if ($this->soap) {
            return $this->soap->Execute($this->key, $cmd);
        } else {
            return false;
        }
    }

    /**
     * Fragt nach Neuigkeiten
     * @return Integer Count
     */
    public function noticeCount() {
        if ($this->soap) {
            return $this->soap->GetNoticeCount($this->key);
        } else {
            return false;
        }
    }

    /**
     * Fragt Verbindungsversuch mit dem Daemon
     * @return Bool
     */
    public function isAlive() {
        if ($this->soap) {
            try {
                return $this->soap->Alive($this->key);
            } catch (\Exception $e) {
                return false;
            }
        } else {
            return false;
        }
    }
}

?>
