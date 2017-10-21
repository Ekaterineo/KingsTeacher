-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2017 at 10:55 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teacher`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions_deleted`
--

CREATE TABLE `questions_deleted` (
  `id` int(11) NOT NULL,
  `subject` int(11) NOT NULL,
  `topic` int(6) NOT NULL,
  `subtopic` int(11) NOT NULL,
  `sch_topic` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `statement` blob NOT NULL,
  `choices` blob NOT NULL,
  `axsna` text COLLATE utf32_unicode_ci NOT NULL,
  `qrnk` tinyint(4) NOT NULL,
  `class` int(11) NOT NULL,
  `gdxdl` tinyint(4) NOT NULL,
  `author` int(11) NOT NULL,
  `addedTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions_deleted`
--
ALTER TABLE `questions_deleted`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions_deleted`
--
ALTER TABLE `questions_deleted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
