-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 31, 2018 at 01:51 PM
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
-- Table structure for table `cimgtext`
--

CREATE TABLE `cimgtext` (
  `img_id` varchar(30) NOT NULL,
  `text_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `qid` varchar(30) NOT NULL,
  `cid` varchar(30) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '99'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expert`
--

CREATE TABLE `expert` (
  `eid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expert`
--

INSERT INTO `expert` (`eid`, `name`) VALUES
(21, 'Expert1');

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
(1, 9167634684, 'Anuj', 'namita');

-- --------------------------------------------------------

--
-- Table structure for table `q`
--

CREATE TABLE `q` (
  `qid` varchar(30) NOT NULL,
  `fid` int(11) NOT NULL DEFAULT '1',
  `solved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `q`
--

INSERT INTO `q` (`qid`, `fid`, `solved`) VALUES
('5b0f9fb4004648.55800097.txt', 1, 0),
('5b0faf35cfb8a6.00483659.txt', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `qimgtext`
--

CREATE TABLE `qimgtext` (
  `img_id` varchar(30) NOT NULL,
  `text_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qs`
--

CREATE TABLE `qs` (
  `qid` varchar(30) NOT NULL,
  `sid` varchar(30) NOT NULL,
  `eid` int(11) NOT NULL DEFAULT '21'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `qs`
--
DELIMITER $$
CREATE TRIGGER `solve` AFTER INSERT ON `qs` FOR EACH ROW UPDATE q
SET q.solved = 1
WHERE q.qid = NEW.qid
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `q_tag`
--

CREATE TABLE `q_tag` (
  `tag` varchar(10) NOT NULL,
  `qid` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `q_tag`
--

INSERT INTO `q_tag` (`tag`, `qid`) VALUES
('Crop', '5b0f9fb4004648.55800097.txt'),
('Soil', '5b0f9fb4004648.55800097.txt');

-- --------------------------------------------------------

--
-- Table structure for table `simgtext`
--

CREATE TABLE `simgtext` (
  `img_id` varchar(30) NOT NULL,
  `text_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag`) VALUES
('Crop'),
('Fruits'),
('Seeds'),
('Soil'),
('Weather');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cimgtext`
--
ALTER TABLE `cimgtext`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `img_id` (`img_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `qid` (`qid`);

--
-- Indexes for table `expert`
--
ALTER TABLE `expert`
  ADD PRIMARY KEY (`eid`);

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
-- Indexes for table `q_tag`
--
ALTER TABLE `q_tag`
  ADD KEY `qid` (`qid`),
  ADD KEY `tag` (`tag`);

--
-- Indexes for table `simgtext`
--
ALTER TABLE `simgtext`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `img_id` (`img_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expert`
--
ALTER TABLE `expert`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `farmer`
--
ALTER TABLE `farmer`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cimgtext`
--
ALTER TABLE `cimgtext`
  ADD CONSTRAINT `comments_img_text_fk` FOREIGN KEY (`img_id`) REFERENCES `comments` (`cid`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_question_fk` FOREIGN KEY (`qid`) REFERENCES `q` (`qid`);

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
-- Constraints for table `q_tag`
--
ALTER TABLE `q_tag`
  ADD CONSTRAINT `q_tag_fk` FOREIGN KEY (`qid`) REFERENCES `q` (`qid`),
  ADD CONSTRAINT `tag_fk` FOREIGN KEY (`tag`) REFERENCES `tags` (`tag`);

--
-- Constraints for table `simgtext`
--
ALTER TABLE `simgtext`
  ADD CONSTRAINT `s_img_text_fk` FOREIGN KEY (`img_id`) REFERENCES `qs` (`sid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
