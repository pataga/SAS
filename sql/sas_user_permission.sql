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
