-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2019 at 09:39 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Langy`
--

-- --------------------------------------------------------

--
-- Table structure for table `Account`
--

CREATE TABLE `Account` (
  `Username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `bankcard` bigint(16) UNSIGNED NOT NULL,
  `pin` int(4) UNSIGNED NOT NULL,
  `Bookid` mediumint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Account`
--

INSERT INTO `Account` (`Username`, `password`, `bankcard`, `pin`, `Bookid`) VALUES
('admin', 'admin', 1111222233334444, 1234, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `Account_Book`
--

CREATE TABLE `Account_Book` (
  `Username` varchar(30) NOT NULL,
  `Bookid` mediumint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Account_Book`
--

INSERT INTO `Account_Book` (`Username`, `Bookid`) VALUES
('admin', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `Book`
--

CREATE TABLE `Book` (
  `Bookid` mediumint(5) UNSIGNED NOT NULL,
  `Title` varchar(30) NOT NULL,
  `Author` varchar(30) NOT NULL,
  `Genre` varchar(30) NOT NULL,
  `ReadingLevel` varchar(10) NOT NULL,
  `Description` text NOT NULL,
  `Text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Book`
--

INSERT INTO `Book` (`Bookid`, `Title`, `Author`, `Genre`, `ReadingLevel`, `Description`, `Text`) VALUES
(1000, 'Alice in the WonderLand', 'Lewis Carroll', 'Fairy Tale', 'Medium', 'Alice is the main character of the story “Alice’s Adventures in Wonderland” and the sequel “Through the Looking Glass and what Alice found there”.\r\n\r\nShe is a seven-year-old English girl with lots of imagination and is fond of showing off her knowledge. Alice is polite, well raised and interested in others, although she sometimes makes the wrong remarks and upsets the creatures in Wonderland. She is easily put off by abruptness and rudeness of others.\r\n\r\nIn Through the Looking Glass, she is 6 months older and more sure of her identity.', 'Random Text');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`Username`),
  ADD KEY `Bookid` (`Bookid`);

--
-- Indexes for table `Book`
--
ALTER TABLE `Book`
  ADD PRIMARY KEY (`Bookid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Account`
--
ALTER TABLE `Account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`Bookid`) REFERENCES `Book` (`Bookid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
