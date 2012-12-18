DROP TABLE IF EXISTS `sas_side_nav`;
CREATE TABLE `sas_side_nav` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  `spage` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `sas_side_nav` VALUES ('1', 'testpat', 'home', 'lol');
