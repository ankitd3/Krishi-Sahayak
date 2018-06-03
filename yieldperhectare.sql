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
-- Indexes for table `yieldperhectare`
--
ALTER TABLE `yieldperhectare`
  ADD PRIMARY KEY (`cropID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `yieldperhectare`
--
ALTER TABLE `yieldperhectare`
  MODIFY `cropID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
