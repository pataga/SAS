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

class Install {
    const STEP_ONE              =   1;
    const STEP_TWO              =   2;
    const STEP_THREE            =   3;
    const STEP_FOUR             =   4;
    const DIRECTORY             =   './install';
    const MYSQL_CONFIG_FILE     =   './includes/Config/MySQL.conf.php';

    public function __construct() {
        if (!is_dir(Install::DIRECTORY)) {
            unset($this);
        }
    }

    public function getFile() {
        if (isset($_GET['install'])) {
            switch ($_GET['install']) {
                case Install::STEP_ONE:
                    return Install::DIRECTORY.'/step1.php';
                    break;
                case Install::STEP_TWO:
                    return Install::DIRECTORY.'/step2.php';
                    break;
                case Install::STEP_THREE:
                    return Install::DIRECTORY.'/step3.php';
                    break;
                case Install::STEP_FOUR:
                    return Install::DIRECTORY.'/step4.php';
                    break;
                default:
                    throw new Exception('Ung&uuml;ltiger GET Parameter '.$_GET['install'], 1000);
            }
        }
    }

    public function writeConfig() {
        if (!is_writable(Install::MYSQL_CONFIG_FILE)) {
            return false;
        } else {
            $host = isset($_POST['host']) ? $_POST['host'] : 0;
            $port = isset($_POST['port']) ? $_POST['port'] : 0;
            $user = isset($_POST['user']) ? $_POST['user'] : 0;
            $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
            $db = isset($_POST['db']) ? $_POST['db'] : 0;

            if (!$host||!$port||!$user||!$db) return false;

            $conf = file_get_contents(Install::DIRECTORY.'/Vorlage.conf.php');
            $search = ['>>HOST<<','>>PORT<<','>>USER<<','>>PASS<<','>>DATA<<'];
            $replace = [$host,$port,$user,$pass,$db];
            $conf = str_replace($search, $replace, $conf);

            file_put_contents(Install::MYSQL_CONFIG_FILE, $conf);
            return true;
        }
    }

    public function connect() {
        if ($this->db = new \Classes\MySQL()) {
            $this->db->selectDatabase(\Config\MySQL::DATABASE);
            return true;
        } else {
            return false;
        }
    }

    public function installDatabase() {
        if (!$this->db) return false;
        $db = $this->db;
        $db->Query("CREATE DATABASE IF NOT EXISTS ".\Config\MySQL::DATABASE);
        $db->Query("DROP TABLE IF EXISTS `sas_server_data`");
        $db->Query("CREATE TABLE `sas_server_data` (
              `id` int(10) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `host` varchar(255) NOT NULL,
              `port` int(10) NOT NULL,
              `user` varchar(255) NOT NULL,
              `pass` varchar(255) NOT NULL,
              `soap` int(3) NOT NULL,
              `soapPort` int(8) NOT NULL,
              `soapKey` varchar(255) NOT NULL,
              `mysql` tinyint(3) NOT NULL,
              `postfix` tinyint(3) NOT NULL,
              `ftp` tinyint(3) NOT NULL,
              `apache` tinyint(3) NOT NULL,
              `samba` tinyint(3) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1");

        $db->Query("DROP TABLE IF EXISTS `sas_server_mysql`");
        $db->Query("CREATE TABLE `sas_server_mysql` (
              `id` int(10) NOT NULL AUTO_INCREMENT,
              `sid` int(10) NOT NULL,
              `host` varchar(255) NOT NULL,
              `port` varchar(255) NOT NULL,
              `username` varchar(255) NOT NULL,
              `password` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1");

        $db->Query("DROP TABLE IF EXISTS `sas_user_permission`");
        $db->Query("CREATE TABLE `sas_user_permission` (
              `uid` int(10) NOT NULL,
              `sid` int(10) NOT NULL,
              `apache` tinyint(3) NOT NULL,
              `postfix` tinyint(3) NOT NULL,
              `mysql` tinyint(3) NOT NULL,
              `ftp` tinyint(3) NOT NULL,
              `samba` tinyint(3) NOT NULL,
              `control` tinyint(3) NOT NULL,
              `webuser` tinyint(3) NOT NULL,
              `tools` tinyint(3) NOT NULL,
              `plugins` tinyint(3) NOT NULL,
              PRIMARY KEY (`uid`,`sid`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1");

        $db->Query("DROP TABLE IF EXISTS `sas_users`");
        $db->Query("CREATE TABLE `sas_users` (
              `id` int(10) NOT NULL AUTO_INCREMENT,
              `username` varchar(255) NOT NULL,
              `password` varchar(255) NOT NULL,
              `email` varchar(255) NOT NULL,
              `admin` tinyint(3) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `userunique` (`username`)
            ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1");

        $db->Query("DROP TABLE IF EXISTS `sas_home_notes`");
        $db->Query("CREATE TABLE `sas_home_notes` (
              `id` int(10) NOT NULL,
              `author` varchar(50) NOT NULL,
              `note` text CHARACTER SET utf8 NOT NULL,
              `notetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
    }

    public function addUser() {
        if (!isset($_POST['user']) || 
            !isset($_POST['pass']) || 
            !isset($_POST['passwdh']) || 
            !isset($_POST['email']) || 
            $_POST['pass'] != $_POST['passwdh']) 
            return false;
        $this->connect();
        if (!$this->db) return false;
        $this->db->tableAction('sas_users')->insert(
            ['username' => $_POST['user'], 'password' => md5($_POST['pass']), 'email' => $_POST['email']]);
        return true;
    }

    private $db=false;
}

?>