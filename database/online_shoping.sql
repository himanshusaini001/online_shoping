-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 02, 2024 at 08:07 AM
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
-- Table structure for table `add_to_cart`
--

CREATE TABLE `add_to_cart` (
  `cart_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `cart_name` varchar(255) NOT NULL,
  `cart_qty` int NOT NULL,
  `cart_price` decimal(10,2) NOT NULL,
  `description` text,
  `cart_color` varchar(50) NOT NULL,
  `cart_size` varchar(20) NOT NULL,
  `total_price` varchar(20) NOT NULL,
  `stock` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `add_to_cart`
--

INSERT INTO `add_to_cart` (`cart_id`, `customer_id`, `product_id`, `cart_name`, `cart_qty`, `cart_price`, `description`, `cart_color`, `cart_size`, `total_price`, `stock`) VALUES
(28, 4, 38, 'Owl', 4, '750.00', 'Best tshirt owl brand', 'Blue', 'S', '9600', 10),
(29, 4, 40, 'Nike', 5, '1150.00', 'Best nike shoes', 'Black', 'S', '5750', 15),
(30, 4, 39, 'Funny tshirt', 1, '850.00', 'Best tshirt', 'Blue', 'XL', '850', 12);

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
-- Table structure for table `billingaddress`
--

CREATE TABLE `billingaddress` (
  `billing_address_id` int NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address_line_1` varchar(100) NOT NULL,
  `address_line_2` varchar(100) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pin_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `billingaddress`
--

INSERT INTO `billingaddress` (`billing_address_id`, `first_name`, `last_name`, `email`, `phone`, `address_line_1`, `address_line_2`, `country`, `city`, `state`, `pin_code`) VALUES
(1, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sad', 'Canada', 'Asdad', 'CA', '435'),
(2, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Fgd', 'USA', 'Gdg', 'NY', '243'),
(3, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfa', 'USA', 'Fddgf', 'NY', '435'),
(4, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'USA', 'Fddgf', 'CA', '435'),
(5, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'USA', 'Frg', 'NY', '452'),
(6, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Ewdw', 'Canada', 'Rre', 'CA', '65877'),
(7, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'USA', 'Erf', 'CA', '435'),
(8, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'Canada', 'Asda', 'NY', '324'),
(9, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'USA', 'Fddgf', 'CA', '435'),
(10, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'Canada', 'Fddgf', 'NY', '435'),
(11, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'USA', 'Sddsa', 'NY', '435'),
(12, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', '435', 'USA', 'Fddgf', 'CA', '435'),
(13, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(14, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(15, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', '435', 'USA', 'Gsdf', 'NY', '435'),
(16, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'USA', 'Asd', 'NY', '4523'),
(17, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'USA', 'Fddgf', 'NY', '34'),
(18, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(19, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(20, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'Canada', 'Fddgf', 'CA', '435'),
(21, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', '435', 'USA', 'Fddgf', 'NY', '234'),
(22, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(23, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(24, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', '435', 'USA', 'Fddgf', 'CA', '232'),
(25, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Ef', 'USA', 'Fddgf', 'CA', '435'),
(26, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'USA', 'Fddgf', 'CA', '435'),
(27, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'USA', 'Fddgf', 'NY', '435243'),
(28, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'Canada', 'Ftgyf', 'NY', '435'),
(29, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(30, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', '56', 'USA', 'Fddgf', 'NY', '546'),
(31, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Mohali', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(32, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Kjhhg', 'NY', '435'),
(33, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'DF', 'NY', '435'),
(34, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Sdf', 'NY', '435'),
(35, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Sdf', 'NY', '435'),
(36, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Sdf', 'NY', '435'),
(37, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(38, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(39, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(40, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'Canada', 'Fddgf', 'NY', '435'),
(41, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(42, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(43, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'CA', '435'),
(44, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'Canada', 'Fddgf', 'NY', '435'),
(45, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(46, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(47, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(48, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(49, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(50, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(51, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'CA', '435'),
(52, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(53, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', '435', 'USA', 'Fddgf', 'NY', '435'),
(54, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(55, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(56, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(57, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(58, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(59, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'Canada', 'Fddgf', 'NY', '435'),
(60, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'Canada', 'Fddgf', 'NY', '435'),
(61, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'Canada', 'Fddgf', 'NY', '435'),
(62, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(63, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(64, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(65, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'CA', '435'),
(66, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(67, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(68, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(69, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(70, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(71, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(72, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(73, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(74, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'Canada', 'Fddgf', 'CA', '435'),
(75, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(76, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'Canada', 'Fddgf', 'NY', '435'),
(77, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(78, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(79, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(80, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(81, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(82, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(83, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(84, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(85, 'Kamal', 'Saini', 'Kamalsaini26112002@gmail.com', '1234567890', 'Derabassi', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(86, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(87, 'Kamal', 'Saini', 'Kamalsaini26112002@gmail.com', '1234567890', 'Derabassi', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(88, 'Satpal', 'Singh', 'Satpalsingh12@gmail.com', '7418529635', 'Kabmit clonay , mubarikpur nera goldan plam', 'Sdfse', 'USA', 'Fddgf', 'NY', '435');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int NOT NULL,
  `cname` varchar(30) NOT NULL,
  `cimg` text,
  `status` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `cname`, `cimg`, `status`) VALUES
(1, 'Tshirt', 'orange_tshirt.png', 1),
(2, 'Jeens', 'scratch_jeen.jpg', 1),
(3, 'Shoes', 'cat-3.jpg', 1),
(4, 'Watch', 'product-6.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clothing_sizes`
--

CREATE TABLE `clothing_sizes` (
  `sid` int NOT NULL,
  `size` varchar(5) DEFAULT NULL,
  `status` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `clothing_sizes`
--

INSERT INTO `clothing_sizes` (`sid`, `size`, `status`) VALUES
(1, 'XS', 1),
(2, 'S', 1),
(3, 'M', 1),
(4, 'L', 1),
(5, 'XL', 1),
(6, 'XXL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `color_id` int NOT NULL,
  `color_name` varchar(50) NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`color_id`, `color_name`, `status`) VALUES
(5, 'Red', 1),
(6, 'Orange', 1),
(7, 'Blue', 1),
(8, 'White', 1),
(57, 'Black', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `address_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `country` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `house_no` varchar(100) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `state` varchar(255) NOT NULL,
  `delivery_instructions` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`address_id`, `customer_id`, `country`, `full_name`, `phone`, `pincode`, `house_no`, `street`, `landmark`, `town`, `state`, `delivery_instructions`) VALUES
(15, 5, 'India', 'Harsh saini', '8699902297', '140201', 'Mubarikpur', 'Goldan plam', 'Goldan plam', 'Goldan plam', 'Punjab', 'House'),
(16, 5, 'India', 'Kamal', '8699902297', '140201', 'Mubarikpur', 'Goldan plam', 'Near Vet Hospital', 'Goldan plam', 'Punjab', 'House'),
(17, 4, 'India', 'Harsh saini', '8699902297', '140201', 'Mubarikpur', 'Goldan plam', 'Goldan plam', 'Goldan plam', 'Punjab', 'House'),
(18, 4, 'India', 'Arjun', '1234567890', '140201', 'Mubarikpur', 'Goldan plam', 'Goldan plam', 'Goldan plam', 'Punjab', 'House'),
(19, 4, 'India', 'Numan', '8699902297', '140201', 'Mubarikpur', 'Goldan plam', 'Goldan plam', 'Goldan plam', 'Punjab', 'House'),
(20, 4, 'India', 'Best', '8699902297', '140201', 'Mubarikpur', 'Goldan plam', 'Goldan plam', 'Goldan plam', 'Punjab', 'House');

-- --------------------------------------------------------

--
-- Table structure for table `customer_contact`
--

CREATE TABLE `customer_contact` (
  `customer_id` int NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_contact`
--

INSERT INTO `customer_contact` (`customer_id`, `fname`, `lname`, `email`, `phone`, `message`) VALUES
(3, 'harsh', 'saini', 'himanshusaini26112002@gmail.com', '7412589630', 'efe'),
(4, 'harsh', 'saini', 'himanshusaini26112002@gmail.com', '7412589630', 'hello'),
(5, 'harsh', 'saini', 'himanshusaini26112002@gmail.com', '7412589630', 'dfe'),
(6, 'harsh', 'saini', 'anitadevi@gmail.com', '7412589630', 'dgf'),
(7, 'harsh', 'saini', 'anitadevi@gmail.com', '7412589630', 'dgf'),
(8, 'harsh', 'saini', 'anitadevi@gmail.com', '7412589630', 'dgf');

-- --------------------------------------------------------

--
-- Table structure for table `inquery`
--

CREATE TABLE `inquery` (
  `id` int NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `message` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `lid` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `order_type` varchar(255) NOT NULL,
  `total_price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `place_order_list`
--

INSERT INTO `place_order_list` (`place_order_id`, `order_id`, `order_name`, `order_color`, `order_size`, `order_qut`, `order_amount`, `order_type`, `total_price`) VALUES
(196, 40, 'Nike', 'Black', 'S', '4', '1150.00', 'cash', '4600'),
(197, 40, 'Nike', 'Black', 'S', '4', '1150.00', 'cash', '4600'),
(198, 40, 'Nike', 'Black', 'S', '4', '1150.00', 'cash', '4600'),
(199, 40, 'Nike', 'Black', 'S', '4', '1150.00', 'cash', '4600'),
(200, 40, 'Nike', 'Black', 'S', '4', '1150.00', 'cash', '4600'),
(201, 40, 'Nike', 'Black', 'S', '4', '1150.00', 'cash', '4600'),
(202, 40, 'Nike', 'Black', 'S', '4', '1150.00', 'cash', '4600'),
(203, 40, 'Nike', 'Black', 'S', '4', '1150.00', 'cash', '4600'),
(204, 37, 'Blue star', 'Black', 'S', '1', '1999.00', 'cash', '1999'),
(205, 37, 'Blue star', 'Black', 'S', '1', '1999.00', 'cash', '1999'),
(206, 37, 'Blue star', 'Black', 'S', '1', '1999.00', 'cash', '1999'),
(207, 38, 'Owl', 'Blue', 'S', '4', '750.00', 'cash', '9600');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int NOT NULL,
  `category` varchar(10) NOT NULL,
  `product_color` varchar(50) NOT NULL,
  `product_size` varchar(10) NOT NULL,
  `stock` varchar(5) NOT NULL,
  `price` int NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `product_img` text NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category`, `product_color`, `product_size`, `stock`, `price`, `product_name`, `description`, `product_img`, `status`) VALUES
(35, '4', 'Black', 'S', '10', 1000, 'Blue star', 'Best watch', '../admin/assets/upload_img/blue_star1.jpg,../admin/assets/upload_img/blue_star2.jpg,../admin/assets/upload_img/blue_star3.jpg,../admin/assets/upload_img/blue_star4.jpg,../admin/assets/upload_img/blue_star5.jpg', 1),
(37, '4', 'Black', 'S', '13', 1999, 'Blue star', 'Best diamond watch', '../admin/assets/upload_img/diamond_watch_1.jpg,../admin/assets/upload_img/diamond_watch_2.png,../admin/assets/upload_img/diamond_watch_3.png,../admin/assets/upload_img/diamond_watch_4.png,../admin/assets/upload_img/diamond_watch_5.png', 1),
(38, '1', 'Blue', 'S', '6', 750, 'Owl', 'Best tshirt owl brand', '../admin/assets/upload_img/blue_tshirt.jpg,../admin/assets/upload_img/blue_tshirt_2.png,../admin/assets/upload_img/blue_tshirt_3.png,../admin/assets/upload_img/blue_tshirt_4.png,../admin/assets/upload_img/blue_tshirt_5.png', 1),
(39, '1', 'Blue', 'XL', '12', 850, 'Funny tshirt', 'Best tshirt', '../admin/assets/upload_img/red_tshirt_1.png,../admin/assets/upload_img/red_tshirt_2.png,../admin/assets/upload_img/red_tshirt_3.png,../admin/assets/upload_img/red_tshirt_4.png,../admin/assets/upload_img/red_tshirt_5.png', 1),
(40, '3', 'Black', 'S', '15', 1150, 'Nike', 'Best nike shoes', '../admin/assets/upload_img/nike_shoes_1.png,../admin/assets/upload_img/nike_shoes_2.png,../admin/assets/upload_img/nike_shoes_3.png,../admin/assets/upload_img/nike_shoes_4.png,../admin/assets/upload_img/nike_shoes_5.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `social_media_id` int NOT NULL,
  `website_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `google_map_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`social_media_id`, `website_name`, `email`, `location`, `phone`, `twitter_link`, `facebook_link`, `linkedin_link`, `instagram_link`, `google_map_link`) VALUES
(1, 'Online Shopping', 'Himanshusaini26112002@gmail.com', 'Panchkula', '8699902297', 'Https://twitter.com/i/flow/login', 'Https://www.facebook.com/', 'Https://in.linkedin.com/', 'Https://www.instagram.com/accounts/login/', 'https://www.google.com/maps/place/Panchkula,+Haryana/@30.7026265,76.7798488,12z/data=!3m1!4b1!4m6!3m5!1s0x390f936ed6a2b757:0x898668d7061b40f0!8m2!3d30.6942091!4d76.860565!16zL20vMDk4MHB2?entry=ttu');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
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
  `otp` varchar(6) DEFAULT NULL,
  `status` varchar(6) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`sid`, `fname`, `lname`, `email`, `phone`, `address`, `username`, `password`, `created_at`, `updated_at`, `otp`, `status`) VALUES
(5, 'Kamal', 'Saini', 'kamalsaini26112002@gmail.com', '1234567890', 'Derabassi', 'admin', '7f58341b9dceb1f1edca80dae10b92bc', '2024-03-27 11:01:15', '2024-04-02 08:03:56', '297410', '1'),
(3, 'Anita', 'Devi', 'anitadevi@gmail.com', '7412589630', 'Derabassi', 'admin', '6a2e2c33086162a2dfb92d0a4decfde8', '2024-03-13 12:39:44', '2024-03-19 13:11:20', '851222', '0'),
(4, 'Satpal', 'Singh', 'satpalsingh12@gmail.com', '7418529635', 'kabmit clonay , mubarikpur nera goldan plam ', 'admin', '7a8a81d85dd319e11600a19f6602fc3d', '2024-03-18 07:41:03', '2024-03-27 07:09:26', '519505', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_to_cart`
--
ALTER TABLE `add_to_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billingaddress`
--
ALTER TABLE `billingaddress`
  ADD PRIMARY KEY (`billing_address_id`);

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
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `customer_contact`
--
ALTER TABLE `customer_contact`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `inquery`
--
ALTER TABLE `inquery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `place_order_list`
--
ALTER TABLE `place_order_list`
  ADD PRIMARY KEY (`place_order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`social_media_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_to_cart`
--
ALTER TABLE `add_to_cart`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `billingaddress`
--
ALTER TABLE `billingaddress`
  MODIFY `billing_address_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `clothing_sizes`
--
ALTER TABLE `clothing_sizes`
  MODIFY `sid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `color_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `customer_contact`
--
ALTER TABLE `customer_contact`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inquery`
--
ALTER TABLE `inquery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `lid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `place_order_list`
--
ALTER TABLE `place_order_list`
  MODIFY `place_order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `social_media_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `sid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
