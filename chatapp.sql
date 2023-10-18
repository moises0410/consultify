-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2023 at 05:39 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(1, 289707101, 1675601887, 'hi'),
(2, 1675601887, 289707101, 'hi'),
(3, 1675601887, 289707101, 'can i ask for consultation?'),
(4, 289707101, 1675601887, 'sure'),
(5, 289707101, 1675601887, 'what time and date'),
(6, 1675601887, 289707101, 'October 10, 2023 at 2:30pm?'),
(7, 289707101, 220156204, 'Hi'),
(8, 220156204, 289707101, 'hi'),
(9, 289707101, 220156204, 'hi'),
(10, 220156204, 289707101, 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `title`, `description`, `start_datetime`, `end_datetime`) VALUES
(2, 'it 221', 'Available time', '2023-10-14 00:03:00', '2023-10-14 11:04:00'),
(3, 'Buhat si Ogot', 'Complaining', '2023-10-14 13:30:00', '2023-10-14 14:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) DEFAULT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `stud_id` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `note` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `stud_id`, `course`, `year`, `email`, `password`, `img`, `status`, `user_type`, `note`) VALUES
(49, 1281388934, 'Ella Mae', 'Papa', '20-0000', 'BSIT', '4th Year', 'ellamae@gmail.com', 'ea906870062564624211f81bfa070344', '1697092338ella.jpg', 'Offline now', 'user', 'approved'),
(50, 1545650365, 'Bianca', 'Lapuz', '20-1111', 'BSIT', '3rd Year', 'bianca@gmail.com', '83de6260ed1dbe549bd23d31c4b8af81', '1697092751profile.png', 'Offline now', 'user', 'approved'),
(51, 324742141, 'Mariz', 'Laxamana', '20-3333', 'BSIT', '1st Year', 'mariz@gmail.com', '4d980d07f7d83754686e3cf39e474beb', 'IMG.jpg', 'Offline now', 'user', 'approved'),
(52, 1651136430, 'Shery Dane', 'Labios', '00-0000', 'Professor', '-', 'shery@gmail.com', '423d6ac7e6fc85dccfa92be00b0d327c', '16971232281695905292profile.png', 'Offline now', 'professor', 'approved'),
(53, 1256912194, 'Frederick', 'Ogot', '20-4444', 'BSIT', '4th Year', 'frederick@gmail.com', 'b43cf7f09ccc873c4150a65c83b6a129', '1697251611profile.png', 'Active now', 'user', 'approved'),
(54, 607268662, 'JC', 'Pumarada', '20-5555', 'BSIT', '3rd Year', 'jc@gmail.com', '7a21acf80bcf3f14db315bfdae25057c', '16972525061695905292profile.png', 'Active now', 'professor', 'approved'),
(55, 836652598, 'Don', 'Diaz', '20-5555', 'BSIT', '4th Year', 'don@gmail.com', '37efcfcd3dad0d511cbfaa718c0f7c86', '1697260967profile.png', 'Offline now', 'user', 'approved'),
(56, 752501951, 'May ', 'Ballita', '00-0000', 'Professor', '-', 'may@gmail.com', 'bfbc14defa7f3231b61f729313df7d89', 'profile.png', 'Offline now', 'professor', 'approved'),
(57, 1330378643, 'Adrian', 'Sarmiento', '20-0000', 'BSIT', '3rd Year', 'adrian@gmail.com', '8c4205ec33d8f6caeaaaa0c10a14138c', '1697263488profile.png', 'Active now', 'user', 'pending'),
(58, 140094305, 'Dennis', 'Nazarea', '00000', 'BSIT', '20-0000', 'dennis@gmail.com', '7daacea5f373b4c1c054158b126d317f', '16972636311695905292profile.png', 'Offline now', 'user', 'approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `schedule_list`
--
ALTER TABLE `schedule_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
