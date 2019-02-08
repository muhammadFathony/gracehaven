-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2019 at 05:06 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gracehaven`
--

-- --------------------------------------------------------

--
-- Table structure for table `child`
--

CREATE TABLE `child` (
  `id_child` int(11) NOT NULL,
  `id_parent` int(5) NOT NULL,
  `child` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `child`
--

INSERT INTO `child` (`id_child`, `id_parent`, `child`, `desc`) VALUES
(1, 1, 'create_user', 'Create User'),
(2, 1, 'privilege', 'Privilege'),
(3, 2, 'create_dialy', 'Create Dialy');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id_class` int(5) NOT NULL,
  `class` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id_class`, `class`) VALUES
(1, 'class 8A'),
(2, 'class 8B');

-- --------------------------------------------------------

--
-- Table structure for table `day`
--

CREATE TABLE `day` (
  `id_day` int(11) NOT NULL,
  `name_day` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `day`
--

INSERT INTO `day` (`id_day`, `name_day`) VALUES
(1, 'Sunday'),
(2, 'Monday'),
(3, 'Tuesday'),
(4, 'Wednesday'),
(5, 'Thursday'),
(6, 'Friday'),
(7, 'Saturday');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id_page` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `id_child` int(5) DEFAULT '0',
  `id_user` int(11) NOT NULL,
  `have_child` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id_page`, `id_parent`, `id_child`, `id_user`, `have_child`) VALUES
(1, 1, 1, 2, 1),
(3, 1, 2, 2, 1),
(4, 1, 1, 5, 1),
(5, 2, 0, 3, 0),
(6, 2, 0, 5, 0),
(10, 3, 0, 2, 0),
(11, 2, 3, 2, 1),
(12, 3, 0, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `id_parent` int(5) NOT NULL,
  `parent` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`id_parent`, `parent`, `desc`) VALUES
(1, 'user_management', 'User Management'),
(2, 'dialy_progamme', 'Dialy Progamme'),
(3, 'dashboard', 'Dahsboard');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id_schedule` int(11) NOT NULL,
  `schedule_name` varchar(255) NOT NULL,
  `id_day` int(11) NOT NULL,
  `schedule_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `schedule_finish` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_class` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id_schedule`, `schedule_name`, `id_day`, `schedule_time`, `schedule_finish`, `id_class`) VALUES
(10, 'Football', 1, '2019-02-08 02:57:49', '2019-02-08 04:15:00', 2),
(11, 'Swiming', 2, '2019-02-08 02:57:52', '2019-02-08 05:57:00', 2),
(13, 'BassketBall', 6, '2019-02-08 03:00:00', '2019-02-08 06:25:00', 2),
(15, 'B.ingris', 1, '2019-02-08 01:15:00', '2019-02-08 03:27:24', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_rule`
--

CREATE TABLE `user_rule` (
  `id_user` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `control` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(300) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '0=on / 1=off',
  `qrcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_rule`
--

INSERT INTO `user_rule` (`id_user`, `firstname`, `lastname`, `email`, `control`, `password`, `image`, `create_at`, `status`, `qrcode`) VALUES
(2, 'toni', 'toni', 'admin@gmail.com', 'administrator', '$2y$10$inpeTcOdep0E/jIx5KJdmuxq5OMOq2svTUQE2KU5GmgKz9fkz7n8e', '0ac509fbcbdffd5151acf3721c11a6a4.jpg', '2019-02-04 09:46:35', 1, ''),
(3, 'aa', 'aa', 'muhaft9@gmail.com', 'inspector', '$2y$10$V8GNEvK9ICWb/qYN01fbfOGYBJlMO.A9g2h4pkVNMh.ylSplddmcK', '84c1c73c40dbafe6934184136765ea1e.jpg', '2019-02-04 09:55:03', 1, ''),
(4, 'bb', 'bb', 'bobo@gmail.com', 'student', '$2y$10$Llk.WopMdykmxKkbzUAgQOu9FJJIgFciMDr3B2YN0hfp4yswTAp.q', '643964d3b272274b65a451bf221b601b.png', '2019-02-04 09:55:13', 1, ''),
(5, 'Alex', 'Brian', 'AlexBrian@gmail.com', 'student', '$2y$10$8W5Lf2xz1FA1ySHlASTeA.Fl6i5ifZzAHWku.TwyjSnMQfGcTeNi6', '3e08fd08b304601a7116c0a12476f3bc.jpg', '2019-02-07 07:19:13', 1, ''),
(6, 'muhaft', 'toni', 'Coba123@gmail.com', 'administrator', '$2y$10$Cf6k.RRezE2PbARqLV2.KuZ3ZxetkYBjCkVgDg6VL/RG5.4IiAKbe', '9412aea4d8f945332b7cf140010b0bb5.jpg', '2019-02-04 10:34:37', 1, '123.png'),
(7, 'toni', 'fathony', 'toni123@gmail.com', 'administrator', '$2y$10$zACatzwy33f0CfqZXXn6a.aR7iZ0xno5vIACmfkKpmmQq9qNMLVH.', '478409bf803dc1ce045895690d851e67.jpg', '2019-02-06 10:11:51', 1, '123.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `child`
--
ALTER TABLE `child`
  ADD PRIMARY KEY (`id_child`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id_class`);

--
-- Indexes for table `day`
--
ALTER TABLE `day`
  ADD PRIMARY KEY (`id_day`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id_page`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`id_parent`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id_schedule`),
  ADD KEY `id_day` (`id_day`);

--
-- Indexes for table `user_rule`
--
ALTER TABLE `user_rule`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `unique_table` (`email`,`qrcode`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `child`
--
ALTER TABLE `child`
  MODIFY `id_child` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id_class` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `day`
--
ALTER TABLE `day`
  MODIFY `id_day` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id_page` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `id_parent` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id_schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_rule`
--
ALTER TABLE `user_rule`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
