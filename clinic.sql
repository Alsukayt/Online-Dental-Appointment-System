-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 04, 2022 at 02:01 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `appointmentId` int NOT NULL AUTO_INCREMENT,
  `patientName` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `doctorId` int NOT NULL,
  `userId` int NOT NULL,
  `accepted` tinyint DEFAULT '0',
  PRIMARY KEY (`appointmentId`),
  KEY `doctorId` (`doctorId`),
  KEY `userId` (`userId`)
)  ;

--
-- Dumping data for table `appointment`
--
 

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `commentId` int NOT NULL AUTO_INCREMENT,
  `comment` varchar(255) NOT NULL,
  `patientName` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `patientId` int NOT NULL,
  `doctorId` int NOT NULL,
  `approve` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`commentId`),
  KEY `patientId` (`patientId`),
  KEY `doctorId` (`doctorId`)
) ;

--
-- Dumping data for table `comment`
--
 

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `doctorId` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `University` varchar(255) NOT NULL,
  `whatsapp` varchar(500) DEFAULT NULL,
  `zoom` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`doctorId`)
)  ;

--
-- Dumping data for table `doctor`
--

 

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(500) NOT NULL,
  `phoneNum` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `pirh_date` date DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT '0',
  `bio` varchar(1000) DEFAULT NULL,
  `addresse` varchar(500) DEFAULT NULL,
  `University` varchar(1000) DEFAULT NULL,
  `whatsapp` varchar(500) DEFAULT NULL,
  `zoom` varchar(500) DEFAULT NULL,
  `map_link` varchar(5000) DEFAULT NULL,
  `Specialization` varchar(500) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`userId`)
) ;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`userId`, `email`, `password`, `firstName`, `lastName`, `phoneNum`, `address`, `gender`, `pirh_date`, `isAdmin`, `bio`, `addresse`, `University`, `whatsapp`, `zoom`, `map_link`, `Specialization`, `price`) VALUES
(1, 'zakariyafirachine@gmail.com', '6c7d9ae9de5b6a2fbff9b755c6a7d7b5597ca0e6', 'zakariya', 'firachine', '06235157899', 'zakariya', 'male', '2022-04-28', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'zzzzzzzzzz@dd.com', 'a11257ca53dc534da44b299c064fef3b37da6bbd', 'zzzzzzzzzz', 'zzzzzzzzzz', '666666666666666', 'zzzzzzzzzzzzzzzzzzzz', 'male', '2022-05-12', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'doctor@doctor.doctor', '1f0160076c9f42a157f0a8f0dcc68e02ff69045b', 'doctor', 'doctor', '06235157899', 'dqsqsd', 'male', '2022-04-14', 2, 'Consultant Internal Medicine at King Abdulaziz Hospital', 'Hafar Al-Batin', 'King Khalid University', 'azezazzz', 'ezaza', 'https://fontawesome.com/v5/icons/map-marker?s=solid', 'zaeza', '30.00'),
(6, 'ezaezaezaeza@d.cpp', '7bfeaa773ec2facda3eaf9263379612fed8a97ee', 'ezaezaezaeza', 'ezaezaezaeza', '1223332333', 'ezaezaezaeza', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `questionId` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `question` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`questionId`)
) ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`questionId`, `date`, `question`, `email`) VALUES
(1, '2022-04-28', '', ''),
(2, '2022-04-28', '', ''),
(3, '2022-04-28', '', ''),
(4, '2022-04-28', 'eazeza', 'eza@dd.cc'),
(5, '2022-04-28', 'eazeza', 'eza@dd.cc'),
(6, '2022-04-28', 'eaz', 'eaz@eazj.com'),
(7, '2022-04-28', 'eaz', 'eaz@eazj.com');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rating` int NOT NULL,
  `userid` int NOT NULL,
  `doctorid` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rating_doctor_id` (`doctorid`),
  KEY `rating_user_id` (`userid`)
)  ;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `rating`, `userid`, `doctorid`) VALUES
(1, 5, 4, 1),
(2, 5, 4, 1),
(3, 5, 4, 1),
(4, 5, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL,
  `whatsapp` varchar(500) DEFAULT NULL,
  `zoom` varchar(500) DEFAULT NULL,
  `facebook` varchar(500) DEFAULT NULL,
  `twiter` varchar(500) DEFAULT NULL,
  `in_` varchar(500) DEFAULT NULL,
  `git` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `whatsapp`, `zoom`, `facebook`, `twiter`, `in_`, `git`) VALUES
(1, '+2120623515775', 'linkzeaz', 'eza', 'eazeza', 'eza', 'eza');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
