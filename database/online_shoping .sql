-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 07, 2024 at 06:53 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_shoping`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'harsh', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int NOT NULL,
  `cname` varchar(30) NOT NULL,
  `cimg` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `cname`, `cimg`) VALUES
(1, 'sahil', 'C:fakepathyoda.gif'),
(2, 'rohit saini', 'C:fakepathavatar.png'),
(3, 'kamal', 'C:fakepathavatar2.png'),
(27, 'efew', 'C:fakepathyoda.gif'),
(25, 'ef', 'C:fakepathyoda.gif'),
(26, 'dsfg', 'C:fakepathyoda.gif'),
(20, 'sahil', 'C:fakepathyoda.gif'),
(22, 'sdcs', 'C:fakepathyoda.gif'),
(23, 'sads', 'C:fakepathyoda.gif'),
(28, 'edwf', 'C:fakepathyoda.gif'),
(29, 'sahil', 'C:fakepathyoda.gif'),
(30, 'bunty', 'C:fakepathyoda.gif');

-- --------------------------------------------------------

--
-- Table structure for table `clothing_sizes`
--

CREATE TABLE `clothing_sizes` (
  `sid` int NOT NULL,
  `size` varchar(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `clothing_sizes`
--

INSERT INTO `clothing_sizes` (`sid`, `size`) VALUES
(14, 'M'),
(7, 'S'),
(13, 'XL'),
(15, 'XXL'),
(16, 'XXXL');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `color_id` int NOT NULL,
  `color_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`color_id`, `color_name`) VALUES
(17, 'cyan'),
(7, 'red'),
(12, 'teal'),
(15, 'white'),
(16, 'yellow');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `lid` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`lid`, `username`, `password`) VALUES
(1, 'harsh', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `sid` int NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `otp` varchar(6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`sid`, `fname`, `lname`, `email`, `phone`, `address`, `username`, `password`, `created_at`, `updated_at`, `otp`) VALUES
(1, 'himanshu', 'saini', 'himanshusaini26112002@gmail.com', '8699902297', 'mubarikpur', 'admin', 'himanshu123', '2024-02-29 05:27:29', '2024-02-29 05:27:29', '722531'),
(2, 'harsh', 'saini', 'harshsaini26112002@gmail.com', '7418529630', 'mubarikpur', 'admin', 'harsh123', '2024-02-29 07:39:12', '2024-02-29 07:39:12', '568310'),
(3, 'kamal', 'saini', 'kamalsaini26112002@gmail.com', '8699902297', 'derabassi', 'admin', 'kamal123', '2024-02-29 11:03:42', '2024-02-29 11:03:42', '411566'),
(4, 'himanshu', 'saini', 'himanshusaini26112002@gmail.com', '8699902297', 'mubarikpur', 'admin', '123456', '2024-03-01 07:14:36', '2024-03-01 07:14:36', '947074');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `clothing_sizes`
--
ALTER TABLE `clothing_sizes`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `size` (`size`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`color_id`),
  ADD UNIQUE KEY `color_name` (`color_name`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `clothing_sizes`
--
ALTER TABLE `clothing_sizes`
  MODIFY `sid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `color_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `lid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `sid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
