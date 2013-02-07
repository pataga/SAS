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


    if (!is_writable('../includes/config/config.mysql.php') && !isset($_GET['p']))
    {
        echo '<b>Die Datei includes/config/config.mysql.php konnte nicht beschrieben werden. Bitte setzen sie die Berechtigung auf 777 (chmod 777 config.mysql.php)<br>Weiterleitung zu Schritt 2 in 5 Sekunden';
        echo '<meta http-equiv="refresh" content="5; URL=step2.php">';
        die();
    }
    
    elseif (file_exists('../includes/config/config.mysql.php') && !isset($_GET['p']))
    {
        $host = $_POST["host"];
        $port = $_POST["port"];
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        $db = $_POST["db"];

        $config = fopen('../includes/config/config.mysql.php', 'a');
        fputs($config,' <?php
                            $data = array();
                            $data[0] = "'.$host.'";
                            $data[1] = "'.$port.'";
                            $data[2] = "'.$user.'";
                            $data[3] = "'.$pass.'";
                            $data[4] = "'.$db.'";
                        ?>');
        fclose($config);

        if (mysql_connect($host,$user,$pass))
        {
            if (!mysql_select_db($db))
            {
                mysql_query("CREATE DATABASE $db");
                mysql_select_db($db);
            }

            mysql_query("DROP TABLE IF EXISTS `sas_server_data`");
            mysql_query("CREATE TABLE `sas_server_data` (
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

            mysql_query("DROP TABLE IF EXISTS `sas_server_mysql`");
            mysql_query("CREATE TABLE `sas_server_mysql` (
              `id` int(10) NOT NULL AUTO_INCREMENT,
              `sid` int(10) NOT NULL,
              `host` varchar(255) NOT NULL,
              `port` varchar(255) NOT NULL,
              `username` varchar(255) NOT NULL,
              `password` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1");

            mysql_query("DROP TABLE IF EXISTS `sas_user_permission`");
            mysql_query("CREATE TABLE `sas_user_permission` (
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

            mysql_query("DROP TABLE IF EXISTS `sas_users`");
            mysql_query("CREATE TABLE `sas_users` (
              `id` int(10) NOT NULL AUTO_INCREMENT,
              `username` varchar(255) NOT NULL,
              `password` varchar(255) NOT NULL,
              `email` varchar(255) NOT NULL,
              `admin` tinyint(3) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `userunique` (`username`)
            ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1");

            mysql_query("DROP TABLE IF EXISTS `sas_home_notes`");
            mysql_query("CREATE TABLE `sas_home_notes` (
              `id` int(10) NOT NULL,
              `author` varchar(50) NOT NULL,
              `note` text CHARACTER SET utf8 NOT NULL,
              `notetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1");

        }
    }
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SAS</title>
        <link rel="stylesheet" href="../css/normalize.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <script src="../js/vendor/modernizr-2.6.1.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.8.2.min.js"><\/script>')</script>
        <script src="../js/plugins.js"></script>
        <script src="../js/main.js"></script>
    </head>
    <body>
        <div class="logoinstall">
            <h1>Server <span>Admin</span> System</h1>
            <h3>Installation</h3>
        </div>
            <div id="main">
                <div id="box1_install">
                    <fieldset>
                        <b>SAS wurde erfolgreich konfiguriert.<br> Bitte legen sie nun einen Administrator Benutzer an.</b>
                    </fieldset>
                    <form action="finish.php" method="post">
                        <fieldset>
                            <p><label>Benutzername:</label>
                            <input type="text" name="user" class="text-long" required></p>
                            <p><label>Passwort:</label>
                            <input type="password" name="pass" class="text-long" required></p>
                            <p><label>Passwort best&auml;tigen:</label>
                            <input type="password" name="passr" class="text-long" required></p>
                            <p><label>E-Mail:</label>
                            <input type="email" name="email" class="text-long" required></p>
                            <div id="installbutton"><input type="submit" value="Installation abschlie&szlig;en" class="button black"></div>
                        </fieldset>
                    </form>
                </div>
            </div>
    </body>
</html>