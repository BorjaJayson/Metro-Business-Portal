-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2019 at 06:03 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.0.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone42`
--

-- --------------------------------------------------------

--
-- Table structure for table `business_table`
--

CREATE TABLE `business_table` (
  `Business_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Business_Name` text NOT NULL,
  `Business_Size` int(11) NOT NULL,
  `Business_Type` varchar(255) NOT NULL,
  `Business_Loc` varchar(255) NOT NULL,
  `Date_Add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Business_Remarks` varchar(255) NOT NULL,
  `Business_Brgy` varchar(255) NOT NULL,
  `Business_Mncipal` varchar(255) NOT NULL,
  `Business_Region` varchar(255) NOT NULL,
  `Business_Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_table`
--

INSERT INTO `business_table` (`Business_ID`, `User_ID`, `Business_Name`, `Business_Size`, `Business_Type`, `Business_Loc`, `Date_Add`, `Business_Remarks`, `Business_Brgy`, `Business_Mncipal`, `Business_Region`, `Business_Status`) VALUES
(18, 7, 'Kimmys Fried Chicken', 1, 'Manufacturing', 'Kasambagan, Banilad, Cebu City', '2019-02-24 22:04:38', '', 'Zapatera', 'Cebu City', 'REGION7', 'approve'),
(27, 64, 'Rodrigos Kitchen', 10, 'Manufacturing', 'Cebu City, Cebu', '2019-03-17 00:43:20', '', 'Panagdait', 'Cebu City', 'REGION7', 'pending'),
(33, 65, 'Shergen Beauty Care', 5, 'Services', 'Hipodromo, Cebu City', '2019-03-18 15:13:27', '', 'Hipodromo', 'Cebu City', 'REGION7', 'pending'),
(41, 68, 'Retorika', 15, 'Services', 'Ramos, Cebu City', '2019-03-23 03:37:50', '', 'Fuente', 'Cebu City', 'REGION7', 'approve'),
(42, 62, 'The Secret Shop', 2, 'Services', 'MJ Cuenco Ave., Jones', '2019-03-23 04:29:59', '', 'Jones', 'Cebu City', 'REGION7', 'pending'),
(45, 77, 'JP Morgan', 200, 'Services', 'IT Park District, Lahug, Cebu City', '2019-03-24 16:58:40', '', 'Lahug ', 'Cebu City', 'REGION7', 'approve'),
(46, 79, 'Jonels eatery', 8, 'Manufacturing', 'Mabolo ', '2019-03-26 22:53:34', '', 'Mabolo ', 'Cebu City', 'REGION7', 'pending'),
(47, 7, 'King Bread Manufacturing', 5, 'Manufacturing', 'Cabantan St., Mabolo,  Cebu City', '2019-03-27 18:24:24', '', 'Mabolo', 'Cebu City', 'REGION7', 'pending'),
(48, 80, 'Big Mao Restaurant', 25, 'Services', 'Ayala District, Cebu City, Cebu', '2019-03-27 22:19:40', '', 'Ayala', 'Cebu City', 'REGION7', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `hd_table`
--

CREATE TABLE `hd_table` (
  `hd_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `_subject` varchar(100) NOT NULL,
  `_message` text NOT NULL,
  `_status` varchar(30) NOT NULL,
  `date_added` datetime NOT NULL,
  `_read` int(11) NOT NULL,
  `_to` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hd_table`
--

INSERT INTO `hd_table` (`hd_ID`, `user_ID`, `_subject`, `_message`, `_status`, `date_added`, `_read`, `_to`) VALUES
(23, 7, 'Message to LGU', 'qwert', 'read', '2019-02-26 02:37:19', 1, 'dti.gov@mbp.com'),
(25, 7, 'Message to BIR', 'Eureka', 'read', '2019-02-26 02:40:01', 1, 'bir.gov@mbp.com'),
(26, 64, 'BIR Form Request', 'Duly Noted, Thank You.', 'read', '2019-03-01 02:16:35', 1, 'dti.gov@mbp.com'),
(27, 7, 'from Ate Fayie', 'Greetings Human!', 'read', '2019-03-06 23:59:22', 1, 'nikkoaballe@gmail.com'),
(28, 7, 'from Ate Fayie', 'Greetings!', 'unread', '2019-03-07 00:33:35', 0, 'nikkoaballe@gmail.com'),
(37, 7, 'BLABLAL', 'BLA blA ', 'read', '2019-03-09 18:45:31', 1, 'lgu.gov@mbp.com'),
(42, 67, 'EOD', 'HI', 'unread', '2019-03-13 13:06:31', 0, 'lgu.gov@mbp.com'),
(43, 67, 'EOD', 'HELLO POD', 'unread', '2019-03-13 13:07:15', 0, 'bir.gov@mbp.com'),
(47, 68, 'Test to DTI', 'Those are Minerals!', 'unread', '2019-03-23 04:25:56', 0, 'dti.gov@mbp.com'),
(48, 79, 'testform1', 'mana gaw palihog approve', 'read', '2019-03-26 22:58:58', 1, 'dti.gov@mbp.com');

-- --------------------------------------------------------

--
-- Table structure for table `information_table`
--

CREATE TABLE `information_table` (
  `Information_ID` int(11) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Middlename` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Birthdate` date NOT NULL,
  `Contact_no` varchar(11) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `information_table`
--

INSERT INTO `information_table` (`Information_ID`, `Firstname`, `Middlename`, `Lastname`, `Birthdate`, `Contact_no`, `Address`, `Gender`, `birthplace`, `nationality`, `religion`, `civil_status`, `_status`) VALUES
(1, 'Nikko', 'Belangel', 'Aballe', '1999-02-09', '2312881', 'Regla St. Mabolo, Cebu City', 'male', 'Cebu City', 'Filipino', 'Christian', 'Single', 'active'),
(2, 'Maria', 'Dela ', 'Cruz', '2019-02-14', '2339523', 'Parian, Cebu', 'female', 'Cebu City', 'Filipino', 'Christian', 'Married', 'active'),
(17, 'John', 'Meyer', 'Werner', '1970-01-01', '3996592', 'Cebu City, Cebu', 'male', 'Osborn, Cebu', 'Foreign', 'None', 'Single', 'active'),
(18, 'Mark', 'Pestolante', 'Martinez', '1970-01-01', '09051123331', 'Cebu City, Cebu', 'male', 'Tubigon, Bohol', 'Filipino', 'Christian', 'Married', 'active'),
(19, 'Justine ', 'Belangel', 'Aballe', '1970-11-12', '09112355123', 'Lahug, Cebu City', 'male', 'Lahug, Cebu City', 'Filipino', 'Christian', 'Single', 'active'),
(22, 'Edna', 'Belangel', 'Aballe', '1960-11-13', '09428882233', 'Cebu City', 'female', 'Illigan City', 'Filipino', 'Christian', 'Widowed', 'active'),
(24, 'Kim', 'Sipalay', 'Intud', '1970-01-01', '09231125522', 'Kasambagan, Cebu City', 'female', 'Masbate', 'Filipino', 'Christian', 'Single', 'active'),
(41, 'Maricel', 'Armenos', 'Cajes', '2002-02-09', '09529993332', 'Cebu City', 'male', 'Mandaue City', 'Filipino', 'Christian', 'Single', 'active'),
(42, 'Mark', 'Protacio', 'Ward', '2003-12-04', '09426107897', 'Cebu City', 'female', 'Cebu City', 'Filipino', 'Christian', 'Married', 'active'),
(43, 'Robert', 'Belangel', 'Aballe', '1990-04-26', '09421122296', 'Cebu City', 'male', 'Cebu City', 'Filipino', 'Christian', 'Single', 'active'),
(44, 'Asdasd', 'Asdsad', 'Asdasdsa', '1997-01-30', '09421125000', 'Cebu', 'female', 'Bohol', 'Filipjno', 'Christian', 'Married', 'active'),
(45, 'Rodrigo', 'Roa', 'Dela Cruz', '1980-01-31', '09421125000', 'Cebu City', 'male', 'Davao City', 'Filipino', 'Christian', 'Divorced', 'active'),
(46, 'Shergen', 'Grace', 'Colina', '1996-02-28', '09441122333', 'Cebu City', 'female', 'Cebu City', 'Filipino', 'Christian', 'Single', 'active'),
(47, 'Fayie', 'Jemino', 'Mojado', '1991-02-14', '09422233311', 'Cebu City', 'female', 'Cebu City', 'Filipino', 'Christian', 'Single', 'active'),
(48, 'Jayson', 'Imus', 'Borja', '1997-03-08', '09168746532', 'Cebu City', 'male', 'Cebu City', 'Filipino', 'Christian', 'Single', 'active'),
(49, 'Rix', 'Ambot', 'Kahimat', '1999-12-03', '09422233311', 'Cebu City', 'male', 'Cebu City', 'Filipino', 'Christian', 'Single', 'active'),
(79, 'Gwyneth', 'Alliana', 'Cervantes', '1995-06-22', '09692235521', 'Cebu City, Cebu', 'female', 'Davao City, Cebu', 'Filipino', 'Christian', 'Single', 'active'),
(80, 'Asdasd', 'Dasdasd', 'Asdasd', '2019-03-28', '01924102412', 'Dasdasd', 'male', 'Asdad', 'Asdasdad', 'Asdasdasd', 'Single', 'active'),
(81, 'Alcala', 'Mai', 'Alcapones', '1998-12-10', '09426996155', 'Cebu City ', 'female', 'Danao City', 'Filipino', 'Protestant', 'Single', 'active'),
(84, 'Nikko', 'Belangel', 'Aballe', '1998-12-10', '09426107897', 'Cebu City, Cebu', 'male', 'Carmen', 'Filipino', 'Christian', 'Single', 'active'),
(85, 'Asdasd', 'Asdasd', 'Asdasd', '1998-12-13', '09426107897', 'Dadasdasd', 'male', 'Sads', 'Asdasdd', 'Asdasdasd', 'Widowed', 'active'),
(89, 'Lecit', 'Karma', 'Brevis', '2001-03-26', '09421112000', 'Cebu City, Cebu', 'male', 'Cebu City, Cebu', 'Filipino', 'Christian', 'Married', 'active'),
(90, 'Barbie', 'Jonel', 'Borja', '1996-02-20', '09422233311', 'Canduman Mandaue City', 'male', 'I.t Park', 'Filipino', 'Aloha Snackbar', 'Divorced', 'active'),
(91, 'Ketchel', 'Maltese', 'Khant', '2019-03-28', '09422232003', 'Cebu City', 'male', 'Shanghai China', 'Chinese', 'None', 'Single', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `progress_table`
--

CREATE TABLE `progress_table` (
  `Progress_ID` int(11) NOT NULL,
  `Business_ID` int(11) NOT NULL,
  `Progress_Status` varchar(255) NOT NULL,
  `Progress_Remarks` varchar(255) NOT NULL,
  `Progress_By` int(11) NOT NULL,
  `Progress_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progress_table`
--

INSERT INTO `progress_table` (`Progress_ID`, `Business_ID`, `Progress_Status`, `Progress_Remarks`, `Progress_By`, `Progress_Date`) VALUES
(127, 45, 'approve_BNRegister', 'complete', 4, '2019-03-24 17:53:13'),
(128, 45, 'approve_BNVerify', 'complete', 4, '2019-03-24 17:53:45'),
(129, 45, 'approve_All', 'complete', 4, '2019-03-24 17:53:45'),
(130, 45, 'approve_brgyBusPerm', 'complete', 3, '2019-03-24 17:54:08'),
(131, 45, 'approve_MunBusPerm', 'complete', 3, '2019-03-24 17:54:08'),
(132, 45, 'approve_AllLGU', 'complete', 3, '2019-03-24 17:54:08'),
(133, 45, 'approve_1901', 'complete', 2, '2019-03-24 17:54:40'),
(134, 45, 'approve_0605', 'complete', 2, '2019-03-24 17:54:40'),
(135, 45, 'approve_2000', 'complete', 2, '2019-03-24 17:54:40'),
(136, 18, 'approve_BNRegister', 'complete', 4, '2019-03-24 18:45:08'),
(137, 18, 'approve_All', 'complete', 4, '2019-03-24 18:45:30'),
(140, 18, 'approve_BNVerify', 'complete', 4, '2019-03-24 18:47:04'),
(141, 18, 'approve_brgyBusPerm', 'complete', 3, '2019-03-24 18:47:43'),
(142, 18, 'approve_MunBusPerm', 'complete', 3, '2019-03-24 18:47:53'),
(143, 18, 'approve_AllLGU', 'complete', 3, '2019-03-24 18:48:03'),
(144, 18, 'approve_1901', 'complete', 2, '2019-03-24 18:48:38'),
(145, 18, 'approve_0605', 'complete', 2, '2019-03-24 18:48:46'),
(146, 18, 'approve_2000', 'complete', 2, '2019-03-24 18:48:46'),
(147, 27, 'approve_BNRegister', 'complete', 4, '2019-03-24 18:50:35'),
(148, 27, 'approve_BNVerify', 'complete', 4, '2019-03-24 18:50:35'),
(149, 27, 'approve_1901', 'complete', 2, '2019-03-24 18:51:15'),
(150, 41, 'approve_1901', 'complete', 2, '2019-03-24 18:57:36'),
(151, 41, 'approve_0605', 'complete', 2, '2019-03-24 18:57:36'),
(152, 41, 'approve_2000', 'complete', 2, '2019-03-24 18:57:36'),
(153, 41, 'approve_brgyBusPerm', 'complete', 3, '2019-03-24 18:58:41'),
(154, 41, 'approve_MunBusPerm', 'complete', 3, '2019-03-24 18:58:41'),
(155, 41, 'approve_AllLGU', 'complete', 3, '2019-03-24 18:58:42'),
(156, 41, 'approve_BNRegister', 'complete', 4, '2019-03-24 19:00:29'),
(157, 41, 'approve_BNVerify', 'complete', 4, '2019-03-24 19:00:29'),
(158, 41, 'approve_All', 'complete', 4, '2019-03-24 19:00:53'),
(159, 46, 'approve_BNRegister', 'complete', 4, '2019-03-26 23:05:48'),
(160, 46, 'approve_BNVerify', 'complete', 4, '2019-03-26 23:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `requirement_table`
--

CREATE TABLE `requirement_table` (
  `id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `type` varchar(40) NOT NULL DEFAULT 'application/octet-stream',
  `description` varchar(100) NOT NULL DEFAULT 'File Transfer',
  `disposition` varchar(20) NOT NULL DEFAULT 'attachment',
  `expires` varchar(10) NOT NULL DEFAULT '0',
  `cache` varchar(20) NOT NULL DEFAULT 'must-revalidate',
  `pragma` varchar(10) NOT NULL DEFAULT 'public',
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requirement_table`
--

INSERT INTO `requirement_table` (`id`, `filename`, `type`, `description`, `disposition`, `expires`, `cache`, `pragma`, `status`) VALUES
(1, 'DTI_BNForm.pdf', 'application/octet-stream', 'File Transfer', 'attachment', '0', 'must-revalidate', 'public', ''),
(2, 'CH_TriplicateBusRegForm.pdf', 'application/octet-stream', 'File Transfer', 'attachment', '0', 'must-revalidate', 'public', ''),
(3, 'BIR_2000.pdf', 'application/octet-stream', 'File Transfer', 'attachment', '0', 'must-revalidate', 'public', ''),
(4, 'BIR_1901.pdf', 'application/octet-stream', 'File Transfer', 'attachment', '0', 'must-revalidate', 'public', ''),
(5, 'BIR_0605.pdf', 'application/octet-stream', 'File Transfer', 'attachment', '0', 'must-revalidate', 'public', '');

-- --------------------------------------------------------

--
-- Table structure for table `send_table`
--

CREATE TABLE `send_table` (
  `send_id` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `_sub` varchar(100) NOT NULL,
  `_mes` text NOT NULL,
  `_stat` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `_to` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `send_table`
--

INSERT INTO `send_table` (`send_id`, `User_ID`, `_sub`, `_mes`, `_stat`, `date_added`, `_to`) VALUES
(2, 2, 'BIR Form Request', 'Your Form 0605 has been processed. Come Back Later!', 'read', '2019-03-01 02:15:36', 'rjaballe'),
(3, 2, 'BIR Form Request', 'A Message with Notice will be sent shortly.', 'read', '2019-03-01 02:17:29', 'rodrigo'),
(6, 2, 'to Sergio', 'to Sergio', 'read', '2019-03-04 03:46:53', 'sergio'),
(15, 1, 'Message for Rodrigo', 'Hi! Rodrigo', 'read', '2019-03-04 13:21:11', 'rodrigo'),
(16, 1, 'from Ate Fayie', 'Kagwang', 'read', '2019-03-07 00:01:29', 'kimofficial'),
(17, 1, 'from Ate Fayie', 'asdfasdf', 'read', '2019-03-07 00:03:20', 'kimofficial'),
(18, 1, 'Message to Rodrigo', 'Hello from IT PARK', 'read', '2019-03-07 05:07:43', 'rodrigo'),
(19, 1, 'asdasd', 'asdasdasd', 'read', '2019-03-07 05:27:18', 'rodrigo'),
(20, 2, 'EOD', 'HI', 'send', '2019-03-13 13:02:16', 'sergio'),
(21, 2, 'EOD', 'HELLO', 'read', '2019-03-13 13:06:46', 'jayson'),
(23, 3, 'Rodrigo', 'LGU', 'send', '2019-03-18 22:39:30', 'rodrigo'),
(25, 2, 'New HD Trappings from Admin', 'Hello,\r\n-BIR', 'send', '2019-03-19 22:53:36', 'rodrigo'),
(26, 4, 'Secret Shop', 'Your DTI BN has been approved!', 'send', '2019-03-23 04:32:26', 'rjaballe'),
(28, 2, 'BIR Form Request', 'Relay', 'read', '2019-03-23 04:49:23', 'rodrigo'),
(29, 2, '123', '123', 'read', '2019-03-23 04:50:58', 'kimofficial'),
(30, 2, 'dasdasd', 'adasda', 'send', '2019-03-26 20:02:10', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `User_ID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `User_level` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Information_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`User_ID`, `Username`, `Password`, `Email`, `User_level`, `Status`, `Information_ID`) VALUES
(1, 'nikkoaballe', '827ccb0eea8a706c4c34a16891f84e7b', 'nikkoaballe@gmail.com', 'admin', 'active', 1),
(2, 'BIR', '827ccb0eea8a706c4c34a16891f84e7b', 'bir.gov@mbp.com', 'admin', 'active', 2),
(3, 'LGU', '827ccb0eea8a706c4c34a16891f84e7b', 'lgu.gov@mbp.com', 'admin', 'active', 17),
(4, 'DTI', '827ccb0eea8a706c4c34a16891f84e7b', 'dti.gov@mbp.com', 'admin', 'active', 18),
(5, 'Boonal13', '2a7d544ccb742bd155e55c796de8e511', 'justinepaulaballe@gmail.com', 'sole', 'active', 19),
(6, 'edmarie', 'e3a33fa5b1a7042bb4d46a27dab13f5c', 'edmarie@gmail.com', 'sole', 'active', 22),
(7, 'kimofficial', '827ccb0eea8a706c4c34a16891f84e7b', 'kimofficial@gmail.com', 'sole', 'active', 24),
(60, 'sDead', '2a7d544ccb742bd155e55c796de8e511', 'sdead@gmail.com', 'sole', 'active', 42),
(61, 'maricel', '2a7d544ccb742bd155e55c796de8e511', 'maricel42@gmail.com', 'sole', 'active', 41),
(62, 'rjaballe', '0242c181129b186469f33fe8e2d60452', 'rjaballe@yahoo.com', 'sole', 'active', 43),
(63, 'man1', '979d472a84804b9f647bc185a877a8b5', 'man1@gmail.com', 'sole', 'inactive', 44),
(64, 'rodrigo', '2a190fa077e8785f07a97557dbdea315', 'rodrigo@gmail.com', 'sole', 'active', 45),
(65, 'shergen44', 'd657d4311ee17d817e4842ebca90b853', 'shergen@outlook.com', 'sole', 'active', 46),
(66, 'fayie', 'bff149a0b87f5b0e00d9dd364e9ddaa0', 'fayie@outlook.com', 'sole', 'active', 47),
(67, 'jayson', '2a7d544ccb742bd155e55c796de8e511', 'jayson@yahoo.com', 'sole', 'active', 48),
(68, 'rix', '6fd80956c10ddff952b27b10f19caaef', 'rixalamat@gmail.com', 'sole', 'active', 49),
(69, 'alliana14', '3be8c5739d8f056b124838de345dec56', 'allianaofficial@gmail.com', 'sole', 'active', 79),
(75, 'princesslea', 'c2f808d66c35793dffe1df5741e5d31e', 'pricesslea@gmail.com', 'sole', 'active', 81),
(76, 'nikko_aballe', '827ccb0eea8a706c4c34a16891f84e7b', 'nikko_aballe@gmail.com', 'sole', 'inactive', 84),
(77, 'asdasd', 'a8f5f167f44f4964e6c998dee827110c', 'asdasd@gmail.com', 'sole', 'inactive', 85),
(78, 'lecit11', 'a3c00a300a2e02d7d58bdd9418a6fcb5', 'lecit11@gmail.com', 'sole', 'active', 89),
(79, 'barbie143', '827ccb0eea8a706c4c34a16891f84e7b', 'jackcolinkita@gmail.com', 'sole', 'active', 90),
(80, 'ketchel', '827ccb0eea8a706c4c34a16891f84e7b', 'ketchelkhan@gmail.com', 'sole', 'active', 91);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_table`
--
ALTER TABLE `business_table`
  ADD PRIMARY KEY (`Business_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `hd_table`
