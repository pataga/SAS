DROP TABLE IF EXISTS `sas_page_content`;
CREATE TABLE `sas_page_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `page` varchar(255) NOT NULL,
  `spage` varchar(255) NOT NULL,
  `inc_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `sas_page_content` VALUES ('1', 'home', '', 'inc/home/home.inc.php');

