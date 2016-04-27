-- phpMyAdmin SQL Dump
-- version 4.2.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2016 at 03:17 PM
-- Server version: 5.5.46
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `duc`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`food_id` int(100) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) unsigned NOT NULL,
  `location` varchar(50) NOT NULL,
  `prep_time` tinyint(3) unsigned NOT NULL,
  `calories` int(50) NOT NULL,
  `serving_size` varchar(50) NOT NULL,
  `total_fat` float NOT NULL,
  `cholesterol` int(50) NOT NULL,
  `sodium` int(50) NOT NULL,
  `total_carbs` int(50) NOT NULL,
  `protein` int(50) NOT NULL,
  `calcium` int(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`food_id`, `name`, `price`, `location`, `prep_time`, `calories`, `serving_size`, `total_fat`, `cholesterol`, `sodium`, `total_carbs`, `protein`, `calcium`) VALUES
(1, 'Low-Fat, Turkey Breast on Wheat Bread', '8.50', 'A', 8, 280, '7.7', 3.5, 20, 670, 46, 18, 300),
(2, 'Meatball Marinara (6") on Wheat Bread', '9.00', 'A', 7, 479, '10.6', 18, 30, 920, 59, 21, 350),
(3, 'Ribeye Steak (12 oz.), without sides', '18.00', 'B', 15, 669, 'plate', 47, 0, 980, 4, 58, 0),
(4, 'Hand-Battered Fish & Chips', '13.00', 'B', 16, 1698, 'order', 125, 0, 2820, 96, 47, 0),
(5, 'Bourbon Street Chicken & Shrimp', '16.00', 'B', 20, 609, 'order', 27, 0, 1960, 39, 55, 0),
(6, 'French Onion Soup', '7.00', 'A', 15, 370, 'bowl', 23, 0, 1410, 25, 17, 0),
(7, 'Tomato Basil Soup', '6.50', 'A', 15, 290, 'bowl', 17, 0, 1530, 29, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`order_id` int(10) unsigned NOT NULL,
  `username` varchar(20) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pickup_time` time NOT NULL,
  `completion` tinyint(3) unsigned NOT NULL,
  `start_prep` tinyint(3) unsigned NOT NULL,
  `location` varchar(50) NOT NULL,
  `status` enum('New Order','Food Prepared','Picked Up','Order Closed') NOT NULL DEFAULT 'New Order',
  `amount` int(11) NOT NULL,
  `cost` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `username`, `order_time`, `pickup_time`, `completion`, `start_prep`, `location`, `status`, `amount`, `cost`) VALUES
(4, 'test123', '2016-04-27 08:25:35', '00:00:00', 0, 0, '', 'New Order', 3, 24.5),
(5, 'test123', '2016-04-27 08:27:21', '00:00:00', 0, 0, '', 'New Order', 2, 34),
(6, 'test123', '2016-04-27 08:29:38', '00:00:00', 0, 0, '', 'New Order', 2, 29),
(7, 'testtest', '2016-04-27 08:30:06', '00:00:00', 0, 0, '', 'New Order', 4, 34),
(8, 'testtest', '2016-04-27 14:35:36', '00:00:00', 0, 0, '', 'New Order', 2, 31),
(9, 'test1234', '2016-04-27 15:12:37', '00:00:00', 0, 0, '', 'New Order', 1, 8.5);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
`detail_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` tinyint(3) unsigned NOT NULL,
  `status` enum('New Order','Food Prepared','Picked Up','Order Closed') NOT NULL DEFAULT 'New Order'
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`detail_id`, `order_id`, `food_id`, `quantity`, `status`) VALUES
(11, 4, 0, 1, 'New Order'),
(12, 4, 1, 1, 'New Order'),
(13, 4, 2, 1, 'New Order'),
(14, 5, 4, 1, 'New Order'),
(15, 5, 6, 1, 'New Order'),
(16, 6, 5, 1, 'New Order'),
(17, 6, 6, 1, 'New Order'),
(18, 7, 0, 4, 'New Order'),
(19, 8, 5, 1, 'New Order'),
(20, 8, 4, 1, 'New Order'),
(21, 9, 0, 1, 'New Order');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE IF NOT EXISTS `sellers` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `salt` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `username`, `location`, `password`, `salt`) VALUES
(1, 's1', 'A', '0UBh9AW6Hmj12', '0UBh9AW6Hmj12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(20) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `student_id` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `balance` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `student_id`, `password`, `balance`) VALUES
(1, 'u1', '', '', 123, 'aAACq8oG7BwJE', '0.00'),
(2, 'a', '', '', 1, 'FT8ol57pNLWgc', '0.00'),
(3, 'ab', '', '', 123, '0UBh9AW6Hmj12', '0.00'),
(4, 'test123', 'test', '123', 123, 'uFmcGlJbxXO2g', '0.00'),
(5, 'testtest', 'testtest', 'testtest', 0, 'c8i7FvX0tbnIA', '0.00'),
(6, 'test1234', 'Yu', 'L', 444987, 'hPKyCTEWwf9Fo', '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
 ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `food_id` int(100) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
MODIFY `detail_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
