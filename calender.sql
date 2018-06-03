-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2018 at 07:26 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calender`
--
ALTER TABLE `calender`
  ADD PRIMARY KEY (`month`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
