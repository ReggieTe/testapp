-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2021 at 02:48 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(50) NOT NULL,
  `auth_id` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
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

INSERT INTO `user` (`id`, `auth_id`, `username`, `firstname`, `surname`, `email`, `password`, `salt`, `state`) VALUES
('04330ee9beff30e8', '4a4ea35b8c74fc7326e2', 'test', 'john', 'Doe', 'test@rtembachako.com', '70427aa33e89b462aeecc607c942b26551fc4e178eb6c4625b2ac44e34217f6d', '924988244605afb5b1c6ed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_person`
--

CREATE TABLE `user_person` (
  `id` varchar(60) NOT NULL,
  `addedby` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `natid` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `language` varchar(100) NOT NULL,
  `interests` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_person`
--

INSERT INTO `user_person` (`id`, `addedby`, `name`, `surname`, `natid`, `phone`, `dob`, `language`, `interests`, `email`, `date_modified`, `date_created`) VALUES
('e988b1477c6dcd35d79e', '04330ee9beff30e8', 'Rathogwaa', 'Tembachako', '9087654321', '0610549027', '13-04-93', 'Sesotho', 'Volunteering,Blogging,Sports,Art,Gaming,Traveling,Music', 'tembachakoregis@gmail.com', '2021-08-16 02:18:13', '2021-08-16 02:18:13'),
('f93d4fce4adc3f9dc807', '04330ee9beff30e8', 'Rathogwaa', 'Tembachako', '1234567890', '0610549027', '12-03-93', 'English', '', 'tembachakoregis@gmail.com', '2021-08-16 02:09:37', '2021-08-16 02:09:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `auth_id` (`auth_id`);

--
-- Indexes for table `user_person`
--
ALTER TABLE `user_person`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
