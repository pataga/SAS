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
