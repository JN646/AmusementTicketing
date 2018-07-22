-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 22, 2018 at 04:13 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `microphone`
--

-- --------------------------------------------------------

--
-- Table structure for table `crud`
--

DROP TABLE IF EXISTS `crud`;
CREATE TABLE IF NOT EXISTS `crud` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Microphone ID',
  `make` varchar(50) DEFAULT NULL COMMENT 'Microphone Make',
  `model` varchar(100) DEFAULT NULL COMMENT 'Microphone Model',
  `type` varchar(50) DEFAULT NULL COMMENT 'Microphone Type',
  `polarpattern` varchar(50) DEFAULT NULL COMMENT 'Microphone Polar Pattern',
  `price` decimal(10,2) DEFAULT '0.00' COMMENT 'Microphone Price',
  `discontinued` tinyint(1) DEFAULT '0' COMMENT 'Microphone Status',
  `notes` text COMMENT 'Microphone Notes',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crud`
--

INSERT INTO `crud` (`id`, `make`, `model`, `type`, `polarpattern`, `price`, `discontinued`, `notes`) VALUES
(1, 'Shure', 'SM57', 'Dynamic', 'Cardioid', '89.00', 0, 'Common studio microphone for recording instruments.'),
(5, 'Shure', 'SM58', 'Dynamic', 'Cardioid', '79.00', 0, 'Common live vocal microphone.'),
(4, 'AKG', 'C414 XLS', 'Condenser', 'Cardioid', '0.00', 0, 'The C414 is probably the best-known microphone that AKG make, alongside the legendary C12. Nevertheless, the C414 has undergone a number of evolutionary changes over its long lifetime, changing shape, adding and discarding transformers, and now, in its latest incarnation, sprouting LEDs! Although the overall shape of the new versions is unmistakably C414, virtually everything about the microphone has been redesigned in an effort to retain the original sound, while at the same time improving the technical performance. AKG cite 15 improved features, though one of these relates to the depth of engraving and the colour of the infill, so clearly some are of more importance than others!'),
(7, 'Shure', 'Beta57', 'Dynamic', 'Cardioid', '0.00', 0, 'Dynamic microphone good for snare drums.'),
(8, 'Rode', 'NT2', 'Condenser', 'Cardioid', '0.00', 0, NULL),
(9, 'Rode', 'NT4', 'Condenser', 'Cardioid', '0.00', 0, NULL),
(10, 'AKG', 'D112', 'Dynamic', 'Cardioid', '120.00', 1, 'Good bass response.'),
(11, 'Shure', 'Beta52a', 'Dynamic', 'Cardioid', '0.00', 0, ''),
(12, 'Sennheiser', 'MD421', 'Dynamic', 'Cardioid', '0.00', 0, 'Studio dynamic microphone.'),
(13, 'Neumann', 'KM184', 'Condenser', 'Super-Cardioid', '0.00', 0, ''),
(14, 'Shure', 'SM7B', 'Condenser', 'Cardioid', '0.00', 0, 'Studio vocal microphone.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
