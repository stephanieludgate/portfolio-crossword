-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 06, 2020 at 02:20 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipd19`
--

-- --------------------------------------------------------

--
-- Table structure for table `project_crossword`
--

CREATE TABLE `project_crossword` (
  `id` int(11) NOT NULL,
  `start_pos` int(11) NOT NULL,
  `direction` char(1) NOT NULL,
  `clue` varchar(200) NOT NULL,
  `answer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_crossword`
--

INSERT INTO `project_crossword` (`id`, `start_pos`, `direction`, `clue`, `answer`) VALUES
(1, 1, 'd', 'A soft, comfortable kind of shoe worn indoors', 'slipper'),
(2, 2, 'a', 'The opposite of strong', 'weak'),
(3, 2, 'd', 'The time when two people get married', 'wedding'),
(4, 3, 'd', 'Write someone\'s name and _ on an envelope', 'address'),
(5, 4, 'a', 'A sky colour', 'blue'),
(6, 5, 'a', 'Creatures that make webs to catch insects', 'spiders'),
(7, 6, 'a', 'A bird builds this', 'nest'),
(8, 7, 'a', 'A green animal that croaks', 'frog');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project_crossword`
--
ALTER TABLE `project_crossword`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `project_crossword`
--
ALTER TABLE `project_crossword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
