-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2025 at 06:16 PM
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
-- Database: `simple_cms`
--
CREATE DATABASE IF NOT EXISTS `simple_cms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `simple_cms`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$xe2y1BKI.i1YzLn9Xd4aQej.E3i31o.NagRIEufLip7anUWSxxz9W', '2025-09-03 10:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(3, 'Article 1', 'This is dummy content for article 1', '2025-09-03 12:34:30', NULL),
(4, 'Article 2', 'This is dummy content for article 2', '2025-09-03 12:34:30', NULL),
(5, 'Article 3', 'This is dummy content for article 3', '2025-09-03 12:34:30', NULL),
(6, 'Article 4', 'This is dummy content for article 4', '2025-09-03 12:34:30', NULL),
(7, 'Article 5', 'This is dummy content for article 5', '2025-09-03 12:34:30', NULL),
(8, 'Article 6', 'This is dummy content for article 6', '2025-09-03 12:34:30', NULL),
(9, 'Article 7', 'This is dummy content for article 7', '2025-09-03 12:34:30', NULL),
(10, 'Article 8', 'This is dummy content for article 8', '2025-09-03 12:34:30', NULL),
(11, 'Article 9', 'This is dummy content for article 9', '2025-09-03 12:34:30', NULL),
(12, 'Article 10', 'This is dummy content for article 10', '2025-09-03 12:34:30', NULL),
(13, 'Tesing', 'content', '2025-09-03 14:14:47', NULL),
(14, 'Demo', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio necessitatibus laboriosam rerum asperiores. Eos temporibus repellat fugit cumque laboriosam odio non reprehenderit perferendis est? Cupiditate doloribus accusamus eligendi accusantium enim.', '2025-09-03 15:03:19', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
