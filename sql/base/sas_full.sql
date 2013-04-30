-- ----------------------------
-- Table structure for sas_home_notes
-- ----------------------------
CREATE TABLE `sas_home_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) DEFAULT NULL,
  `note` text NOT NULL,
  `notetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sas_notifications
-- ----------------------------
CREATE TABLE `sas_notifications` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `datum` varchar(255) DEFAULT NULL,
  `zeit` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sas_plugin_scripts
-- ----------------------------
CREATE TABLE `sas_plugin_scripts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `script` varchar(255) NOT NULL,
  `type` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sas_plugins
-- ----------------------------
CREATE TABLE `sas_plugins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `repo` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `installed` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDBDEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sas_server_data
-- ----------------------------
CREATE TABLE `sas_server_data` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sas_server_mysql
-- ----------------------------
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
-- Table structure for sas_user_permission
-- ----------------------------
CREATE TABLE `sas_user_permission` (
  `pid` int(11) unsigned NOT NULL,
  `sid` int(11) unsigned NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  `bitmask` bigint(20) NOT NULL,
  PRIMARY KEY (`pid`,`sid`,`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sas_users
-- ----------------------------
CREATE TABLE `sas_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userunique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sas_user_permission` VALUES ('1', '1', '1', '255');
INSERT INTO `sas_user_permission` VALUES ('2', '1', '1', '255');
INSERT INTO `sas_user_permission` VALUES ('3', '1', '1', '255');
INSERT INTO `sas_user_permission` VALUES ('4', '1', '1', '255');
INSERT INTO `sas_user_permission` VALUES ('5', '1', '1', '255');
INSERT INTO `sas_user_permission` VALUES ('6', '1', '1', '255');
INSERT INTO `sas_user_permission` VALUES ('7', '1', '1', '255');
INSERT INTO `sas_user_permission` VALUES ('8', '1', '1', '255');
INSERT INTO `sas_user_permission` VALUES ('9', '1', '1', '255');
INSERT INTO `sas_user_permission` VALUES ('10', '1', '1', '255');
INSERT INTO `sas_users` VALUES ('1', 'admin', '202cb962ac59075b964b07152d234b70', 'admin@admin.de', '0');
