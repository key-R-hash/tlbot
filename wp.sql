-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 24, 2018 at 10:28 AM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wp`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `chat_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `functions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `chat_id`, `date`, `status`, `functions`) VALUES
(34, 'kiarash', 'Skills39', 110707256, 1542896125, 1, '-password-'),
(37, 'kiarash', 'Skills39', 29971482, 1542898626, 1, '-password-');

-- --------------------------------------------------------

--
-- Table structure for table `tbl-function`
--

CREATE TABLE `tbl-function` (
  `-command-` text NOT NULL,
  `start-function-name` text NOT NULL,
  `end-function-name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl-function`
--

INSERT INTO `tbl-function` (`-command-`, `start-function-name`, `end-function-name`) VALUES
('-start-', '', ''),
('-title-', '', ''),
('-body-', '', ''),
('-finish-', '', ''),
('-username-', '', ''),
('-password-', '', ''),
('-finish_login-', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl-massage`
--

CREATE TABLE `tbl-massage` (
  `id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `date` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `functions` text NOT NULL,
  `login` int(11) NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl-massage`
--

INSERT INTO `tbl-massage` (`id`, `chat_id`, `body`, `date`, `status`, `functions`, `login`, `title`) VALUES
(1200, 110707256, 'hahah', 1542896140, 1, '-body-', 1, 'kia'),
(1201, 29971482, 'gilan', 1542898642, 1, '-body-', 1, 'amir'),
(1202, 29971482, 'gilan', 1542898648, 1, '-body-', 1, 'amir');

-- --------------------------------------------------------

--
-- Table structure for table `variable`
--

CREATE TABLE `variable` (
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variable`
--

INSERT INTO `variable` (`a`, `b`) VALUES
(13, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl-massage`
--
ALTER TABLE `tbl-massage`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `tbl-massage`
--
ALTER TABLE `tbl-massage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1203;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
