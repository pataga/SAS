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
