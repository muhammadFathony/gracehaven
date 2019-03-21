-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2019 at 05:23 AM
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
-- Table structure for table `activity_student`
--

CREATE TABLE `activity_student` (
  `no` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `id_schedule` int(11) NOT NULL,
  `id_class` int(5) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = belum / 1 = sudah',
  `date` date NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_student`
--

INSERT INTO `activity_student` (`no`, `id_student`, `firstname`, `id_schedule`, `id_class`, `status`, `date`, `create_at`) VALUES
(56, 32, 'Ayu', 30, 1, 1, '2019-02-26', '2019-02-26 03:46:44'),
(59, 32, 'Ayu', 37, 1, 1, '2019-02-26', '2019-02-26 04:00:11'),
(60, 31, 'toni', 24, 2, 1, '2019-02-26', '2019-02-26 04:09:08'),
(61, 32, 'Ayu', 38, 1, 1, '2019-02-26', '2019-02-26 04:09:44'),
(62, 29, 'Arif', 27, 1, 1, '2019-02-27', '2019-02-27 06:52:53'),
(65, 32, 'Ayu', 27, 1, 1, '2019-02-27', '2019-02-27 07:25:46'),
(66, 32, 'Ayu', 41, 1, 1, '2019-02-27', '2019-02-27 07:27:50'),
(68, 32, 'Munawir', 16, 1, 1, '2019-02-27', '2019-02-27 07:51:36'),
(69, 32, 'Ayu', 27, 1, 1, '2019-03-06', '2019-03-06 03:43:05');

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
-- Table structure for table `class_room`
--

CREATE TABLE `class_room` (
  `id_location` int(11) NOT NULL,
  `class_room` varchar(255) NOT NULL,
  `qrcode` varchar(300) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 =off / 1 = on'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_room`
--

INSERT INTO `class_room` (`id_location`, `class_room`, `qrcode`, `create_at`, `id_user`, `status`) VALUES
(49, 'Computer', 'Computer.png', '2019-02-26 07:43:52', 14, 0),
(50, 'Biology', 'Biology.png', '2019-02-27 02:53:35', 14, 0),
(51, 'English', 'English.png', '2019-02-27 07:29:50', 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `control_access`
--

CREATE TABLE `control_access` (
  `id_control` int(11) NOT NULL,
  `control` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `control_access`
--

INSERT INTO `control_access` (`id_control`, `control`) VALUES
(1, 'Admin'),
(2, 'Staff'),
(3, 'Children');

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
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednesday'),
(4, 'Thursday'),
(5, 'Friday'),
(6, 'Saturday'),
(7, 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `level_negativebehaviours`
--

CREATE TABLE `level_negativebehaviours` (
  `id_level` int(11) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level_negativebehaviours`
--

INSERT INTO `level_negativebehaviours` (`id_level`, `level`) VALUES
(1, 'Immediate one level drop'),
(2, 'Immediate drop to level 1');

-- --------------------------------------------------------

--
-- Table structure for table `log_class`
--

CREATE TABLE `log_class` (
  `id_log` int(11) NOT NULL,
  `nis` varchar(300) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_control` int(11) NOT NULL,
  `id_location` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_class`
--

INSERT INTO `log_class` (`id_log`, `nis`, `id_student`, `id_control`, `id_location`, `create_at`) VALUES
(2, 'NIS-20190215-000001', 29, 3, 14, '2019-02-21 04:42:52'),
(3, '', 25, 4, 3, '2019-02-21 04:48:53'),
(4, '', 24, 4, 3, '2019-02-21 04:49:35'),
(5, '', 241, 4, 3, '2019-02-21 04:50:19'),
(6, '', 2411, 42, 3, '2019-02-21 04:51:11'),
(7, '', 24112, 42, 3, '2019-02-21 04:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `negative_behaviours`
--

CREATE TABLE `negative_behaviours` (
  `nomer` int(11) NOT NULL,
  `negativebehaviours` varchar(255) NOT NULL,
  `id_level` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `negative_behaviours`
--

INSERT INTO `negative_behaviours` (`nomer`, `negativebehaviours`, `id_level`, `create_at`) VALUES
(5, 'Physical aggression', 2, '2019-03-01 03:32:22'),
(6, 'Abscondence', 2, '2019-03-01 04:09:21'),
(8, 'Prohibited Items', 2, '2019-03-01 04:13:29'),
(11, 'Verbal aggression', 1, '2019-03-01 04:16:09'),
(12, 'Non-compliance', 1, '2019-03-01 04:16:35'),
(13, 'Late Return', 1, '2019-03-01 04:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `rbac`
--

CREATE TABLE `rbac` (
  `id_rbac` int(11) NOT NULL,
  `id` int(11) NOT NULL COMMENT 'id = id pada tabel sidebar',
  `id_control` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rbac`
--

INSERT INTO `rbac` (`id_rbac`, `id`, `id_control`) VALUES
(136, 3, 1),
(137, 4, 1),
(138, 5, 1),
(139, 6, 1),
(140, 10, 1),
(148, 8, 1),
(149, 11, 1),
(150, 9, 1),
(151, 12, 1),
(157, 2, 1),
(161, 7, 3),
(165, 8, 3),
(166, 11, 3),
(168, 11, 2),
(169, 7, 2),
(170, 8, 2),
(171, 12, 2),
(173, 7, 1),
(174, 14, 1),
(175, 13, 1),
(176, 15, 3),
(177, 15, 1),
(178, 15, 2),
(179, 13, 2),
(180, 14, 2),
(183, 9, 2),
(186, 16, 1),
(187, 17, 1),
(188, 18, 1),
(189, 19, 1),
(190, 18, 2),
(191, 16, 2);

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
(11, 'Swiming', 5, '2019-02-08 02:57:52', '2019-02-08 05:57:00', 1),
(13, 'BassketBall', 5, '2019-02-08 03:00:00', '2019-02-08 06:25:00', 2),
(15, 'B.ingris', 1, '2019-02-08 01:15:00', '2019-02-08 03:27:24', 2),
(16, 'Wakeup', 1, '2019-02-18 22:30:00', '2019-02-18 23:14:00', 1),
(24, 'Wakeup', 2, '2019-02-17 23:00:00', '2019-02-17 23:15:00', 2),
(27, 'Wakeup', 3, '2019-02-17 23:00:00', '2019-02-17 23:15:00', 1),
(28, 'Wakeup', 4, '2019-02-17 23:00:00', '2019-02-17 23:15:00', 1),
(29, 'Greeting', 1, '2019-02-18 00:00:00', '2019-02-18 00:15:00', 1),
(30, 'Greeting', 2, '2019-02-18 00:00:00', '2019-02-18 00:15:00', 1),
(31, 'Greeting', 3, '2019-02-18 00:00:00', '2019-02-18 00:15:00', 1),
(32, 'Greeting', 3, '2019-02-18 00:00:00', '2019-02-18 00:15:00', 1),
(33, 'Greeting', 5, '2019-02-18 00:00:00', '2019-02-18 00:15:00', 1),
(34, 'Singing', 5, '2019-02-22 06:00:00', '2019-02-22 08:00:00', 2),
(35, 'Englsih Listening', 2, '2019-02-26 00:30:00', '2019-02-26 03:30:00', 1),
(36, 'Computer Lab', 2, '2019-02-26 03:30:00', '2019-02-26 05:30:00', 1),
(37, 'Lunch', 2, '2019-02-26 05:30:00', '2019-02-26 06:30:00', 1),
(38, 'Mathematics', 2, '2019-02-26 06:30:00', '2019-02-26 08:30:00', 1),
(39, 'Prayer', 2, '2019-02-26 08:30:00', '2019-02-26 09:00:00', 1),
(40, 'Swimming', 2, '2019-02-26 01:30:00', '2019-02-26 02:00:00', 2),
(41, 'Badminton', 3, '2019-02-27 08:00:00', '2019-02-27 09:15:00', 1),
(42, 'Dinner', 3, '2019-02-27 10:15:00', '2019-02-27 11:15:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sidebar`
--

CREATE TABLE `sidebar` (
  `id` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `child` int(11) NOT NULL COMMENT '0=single / 1=parent / 2=child',
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sidebar`
--

INSERT INTO `sidebar` (`id`, `parent`, `child`, `title`, `icon`, `color`, `url`, `create_at`) VALUES
(2, 0, 1, 'Master', 'fa fa-cog', 'rgb(15, 141, 47)', 'conten/User#', '2019-02-12 02:56:43'),
(3, 2, 2, 'User Root', 'fa', '', 'conten/User', '2019-02-12 03:01:32'),
(4, 2, 2, 'Create User', 'fa', '', 'conten/User/view_create_user', '2019-02-12 03:01:32'),
(5, 2, 2, 'List Student', 'fa', '', 'conten/User/view_list_student', '2019-02-12 04:27:19'),
(6, 2, 2, 'Create Student', 'fa', '', 'conten/User/view_create_new_student', '2019-02-12 04:27:19'),
(7, 0, 1, 'Daily Programme', 'fa fa-bell', 'rgb(219, 22, 60)', 'student/Dailystudent#', '2019-02-12 04:42:48'),
(8, 7, 2, 'Daily Student', 'fa', '', 'student/Dailystudent', '2019-02-12 04:46:36'),
(9, 0, 0, 'Movement Tracking', 'fa fa-street-view', 'rgb(75, 46, 149)', 'conten/Location', '2019-02-12 09:24:33'),
(10, 2, 2, 'User Permission', 'fa ', '', 'conten/User/View_role_user', '2019-02-14 06:28:27'),
(11, 7, 2, 'Finished Activty', 'fa', '', 'student/Dailystudent/View_finished_activity', '2019-02-14 09:25:18'),
(12, 7, 2, 'All Schedule', 'fa', '', 'student/Dailystudent/Dailyprogamme', '2019-02-19 06:40:26'),
(13, 14, 2, 'List Class Room', 'fa', '', 'conten/Movement_tracking', '2019-02-20 07:38:04'),
(14, 0, 1, 'Movement Type', 'fa fa-institution', 'rgb(203, 85, 79)', 'conten/Movement_tracking#', '2019-02-21 02:07:50'),
(15, 7, 2, 'All Student Activities', 'fa', '', 'student/Dailystudent/view_completed_activities', '2019-02-22 07:01:43'),
(16, 0, 1, 'Incidents', 'fa fa-newspaper-o', 'rgb(75, 46, 149)', 'conten/Incidents#', '2019-02-27 08:44:13'),
(17, 0, 1, 'Report', 'fa fa-book', 'rgb(219, 22, 60)', '#', '2019-02-27 08:44:13'),
(18, 16, 2, 'Negative Behavior ', 'fa', '', 'conten/Incidents/negative_behaviours', '2019-02-27 08:49:13'),
(19, 16, 2, 'Positive Behavior', 'fa', '', '#', '2019-02-27 08:49:13'),
(20, 0, 0, 'Incident Report', 'fa', '', 'conten/', '2019-03-01 06:30:45');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id_student` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `id_class` int(5) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_control` int(11) NOT NULL DEFAULT '3',
  `password` varchar(300) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id_student`, `nis`, `firstname`, `lastname`, `date_of_birth`, `id_class`, `address`, `image`, `id_control`, `password`, `create_at`) VALUES
(29, 'NIS-20190215-000001', 'Arif', 'Rahman', '2009-01-13', 1, 'jalan semarang - kendal\r\nWonosari ngaliyan', 'da3a4ff38f6fec5eb20863852fa0461a.jpg', 3, '$2y$10$AGJDRjfgcLPO.qX52gHNzehAReSVBNRRfkMOBwtVJmS.WgPmlr2ra', '2019-02-15 07:11:36'),
(30, 'NIS-20190215-000002', 'Deni', 'Herdiansyah', '2019-03-03', 2, 'jalan semarang - kendal\r\nWonosari ngaliyan', 'eb44e51791ba4a215a4c4d93ab8c9521.jpg', 3, '$2y$10$uvqBmaOh/ulE6.2s04LelO172ly13Mg2NG6b8bCLnv4i4nagBYTmq', '2019-02-15 08:54:57'),
(31, 'NIS-20190215-000003', 'toni', 'toni', '2019-02-20', 2, 'jalan semarang - kendal\r\nWonosari ngaliyan', 'e97c1cb2d7299539bf85d0b2c8913b09.png', 3, '$2y$10$PPT78W9lBbzDpsS1tdHt6eAqAa3KaJJWqHl0OCo6sNWdE78GgtcTy', '2019-02-15 09:41:52'),
(32, 'NIS-20190225-000004', 'Ayu', 'Hakiki', '2010-03-25', 1, 'jalan semarang - kendal\r\nWonosari ngaliyan', 'b99f64248dad1632ac49dfd951e60291.jpg', 3, '$2y$10$XIY1U2px.zs9D9KValHjwOrhJnWwoM5phqkX9k5iHvvqUcydAmPea', '2019-02-25 02:56:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_rule`
--

CREATE TABLE `user_rule` (
  `id_user` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_control` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(300) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '0=on / 1=off',
  `qrcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_rule`
--

INSERT INTO `user_rule` (`id_user`, `firstname`, `lastname`, `email`, `id_control`, `password`, `image`, `create_at`, `status`, `qrcode`) VALUES
(14, 'Muhammad', 'Fathony', 'mfathony115@gmail.com', 1, '$2y$10$Vxe8m86N1NtzFY04hcqTluZC744u3yorlLHkb2ihjDSsnQVXQRnfu', '62a9a001b4ce080e925f9a8d0d2cc989.jpg', '2019-02-18 06:27:32', 1, '123.png'),
(15, 'Munawir', 'Rizqon', 'admin@gmail.com', 2, '$2y$10$s2yFOg6DpL2lpQUwtXqOFewD/8WxSsBawVWUG2Gj5xQhyxsy5nqJ2', '5cb2ff731929f9d9647937789b0d31d4.jpg', '2019-02-18 06:29:16', 1, '1234.png'),
(16, 'test555', 'test555', 'test@gmail.com', 3, '$2y$10$K4on8XPbWaJI3wJ7apvDnOvnPZKwKjGM0yiEITE7zQXDQGjD6gplG', '241360200f7b4bc81abbc90d06633026.jpg', '2019-02-19 06:30:42', 1, '1234.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_student`
--
ALTER TABLE `activity_student`
  ADD PRIMARY KEY (`no`),
  ADD KEY `id_student` (`id_student`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id_class`);

--
-- Indexes for table `class_room`
--
ALTER TABLE `class_room`
  ADD PRIMARY KEY (`id_location`);

--
-- Indexes for table `control_access`
--
ALTER TABLE `control_access`
  ADD PRIMARY KEY (`id_control`);

--
-- Indexes for table `day`
--
ALTER TABLE `day`
  ADD PRIMARY KEY (`id_day`);

--
-- Indexes for table `level_negativebehaviours`
--
ALTER TABLE `level_negativebehaviours`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `log_class`
--
ALTER TABLE `log_class`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `negative_behaviours`
--
ALTER TABLE `negative_behaviours`
  ADD PRIMARY KEY (`nomer`),
  ADD KEY `id_level` (`id_level`);

--
-- Indexes for table `rbac`
--
ALTER TABLE `rbac`
  ADD PRIMARY KEY (`id_rbac`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id_schedule`),
  ADD KEY `id_day` (`id_day`,`id_schedule`) USING BTREE;

--
-- Indexes for table `sidebar`
--
ALTER TABLE `sidebar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_student`),
  ADD UNIQUE KEY `NIS` (`nis`),
  ADD KEY `firstname` (`firstname`,`nis`) USING BTREE;

--
-- Indexes for table `user_rule`
--
ALTER TABLE `user_rule`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `unique_table` (`email`,`qrcode`) USING BTREE,
  ADD KEY `email` (`email`,`firstname`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_student`
--
ALTER TABLE `activity_student`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id_class` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class_room`
--
ALTER TABLE `class_room`
  MODIFY `id_location` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `control_access`
--
ALTER TABLE `control_access`
  MODIFY `id_control` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `day`
--
ALTER TABLE `day`
  MODIFY `id_day` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `level_negativebehaviours`
--
ALTER TABLE `level_negativebehaviours`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_class`
--
ALTER TABLE `log_class`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `negative_behaviours`
--
ALTER TABLE `negative_behaviours`
  MODIFY `nomer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rbac`
--
ALTER TABLE `rbac`
  MODIFY `id_rbac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id_schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `sidebar`
--
ALTER TABLE `sidebar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_rule`
--
ALTER TABLE `user_rule`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
