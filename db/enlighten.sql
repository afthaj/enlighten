-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 05, 2013 at 09:39 AM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `enlighten`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `joinDate` datetime NOT NULL,
  `privilegeLevel` varchar(2) NOT NULL,
  `title` varchar(4) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `otherNames` varchar(60) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `nationalID` varchar(10) NOT NULL,
  `gender` char(1) NOT NULL,
  `contactAddress` varchar(200) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `telephoneNumber` varchar(13) NOT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` VALUES(1, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2011-06-10 21:13:27', '01', 'Mr', 'Admin', '', 'User', '883231511v', 'M', 'Colombo', 'aftha.jaldin88@gmail.com', '0774422980');
INSERT INTO `admin` VALUES(2, 'aftha', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2011-06-27 18:36:58', '02', 'Mr', 'Aftha', '', 'Jaldin', '883231511v', '', '', 'aftha.jaldin88@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `sponsorID` int(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `joinDate` datetime NOT NULL,
  `title` varchar(4) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `otherNames` varchar(60) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `IDNumber` varchar(10) NOT NULL,
  `gender` char(1) NOT NULL,
  `contactAddress` varchar(200) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `telephoneNumber1` varchar(13) NOT NULL,
  `telephoneNumber2` varchar(13) NOT NULL,
  PRIMARY KEY (`sponsorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` VALUES(3, 'user', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2011-06-27 20:11:57', 'Mr', 'General', '', 'User', '883231511v', 'M', '218/61, Deniyawatte Road, Thalangama Battaramulla', 'aftha.jaldin88@gmail.com', '0112861563', '0774422980');

-- --------------------------------------------------------

--
-- Table structure for table `sponsorship`
--

CREATE TABLE `sponsorship` (
  `sponsorshipID` int(8) NOT NULL AUTO_INCREMENT,
  `sponsorID` int(6) NOT NULL,
  `studentID` int(8) NOT NULL,
  `dateSubmitted` datetime NOT NULL,
  `dateEdited` datetime NOT NULL,
  `progress` varchar(2) NOT NULL,
  PRIMARY KEY (`sponsorshipID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `sponsorship`
--

