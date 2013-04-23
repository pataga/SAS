DROP TABLE IF EXISTS `sas_user_permission`;
CREATE TABLE `sas_user_permission` (
  `uid` int(11) unsigned NOT NULL,
  `bitmask` bigint(20) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sas_user_permission` SELECT id, 131071 FROM `sas_users`;
