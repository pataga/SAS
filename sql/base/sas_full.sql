-- ----------------------------
-- Table structure for `sas_content`
-- ----------------------------
DROP TABLE IF EXISTS `sas_content`;
CREATE TABLE `sas_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `page` varchar(255) NOT NULL,
  `spage` varchar(255) NOT NULL,
  `inc_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sas_content
-- ----------------------------
INSERT INTO `sas_content` VALUES ('1', 'home', '', 'includes/content/home/overview.inc.php');
INSERT INTO `sas_content` VALUES ('2', 'mysql', '', 'includes/content/mysql/overview.inc.php');
INSERT INTO `sas_content` VALUES ('3', 'apache', '', 'includes/content/apache/overview.inc.php');
INSERT INTO `sas_content` VALUES ('4', 'postfix', '', 'includes/content/postfix/overview.inc.php');
INSERT INTO `sas_content` VALUES ('5', 'ftp', '', 'includes/content/ftp/overview.inc.php');
INSERT INTO `sas_content` VALUES ('6', 'samba', '', 'includes/content/samba/overview.inc.php');
INSERT INTO `sas_content` VALUES ('7', 'management', '', 'includes/content/management/overview.inc.php');
INSERT INTO `sas_content` VALUES ('8', 'webuser', '', 'includes/content/webuser/overview.inc.php');
INSERT INTO `sas_content` VALUES ('17', 'tools', '', 'includes/content/tools/overview.inc.php');
INSERT INTO `sas_content` VALUES ('18', 'apache', 'config', 'includes/content/apache/config.inc.php');
INSERT INTO `sas_content` VALUES ('19', 'apache', 'control', 'includes/content/apache/control.inc.php');
INSERT INTO `sas_content` VALUES ('20', 'apache', 'hostingsys', 'includes/content/apache/hostingsys.inc.php');
INSERT INTO `sas_content` VALUES ('21', 'apache', 'module', 'includes/content/apache/module.inc.php');
INSERT INTO `sas_content` VALUES ('22', 'apache', 'stats', 'includes/content/apache/stats.inc.php');
INSERT INTO `sas_content` VALUES ('23', 'ftp', 'control', 'includes/content/ftp/control.inc.php');
INSERT INTO `sas_content` VALUES ('24', 'ftp', 'dir', 'includes/content/ftp/directories.inc.php');
INSERT INTO `sas_content` VALUES ('25', 'ftp', 'users', 'includes/content/ftp/users.inc.php');
INSERT INTO `sas_content` VALUES ('26', 'ftp', 'stats', 'includes/content/ftp/stats.inc.php');
INSERT INTO `sas_content` VALUES ('27', 'management', 'install', 'includes/content/management/install.inc.php');
INSERT INTO `sas_content` VALUES ('28', 'management', 'destroy', 'includes/content/management/destroy.inc.php');
INSERT INTO `sas_content` VALUES ('29', 'management', 'reboot', 'includes/content/management/reboot.inc.php');
INSERT INTO `sas_content` VALUES ('30', 'postfix', 'conf', 'includes/content/postfix');
INSERT INTO `sas_content` VALUES ('31', 'postfix', 'users', 'includes/content/postfix/users.inc.php');
INSERT INTO `sas_content` VALUES ('32', 'postfix', 'stats', 'includes/content/postfix/stats.inc.php');
INSERT INTO `sas_content` VALUES ('33', 'samba', 'conf', 'includes/content/samba/config.inc.php');
INSERT INTO `sas_content` VALUES ('34', 'samba', 'control', 'includes/content/samba/control.inc.php');
INSERT INTO `sas_content` VALUES ('35', 'samba', 'shares', 'includes/content/samba/shares.inc.php');
INSERT INTO `sas_content` VALUES ('36', 'samba', 'users', 'includes/content/samba/users.inc.php');
INSERT INTO `sas_content` VALUES ('37', 'tools', 'console', 'includes/content/tools/console.inc.php');
INSERT INTO `sas_content` VALUES ('38', 'tools', 'cpu', 'includes/content/tools/cpuload.inc.php');
INSERT INTO `sas_content` VALUES ('39', 'tools', 'cron', 'includes/content/tools/cronjobs.inc.php');
INSERT INTO `sas_content` VALUES ('40', 'tools', 'hdd', 'includes/content/tools/hddinfo.inc.php');
INSERT INTO `sas_content` VALUES ('41', 'tools', 'hw', 'includes/content/tools/hwinfo.inc.php');
INSERT INTO `sas_content` VALUES ('42', 'tools', 'ram', 'includes/content/tools/ramload.inc.php');
INSERT INTO `sas_content` VALUES ('43', 'tools', 'taskmgr', 'includes/content/tools/taskmgr.inc.php');
INSERT INTO `sas_content` VALUES ('44', 'tools', 'stats', 'includes/content/tools/stats.inc.php');
INSERT INTO `sas_content` VALUES ('45', 'home', 'devstyle', 'includes/content/sas-dev/styles.inc.php');
INSERT INTO `sas_content` VALUES ('46', 'mysql', 'adduser', 'includes/content/mysql/useradd.inc.php');
INSERT INTO `sas_content` VALUES ('47', 'mysql', 'db', 'includes/content/mysql/db.inc.php');
INSERT INTO `sas_content` VALUES ('48', 'mysql', 'configure', 'includes/content/mysql/configure.inc.php');
INSERT INTO `sas_content` VALUES ('49', 'webuser', 'add', 'includes/content/webuser/adduser.inc.php');
INSERT INTO `sas_content` VALUES ('50', 'webuser', 'edit', 'includes/content/webuser/edituser.inc.php');
INSERT INTO `sas_content` VALUES ('51', 'home', 'quickpanel', 'includes/content/home/qp.inc.php');
INSERT INTO `sas_content` VALUES ('52', 'apache', 'phpinfo', 'includes/content/apache/pi.inc.php');