--
ALTER TABLE `hd_table`
  ADD PRIMARY KEY (`hd_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `information_table`
--
ALTER TABLE `information_table`
  ADD PRIMARY KEY (`Information_ID`);

--
-- Indexes for table `progress_table`
--
ALTER TABLE `progress_table`
  ADD PRIMARY KEY (`Progress_ID`),
  ADD KEY `Business_ID` (`Business_ID`);

--
-- Indexes for table `requirement_table`
--
ALTER TABLE `requirement_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_table`
--
ALTER TABLE `send_table`
  ADD PRIMARY KEY (`send_id`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`User_ID`),
  ADD KEY `Information_ID` (`Information_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_table`
--
ALTER TABLE `business_table`
  MODIFY `Business_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `hd_table`
--
ALTER TABLE `hd_table`
  MODIFY `hd_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `information_table`
--
ALTER TABLE `information_table`
  MODIFY `Information_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `progress_table`
--
ALTER TABLE `progress_table`
  MODIFY `Progress_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `requirement_table`
--
ALTER TABLE `requirement_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `send_table`
--
ALTER TABLE `send_table`
  MODIFY `send_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `business_table`
--
ALTER TABLE `business_table`
  ADD CONSTRAINT `business_table_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user_table` (`User_ID`);

--
-- Constraints for table `hd_table`
--
ALTER TABLE `hd_table`
  ADD CONSTRAINT `hd_table_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user_table` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `progress_table`
--
ALTER TABLE `progress_table`
  ADD CONSTRAINT `progress_table_ibfk_1` FOREIGN KEY (`Business_ID`) REFERENCES `business_table` (`Business_ID`);

--
-- Constraints for table `send_table`
--
ALTER TABLE `send_table`
  ADD CONSTRAINT `send_table_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user_table` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_table`
--
ALTER TABLE `user_table`
  ADD CONSTRAINT `user_table_ibfk_1` FOREIGN KEY (`Information_ID`) REFERENCES `information_table` (`Information_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
