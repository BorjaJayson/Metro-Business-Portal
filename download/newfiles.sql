-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2017 at 04:44 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydata`
--

-- --------------------------------------------------------

--
-- Table structure for table `newfiles`
--

CREATE TABLE `newfiles` (
  `id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `type` varchar(40) NOT NULL DEFAULT 'application/octet-stream',
  `description` varchar(100) NOT NULL DEFAULT 'File Transfer',
  `disposition` varchar(20) NOT NULL DEFAULT 'attachment',
  `expires` varchar(10) NOT NULL DEFAULT '0',
  `cache` varchar(20) NOT NULL DEFAULT 'must-revalidate',
  `pragma` varchar(10) NOT NULL DEFAULT 'public'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newfiles`
--

INSERT INTO `newfiles` (`id`, `filename`, `type`, `description`, `disposition`, `expires`, `cache`, `pragma`) VALUES
(1, 'archive.zip', 'application/octet-stream', 'File Transfer', 'attachment', '0', 'must-revalidate', 'public'),
(2, 'cat.png', 'application/octet-stream', 'File Transfer', 'attachment', '0', 'must-revalidate', 'public'),
(3, 'document.pdf', 'application/octet-stream', 'File Transfer', 'attachment', '0', 'must-revalidate', 'public'),
(4, 'video.mp4', 'application/octet-stream', 'File Transfer', 'attachment', '0', 'must-revalidate', 'public');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `newfiles`
--
ALTER TABLE `newfiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `newfiles`
--
ALTER TABLE `newfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
