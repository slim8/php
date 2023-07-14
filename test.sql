-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 13, 2021 at 01:22 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `start_date`, `end_date`) VALUES
(3, 'Event3', '2021-07-08', '2021-07-17'),
(1, 'Event 2', '2021-07-13', '2021-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

DROP TABLE IF EXISTS `participants`;
CREATE TABLE IF NOT EXISTS `participants` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender` varchar(15) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(150) NOT NULL,
  `position` varchar(150) NOT NULL,
  `street` varchar(250) DEFAULT NULL,
  `street_number` int DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `state` varchar(25) NOT NULL,
  `country` varchar(25) NOT NULL,
  `reason` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `gender`, `first_name`, `last_name`, `birth_date`, `email`, `company`, `position`, `street`, `street_number`, `zip_code`, `state`, `country`, `reason`) VALUES
(1, 'male', 'slim', 'khamessi', '2021-07-09', 'slim.khamessi@gmail.com', 'okay', 'ffff', '12 rue imam chafii cité zitoun fouchana', 15, '2082', 'tunis', 'Tunisia', 'Hello world'),
(2, 'male', 'slim', 'khamessi', '2008-10-10', 'slim.khamessi@gmail.com', 'okay', 'ffff', '12 rue imam chafii cité zitoun fouchana', 3, '2082', 'tunis', 'Tunisia', 'eefefeee');

-- --------------------------------------------------------

--
-- Table structure for table `participant_event`
--

DROP TABLE IF EXISTS `participant_event`;
CREATE TABLE IF NOT EXISTS `participant_event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_participant` int NOT NULL,
  `id_event` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `participant_event`
--

INSERT INTO `participant_event` (`id`, `id_participant`, `id_event`) VALUES
(1, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usres`
--

DROP TABLE IF EXISTS `usres`;
CREATE TABLE IF NOT EXISTS `usres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `role` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `type` int NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usres`
--

INSERT INTO `usres` (`id`, `first_name`, `last_name`, `role`, `email`, `password`, `type`, `image`) VALUES
(1, 'slim', 'khamessi', 1, 'slim.khamessi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '1626182449.png'),
(3, 'user', 'user', 0, 'user1@gmail.com', '4a7d1ed414474e4033ac29ccb8653d9b', 0, 'no-image.jpg'),
(5, 'slim', 'khamessi', 1, 'slim.khamessi@gmail.com', 'cfcd208495d565ef66e7dff9f98764da', 0, 'no-image.jpg'),
(4, 'slim', 'khamessi', 1, 'slim.khamessi@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 'no-image.jpg'),
(6, 'slim', 'khamessi', 1, 'slim.khamessi@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 0, 'no-image.jpg'),
(7, 'slim', 'khamessi', 1, 'slim.khamessi@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 0, '1626179971.png'),
(8, 'slim', 'khamessi', 0, 'slim.khamessi@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 0, '1626180203.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