INSERT INTO `sponsorship` VALUES(24, 3, 1, '2011-06-28 00:46:17', '0000-00-00 00:00:00', '02');
INSERT INTO `sponsorship` VALUES(25, 3, 2, '2011-06-28 02:30:54', '0000-00-00 00:00:00', '02');
INSERT INTO `sponsorship` VALUES(26, 3, 3, '2011-06-28 10:22:12', '0000-00-00 00:00:00', '01');
INSERT INTO `sponsorship` VALUES(27, 3, 5, '2011-06-28 10:24:58', '0000-00-00 00:00:00', '01');
INSERT INTO `sponsorship` VALUES(28, 3, 6, '2011-06-28 14:42:23', '0000-00-00 00:00:00', '01');
INSERT INTO `sponsorship` VALUES(29, 3, 16, '2013-06-12 00:24:16', '0000-00-00 00:00:00', '01');
INSERT INTO `sponsorship` VALUES(30, 3, 16, '2013-06-12 00:25:00', '0000-00-00 00:00:00', '01');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` int(8) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) NOT NULL,
  `otherNames` varchar(60) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `contactAddress` varchar(200) NOT NULL,
  `guardianName` varchar(100) NOT NULL,
  `guardianTelephoneNumber` varchar(13) NOT NULL,
  `guardianContactAddress` varchar(300) NOT NULL,
  `currentGrade` varchar(2) NOT NULL,
  `sponsorshipProgress` varchar(2) NOT NULL,
  PRIMARY KEY (`studentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` VALUES(1, 'Aftha', 'Rizwan', 'Jaldin', '1988-11-18', '218/61, Deniyawatte Road, Thalangama Battaramulla', 'Imtiaz Jaldin', '0775799571', 'Colombo', '5', '02');
INSERT INTO `student` VALUES(2, 'John', 'Alan', 'Doe', '1987-10-10', '10, Jaya Mawatha, Colombo 5', 'Adam Doe', '0112345678', 'Kandy', '3', '02');
INSERT INTO `student` VALUES(3, 'Manoj', '', 'Prasanna', '1998-06-13', '302/A, Meethotamulla Road, Wellampitiya', 'Kamal Prasanna', '0777654321', '302/A, Meethotamulla Road, Wellampitiya', '8', '01');
INSERT INTO `student` VALUES(5, 'Abdulla', '', 'Mukkhar', '1998-05-29', '2/18, Pirivena Road, Kolonnawa.', 'Mohammed Mukkhar', '0788654321', '2/18, Pirivena Road, Kolonnawa.', '8', '01');
INSERT INTO `student` VALUES(6, 'Malith', '', 'Pushpakumara', '1995-07-25', '14/A, Jayanthi Mw, Wellampitiya', 'Ajith Pushpakumara', '0112987654', '14/A, Jayanthi Mw, Wellampitiya', '10', '01');
INSERT INTO `student` VALUES(7, 'Yohan', '', 'Arendtsz', '1995-08-25', '100/54, Perera Mw, Wadugodawaththa, Meethotamulla', 'Naven Arendtsz', '0112436587', '100/54, Perera Mw, Wadugodawaththa, Meethotamulla', '10', '00');
INSERT INTO `student` VALUES(8, 'Siraj', 'Mohammed', 'Din', '1995-02-12', '12/17, Parakrama Mw, Hunupitiya.', 'Safar Din', '0712345678', '12/17, Parakrama Mw, Hunupitiya.', '10', '00');
INSERT INTO `student` VALUES(9, 'Tharuka', '', 'Lakshan', '1998-02-18', '28, Puwakgahawaththa, 2nd lane, Kolonnawa', 'Sunil Lakshan', '0722345678', '28, Puwakgahawaththa, 2nd lane, Kolonnawa', '8', '00');
INSERT INTO `student` VALUES(10, 'Mohammed', '', 'Nifraz', '1996-06-04', '16/6, Meethotamulla Lane, Wellampitiya', 'Muneef Nifraz', '0115432198', '16/6, Meethotamulla Lane, Wellampitiya', '9', '00');
INSERT INTO `student` VALUES(11, 'Dinesh', '', 'Kumar', '2000-09-09', '95/8, Saththammawaththa, Wellampitiya', 'Arun Kumar', '0112896745', '95/8, Saththammawaththa, Wellampitiya', '6', '00');
INSERT INTO `student` VALUES(12, 'Sanduni', '', 'Dilrukshi', '2001-04-20', '95/5B, Majeed Place, Wellampitiya', 'Iresha Dilrukshi', '0112567812', '95/5B, Majeed Place, Wellampitiya', '5', '00');
INSERT INTO `student` VALUES(13, 'Viraj', '', 'Prasad', '2006-08-17', '86/32, Saththammawaththa, Wellampitiya', 'Mahen Prasad', '0114987654', '86/32, Saththammawaththa, Wellampitiya', '1', '00');
INSERT INTO `student` VALUES(14, 'Anoma', '', 'Gayathri', '2004-05-13', '86/23, Pirivena Road, Kolonnawa.', 'Sonali Gayathri', '0114896745', '86/23, Pirivena Road, Kolonnawa.', '2', '00');
INSERT INTO `student` VALUES(15, 'Niroshini', '', 'Sandarenu', '2001-04-25', '25, Kohilawaththa, Weeramal Mawatha', 'Nishika Sandarenu', '0114123456', '25, Kohilawaththa, Weeramal Mawatha', '5', '00');
INSERT INTO `student` VALUES(16, 'Af', '', 'Jay', '1988-11-18', 'Colombo', 'Feroza Jaldin', '0777746692', 'Colombo', '4', '01');
