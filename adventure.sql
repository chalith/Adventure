-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2016 at 05:09 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `adventure`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customerID` varchar(50) NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) DEFAULT NULL,
  `fax` int(10) NOT NULL,
  `userName` varchar(100) NOT NULL,
  PRIMARY KEY (`customerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customermobilenumber`
--

CREATE TABLE IF NOT EXISTS `customermobilenumber` (
  `customerID` varchar(50) NOT NULL,
  `mobileNumber` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `feedbackID` varchar(50) NOT NULL,
  `packageID` varchar(50) NOT NULL,
  `customerName` varchar(500) NOT NULL,
  `customerID` varchar(50) DEFAULT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`feedbackID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `following`
--

CREATE TABLE IF NOT EXISTS `following` (
  `shopID` varchar(50) NOT NULL,
  `customerID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE IF NOT EXISTS `package` (
  `packageID` varchar(50) NOT NULL,
  `packageName` varchar(500) NOT NULL,
  `about` text NOT NULL,
  `durationDays` int(11) NOT NULL,
  `durationHours` int(11) NOT NULL,
  `durationMinutes` int(11) NOT NULL,
  `durationNights` int(11) NOT NULL,
  `meals` varchar(1000) NOT NULL,
  `price` float NOT NULL,
  `shopID` varchar(50) NOT NULL,
  PRIMARY KEY (`packageID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

CREATE TABLE IF NOT EXISTS `provider` (
  `shopID` varchar(50) NOT NULL,
  `shopName` varchar(500) NOT NULL,
  `ownerName` varchar(500) NOT NULL,
  `email` varchar(500) DEFAULT NULL,
  `address` text NOT NULL,
  `fax` int(10) DEFAULT NULL,
  `about` text,
  `userName` varchar(100) NOT NULL,
  PRIMARY KEY (`shopID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `customerID` varchar(50) NOT NULL,
  `packageID` varchar(50) NOT NULL,
  `rate` int(11) NOT NULL,
  `comment` text,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recervedpackage`
--

CREATE TABLE IF NOT EXISTS `recervedpackage` (
  `reservationID` varchar(50) NOT NULL,
  `packageID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `reservationID` varchar(50) NOT NULL,
  `customerID` varchar(50) NOT NULL,
  `shopID` varchar(50) NOT NULL,
  `totalPrice` float NOT NULL,
  `reserveDate` datetime NOT NULL,
  `acceptedDate` datetime NOT NULL,
  PRIMARY KEY (`reservationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shopmobilenumber`
--

CREATE TABLE IF NOT EXISTS `shopmobilenumber` (
  `shopID` varchar(50) NOT NULL,
  `mobileNumber` int(10) NOT NULL,
  `contactName` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
