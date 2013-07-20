-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 02, 2013 at 09:58 AM
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
-- Table structure for table `property_types`
--

CREATE TABLE IF NOT EXISTS `property_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(150) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `description`, `created_on`, `created_by`, `modified_on`, `modified_by`) VALUES
(1, 'CONDO', '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM'),
(2, 'APARTMENT', '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM'),
(3, 'BEDSPACE', '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM'),
(4, 'ROOM FOR RENT', '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM'),
(5, 'DORMITORY', '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
