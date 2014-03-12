-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 12, 2014 at 08:28 PM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `price` int(5) NOT NULL,
  `info` text COLLATE utf8_bin NOT NULL,
  `availibility` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `price`, `info`, `availibility`) VALUES
(1, 'Let Us C', 100, 'Yashwant Kanetwar', 0),
(2, 'Teach yourself C++', 100, 'Harbert Schield', 0),
(3, 'Intro to Algorithms', 5000, 'Cormen', 1),
(4, 'PHP tutorials', 200, '', 1),
(5, 'c++', 100, 'programming', 27),
(6, 'riyan', 123, 'asdf', 12),
(7, 'skfjdbvks', 23, 'df', 12),
(8, 'sfdnkjbvsn', 123, 'adsfgh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `newuser`
--

CREATE TABLE IF NOT EXISTS `newuser` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `sidx` int(11) NOT NULL AUTO_INCREMENT,
  `bid` int(15) NOT NULL,
  `uid` int(15) NOT NULL,
  `borrow` date NOT NULL,
  `rdate` date DEFAULT NULL,
  PRIMARY KEY (`sidx`),
  UNIQUE KEY `bid` (`bid`),
  UNIQUE KEY `bid_2` (`bid`),
  UNIQUE KEY `bid_3` (`bid`),
  UNIQUE KEY `bid_4` (`bid`),
  UNIQUE KEY `sidx` (`sidx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=54 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(15) NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  `category` int(1) NOT NULL,
  `fine` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`name`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `name_2` (`name`),
  UNIQUE KEY `id_2` (`id`),
  UNIQUE KEY `id_3` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `category`, `fine`) VALUES
(0, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 0),
(1, 'prom', '123', 0, 0),
(43, 'sfafvas', 'f7177163c833dff4b38f', 1, 0),
(100, 'pagol', '0ee7bac38f62a0f3ae2387973e190cf2', 0, 0),
(99, 'gogo', 'gogo', 0, 0),
(98, 'agag', '8cf2ef962c670c16adac390035233d4f', 0, 0),
(30, 'nabid', '21232f297a57a5a743894a0e4a801fc3', 1, 367),
(44, 'shurid', '202cb962ac59075b964b', 1, 0),
(45, 'riyan', 'ba4e586503b7cb15e2b5', 1, 0),
(46, 'hillol', '587b87fa48138841cb94', 1, 0),
(33, 'pikachu', '21232f297a57a5a743894a0e4a801fc3', 0, 0),
(47, 'hello', 'world', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
