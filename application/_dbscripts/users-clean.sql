-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 02, 2013 at 09:59 AM
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
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `for_authenticate` varchar(150) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL DEFAULT 'SYSTEM',
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` varchar(100) NOT NULL DEFAULT 'SYSTEM',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `for_authenticate`, `created_on`, `created_by`, `modified_on`, `modified_by`) VALUES
(1, 'stephsteph', '$2a$08$OElPRkdaNGFTcVVoQnhwbu3ShrtH4vuAwy9/Cp47eIS.kXLH/nzUO', 'jose16orange@yahoo.com', '', '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM'),
(2, 'maki1300', '$2a$08$aTVrcmJUZnB6VEdIUjB3buv8d3KbuNsbtBRSlJVYut3t.hq//1svO', 'maki1300@yahoo.com', '', '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
