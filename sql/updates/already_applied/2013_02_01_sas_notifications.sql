DROP TABLE IF EXISTS `sas_notifications`;
CREATE TABLE `sas_notifications` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `datum` varchar(255) DEFAULT NULL,
  `zeit` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=latin1;
