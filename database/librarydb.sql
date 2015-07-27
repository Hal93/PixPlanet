-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 10, 2013 at 04:33 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `library`
--
CREATE DATABASE `library` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `library`;

----------------------------------------------------------


----------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(80) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `date_added` date NOT NULL,
  `last_logged_in` date NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`userid`, `firstname`, `lastname`, `username`, `password`, `email`, `date_added`, `last_logged_in`) VALUES
(1, 'administrator', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.ie', '2013-03-07', '2013-04-10'),
(2, 'John', 'Murphy', 'johnm', 'e10adc3949ba59abbe56e057f20f883e', 'mike@iol.ie', '2013-03-04', '2013-04-10'),
(3, 'Brian', NULL, 'brian123', 'e10adc3949ba59abbe56e057f20f883e', 'brian@iol.ie', '2013-03-24', '2013-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `picid` int(11) NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`r_id`, `userid`, `picid`) VALUES
(1, 2, 1),
(2, 1, 1),
(3, 3, 1),
(4, 1, 9),
(5, 2, 11),
(6, 2, 10),
(7, 2, 4),
(8, 2, 14);

-- --------------------------------------------------------

--
-- Table structure for table `usercollection`
--

CREATE TABLE IF NOT EXISTS `usercollection` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `pictureID` int(11) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `usercollection`
--

INSERT INTO `usercollection` (`cid`, `userid`, `pictureID`, `date_added`) VALUES
(3, 2, 14, '2013-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `usercomments`
--

CREATE TABLE IF NOT EXISTS `usercomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picid` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `date_added` date NOT NULL,
  `commenttext` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `usercomments`
--

INSERT INTO `usercomments` (`id`, `picid`, `username`, `date_added`, `commenttext`) VALUES
(1, 0, 'admin', '2013-03-05', 'test'),
(2, 0, 'admin', '2013-03-05', 'test'),
(3, 1, 'admin', '2013-03-05', 'test'),
(4, 1, 'admin', '2013-03-08', 'Hello'),
(5, 3, 'johnm', '2013-03-13', 'Spiderman is a great Movie'),

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE IF NOT EXISTS `picture` (
  `pictureID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `fullimage` varchar(70) DEFAULT NULL,
  `upload_path` varchar(70) DEFAULT NULL,
  `category` varchar(80) DEFAULT NULL,
  `plot` text,
  `mediatype` varchar(100) DEFAULT NULL,
  `mediaformat` varchar(100) DEFAULT NULL,
  `ext` varchar(4) DEFAULT NULL,
  `thumb` varchar(100) DEFAULT NULL,
  `ratings` text,
  PRIMARY KEY (`pictureID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;



