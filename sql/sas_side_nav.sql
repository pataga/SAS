DROP TABLE IF EXISTS `sas_side_nav`;
CREATE TABLE `sas_side_nav` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `get` varchar(255) NOT NULL,
  `getValue` varchar(255) NOT NULL,
  `sub_get` varchar(255) NOT NULL,
  `sub_getValue` varchar(255) NOT NULL,
  `inc_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `sas_side_nav` VALUES ('1', 'testpat', 'page', 'home', 'pat', 'lol', '');

