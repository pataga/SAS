--
-- MySQL 5.5.29
-- Fri, 19 Apr 2013 06:39:56 +0000
--

CREATE TABLE `sas_home_notes` (
   `id` int(11) not null auto_increment,
   `author` varchar(255),
   `note` text CHARSET utf8 not null,
   `notetime` timestamp not null default CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=8;

INSERT INTO `sas_home_notes` (`id`, `author`, `note`, `notetime`) VALUES 
('1', 'Gabriel', 'Willkommen! \\o/', '2013-04-19 08:05:31');