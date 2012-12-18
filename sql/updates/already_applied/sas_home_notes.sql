-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 30. Nov 2012 um 18:45
-- Server Version: 5.5.28
-- PHP-Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `sas`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sas_home_notes`
--

CREATE TABLE IF NOT EXISTS `sas_home_notes` (
  `id` int(10) NOT NULL,
  `author` varchar(50) NOT NULL,
  `note` text CHARACTER SET utf8 NOT NULL,
  `notetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `sas_home_notes`
--

INSERT INTO `sas_home_notes` (`id`, `author`, `note`, `notetime`) VALUES
(0, 'admin', 'Testnotiz \r\näüö', '2012-11-30 17:44:30');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
