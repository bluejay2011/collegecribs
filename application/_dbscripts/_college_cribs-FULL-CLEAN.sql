-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 02, 2013 at 09:54 AM
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
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `ads_page_location` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


-- --------------------------------------------------------

--
-- Table structure for table `membership_types`
--

CREATE TABLE IF NOT EXISTS `membership_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `age_of_validity` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `membership_types`
--

INSERT INTO `membership_types` (`id`, `description`, `price`, `age_of_validity`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'FREE', 0, 0, '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM'),
(2, 'SILVER', 500, 90, '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM'),
(3, 'GOLD', 900, 120, '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM'),
(4, 'PLATINUM', 1200, 120, '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE IF NOT EXISTS `properties` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `membership_type_id` int(11) NOT NULL DEFAULT '1',
  `property_name` varchar(100) NOT NULL,
  `property_description` text NOT NULL,
  `property_type_id` int(11) NOT NULL DEFAULT '0',
  `address` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL DEFAULT 'PHILIPPINES',
  `zip_code` varchar(10) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `contact_person` varchar(150) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `map_long` varchar(20) NOT NULL,
  `map_lat` varchar(20) NOT NULL,
  `rent_min` int(11) NOT NULL,
  `rent_max` int(11) NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - pending; 1- approved; 2 - disapproved',
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='list of property details' AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE IF NOT EXISTS `property_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(150) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='property upload image path' AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `property_reviews`
--

CREATE TABLE IF NOT EXISTS `property_reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `stars` float NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='list of property reviews' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE IF NOT EXISTS `property_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'CONDO', '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM'),
(2, 'APARTMENT', '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM'),
(3, 'BEDSPACE', '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM'),
(4, 'ROOM FOR RENT', '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM'),
(5, 'DORMITORY', '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM');

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
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `for_authenticate`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'stephsteph', '$2a$08$OElPRkdaNGFTcVVoQnhwbu3ShrtH4vuAwy9/Cp47eIS.kXLH/nzUO', 'jose16orange@yahoo.com', '', '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM'),
(2, 'maki1300', '$2a$08$aTVrcmJUZnB6VEdIUjB3buv8d3KbuNsbtBRSlJVYut3t.hq//1svO', 'maki1300@yahoo.com', '', '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `middle_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `is_owner` tinyint(1) NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `membership_type_id` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `first_name`, `middle_name`, `last_name`, `contact_number`, `is_owner`, `is_admin`, `membership_type_id`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'steph', 'c', 'jose', '9161117777', 1, 1, 1, '2013-04-01 00:00:00', 'SYSTEM', '2013-04-02 09:15:16', 'SYSTEM'),
(2, 2, 'maki', 'x', 'boy', '9163209999', 1, 0, 1, '2013-04-01 00:00:00', 'SYSTEM', '2013-03-31 16:00:00', 'SYSTEM');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
