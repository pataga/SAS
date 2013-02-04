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

class Main {

    private $mysql_data,$mysql,$db,$result,$server,$ssh,$user,$tableaction,$loader,$logFile,$debugLevel,$session;

    public function __construct($data=false, $debugLevel=2, $logFile='error.log') {
        $this->debugLevel = $debugLevel;
        $this->logFile = $logFile;
        if (!$data) {
            throw new Main\Exception("Fehler in ./includes/config/config.mysql.php");
        } else {
            $this->mysql_data = $data;
            $this->initialisizeInstances();
        }
    }


    /**
     * Initialisiert Objekte der Hauptklassen
     */
    private function initialisizeInstances() {
        try {
            $this->debug = new \Main\Debug($this->debugLevel, $this->logFile);
        } catch (Main\Exception $e) {
            throw new Main\Exception($e->getMessage());
        }

        try {
            $this->mysql = new \MySQL($this,$this->mysql_data[0], 
            $this->mysql_data[1], $this->mysql_data[2], 
            $this->mysql_data[3], $this->mysql_data[4]);    
        } catch (Main\Exception $e) {
            $this->debug->error($e);
        }

        try {
            $this->session = new \Session($this);
        } catch (Main\Exception $e) {
            $this->debug->error($e);
        }

        try {
            $this->loader = new \Main\Loader($this);
        } catch (Main\Exception $e) {
            $this->debug->error($e);
        }

        try {
            $this->server = new \Server($this);
        } catch (Main\Exception $e) {
            $this->debug->error($e);
        }

        try {
            $this->database = new \MySQL\Database($this);
        } catch (Main\Exception $e) {
            $this->debug->error($e);
        }

        try {
            $this->cache = new \Cache($this);
        } catch (Main\Exception $e) {
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
                    throw new Main\Exception("unable to find data of ssh daemon in Main::setSSHInstance()", 1);

                return new \SSH($this,$data[0],22,$data[1],$data[2]);
            } else {
                return NULL;
            }
        } catch (Main\Exception $e) {
            $this->debug->error($e);
        }
    }

    public function Server() { return $this->server; }
    public function SSH() { return $this->ssh; }
    public function MySQL() { return $this->mysql; }
    public function User() { return $this->user; }
    public function Database() { return $this->database; }
    public function Loader() { return $this->loader; }
    public function Debug() { return $this->debug; }
    public function Cache() { return $this->cache; }
    public function Session() { return $this->session; }


    public static function printLoadTime($startTime, $endTime) {
        try {
            if (!is_float($startTime) || !is_float($endTime)) {
                throw new Main\Exception('', 5);
            } else {
                $totalTime = $endTime - $startTime;
                $outStr = sprintf('<p class="loadtime">Seite wurde in %s Sekunden generiert</p>',round($totalTime,3));
                print($outStr);
            }
        } catch (Main\Exception $e) {
            //$this->debug->logInfo('Fehler beim Berechnen der Ladezeit');
        }
    }
}

?>
