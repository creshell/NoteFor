-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2024 at 06:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phplogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`user_id`, `username`, `password`, `email`) VALUES
(14, 'admin1', '$2y$10$QBds5enNkFcJ6/AhddxwfuvLEm02Ohcr1XPF0S/MlY6xoKg0X5582', 'admin1@gmail.com'),
(15, 'rklaroa182416', '$2y$10$i3oqRc6zoFIbfZE.Gb2XRee8RrWD7Iu0nVyCCpEtPzNfxFYIc077G', 'rklaroa@gmail.com'),
(16, 'kapoya', '$2y$10$iU85LByTOdZ4Zc4SLF2WQ.oTLtB7ius3KyU67EC9oAnCj9gA6n322', 'laban@gmail.com'),
(17, 'rkteloy125', '$2y$10$npN5zi0r0mskRgQMoANV5u4ZRWrtdWmU3IRjLaw8.74K7oSw7fdm.', 'rkteloy@gmail.com'),
(18, 'admin128', '$2y$10$tmPoG1DhvypsjmsYuvAIOeq0xQNSYrl0tffFA/61ZwuAY0W.l/wli', 'rklaroa@gmail.com'),
(19, 'jake9991', '$2y$10$2tZWMoxDHRuzfspjDe4fRu0R2WyxZ4TGjkolZvP1HPS1c5lj1vK5e', 'jake991@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

CREATE TABLE `archive` (
  `notes_id` int(11) NOT NULL,
  `archive_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archive`
--

INSERT INTO `archive` (`notes_id`, `archive_id`) VALUES
(41, 0),
(27, 0),
(39, 0);

-- --------------------------------------------------------

--
-- Table structure for table `favorite_note`
--

CREATE TABLE `favorite_note` (
  `notes_id` int(11) NOT NULL,
  `fav_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorite_note`
--

INSERT INTO `favorite_note` (`notes_id`, `fav_id`) VALUES
(37, 1),
(37, 1),
(35, 1),
(33, 1),
(30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `notes_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `notes_username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`notes_id`, `user_id`, `title`, `description`, `created_at`, `notes_username`) VALUES
(18, 17, 'my first note', 'kapoy pero bawal sumuko', '2024-04-19 00:29:11', 'admin1'),
(19, 17, 'yey mo add ', 'ambot mo display bah ni\r\n', '2024-04-19 00:31:55', 'admin128'),
(20, 17, 'die trying', 'i would betray the world than let the world betrayed me!\r\n', '2024-04-19 00:35:30', ''),
(21, 14, 'please work', 'im so tired and sick of this\r\n', '2024-04-19 15:11:50', ''),
(27, 14, 'tada ', 'wa na jud na mao\r\n', '2024-04-21 00:47:31', ''),
(30, 14, 'anti-social', 'i tried so hard\r\n', '2024-04-21 02:42:52', ''),
(33, 14, 'fall forward', 'ill see what im going to hit', '2024-04-21 02:44:56', ''),
(34, 19, 'yey', 'weqweqwe', '2024-04-22 14:28:42', ''),
(35, 19, 'rtret', 'e', '2024-04-22 14:28:48', ''),
(36, 19, 'sure uy', 'wrewr', '2024-04-22 14:29:02', ''),
(37, 19, 'etwerewr', 'ewrwer', '2024-04-22 22:56:28', ''),
(38, 14, '45345', '435345', '2024-04-23 00:34:59', ''),
(39, 14, 'erwer', 'ewrew', '2024-04-23 03:39:51', ''),
(40, 14, 'ewrwerew', 'ewrewr', '2024-04-23 07:05:27', ''),
(41, 14, 'rwerwe', 'rwerew', '2024-04-23 07:09:18', ''),
(42, 14, 'ewrwerwe', 'rrwerwe', '2024-04-23 07:10:02', ''),
(43, 14, 'ewrew', 'rwerewr', '2024-04-23 07:11:51', ''),
(50, 14, 'okay', 'life update?gege AHAHAHA', '2024-04-26 16:19:48', '');

-- --------------------------------------------------------

--
-- Table structure for table `trashnote`
--

CREATE TABLE `trashnote` (
  `notes_id` int(11) NOT NULL,
  `trash_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `archive`
--
ALTER TABLE `archive`
  ADD KEY `notes_id` (`notes_id`);

--
-- Indexes for table `favorite_note`
--
ALTER TABLE `favorite_note`
  ADD KEY `notes_id` (`notes_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`notes_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `trashnote`
--
ALTER TABLE `trashnote`
  ADD KEY `notes_id` (`notes_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `notes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archive`
--
ALTER TABLE `archive`
  ADD CONSTRAINT `archive_ibfk_1` FOREIGN KEY (`notes_id`) REFERENCES `notes` (`notes_id`);

--
-- Constraints for table `favorite_note`
--
ALTER TABLE `favorite_note`
  ADD CONSTRAINT `favorite_note_ibfk_1` FOREIGN KEY (`notes_id`) REFERENCES `notes` (`notes_id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`user_id`);

--
-- Constraints for table `trashnote`
--
ALTER TABLE `trashnote`
  ADD CONSTRAINT `trashnote_ibfk_1` FOREIGN KEY (`notes_id`) REFERENCES `notes` (`notes_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
