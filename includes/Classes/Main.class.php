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
class Main {

    private $mysql,$db,$result,$server,$ssh,$user,$tableaction,$loader,$session,$header;

    public function __construct() {
        if (!file_exists('./includes/Config/MySQL.conf.php')) {
            throw new \Classes\Main\Exception("Fehler in ./includes/Config/MySQL.conf.php");
        } else {
            $this->initialisizeInstances();
        }
    }


    /**
     * Initialisiert Objekte der Hauptklassen
     */
    private function initialisizeInstances() {
        try {
            $this->debug = new \Classes\Main\Debug();
        } catch (\Classes\Main\Exception $e) {
            throw new \Classes\Main\Exception($e->getMessage());
        }

        try {
            $this->mysql = new \Classes\MySQL();  
            $this->mysql->selectDatabase(\Config\MySQL::DATABASE);  
        } catch (\Classes\Main\Exception $e) {
            $this->debug->error($e);
        }

        try {
            $this->session = new \Classes\Session($this);
        } catch (\Classes\Main\Exception $e) {
            $this->debug->error($e);
        }

        try {
            $this->loader = new \Classes\Main\Loader($this);
        } catch (\Classes\Main\Exception $e) {
            $this->debug->error($e);
        }

        try {
            $this->server = new \Classes\Server($this);
        } catch (\Classes\Main\Exception $e) {
            $this->debug->error($e);
        }

        try {
            $this->header = new \Classes\Main\Header();
        } catch (\Classes\Main\Exception $e) {
            $this->debug->error($e);
        }

        try {
            $this->cache = new \Classes\Cache($this);
        } catch (\Classes\Main\Exception $e) {
            $this->debug->error($e);
        }

        $this->ssh = $this->setSSHInstance();
    }

    /**
     * Erstellt SSH Instanz
     * @return SSH ssh [SSH Instanz]
     */
    private function setSSHInstance() {
        try {
            if ($this->session->isServerChosen()) {
                $this->server->setID($this->session->getServerId());
                $data = $this->server->getServerData();
                if (!is_array($data))
                    throw new \Classes\Main\Exception("unable to find data of ssh daemon in Main::setSSHInstance()", 1);

                return new \Classes\SSH($this,$data[0],22,$data[1],$data[2]);
            } else {
                return NULL;
            }
        } catch (\Classes\Main\Exception $e) {
            $this->debug->error($e);
        }
    }

    public function Server() { return $this->server; }
    public function SSH() { return $this->ssh; }
    public function MySQL() { return $this->mysql; }
    public function User() { return $this->user; }
    public function Loader() { return $this->loader; }
    public function Debug() { return $this->debug; }
    public function Cache() { return $this->cache; }
    public function Session() { return $this->session; }
    public function Header() { return $this->header; }


    public static function printLoadTime($startTime, $endTime) {
        try {
            if (!is_float($startTime) || !is_float($endTime)) {
                throw new \Classes\Main\Exception('', 5);
            } else {
                $totalTime = $endTime - $startTime;
                $outStr = sprintf('<p class="loadtime">Seite wurde in %s Sekunden generiert</p>',round($totalTime,3));
                print($outStr);
            }
        } catch (\Classes\Main\Exception $e) {
            //$this->debug->logInfo('Fehler beim Berechnen der Ladezeit');
        }
    }
}

?>
