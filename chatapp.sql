-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 04:02 PM
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
(2, 'admin@gmail.com', 'au_admin123'),
(3, 'aujasconsultify@gmail.com', 'consultify123');

-- --------------------------------------------------------

--
-- Table structure for table `consult`
--

CREATE TABLE `consult` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `stud_no` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `concern` varchar(255) NOT NULL,
  `professor` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `consult`
--

INSERT INTO `consult` (`id`, `name`, `stud_no`, `level`, `concern`, `professor`, `date`, `time`) VALUES
(26, 'Ella Mae Papa', '20-0000', '4th Year -BSIT', 'consultation for capstone', 74, '2023-11-20', '13:00PM-13:30PM'),
(27, 'Ella Mae Papa', 'TRIAL', '4th Year -BSIT', 'TESTING FOR BOOKING', 68, '2023-11-19', '09:00AM-10:00AM'),
(49, 'Ella Mae Papa', '', '4th Year -BSIT', 'I would like to have consult regarding to the project.', 68, '2023-11-23', '10:00AM-10:30AM');

-- --------------------------------------------------------

--
-- Table structure for table `consult_report`
--

CREATE TABLE `consult_report` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `professor` varchar(100) NOT NULL,
  `level` varchar(255) NOT NULL,
  `concern` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `consult_report`
--

INSERT INTO `consult_report` (`id`, `name`, `professor`, `level`, `concern`, `remark`) VALUES
(34, 'Ella Mae Papa', 'Maylane Ballita', '4th Year -BSIT', 'consultation for capstone', 'Ella ask for help in evaluation of their capstone.'),
(35, 'Ella Mae Papa', 'Dennis Nazarrea', '4th Year -BSIT', 'consultation for capstone', 'a student seek of help regarding on there system.');

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
(14, 1027966144, 1281388934, 'fasd'),
(15, 1281388934, 1027966144, 'hi'),
(16, 1027966144, 1281388934, 'hello'),
(17, 1281388934, 1027966144, 'musta'),
(18, 1027966144, 1281388934, 'https://meet.google.com/yii-nqfi-cqq'),
(19, 1027966144, 1281388934, 'Hi! Meet nalang tayo online.');

-- --------------------------------------------------------

--
-- Table structure for table `professor_availability`
--

CREATE TABLE `professor_availability` (
  `id` int(11) NOT NULL,
  `professor_id` int(11) DEFAULT NULL,
  `booking_day` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `professor_availability`
--

INSERT INTO `professor_availability` (`id`, `professor_id`, `booking_day`) VALUES
(35, 73, 'Saturday');

-- --------------------------------------------------------

--
-- Table structure for table `professor_schedule`
--

CREATE TABLE `professor_schedule` (
  `id` int(11) NOT NULL,
  `professor_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `professor_schedule`
--

INSERT INTO `professor_schedule` (`id`, `professor_id`, `date`, `start_time`, `end_time`) VALUES
(25, 68, '2023-11-25', '10:58:00', '11:58:00'),
(26, 68, '2023-11-26', '14:30:00', '15:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `day` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `professor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `day`, `date`, `time`, `status`, `professor`) VALUES
(1, 'Monday', '11/20/2023', '1:00PM-1:30PM', 'Available', 'Maylane Ballita'),
(2, 'Monday', '11/20/2023', '1:30PM-2:00PM', 'Booked', 'Maylane Ballita'),
(4, 'Tuesday', '11/21/2023', '1:00PM-1:30-PM', 'Available', 'Milagros Santiago');

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
  `note` varchar(255) NOT NULL DEFAULT 'pending',
  `data_privacy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `stud_id`, `course`, `year`, `email`, `password`, `img`, `status`, `user_type`, `note`, `data_privacy`) VALUES
(49, 1281388934, 'Ella Mae', 'Papa', '20-0000', 'BSIT', '4th Year', 'ellamae@gmail.com', 'ea906870062564624211f81bfa070344', 'ella.jpg', 'Offline now', 'user', 'approved', ''),
(68, 425599189, 'Melchor', 'Erise', '00-7492', 'CITE', '', 'erise@gmail.com', 'c39358e96e7cf223441669574b60e2cb', 'profile.png', 'Offline now', 'professor', 'approved', ''),
(72, 237971535, 'Shery Dane', 'Labios', '20-9472', 'BSIT', '4TH YEAR', 'shery@gmail.com', '423d6ac7e6fc85dccfa92be00b0d327c', '1699080319profile.png', 'Offline now', 'user', 'approved', ''),
(73, 498209038, 'Dennis', 'Nazarrea', '00-7932', 'CITE', '', 'dennis@gmail.com', '55010f3cd47d898b3090122ee3319198', '1699080607profile.png', 'Offline now', 'professor', 'approved', ''),
(74, 1027966144, 'Maylane', 'Ballita', '00-8462', 'CITE', '', 'moisesireneo.10@gmail.com', '4a7726c0f1887f6501ba6a399a72218e', '1699259480profile.png', 'Offline now', 'professor', 'approved', ''),
(77, 190412625, 'Milagros', 'Santiago', '00-6432', 'CITE', '', 'milagros@gmail.com', 'a6f30815a43f38ec6de95b9a9d74da37', '1700724255profile.png', 'Offline now', 'professor', 'approved', ''),
(81, 1570105816, 'Bianca', 'Lapuz', '20-0838', 'BSIT', '2ND YEAR', 'bianca@gmail.com', '4aa00a7f7aeb32e5a33a25b5b58c657b', '1700753930profile.png', 'Offline now', 'user', 'approved', ''),
(89, 1164647132, 'JC', 'Pumarada', '20-1111', 'BSIT', '4TH YEAR', 'jcpumarada@gmail.com', '3cb40a2999ced13eb6ef041b5a207a3e', '1701016420profile.png', 'Active now', 'user', 'pending', 'accept');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consult`
--
ALTER TABLE `consult`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professor` (`professor`);

--
-- Indexes for table `consult_report`
--
ALTER TABLE `consult_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `professor_availability`
--
ALTER TABLE `professor_availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professor_id` (`professor_id`);

--
-- Indexes for table `professor_schedule`
--
ALTER TABLE `professor_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professor_id` (`professor_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `consult`
--
ALTER TABLE `consult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `consult_report`
--
ALTER TABLE `consult_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `professor_availability`
--
ALTER TABLE `professor_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `professor_schedule`
--
ALTER TABLE `professor_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `professor_availability`
--
ALTER TABLE `professor_availability`
  ADD CONSTRAINT `professor_availability_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `professor_schedule`
--
ALTER TABLE `professor_schedule`
  ADD CONSTRAINT `professor_schedule_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
