-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 02, 2013 at 09:56 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `college_cribs`
--

-- --------------------------------------------------------

--
-- Table structure for table `membership_types`
--

CREATE TABLE IF NOT EXISTS `membership_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `age_of_validity` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `membership_types`
--

INSERT INTO `membership_types` (`id`, `description`, `price`, `age_of_validity`, `created_on`, `created_by`, `modified_on`, `modified_by`) VALUES
(1, 'FREE', 0, 0, '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM'),
(2, 'SILVER', 500, 90, '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM'),
(3, 'GOLD', 900, 120, '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM'),
(4, 'PLATINUM', 1200, 120, '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
