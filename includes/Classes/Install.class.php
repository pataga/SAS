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
        $db->Query("CREATE DATABASE IF NOT EXISTS".\Config\MySQL::DATABASE);
        $db->selectDatabase(\Config\MySQL::DATABASE);
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
              `domains` varchar(255) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1");

        $db->Query("DROP TABLE IF EXISTS `sas_server_mysql`");
        $db->Query("CREATE TABLE `sas_server_mysql` (
              `id` int(10) NOT NULL AUTO_INCREMENT,
              `sid` int(10) NOT NULL,
              `host` varchar(255) NOT NULL,
              `port` varchar(255) NOT NULL,
              `username` varchar(255) NOT NULL,
              `password` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
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
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1");

        $db->Query("DROP TABLE IF EXISTS `sas_home_notes`");
        $db->Query("CREATE TABLE `sas_home_notes` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `author` varchar(255) DEFAULT NULL,
              `note` text NOT NULL,
              `notetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
        $db->Query("INSERT INTO `sas_home_notes` (`id`, `author`, `note`, `notetime`) VALUES (NULL, 'sas', 'Hier k&ouml;nnen Sie Notizen eintragen. Diese werden f&uuml;r alle Benutzer sichtbar sein.', NULL);");

        $db->Query("DROP TABLE IF EXISTS `sas_user_permission`");
        $db->Query("CREATE TABLE `sas_user_permission` (
              `pid` int(11) unsigned NOT NULL,
              `sid` int(11) unsigned NOT NULL,
              `uid` int(11) unsigned NOT NULL,
              `bitmask` bigint(20) NOT NULL,
              PRIMARY KEY (`pid`,`sid`,`uid`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1");

        $db->Query("DROP TABLE IF EXISTS `sas_plugins`");
        $db->Query("CREATE TABLE `sas_plugins` (
              `id` int(10) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `version` varchar(255) NOT NULL,
              `repo` varchar(255) NOT NULL,
              `content` varchar(255) NOT NULL,
              `installed` tinyint(3) NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDBDEFAULT CHARSET=latin1");

        $db->Query("DROP TABLE IF EXISTS `sas_plugin_scripts`");
        $db->Query("CREATE TABLE `sas_plugin_scripts` (
              `id` int(10) NOT NULL AUTO_INCREMENT,
              `pid` int(10) NOT NULL,
              `script` varchar(255) NOT NULL,
              `type` int(10) NOT NULL,
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
            ['username' => $_POST['user'], 'password' => sha1(sha1($_POST['user']).sha1($_POST['pass'])), 'email' => $_POST['email']]);
        $this->db->Query("INSERT INTO `sas_user_permission` (pid, uid, sid, bitmask) SELECT 0, id, 0, 0xFF FROM `sas_users`");
        return true;
    }

    private $db=false;
}

?>
