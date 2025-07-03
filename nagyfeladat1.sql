-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 03, 2025 at 07:37 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nagyfeladat1`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_hungarian_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb3_hungarian_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb3_hungarian_ci NOT NULL,
  `regdatetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `rights` int DEFAULT '101',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_hungarian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `mail`, `pass`, `regdatetime`, `rights`) VALUES
(1, 'IgnácSzilvi', 'ignac.szilvia@outlook.com', '$2y$10$Spu0N5Aj/7Fj9smk7DaSTery7vRRDzJitnl0bIx/wdTzyrnktl/BG', '2025-06-26 14:03:58', 103),
(2, 'Szilvia', 'gfdgdf@fsdfsdf', '$2y$10$kCuCHvBPJsUA70aMhG8Uiuat6GYS2LPE1gnQNq4ZSVdLD45K77HP.', '2025-06-26 18:46:43', 101),
(3, 'dsad', 'dasdadsadasd@dflkhgdflkg', '$2y$10$cI7QDVHAwZhrPDfJmWB.eezcirOfrQEr6vin1keS5Ou9jwXb3y65q', '2025-06-26 18:59:21', 101),
(4, 'Nudlifffff', 'Nudli@nudli.com', '$2y$10$LFk0uIkXVWpnKmka1BEHfOwfsJe/94RCMTn5BXfZeXbLoKmM9/.qu', '2025-06-26 21:46:18', 101);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
