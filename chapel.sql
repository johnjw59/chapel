-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 21, 2015 at 01:44 AM
-- Server version: 5.5.41-cll-lve
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chapel`
--

-- --------------------------------------------------------

--
-- Table structure for table `common`
--

CREATE TABLE IF NOT EXISTS `common` (
  `date` datetime NOT NULL,
  `title` text NOT NULL,
  `location` text NOT NULL,
  `event_link` text,
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `north_shore`
--

CREATE TABLE IF NOT EXISTS `north_shore` (
  `date` datetime NOT NULL,
  `title` text NOT NULL,
  `locatoin` text NOT NULL,
  `event_link` text,
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tri-cities`
--

CREATE TABLE IF NOT EXISTS `tri-cities` (
  `date` datetime NOT NULL,
  `title` text NOT NULL,
  `locatoin` text NOT NULL,
  `event_link` text,
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vancouver`
--

CREATE TABLE IF NOT EXISTS `vancouver` (
  `date` datetime NOT NULL,
  `title` text NOT NULL,
  `location` text NOT NULL,
  `event_link` text,
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