-- ----------------------------
-- Table structure for `sas_home_notes`
-- ----------------------------
DROP TABLE IF EXISTS `sas_home_notes`;
CREATE TABLE `sas_home_notes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `author` varchar(50) NOT NULL,
  `note` text CHARACTER SET utf8 NOT NULL,
  `notetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sas_home_notes
-- ----------------------------

-- ----------------------------
-- Table structure for `sas_menu_main`
-- ----------------------------
DROP TABLE IF EXISTS `sas_menu_main`;
CREATE TABLE `sas_menu_main` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sas_menu_main
-- ----------------------------
INSERT INTO `sas_menu_main` VALUES ('1', 'Home', 'home');
INSERT INTO `sas_menu_main` VALUES ('2', 'Apache', 'apache');
INSERT INTO `sas_menu_main` VALUES ('3', 'Postfix', 'postfix');
INSERT INTO `sas_menu_main` VALUES ('4', 'FTP', 'ftp');
INSERT INTO `sas_menu_main` VALUES ('5', 'MySQL', 'mysql');
INSERT INTO `sas_menu_main` VALUES ('6', 'Samba', 'samba');
INSERT INTO `sas_menu_main` VALUES ('7', 'Control', 'management');
INSERT INTO `sas_menu_main` VALUES ('8', 'Webuser', 'webuser');
INSERT INTO `sas_menu_main` VALUES ('9', 'Tools', 'tools');
INSERT INTO `sas_menu_main` VALUES ('10', 'Plugins', 'plugins');

