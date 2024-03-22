-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 22, 2024 at 11:39 AM
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
-- Table structure for table `place_order_list`
--

CREATE TABLE `place_order_list` (
  `place_order_id` int NOT NULL,
  `order_id` int NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `order_color` varchar(50) NOT NULL,
  `order_size` varchar(20) NOT NULL,
  `order_qut` varchar(6) NOT NULL,
  `order_amount` varchar(10) NOT NULL,
  `order_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `place_order_list`
--

INSERT INTO `place_order_list` (`place_order_id`, `order_id`, `order_name`, `order_color`, `order_size`, `order_qut`, `order_amount`, `order_type`) VALUES
(1, 37, 'Blue star', 'Black', 'S', '2', '3998', 'cash'),
(2, 37, 'Blue star', 'Black', 'S', '2', '3998', 'cash'),
(3, 37, 'Blue star', 'Black', 'S', '2', '3998', 'cash'),
(4, 37, 'Blue star', 'Black', 'S', '2', '3998', 'cash'),
(5, 37, 'Blue star', 'Black', 'S', '2', '3998', 'cash'),
(6, 37, 'Blue star', 'Black', 'S', '1', '2039', 'cash');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `place_order_list`
--
ALTER TABLE `place_order_list`
  ADD PRIMARY KEY (`place_order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `place_order_list`
--
ALTER TABLE `place_order_list`
  MODIFY `place_order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
