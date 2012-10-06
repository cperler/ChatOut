SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `chat` (
  `profile_id` int(11) NOT NULL,
  `latitude` decimal(20,10) NOT NULL,
  `longitude` decimal(20,10) NOT NULL,
  `message` text NOT NULL,
  `broadcast_datetime` datetime NOT NULL,
  KEY `profile_id` (`profile_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `chat` (`profile_id`, `latitude`, `longitude`, `message`, `broadcast_datetime`) VALUES
(1, 100.0000000000, 101.0000000000, 'hello', '2010-12-18 14:38:49'),
(1, 100.0000000000, 101.0000000000, 'hello there', '2010-12-18 14:39:08'),
(1, 100.0000000000, 101.0000000000, 'hi again', '2010-12-18 14:39:17'),
(1, 100.0000000000, 101.0000000000, 'hi again', '2010-12-18 14:49:00'),
(1, 100.0000000000, 105.0000000000, 'hi again', '2010-12-18 14:49:35');

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `latitude` decimal(20,10) DEFAULT NULL,
  `longitude` decimal(20,10) DEFAULT NULL,
  `radius_of_interest_distance` decimal(10,0) NOT NULL DEFAULT '1',
  `radius_of_interest_units` enum('foot','mile') NOT NULL DEFAULT 'mile',
  `genders_of_interest` enum('male','female','both') NOT NULL DEFAULT 'both',
  `min_age_of_interest` int(11) NOT NULL DEFAULT '18',
  `max_age_of_interest` int(11) NOT NULL DEFAULT '100',
  `last_location_updatetime` datetime DEFAULT NULL,
  `profile_pic` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `profile` (`id`, `username`, `birthdate`, `gender`, `latitude`, `longitude`, `radius_of_interest_distance`, `radius_of_interest_units`, `genders_of_interest`, `min_age_of_interest`, `max_age_of_interest`, `last_location_updatetime`, `profile_pic`) VALUES
(1, 'cperler', '1982-06-28', 'male', 37.4220050000, -122.0845983333, 1, 'mile', 'both', 18, 38, '2010-12-25 11:32:55', NULL);
