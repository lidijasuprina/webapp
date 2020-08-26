-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `day`;
CREATE TABLE `day` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `day` (`id`, `name`) VALUES
(1,	'Monday'),
(2,	'Tuesday'),
(3,	'Wednesday'),
(4,	'Thursday'),
(5,	'Friday'),
(6,	'Saturday'),
(7,	'Sunday');

DROP TABLE IF EXISTS `gender`;
CREATE TABLE `gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `gender` (`id`, `name`) VALUES
(1,	'M'),
(2,	'F');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `birth` date NOT NULL,
  `gender` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gender` (`gender`),
  KEY `user_type` (`user_type`),
  CONSTRAINT `user_ibfk_3` FOREIGN KEY (`gender`) REFERENCES `gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_ibfk_4` FOREIGN KEY (`user_type`) REFERENCES `user_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`id`, `name`, `surname`, `email`, `password`, `birth`, `gender`, `user_type`) VALUES
(20,	'Lara',	'Larić',	'lara@lara.lara',	'be774fb111eb21e85cb9a885342b43e739227ce193daa2501332515ddf15142c86da667a1003831d2fbfc4494e3101d9432eff65bee31d8211bbab4ecf9d761c',	'1999-06-22',	2,	3),
(22,	'Filip',	'Filipović',	'filip@srafit.hr',	'0742d50ac21b91543aab456dd6a36ef7f929f13ae7045d921cb6ce2a85c146fa88ba321da9295a848d09ab8b2dc204e38f174431d4cb229447b534d8c14f35ff',	'1996-07-15',	1,	2);

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user_type` (`id`, `name`) VALUES
(1,	'administrator'),
(2,	'moderator'),
(3,	'user');

DROP TABLE IF EXISTS `workout`;
CREATE TABLE `workout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `coach` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `coach` (`coach`),
  KEY `day` (`day`),
  CONSTRAINT `workout_ibfk_3` FOREIGN KEY (`coach`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `workout_ibfk_4` FOREIGN KEY (`day`) REFERENCES `day` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `workout` (`id`, `name`, `start_time`, `end_time`, `coach`, `day`) VALUES
(12,	'Zumba',	'17:00:00',	'18:00:00',	22,	1),
(13,	'Fitness',	'16:00:00',	'17:00:00',	22,	3),
(14,	'Crossfit',	'17:00:00',	'19:00:00',	22,	5),
(15,	'Full Body Workout',	'16:00:00',	'17:00:00',	22,	2);

DROP TABLE IF EXISTS `workout_members`;
CREATE TABLE `workout_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `workout` int(11) NOT NULL,
  `member` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `workout` (`workout`),
  KEY `member` (`member`),
  CONSTRAINT `workout_members_ibfk_1` FOREIGN KEY (`workout`) REFERENCES `workout` (`id`) ON DELETE CASCADE,
  CONSTRAINT `workout_members_ibfk_2` FOREIGN KEY (`member`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `workout_members` (`id`, `workout`, `member`) VALUES
(12,	14,	20),
(13,	12,	20);

-- 2020-07-06 10:25:38
