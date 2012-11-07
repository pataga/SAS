DROP TABLE IF EXISTS `sas_main_menu`;
CREATE TABLE `sas_main_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `sas_main_menu` VALUES ('1', 'START', 'home');
INSERT INTO `sas_main_menu` VALUES ('2', 'APACHE', '');
INSERT INTO `sas_main_menu` VALUES ('3', 'POSTFIX', '');
INSERT INTO `sas_main_menu` VALUES ('4', 'FTP', '');
INSERT INTO `sas_main_menu` VALUES ('5', 'MYSQL', '');
INSERT INTO `sas_main_menu` VALUES ('6', 'SAMBA', '');
INSERT INTO `sas_main_menu` VALUES ('7', 'MANAGEMENT', '');
INSERT INTO `sas_main_menu` VALUES ('8', 'WEBUSER', '');

