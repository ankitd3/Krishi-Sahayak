-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 26, 2018 at 07:06 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ks`
--

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `fid` int(11) NOT NULL,
  `phno` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`fid`, `phno`, `name`, `password`) VALUES
(1, 9167634684, 'Chippy', 'namita');

-- --------------------------------------------------------

--
-- Table structure for table `q`
--

CREATE TABLE `q` (
  `qid` varchar(30) NOT NULL,
  `fid` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `q`
--

INSERT INTO `q` (`qid`, `fid`) VALUES
('5b0970268df125.39861510.mp3', 1),
('5b0993baa24c01.10087531.mp3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `qimgtext`
--

CREATE TABLE `qimgtext` (
  `img_id` varchar(30) NOT NULL,
  `text_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qimgtext`
--

INSERT INTO `qimgtext` (`img_id`, `text_id`) VALUES
('5b0970268df125.39861510.mp3', '5b0970268e8064.48918637.txt');

-- --------------------------------------------------------

--
-- Table structure for table `qs`
--

CREATE TABLE `qs` (
  `qid` varchar(30) NOT NULL,
  `sid` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qs`
--

INSERT INTO `qs` (`qid`, `sid`) VALUES
('5b0970268df125.39861510.mp3', '5b0970a333fa49.52985219.jpg'),
('5b0970268df125.39861510.mp3', '5b0973c353c3f2.96081455.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `simgtext`
--

CREATE TABLE `simgtext` (
  `img_id` varchar(30) NOT NULL,
  `text_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simgtext`
--

INSERT INTO `simgtext` (`img_id`, `text_id`) VALUES
('5b0970a333fa49.52985219.jpg', '5b0970a3345768.40441358.txt'),
('5b0973c353c3f2.96081455.jpg', '5b0973c3544f93.89224852.txt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`fid`),
  ADD UNIQUE KEY `phno` (`phno`);

--
-- Indexes for table `q`
--
ALTER TABLE `q`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `fid` (`fid`);

--
-- Indexes for table `qimgtext`
--
ALTER TABLE `qimgtext`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `img_id` (`img_id`);

--
-- Indexes for table `qs`
--
ALTER TABLE `qs`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `qid` (`qid`);

--
-- Indexes for table `simgtext`
--
ALTER TABLE `simgtext`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `img_id` (`img_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `farmer`
--
ALTER TABLE `farmer`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `q`
--
ALTER TABLE `q`
  ADD CONSTRAINT `farmer_id_fk` FOREIGN KEY (`fid`) REFERENCES `farmer` (`fid`);

--
-- Constraints for table `qimgtext`
--
ALTER TABLE `qimgtext`
  ADD CONSTRAINT `image_text_fk` FOREIGN KEY (`img_id`) REFERENCES `q` (`qid`);

--
-- Constraints for table `qs`
--
ALTER TABLE `qs`
  ADD CONSTRAINT `question_qid_fk` FOREIGN KEY (`qid`) REFERENCES `q` (`qid`);

--
-- Constraints for table `simgtext`
--
ALTER TABLE `simgtext`
  ADD CONSTRAINT `s_img_text_fk` FOREIGN KEY (`img_id`) REFERENCES `qs` (`sid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
