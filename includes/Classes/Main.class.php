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

    private static $mysql,$server,$ssh,$user,$loader,$session,$header,$debug,$cache;

    public static function start() {
        if (!file_exists('./includes/Config/MySQL.conf.php')) {
            throw new \Classes\Main\Exception("Fehler in ./includes/Config/MySQL.conf.php");
        } else {
            self::initialisizeInstances();
        }
    }


    /**
     * Initialisiert Objekte der Hauptklassen
     */
    private static function initialisizeInstances() {
        try {
            self::$debug = new \Classes\Main\Debug();
        } catch (\Classes\Main\Exception $e) {
            throw new \Classes\Main\Exception($e->getMessage());
        }

        try {
            self::$mysql = new \Classes\MySQL();  
            self::$mysql->selectDatabase(\Config\MySQL::DATABASE);  
        } catch (\Classes\Main\Exception $e) {
            self::$debug->error($e);
        }

        try {
            self::$session = new \Classes\Session();
        } catch (\Classes\Main\Exception $e) {
            self::$debug->error($e);
        }

        try {
            self::$loader = new \Classes\Main\Loader();
        } catch (\Classes\Main\Exception $e) {
            self::$debug->error($e);
        }

        try {
            self::$server = new \Classes\Server();
        } catch (\Classes\Main\Exception $e) {
            self::$debug->error($e);
        }

        try {
            self::$header = new \Classes\Main\Header();
        } catch (\Classes\Main\Exception $e) {
            self::$debug->error($e);
        }

        try {
            self::$cache = new \Classes\Cache();
        } catch (\Classes\Main\Exception $e) {
            self::$debug->error($e);
        }

        self::$ssh = self::setSSHInstance();
    }

    /**
     * Erstellt SSH Instanz
     * @return SSH ssh [SSH Instanz]
     */
    private static function setSSHInstance() {
        try {
            if (self::$session->isServerChosen()) {
                self::$server->setID(self::$session->getServerId());
                $data = self::$server->getServerData();
                if (!is_array($data))
                    throw new \Classes\Main\Exception("unable to find data of ssh daemon in Main::setSSHInstance()", 1);

                return new \Classes\SSH($data[0],22,$data[1],$data[2]);
            } else {
                return NULL;
            }
        } catch (\Classes\Main\Exception $e) {
            self::$debug->error($e);
        }
    }

    /**
     * @return \Classes\Server
     */
    public static function Server() { return self::$server; }

    /**
     * @return \Classes\SSH
     */
    public static function SSH() { return self::$ssh; }

    /**
     * @return \Classes\MySQL
     */
    public static function MySQL() { return self::$mysql; }

    /**
     * @return \Classes\User
     */
    public static function User() { return self::$user; }

    /**
     * @return \Classes\Main\Loader
     */
    public static function Loader() { return self::$loader; }

    /**
     * @return \Classes\Main\Debug
     */
    public static function Debug() { return self::$debug; }

    /**
     * @return \Classes\Main\Cache
     */
    public static function Cache() { return self::$cache; }

    /**
     * @return \Classes\Session
     */
    public static function Session() { return self::$session; }

    /**
     * @return \Classes\Main\Header
     */
    public static function Header() { return self::$header; }

    public static function setUser(\Classes\User $user) {
        self::$user = $user;
    }

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
            //self::$debug->logInfo('Fehler beim Berechnen der Ladezeit');
        }
    }
}

?>
