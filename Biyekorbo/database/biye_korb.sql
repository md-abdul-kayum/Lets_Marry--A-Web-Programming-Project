-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2022 at 08:10 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biye_korbo`
--

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `fav_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `chat_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message` mediumtext NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`chat_id`, `user_id`, `to_user_id`, `message`, `time`) VALUES
(1, 1, 4, 'HI', '2022-01-06 07:38:58'),
(2, 4, 1, 'Hi There!', '2022-01-05 19:27:28'),
(3, 4, 1, 'how are you', '2022-01-05 21:20:26'),
(4, 4, 1, '?', '2022-01-05 21:36:59'),
(5, 4, 1, 'Are you fine', '2022-01-05 21:40:57'),
(6, 4, 2, 'how r you', '2022-10-05 21:42:38'),
(7, 4, 2, '?', '2022-10-05 21:43:22'),
(8, 1, 4, 'asdsad', '2022-10-05 23:24:01'),
(9, 7, 5, 'hii!!', '2022-10-06 02:36:17'),
(10, 5, 7, 'hello there!!', '2022-10-06 02:37:14'),
(11, 7, 5, 'nice dp!', '2022-01-06 07:39:08'),
(12, 5, 7, 'Thanks!!', '2022-01-06 07:39:05'),
(13, 5, 7, 'you hasadas-)', '2022-01-06 07:39:19'),
(14, 8, 5, 'hello there!!', '2022-01-06 07:39:15'),
(15, 5, 8, 'hii!!', '2022-01-06 04:25:21'),
(16, 1, 2, 'hi', '2022-03-13 14:26:43');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(1) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `body` char(1) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `nid` int(10) NOT NULL,
  `education` varchar(50) NOT NULL,
  `phonenumber` int(11) NOT NULL,
  `height` int(5) NOT NULL,
  `weight` int(5) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `blood` varchar(5) NOT NULL,
  `join_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `first_name`, `last_name`, `date_of_birth`, `gender`, `city`, `state`, `picture`, `body`, `occupation`, `nid`, `education`, `phonenumber`, `height`, `weight`, `religion`, `blood`, `join_date`) VALUES
(1, 'pppopo@gmail.com', 'dhruvc', 'Pol', 'shs', '1999-06-13', 'm', 'Dhaka', 'Quebec', '', 'y', '', 0, '', 0, 0, 0, '', '', '2021-10-06'),
(2, 'mhhhh@gmail.com', 'zxcvbnm', 'mhaha', 'shsh', '1999-01-25', 'm', 'Dhaka, Bangladesh', 'QC', 'koala.jpg', 'n', '', 0, '', 0, 0, 0, '', '', '2020-10-04'),
(3, 'nopopopo@gmail.com', 'zxcvbnm', 'mahah', 'asas', '1999-02-02', 'm', 'Dhaka, Bangladesh', 'Quebec', 'insurance.jpg', 'y', '', 0, '', 0, 0, 0, '', '', '2020-10-04'),
(4, 'plsss@gmail.com', 'zxcvbnm', 'plaaa', 'sadas', '1996-03-21', 'f', 'Chittagong', 'Ontario', 'logo.png', 'n', '', 0, '', 0, 0, 0, '', '', '2020-10-04'),
(5, 'mahhh@gmail.com', 'bhumil1212', 'mahaa', 'ma', '1996-12-12', 'm', 'Rajshahi', 'Quebec', '99ADAD6F-7046-4170-AEC8-373A554303D7.jpg', 'n', '', 0, '', 0, 0, 0, '', '', '2020-10-05'),
(7, 'plplpl@gmail.com', 'zxcvbnm', 'plass', 'pl', '1997-12-05', 'f', 'Sylhet', 'Quebec', 'download.jpg', 'n', '', 0, '', 0, 0, 0, '', '', '2020-10-05'),
(8, 'opopo@gmail.com', 'zxcvbnm', 'plas', 'pl', '1997-12-11', 'f', 'Dhaka, Bangladesh', 'Quebec', 'download (1).jpg', 'n', '', 0, '', 0, 0, 0, '', '', '2020-10-06'),
(9, 'bb@gmail.com', 'zxcvbnm', 'jh', 'hj', '2022-03-07', 'f', 'Dhaka, Bangladesh', 'awdw', 'p15.JPG', 'y', '', 0, '', 0, 0, 0, '', '', '2022-03-12'),
(10, 'bgb@gmail.com', 'zxcvbnm', 'tfdgtd', 'ytrfut', '2022-03-22', 'm', 'Dhaka, Bangladesh', 'grwtrstr', 'y', 'y', 'p6.JPG', 0, '', 0, 0, 0, '', '', '2022-03-12'),
(11, 'ccb@gmail.com', 'zxcvbnm', 'aewdawd', 'aefec', '2022-03-22', 'm', 'sfaecac', 'wfaff', 'p11.jpg', 'y', 'fewcaadwadawdawd', 0, '', 0, 0, 0, '', '', '2022-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `wink`
--

CREATE TABLE `wink` (
  `wink_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wink`
--

INSERT INTO `wink` (`wink_id`, `user_id`, `user2_id`) VALUES
(1, 1, 4),
(2, 1, 4),
(3, 4, 2),
(5, 5, 7),
(7, 5, 8),
(4, 7, 5),
(6, 8, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`fav_id`),
  ADD KEY `TO_USER_ID` (`user_id`,`user2_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `TO_USER_ID` (`user_id`,`to_user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wink`
--
ALTER TABLE `wink`
  ADD PRIMARY KEY (`wink_id`),
  ADD KEY `USER_ID` (`user_id`,`user2_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `chat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wink`
--
ALTER TABLE `wink`
  MODIFY `wink_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
