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
            mysql_query("DROP TABLE IF EXISTS `sas_content`");
            mysql_query("CREATE TABLE `sas_content` (
              `id` int(10) NOT NULL AUTO_INCREMENT,
              `page` varchar(255) NOT NULL,
              `spage` varchar(255) NOT NULL,
              `inc_path` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1");


            mysql_query("INSERT INTO `sas_content` VALUES ('1', 'home', '', 'includes/content/home/overview.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('2', 'mysql', '', 'includes/content/mysql/overview.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('3', 'apache', '', 'includes/content/apache/overview.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('4', 'postfix', '', 'includes/content/postfix/overview.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('5', 'ftp', '', 'includes/content/ftp/overview.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('6', 'samba', '', 'includes/content/samba/overview.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('7', 'management', '', 'includes/content/management/overview.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('8', 'webuser', '', 'includes/content/webuser/overview.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('17', 'tools', '', 'includes/content/tools/overview.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('18', 'apache', 'config', 'includes/content/apache/config.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('19', 'apache', 'control', 'includes/content/apache/control.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('20', 'apache', 'hostingsys', 'includes/content/apache/hostingsys.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('21', 'apache', 'module', 'includes/content/apache/module.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('22', 'apache', 'stats', 'includes/content/apache/stats.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('23', 'ftp', 'control', 'includes/content/ftp/control.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('24', 'ftp', 'dir', 'includes/content/ftp/directories.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('25', 'ftp', 'users', 'includes/content/ftp/users.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('26', 'ftp', 'stats', 'includes/content/ftp/stats.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('27', 'management', 'install', 'includes/content/management/install.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('28', 'management', 'destroy', 'includes/content/management/destroy.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('29', 'management', 'reboot', 'includes/content/management/reboot.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('30', 'postfix', 'conf', 'includes/content/postfix')");
            mysql_query("INSERT INTO `sas_content` VALUES ('31', 'postfix', 'users', 'includes/content/postfix/users.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('32', 'postfix', 'stats', 'includes/content/postfix/stats.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('33', 'samba', 'conf', 'includes/content/samba/config.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('34', 'samba', 'control', 'includes/content/samba/control.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('35', 'samba', 'shares', 'includes/content/samba/shares.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('36', 'samba', 'users', 'includes/content/samba/users.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('37', 'tools', 'console', 'includes/content/tools/console.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('38', 'tools', 'cpu', 'includes/content/tools/cpuload.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('39', 'tools', 'cron', 'includes/content/tools/cronjobs.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('40', 'tools', 'hdd', 'includes/content/tools/hddinfo.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('41', 'tools', 'hw', 'includes/content/tools/hwinfo.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('42', 'tools', 'ram', 'includes/content/tools/ramload.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('43', 'tools', 'taskmgr', 'includes/content/tools/taskmgr.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('44', 'tools', 'stats', 'includes/content/tools/stats.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('45', 'home', 'devstyle', 'includes/content/sas-dev/styles.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('46', 'mysql', 'adduser', 'includes/content/mysql/useradd.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('47', 'mysql', 'db', 'includes/content/mysql/db.inc.php')");
            mysql_query("INSERT INTO `sas_content` VALUES ('48', 'mysql', 'configure', 'includes/content/mysql/configure.inc.php')");
            mysql_query("INSERT INTO sas_content (page,spage,inc_path) VALUES ('samba','install','includes/content/samba/install.inc.php');
");
            mysql_query("DROP TABLE IF EXISTS `sas_menu_main`");
            mysql_query("CREATE TABLE `sas_menu_main` (
              `id` int(10) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `page` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1");


            mysql_query("INSERT INTO `sas_menu_main` VALUES ('1', 'Home', 'home')");
            mysql_query("INSERT INTO `sas_menu_main` VALUES ('2', 'Apache', 'apache')");
            mysql_query("INSERT INTO `sas_menu_main` VALUES ('3', 'Postfix', 'postfix')");
            mysql_query("INSERT INTO `sas_menu_main` VALUES ('4', 'FTP', 'ftp')");
            mysql_query("INSERT INTO `sas_menu_main` VALUES ('5', 'MySQL', 'mysql')");
            mysql_query("INSERT INTO `sas_menu_main` VALUES ('6', 'Samba', 'samba')");
            mysql_query("INSERT INTO `sas_menu_main` VALUES ('7', 'Control', 'management')");
            mysql_query("INSERT INTO `sas_menu_main` VALUES ('8', 'Webuser', 'webuser')");
            mysql_query("INSERT INTO `sas_menu_main` VALUES ('9', 'Tools', 'tools')");
            mysql_query("INSERT INTO `sas_menu_main` VALUES ('10', 'Plugins', 'plugins')");


            mysql_query("DROP TABLE IF EXISTS `sas_menu_side`");
            mysql_query("CREATE TABLE `sas_menu_side` (
              `id` int(10) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `page` varchar(255) NOT NULL,
              `spage` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1");

            mysql_query("INSERT INTO `sas_menu_side` VALUES ('1', '&Uuml;bersicht', 'home', '')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('2', '&Uuml;bersicht', 'mysql', '')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('3', '&Uuml;bersicht', 'apache', '')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('4', '&Uuml;bersicht', 'ftp', '')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('5', '&Uuml;bersicht', 'postfix', '')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('6', '&Uuml;bersicht', 'webuser', '')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('7', '&Uuml;bersicht', 'samba', '')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('8', '&Uuml;bersicht', 'management', '')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('9', '&Uuml;bersicht', 'tools', '')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('10', '&Uuml;bersicht', 'plugins', '')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('11', 'Konfiguration', 'apache', 'config')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('12', 'Control', 'apache', 'control')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('13', 'Hosting-System', 'apache', 'hostingsys')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('14', 'Module', 'apache', 'module')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('15', 'Statistik', 'apache', 'stats')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('16', 'Control', 'ftp', 'control')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('17', 'Verzeichnisse', 'ftp', 'dir')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('18', 'Benutzer', 'ftp', 'users')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('19', 'Statistik', 'ftp', 'stats')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('20', 'Paket Installation', 'management', 'install')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('21', 'Selbstzerst&ouml;rung', 'management', 'destroy')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('22', 'Neustarten', 'management', 'reboot')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('23', 'Konfiguration', 'postfix', 'conf')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('24', 'Benutzer', 'postfix', 'users')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('25', 'Statistik', 'postfix', 'stats')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('26', 'Konfiguration', 'samba', 'conf')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('27', 'Verwaltung', 'samba', 'control')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('28', 'Freigaben', 'samba', 'shares')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('29', 'Benutzer', 'samba', 'users')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('30', 'Konsole', 'tools', 'console')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('31', 'CPU Auslastung', 'tools', 'cpu')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('32', 'Cronjobs', 'tools', 'cron')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('33', 'Festplatten Informationen', 'tools', 'hdd')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('34', 'Hardware Informationen', 'tools', 'hw')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('35', 'Arbeitsspeicher Informationen', 'tools', 'ram')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('36', 'Taskmanager', 'tools', 'taskmgr')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('37', 'Statistiken', 'tools', 'stats')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('38', '<i>Dev: CSS-Info</i>', 'home', 'devstyle')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('39', 'Benutzer anlegen', 'mysql', 'adduser')");
            mysql_query("INSERT INTO `sas_menu_side` VALUES ('40', 'Datenbanken', 'mysql', 'db')");

            mysql_query("DROP TABLE IF EXISTS `sas_server_data`");
            mysql_query("CREATE TABLE `sas_server_data` (
              `id` int(10) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `host` varchar(255) NOT NULL,
              `port` int(10) NOT NULL,
              `user` varchar(255) NOT NULL,
              `pass` varchar(255) NOT NULL,
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

            //Update 18.12.2012
            mysql_query("INSERT INTO sas_content (page, spage, inc_path) VALUES ('webuser', 'add', 'includes/content/webuser/adduser.inc.php')");
            mysql_query("INSERT INTO sas_content (page, spage, inc_path) VALUES ('webuser', 'edit', 'includes/content/webuser/edituser.inc.php')");
            mysql_query("INSERT INTO sas_content (page, spage, inc_path) VALUES ('home', 'quickpanel', 'includes/content/home/qp.inc.php')");
            mysql_query("INSERT INTO sas_menu_side (name, page, spage) VALUES ('QuickPanel', 'home', 'quickpanel')");
            mysql_query("INSERT INTO sas_menu_side (name, page, spage) VALUES ('phpinfo', 'apache', 'phpinfo')");
            mysql_query("INSERT INTO sas_content (page, spage, inc_path) VALUES ('apache', 'phpinfo', 'includes/content/apache/pi.inc.php')");
            mysql_query("CREATE TABLE IF NOT EXISTS `sas_home_notes` (
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