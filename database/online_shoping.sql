-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 08, 2024 at 07:07 AM
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
(1, 1, 1, 'Red', 1, '1000.00', 'Best', 'Red', 'S', '6000', 10),
(2, 1, 4, 'Nike', 3, '999.00', 'Best shoes', 'Black', 'S', '18197', 25),
(13, 2, 3, 'Dimodan', 2, '2500.00', 'Best watch', 'Black', 'M', '5000', 20),
(15, 2, 1, 'Red', 2, '1000.00', 'Best', 'Red', 'S', '2000', 10);

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
(1, 'Kamal', 'Saini', 'Kamalsaini26112002@gmail.com', '1234567890', 'Mubarikpur', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(2, 'Anita', 'Devi', 'Anitadevi@gmail.com', '8699902297', 'Derabassi', 'Sdfse', 'Canada', 'Fddgf', 'NY', '435'),
(3, 'Anita', 'Devi', 'Anitadevi@gmail.com', '8699902297', 'Derabassi', 'Sdfse', 'USA', 'Fddgf', 'NY', '435'),
(4, 'Anita', 'Devi', 'Anitadevi@gmail.com', '8699902297', 'Derabassi', 'Sdfse', 'USA', 'Fddgf', 'NY', '45725'),
(5, 'Anita', 'Devi', 'Anitadevi@gmail.com', '8699902297', 'Derabassi', 'Sdfse', 'USA', 'Fddgf', 'NY', '245'),
(6, 'Anita', 'Devi', 'Anitadevi@gmail.com', '8699902297', 'Derabassi', 'Sdfse', 'USA', 'Fddgf', 'NY', '6476'),
(7, 'Anita', 'Devi', 'Anitadevi@gmail.com', '8699902297', 'Derabassi', 'Sdfse', 'USA', 'Fddgf', 'NY', '454'),
(8, 'Anita', 'Devi', 'Anitadevi@gmail.com', '8699902297', 'Derabassi', 'Sdfse', 'USA', 'Fddgf', 'NY', '4534'),
(9, 'Anita', 'Devi', 'Anitadevi@gmail.com', '8699902297', 'Derabassi', 'Sdfse', 'USA', 'Fddgf', 'NY', '534'),
(10, 'Anita', 'Devi', 'Anitadevi@gmail.com', '8699902297', 'Derabassi', 'Sdfse', 'USA', 'Fddgf', 'NY', '5645'),
(11, 'Anita', 'Devi', 'Anitadevi@gmail.com', '8699902297', 'Derabassi', 'Sdfse', 'USA', 'Fddgf', 'NY', '45'),
(12, 'Anita', 'Devi', 'Anitadevi@gmail.com', '8699902297', 'Derabassi', 'Sdfse', 'USA', 'Fddgf', 'NY', '534'),
(13, 'Anita', 'Devi', 'Anitadevi@gmail.com', '8699902297', 'Derabassi', 'Sdfse', 'USA', 'Fddgf', 'CA', '255'),
(14, 'Anita', 'Devi', 'Anitadevi@gmail.com', '8699902297', 'Derabassi', 'Sdfse', 'USA', 'Fddgf', 'NY', '7675'),
(15, 'Anita', 'Devi', 'Anitadevi@gmail.com', '8699902297', 'Derabassi', 'Sdfse', 'USA', 'Fddgf', 'NY', '43543'),
(16, 'Anita', 'Devi', 'Anitadevi@gmail.com', '8699902297', 'Derabassi', 'Sdfse', 'USA', 'Fddgf', 'NY', '222'),
(17, 'Anita', 'Devi', 'Anitadevi@gmail.com', '8699902297', 'Derabassi', 'Sdfse', 'USA', 'Fddgf', 'NY', '2423'),
(18, 'Anita', 'Devi', 'Anitadevi@gmail.com', '8699902297', 'Derabassi', 'Sdfse', 'USA', 'Fddgf', 'NY', '4342');

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
(1, 'Tshirt', 'red_tshirt_1.png', 1),
(2, 'Jeens', 'jeens_blue.png', 1),
(3, 'Shoes', 'cat-3.jpg', 1),
(4, 'Watch', 'blue_star1.jpg', 1);

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
(3, 'L', 1),
(4, 'XL', 1),
(5, 'XXL', 1),
(6, 'XXXL', 1);

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
(1, 'Red', 1),
(2, 'Black', 1),
(4, 'Blue', 1),
(5, 'Yellow', 1);

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
(1, 2, 'India', 'Harsh saini', '8699902297', '140201', 'Mubarikpur', 'Goldan plam', 'Goldan plam', 'Goldan plam', 'Punjab', 'House'),
(2, 2, 'India', 'Arjun', '8699902297', '140201', 'Mubarikpur', 'Goldan plam', 'Goldan plam', 'Goldan plam', 'Punjab', 'House');

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
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `order_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_qty` int NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_color` varchar(50) NOT NULL,
  `product_size` varchar(20) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`order_id`, `customer_id`, `product_id`, `product_name`, `product_qty`, `product_price`, `product_color`, `product_size`, `total_price`, `order_type`) VALUES
(23, 3, 1, 'Bluestar', 3, '1000.00', 'Black', 'S', '3000.00', 'cash'),
(24, 3, 2, 'Spider', 2, '999.00', 'Red', 'S', '1998.00', 'cash');

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
(1, '4', 'Black', 'S', '22', 1000, 'Bluestar', 'Bests', '../admin/assets/upload_img/blue_star1.jpg,../admin/assets/upload_img/blue_star2.jpg,../admin/assets/upload_img/blue_star3.jpg,../admin/assets/upload_img/blue_star4.jpg,../admin/assets/upload_img/blue_star5.jpg', 1),
(2, '1', 'Red', 'S', '8', 999, 'Spider', 'Best product', '../admin/assets/upload_img/red_tshirt_1.png,../admin/assets/upload_img/red_tshirt_2.png,../admin/assets/upload_img/red_tshirt_3.png,../admin/assets/upload_img/red_tshirt_4.png,../admin/assets/upload_img/red_tshirt_5.png', 1),
(6, '3', 'Black', 'L', '30', 1499, 'Nike', 'Best shoes', '../admin/assets/upload_img/nike_shoes_1.png,../admin/assets/upload_img/nike_shoes_2.png,../admin/assets/upload_img/nike_shoes_3.png,../admin/assets/upload_img/nike_shoes_4.png,../admin/assets/upload_img/nike_shoes_5.png', 1),
(7, '4', 'Black', 'L', '10', 1999, 'Diamond', 'Best diamond Watch', '../admin/assets/upload_img/diamond_watch_1.jpg,../admin/assets/upload_img/diamond_watch_2.png,../admin/assets/upload_img/diamond_watch_3.png,../admin/assets/upload_img/diamond_watch_4.png,../admin/assets/upload_img/diamond_watch_5.png', 1);

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
(1, 'Harsh', 'Saini', 'harshsaini26112002@gmail.com', '8699902297', 'Derabassi', 'admin', 'b0aa651c991deca550252ed6cbba99ba', '2024-04-02 12:45:23', '2024-04-02 12:51:35', '527586', '1'),
(2, 'Kamal', 'Saini', 'kamalsaini26112002@gmail.com', '1234567890', 'Mubarikpur', 'admin', '7f58341b9dceb1f1edca80dae10b92bc', '2024-04-02 12:52:53', '2024-04-02 12:53:27', '453138', '1'),
(3, 'Anita', 'Devi', 'anitadevi@gmail.com', '8699902297', 'Derabassi', 'admin', 'cf0761a0e0eb3fa006dc5dd9844736b0', '2024-04-05 10:18:29', '2024-04-05 10:40:12', '125663', '1');

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
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`order_id`);

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
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `billingaddress`
--
ALTER TABLE `billingaddress`
  MODIFY `billing_address_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clothing_sizes`
--
ALTER TABLE `clothing_sizes`
  MODIFY `sid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `color_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_contact`
--
ALTER TABLE `customer_contact`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `social_media_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `sid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
