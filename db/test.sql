-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 29, 2021 at 06:44 AM
-- Server version: 10.3.31-MariaDB-log-cll-lve
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rtembach_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `project_timesheet`
--

CREATE TABLE `project_timesheet` (
  `id` varchar(60) NOT NULL,
  `addedby` varchar(60) NOT NULL,
  `project_id` varchar(60) NOT NULL,
  `hours_spent` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_timesheet`
--

INSERT INTO `project_timesheet` (`id`, `addedby`, `project_id`, `hours_spent`, `date`, `description`, `date_created`) VALUES
('1f5f6700fbdd391a78e1', '2372afd9e9404935d601', 'sports-and-surfing', 2, '2021-08-19', '', '2021-08-29'),
('2215ae8ff889a22b07c8', 'a549ba49c3176696b3cd', 'health-care', 4, '2021-08-17', '', '2021-08-29'),
('8cb802bef46ec559de6a', 'a549ba49c3176696b3cd', 'sports-and-surfing', 5, '2021-08-27', '', '2021-08-29'),
('b047bf41153c23f3a4d4', '2372afd9e9404935d601', 'wildlife-conservation', 2, '2021-08-27', '', '2021-08-29'),
('bbc4e0b2da630494b4a5', '2372afd9e9404935d601', 'health-care', 6, '2021-08-29', '', '2021-08-29'),
('edf1af1619916e7ef44e', '2372afd9e9404935d601', 'wildlife-conservation', 3, '2021-08-29', '', '2021-08-29'),
('fc67def8c8c1a2a63795', 'a549ba49c3176696b3cd', 'sports-and-surfing', 6, '2021-08-28', '', '2021-08-29');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `state` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `surname`, `email`, `password`, `salt`, `state`) VALUES
('2372afd9e9404935d601', 'John', 'Doe', 'gvivolunteer1@gviworld.com', '65ebff69014db9fa106f79eb7b32e5f27f12804b5c89f1578e0af4eff0cb0cec', '924988244605afb5b1c6ed', 0),
('8b62790b884c2faff2d0', 'Bob', 'Doe', 'gvivolunteer3@gviworld.com', 'ed245996d1d49e70f9c2ce9063cc922600ac73ddd553a1d2d79b443cc4db658f', '924988244605afb5b1c6ed', 0),
('a549ba49c3176696b3cd', 'Jane', 'Doe', 'gvivolunteer2@gviworld.com', '09d56c5ad6bb3f318651d728a008424674cafcde19f57ba553620dfcfb36f6da', '924988244605afb5b1c6ed', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project_timesheet`
--
ALTER TABLE `project_timesheet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
