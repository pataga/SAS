-- ----------------------------
-- Table structure for `sas_main_menu`
-- ----------------------------
DROP TABLE IF EXISTS `sas_main_menu`;
CREATE TABLE `sas_main_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sas_main_menu
-- ----------------------------
INSERT INTO `sas_main_menu` VALUES ('1', 'Home', 'home');
INSERT INTO `sas_main_menu` VALUES ('2', 'Apache', 'mysql');
INSERT INTO `sas_main_menu` VALUES ('3', 'Postfix', 'apache');
INSERT INTO `sas_main_menu` VALUES ('4', 'FTP', 'postfix');
INSERT INTO `sas_main_menu` VALUES ('5', 'MySQL', 'ftp');
INSERT INTO `sas_main_menu` VALUES ('6', 'Samba', 'samba');
INSERT INTO `sas_main_menu` VALUES ('7', 'Control', 'management');
INSERT INTO `sas_main_menu` VALUES ('8', 'Webuser', 'webuser');
INSERT INTO `sas_main_menu` VALUES ('9', 'Tools', 'tools');
INSERT INTO `sas_main_menu` VALUES ('10', 'Plugins', 'plugins');
