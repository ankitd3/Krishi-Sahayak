-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2018 at 08:23 AM
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
-- Table structure for table `calender`
--

CREATE TABLE `calender` (
  `month` varchar(32) NOT NULL,
  `north` mediumtext NOT NULL,
  `south` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calender`
--

INSERT INTO `calender` (`month`, `north`, `south`) VALUES
('APRIL', 'Capsicum', 'Onion, Amaranthus, Coriander, Gourds, Okra, Tomato, Chilli'),
('AUGUST', 'Carrot, Cauliflower, Radish, Tomato', 'Carrot, Cauliflower, Beans, Beet'),
('DECEMBER', 'Tomato', 'Lettuce, Pumpkin, Watermelon, Muskmelon, Ash gourd, Ridge gourd, Bitter gourd, Bottle gourd, Cucumber, Chilly, Cabbage,'),
('FEBRUARY', 'Applegourd, Bittergourd, Bottle gourd, Cucumber, French Beans, Okra, Sponge, Gourd, Watermelon, Spinach', 'Lettuce,Spinach, Gourds, Melons, Radish, Carrot, Onion, Tomato,Okra,Brinjal, Bean'),
('JANUARY', 'Brinjal', 'Lettuce,Spinach, Gourds, Melons, Radish, Carrot, Onion, Tomato,Okra,Brinjal, Bean'),
('JULY', 'All gourds, Cucumber, Okra, Sem, Tomato', 'All Gourds, Solanaeceae,Almost all vegetables'),
('JUNE', 'All gourds, Brinjal, Cucumber, Cauliflower (Early), Okra, Onion,Sem,Tomato,Pepper', 'All Gourds, Solanaeceae,Almost all vegetables'),
('MARCH', 'Applegourd, Bittergourd, Bottle gourd, Cucumber, French Beans, Okra, Sponge, Gourd, Watermelon, Spinach', 'Amaranthus, Coriander, Gourds, Beans, Melons, Spinach, Okra'),
('MAY', 'Onion, Pepper, Brinjal', 'Okra, Onion, Chilli'),
('NOVEMBER', 'Turnip, Tomato, Radish, Pepper, Peas, Beet', 'Beet, Eggplant, Cabbage, Carrot, Beans, Lettuce, Melon, Okra, Turnip'),
('OCTOBER', 'Beet, Brinjal, Cabbage, Cauliflower, Lettuce, Peas, Radish, Spinach, Turnip', 'Brinjal, Cabbage,Capsicum,Cucumber, Beans,Peas, Spinach, Turnip, Watermelon'),
('SEPTEMBER', 'Cabbage, Carrot, Cauliflower, Peas, Radish, Tomato, Lettuce', 'Cauliflower, Cucumber, Onion,Peas,Spinach');

-- --------------------------------------------------------

--
-- Table structure for table `cimgtext`
--

CREATE TABLE `cimgtext` (
  `img_id` varchar(30) NOT NULL,
  `text_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cimgtext`
--

INSERT INTO `cimgtext` (`img_id`, `text_id`) VALUES
('5b16e4fb3c32e7.35136183.jpg', '5b16e4fb3d06f1.02358913.txt');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `qid` varchar(30) NOT NULL,
  `cid` varchar(30) NOT NULL,
  `user` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`qid`, `cid`, `user`) VALUES
('5b16e4bb2ec244.62675139.jpg', '5b16e4fb3c32e7.35136183.jpg', 'Ankit');

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
(7, 9167044242, 'namrata', 'd8578edf8458ce06fbc5bb76a58c5ca4'),
(8, 89, 'Anuj', '7647966b7343c29048673252e490f736'),
(9, 6, 'Ank', '1679091c5a880faf6fb5e6087eb1b2dc');

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
('5b16e4bb2ec244.62675139.jpg', 8, 1),
('5b16e57de2ae87.42363661.txt', 8, 0),
('5b16e5b588e7c1.02807596.txt', 5, 0),
('5b16e5d4c68729.24569565.txt', 5, 1),
('5b16e673893bb2.34943793.txt', 8, 0),
('5b16e6e0364f94.05604740.txt', 8, 0);

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
('5b16e4bb2ec244.62675139.jpg', '5b16e4bb2f7e30.22706380.txt');

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
-- Dumping data for table `qs`
--

INSERT INTO `qs` (`qid`, `sid`, `eid`) VALUES
('5b16e4bb2ec244.62675139.jpg', '5b16e7687e8116.02861596.jpg', 25),
('5b16e5d4c68729.24569565.txt', '5b18c1f9871ff3.97923967.png', 25);

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
  `tag` varchar(100) NOT NULL,
  `qid` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `q_tag`
--

INSERT INTO `q_tag` (`tag`, `qid`) VALUES
('seeds,sow,basis,', '5b16e4bb2ec244.62675139.jpg'),
('water,man,area,', '5b16e57de2ae87.42363661.txt'),
('move forward,madman,water,', '5b16e5b588e7c1.02807596.txt'),
('water,man,field,', '5b16e5d4c68729.24569565.txt'),
('water,man,&#,', '5b16e673893bb2.34943793.txt'),
('water man,', '5b16e6e0364f94.05604740.txt');

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
('5b16e7687e8116.02861596.jpg', '5b16e7687f9927.18899913.txt'),
('5b18c1f9871ff3.97923967.png', '5b18c1f9882b09.32478678.txt');

-- --------------------------------------------------------

--
-- Table structure for table `star`
--

CREATE TABLE `star` (
  `qid` varchar(50) NOT NULL,
  `fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag`) VALUES
('rabbi crop'),
('delhi'),
('weather'),
('bangkok'),
('mp satna'),
('irrigation requirement'),
('crop'),
('seed rises'),
('living'),
('delhi'),
('wheat crop'),
('decided'),
('delhi'),
('wheat crop'),
('decided'),
('delhi'),
('fertile seed'),
('wheat crop'),
('wheat'),
('tidal crop'),
('yellowish worm'),
('field'),
('answer'),
('delhi farmers'),
('beach rises'),
('delhi'),
('kind'),
('eat rice'),
('rainy season'),
('crop'),
('sow'),
('water'),
('field'),
('wheat crop'),
('harvested'),
('wheat crop'),
('harvested'),
('chicken diner'),
('hear'),
('dinner'),
('compost'),
('lacking'),
('farm'),
('seeds'),
('sow'),
('basis'),
('water'),
('man'),
('area'),
('move forward'),
('madman'),
('water'),
('water'),
('man'),
('field'),
('water'),
('man'),
('&#'),
('water man');

-- --------------------------------------------------------

--
-- Table structure for table `vps`
--

CREATE TABLE `vps` (
  `plantID` int(11) NOT NULL,
  `plant` text NOT NULL,
  `inchBwPlants` varchar(11) NOT NULL,
  `depthOfSeed` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vps`
--

INSERT INTO `vps` (`plantID`, `plant`, `inchBwPlants`, `depthOfSeed`) VALUES
(1, 'Asparagus', '43452', '01-Feb\r'),
(2, 'Beans, Broad', '43322', '1-1.5\r'),
(3, 'Beans, Lima bush pole', '2-3 4-6', '1-1.5 1-1.5\r'),
(4, 'Beans, Snap or Green bush pole', '2-3 4-6', '1-1.5 1-1.5\r'),
(5, 'Beetroot', '43134', '1\r'),
(6, 'Broccoli', '24', '1.5\r'),
(7, 'Brussels Sprouts', '24', '0.25\r'),
(8, 'Cabbage', '18-24', '0.25\r'),
(9, 'Carrot', '4', '0.25\r'),
(10, 'Cauliflower', '18-24', '0.5\r'),
(11, 'Celery', '43322', '0.25\r'),
(12, 'Chard', '43260', '0.5\r'),
(13, 'Chayote', '30', '05-Jun\r'),
(14, 'Chick pea', '43259', '0.5\r'),
(15, 'Chicory', '43452', '0.5\r'),
(16, 'Chinese Cabbage', '18', '0.5\r'),
(17, 'Collards', '12', '0.5\r'),
(18, 'Corn', '12', '1-1.5\r'),
(19, 'Cucumber', '12', '0.5\r'),
(20, 'Eggplant', '18-24', '0.25\r'),
(21, 'Endive', '43355', '0.25\r'),
(22, 'Horseradish', '24', '0.25\r'),
(23, 'Kale', '12', '0.5\r'),
(24, 'Kohlrabi', '8', '0.25\r'),
(25, 'Leek', '43260', 'Surface sow, cover it lightly\r\n'),
(43, 'Squash, Winter', '24-48', '1\r'),
(44, 'Tomato', '24', '0.25\r'),
(45, 'Watermelon', '24-72', '1\r');

-- --------------------------------------------------------

--
-- Table structure for table `yieldperhectare`
--

CREATE TABLE `yieldperhectare` (
  `cropID` int(11) NOT NULL,
  `crop` text NOT NULL,
  `yh` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `yieldperhectare`
--

INSERT INTO `yieldperhectare` (`cropID`, `crop`, `yh`) VALUES
(2, 'Cereals', '1841'),
(3, 'Pulses', '602'),
(4, 'Rice', '1913'),
(5, 'Foodgrains', '1606'),
(6, 'Jowar', '828'),
(7, 'Maize', '1952'),
(8, 'Bajra', '828'),
(9, 'Gram', '795'),
(10, 'Tur', '690'),
(11, 'Groundnut', '1087'),
(12, 'Cotton', '326'),
(13, 'Jute', '2000'),
(14, 'Mesta', '1040'),
(15, 'Tea ', '1625'),
(16, 'Coffee ', '795'),
(17, 'Rubber ', '1148'),
(18, 'Potato', '1820');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calender`
--
ALTER TABLE `calender`
  ADD PRIMARY KEY (`month`);

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
  ADD UNIQUE KEY `qid` (`qid`);

--
-- Indexes for table `simgtext`
--
ALTER TABLE `simgtext`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `img_id` (`img_id`);

--
-- Indexes for table `star`
--
ALTER TABLE `star`
  ADD KEY `qid` (`qid`),
  ADD KEY `fid` (`fid`);

--
-- Indexes for table `vps`
--
ALTER TABLE `vps`
  ADD PRIMARY KEY (`plantID`);

--
-- Indexes for table `yieldperhectare`
--
ALTER TABLE `yieldperhectare`
  ADD PRIMARY KEY (`cropID`);

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
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `yieldperhectare`
--
ALTER TABLE `yieldperhectare`
  MODIFY `cropID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  ADD CONSTRAINT `tag_qid` FOREIGN KEY (`qid`) REFERENCES `q` (`qid`);

--
-- Constraints for table `simgtext`
--
ALTER TABLE `simgtext`
  ADD CONSTRAINT `s_img_text_fk` FOREIGN KEY (`img_id`) REFERENCES `qs` (`sid`);

--
-- Constraints for table `star`
--
ALTER TABLE `star`
  ADD CONSTRAINT `fid_star_fk` FOREIGN KEY (`fid`) REFERENCES `farmer` (`fid`),
  ADD CONSTRAINT `qid_star_fk` FOREIGN KEY (`qid`) REFERENCES `q` (`qid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
