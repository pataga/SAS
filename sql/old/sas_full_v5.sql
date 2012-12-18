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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

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

-- ----------------------------
-- Table structure for `sas_server_data`
-- ----------------------------
DROP TABLE IF EXISTS `sas_server_data`;
CREATE TABLE `sas_server_data` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sas_server_data
-- ----------------------------
INSERT INTO `sas_server_data` VALUES ('1', '127.0.0.1', 'root', '12345', '1', '0', '0', '0', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sas_server_mysql
-- ----------------------------
INSERT INTO `sas_server_mysql` VALUES ('1', '1', '127.0.0.1', '3306', 'root', '123');

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
INSERT INTO `sas_users` VALUES ('1', 'admin', 'e8636ea013e682faf61f56ce1cb1ab5c', 'admin@admin.de');

