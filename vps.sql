-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2018 at 07:25 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vps`
--
ALTER TABLE `vps`
  ADD PRIMARY KEY (`plantID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
