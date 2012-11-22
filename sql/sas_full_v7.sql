SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `sas_content`;
CREATE TABLE IF NOT EXISTS `sas_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `page` varchar(255) NOT NULL,
  `spage` varchar(255) NOT NULL,
  `inc_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

INSERT INTO `sas_content` (`id`, `page`, `spage`, `inc_path`) VALUES
(1, 'home', '', 'includes/content/home/overview.inc.php'),
(2, 'mysql', '', 'includes/content/mysql/overview.inc.php'),
(3, 'apache', '', 'includes/content/apache/overview.inc.php'),
(4, 'postfix', '', 'includes/content/postfix/overview.inc.php'),
(5, 'ftp', '', 'includes/content/ftp/overview.inc.php'),
(6, 'samba', '', 'includes/content/samba/overview.inc.php'),
(7, 'management', '', 'includes/content/management/overview.inc.php'),
(8, 'webuser', '', 'includes/content/webuser/overview.inc.php'),
(17, 'tools', '', 'includes/content/tools/overview.inc.php'),
(18, 'apache', 'config', 'includes/content/apache/config.inc.php'),
(19, 'apache', 'control', 'includes/content/apache/control.inc.php'),
(20, 'apache', 'hostingsys', 'includes/content/apache/hostingsys.inc.php'),
(21, 'apache', 'module', 'includes/content/apache/module.inc.php'),
(22, 'apache', 'stats', 'includes/content/apache/stats.inc.php'),
(23, 'ftp', 'control', 'includes/content/ftp/control.inc.php'),
(24, 'ftp', 'dir', 'includes/content/ftp/directories.inc.php'),
(25, 'ftp', 'users', 'includes/content/ftp/users.inc.php'),
(26, 'ftp', 'stats', 'includes/content/ftp/stats.inc.php'),
(27, 'management', 'install', 'includes/content/management/install.inc.php'),
(28, 'management', 'destroy', 'includes/content/management/destroy.inc.php'),
(29, 'management', 'reboot', 'includes/content/management/reboot.inc.php'),
(30, 'postfix', 'conf', 'includes/content/postfix'),
(31, 'postfix', 'users', 'includes/content/postfix/users.inc.php'),
(32, 'postfix', 'stats', 'includes/content/postfix/stats.inc.php'),
(33, 'samba', 'conf', 'includes/content/samba/config.inc.php'),
(34, 'samba', 'control', 'includes/content/samba/control.inc.php'),
(35, 'samba', 'shares', 'includes/content/samba/shares.inc.php'),
(36, 'samba', 'users', 'includes/content/samba/users.inc.php'),
(37, 'tools', 'console', 'includes/content/tools/console.inc.php'),
(38, 'tools', 'cpu', 'includes/content/tools/cpuload.inc.php'),
(39, 'tools', 'cron', 'includes/content/tools/cronjobs.inc.php'),
(40, 'tools', 'hdd', 'includes/content/tools/hddinfo.inc.php'),
(41, 'tools', 'hw', 'includes/content/tools/hwinfo.inc.php'),
(42, 'tools', 'ram', 'includes/content/tools/ramload.inc.php'),
(43, 'tools', 'taskmgr', 'includes/content/tools/taskmgr.inc.php'),
(44, 'tools', 'stats', 'includes/content/tools/stats.inc.php'),
(45, 'home', 'devstyle', 'includes/content/sas-dev/styles.inc.php');

DROP TABLE IF EXISTS `sas_menu_main`;
CREATE TABLE IF NOT EXISTS `sas_menu_main` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

INSERT INTO `sas_menu_main` (`id`, `name`, `page`) VALUES
(1, 'Home', 'home'),
(2, 'Apache', 'apache'),
(3, 'Postfix', 'postfix'),
(4, 'FTP', 'ftp'),
(5, 'MySQL', 'mysql'),
(6, 'Samba', 'samba'),
(7, 'Control', 'management'),
(8, 'Webuser', 'webuser'),
(9, 'Tools', 'tools'),
(10, 'Plugins', 'plugins');

