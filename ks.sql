-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 02, 2018 at 11:51 PM
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
  `user` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expert`
--

CREATE TABLE `expert` (
  `eid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(64) NOT NULL,
  `phno` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expert`
--

INSERT INTO `expert` (`eid`, `name`, `password`, `phno`) VALUES
(25, 'Namita', 'a3f390d88e4c41f2747bfa2f1b5f87db', 68),
(501, 'qw', '76d80224611fc919a5d54f0ff9fba446', 123);

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `fid` int(11) NOT NULL,
  `phno` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`fid`, `phno`, `name`, `password`) VALUES
(5, 654, 'Ankit', 'caf1a3dfb505ffed0d024130f58c5cfa'),
(7, 9167044242, 'namrata', 'd8578edf8458ce06fbc5bb76a58c5ca4');

-- --------------------------------------------------------

--
-- Table structure for table `q`
--

CREATE TABLE `q` (
  `qid` varchar(30) NOT NULL,
  `fid` int(11) NOT NULL,
  `solved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `q`
--

INSERT INTO `q` (`qid`, `fid`, `solved`) VALUES
('5b12e77123c4c3.51598696.txt', 7, 0);

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
  `eid` int(11) NOT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `tags_q`
--

CREATE TABLE `tags_q` (
  `tags` varchar(64) NOT NULL,
  `qid` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags_q`
--

INSERT INTO `tags_q` (`tags`, `qid`) VALUES
('Peter', '40'),
('Ben', '40'),
('Joe', '40'),
('Peter', '41'),
('Loe', '41');

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
  ADD KEY `qid` (`qid`),
  ADD KEY `eid` (`eid`);

--
-- Indexes for table `q_tag`
--
ALTER TABLE `q_tag`
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
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;

--
-- AUTO_INCREMENT for table `farmer`
--
ALTER TABLE `farmer`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  ADD CONSTRAINT `exp_fk_sol` FOREIGN KEY (`eid`) REFERENCES `expert` (`eid`),
  ADD CONSTRAINT `question_qid_fk` FOREIGN KEY (`qid`) REFERENCES `q` (`qid`);

--
-- Constraints for table `q_tag`
--
ALTER TABLE `q_tag`
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