-- ----------------------------
-- Table structure for `sas_menu_side`
-- ----------------------------
DROP TABLE IF EXISTS `sas_menu_side`;
CREATE TABLE `sas_menu_side` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  `spage` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sas_menu_side
-- ----------------------------
INSERT INTO `sas_menu_side` VALUES ('1', '&Uuml;bersicht', 'home', '');
INSERT INTO `sas_menu_side` VALUES ('2', '&Uuml;bersicht', 'mysql', '');
INSERT INTO `sas_menu_side` VALUES ('3', '&Uuml;bersicht', 'apache', '');
INSERT INTO `sas_menu_side` VALUES ('4', '&Uuml;bersicht', 'ftp', '');
INSERT INTO `sas_menu_side` VALUES ('5', '&Uuml;bersicht', 'postfix', '');
INSERT INTO `sas_menu_side` VALUES ('6', '&Uuml;bersicht', 'webuser', '');
INSERT INTO `sas_menu_side` VALUES ('7', '&Uuml;bersicht', 'samba', '');
INSERT INTO `sas_menu_side` VALUES ('8', '&Uuml;bersicht', 'management', '');
INSERT INTO `sas_menu_side` VALUES ('9', '&Uuml;bersicht', 'tools', '');
INSERT INTO `sas_menu_side` VALUES ('10', '&Uuml;bersicht', 'plugins', '');
INSERT INTO `sas_menu_side` VALUES ('11', 'Konfiguration', 'apache', 'config');
INSERT INTO `sas_menu_side` VALUES ('12', 'Control', 'apache', 'control');
INSERT INTO `sas_menu_side` VALUES ('13', 'Hosting-System', 'apache', 'hostingsys');
INSERT INTO `sas_menu_side` VALUES ('14', 'Module', 'apache', 'module');
INSERT INTO `sas_menu_side` VALUES ('15', 'Statistik', 'apache', 'stats');
INSERT INTO `sas_menu_side` VALUES ('16', 'Control', 'ftp', 'control');
INSERT INTO `sas_menu_side` VALUES ('17', 'Verzeichnisse', 'ftp', 'dir');
INSERT INTO `sas_menu_side` VALUES ('18', 'Benutzer', 'ftp', 'users');
INSERT INTO `sas_menu_side` VALUES ('19', 'Statistik', 'ftp', 'stats');
INSERT INTO `sas_menu_side` VALUES ('20', 'Paket Installation', 'management', 'install');
INSERT INTO `sas_menu_side` VALUES ('21', 'Selbstzerst&ouml;rung', 'management', 'destroy');
INSERT INTO `sas_menu_side` VALUES ('22', 'Neustarten', 'management', 'reboot');
INSERT INTO `sas_menu_side` VALUES ('23', 'Konfiguration', 'postfix', 'conf');
INSERT INTO `sas_menu_side` VALUES ('24', 'Benutzer', 'postfix', 'users');
INSERT INTO `sas_menu_side` VALUES ('25', 'Statistik', 'postfix', 'stats');
INSERT INTO `sas_menu_side` VALUES ('26', 'Konfiguration', 'samba', 'conf');
INSERT INTO `sas_menu_side` VALUES ('27', 'Verwaltung', 'samba', 'control');
INSERT INTO `sas_menu_side` VALUES ('28', 'Freigaben', 'samba', 'shares');
INSERT INTO `sas_menu_side` VALUES ('29', 'Benutzer', 'samba', 'users');
INSERT INTO `sas_menu_side` VALUES ('30', 'Konsole', 'tools', 'console');
INSERT INTO `sas_menu_side` VALUES ('31', 'CPU Auslastung', 'tools', 'cpu');
INSERT INTO `sas_menu_side` VALUES ('32', 'Cronjobs', 'tools', 'cron');
INSERT INTO `sas_menu_side` VALUES ('33', 'Festplatten Informationen', 'tools', 'hdd');
INSERT INTO `sas_menu_side` VALUES ('34', 'Hardware Informationen', 'tools', 'hw');
INSERT INTO `sas_menu_side` VALUES ('35', 'Arbeitsspeicher Informationen', 'tools', 'ram');
INSERT INTO `sas_menu_side` VALUES ('36', 'Taskmanager', 'tools', 'taskmgr');
INSERT INTO `sas_menu_side` VALUES ('37', 'Statistiken', 'tools', 'stats');
INSERT INTO `sas_menu_side` VALUES ('38', '<i>Dev: CSS-Info</i>', 'home', 'devstyle');
INSERT INTO `sas_menu_side` VALUES ('39', 'Benutzer anlegen', 'mysql', 'adduser');
INSERT INTO `sas_menu_side` VALUES ('40', 'Datenbanken', 'mysql', 'db');
INSERT INTO `sas_menu_side` VALUES ('41', 'QuickPanel', 'home', 'quickpanel');
INSERT INTO `sas_menu_side` VALUES ('42', 'phpinfo', 'apache', 'phpinfo');

-- ----------------------------
-- Table structure for `sas_server_data`
-- ----------------------------
DROP TABLE IF EXISTS `sas_server_data`;
CREATE TABLE `sas_server_data` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sas_server_data
-- ----------------------------

-- ----------------------------
-- Table structure for `sas_server_mysql`
-- ----------------------------
DROP TABLE IF EXISTS `sas_server_mysql`;
CREATE TABLE `sas_server_mysql` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sid` int(10) NOT NULL,
  `host` varchar(255) NOT NULL,
  `port` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sas_server_mysql
-- ----------------------------

-- ----------------------------
-- Table structure for `sas_user_permission`
-- ----------------------------
DROP TABLE IF EXISTS `sas_user_permission`;
CREATE TABLE `sas_user_permission` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sas_user_permission
-- ----------------------------

-- ----------------------------
-- Table structure for `sas_users`
-- ----------------------------
DROP TABLE IF EXISTS `sas_users`;
CREATE TABLE `sas_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userunique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sas_users
-- ----------------------------
INSERT INTO `sas_users` VALUES ('2', 'admin', 'e8636ea013e682faf61f56ce1cb1ab5c', 'admin@server-admin-system.de');