DROP TABLE IF EXISTS `sas_menu_side`;
CREATE TABLE IF NOT EXISTS `sas_menu_side` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  `spage` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

INSERT INTO `sas_menu_side` (`id`, `name`, `page`, `spage`) VALUES
(1, '&Uuml;bersicht', 'home', ''),
(2, '&Uuml;bersicht', 'mysql', ''),
(3, '&Uuml;bersicht', 'apache', ''),
(4, '&Uuml;bersicht', 'ftp', ''),
(5, '&Uuml;bersicht', 'postfix', ''),
(6, '&Uuml;bersicht', 'webuser', ''),
(7, '&Uuml;bersicht', 'samba', ''),
(8, '&Uuml;bersicht', 'management', ''),
(9, '&Uuml;bersicht', 'tools', ''),
(10, '&Uuml;bersicht', 'plugins', ''),
(11, 'Konfiguration', 'apache', 'config'),
(12, 'Control', 'apache', 'control'),
(13, 'Hosting-System', 'apache', 'hostingsys'),
(14, 'Module', 'apache', 'module'),
(15, 'Statistik', 'apache', 'stats'),
(16, 'Control', 'ftp', 'control'),
(17, 'Verzeichnisse', 'ftp', 'dir'),
(18, 'Benutzer', 'ftp', 'users'),
(19, 'Statistik', 'ftp', 'stats'),
(20, 'Paket Installation', 'management', 'install'),
(21, 'Selbstzerst&ouml;rung', 'management', 'destroy'),
(22, 'Neustarten', 'management', 'reboot'),
(23, 'Konfiguration', 'postfix', 'conf'),
(24, 'Benutzer', 'postfix', 'users'),
(25, 'Statistik', 'postfix', 'stats'),
(26, 'Konfiguration', 'samba', 'conf'),
(27, 'Verwaltung', 'samba', 'control'),
(28, 'Freigaben', 'samba', 'shares'),
(29, 'Benutzer', 'samba', 'users'),
(30, 'Konsole', 'tools', 'console'),
(31, 'CPU Auslastung', 'tools', 'cpu'),
(32, 'Cronjobs', 'tools', 'cron'),
(33, 'Festplatten Informationen', 'tools', 'hdd'),
(34, 'Hardware Informationen', 'tools', 'hw'),
(35, 'Arbeitsspeicher Informationen', 'tools', 'ram'),
(36, 'Taskmanager', 'tools', 'taskmgr'),
(37, 'Statistiken', 'tools', 'stats'),
(38, '<i>Dev: CSS-Info</i>', 'home', 'devstyle');

DROP TABLE IF EXISTS `sas_server_data`;
CREATE TABLE IF NOT EXISTS `sas_server_data` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `host` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `mysql` tinyint(3) NOT NULL,
  `postfix` tinyint(3) NOT NULL,
  `ftp` tinyint(3) NOT NULL,
  `apache` tinyint(3) NOT NULL,
  `samba` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `sas_server_data` (`id`, `host`, `user`, `pass`, `mysql`, `postfix`, `ftp`, `apache`, `samba`) VALUES
(1, '127.0.0.1', 'root', '', 1, 0, 0, 0, 0);

DROP TABLE IF EXISTS `sas_server_mysql`;
CREATE TABLE IF NOT EXISTS `sas_server_mysql` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sid` int(10) NOT NULL,
  `host` varchar(255) NOT NULL,
  `port` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `sas_server_mysql` (`id`, `sid`, `host`, `port`, `username`, `password`) VALUES
(1, 1, '127.0.0.1', '3306', 'root', '');

DROP TABLE IF EXISTS `sas_users`;
CREATE TABLE IF NOT EXISTS `sas_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userunique` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `sas_users` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', 'e8636ea013e682faf61f56ce1cb1ab5c', 'admin@admin.de'),
(2, 'gabriel', 'cf1e8c14e54505f60aa10ceb8d5d8ab3', 'gabriel8810@yahoo.de');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
