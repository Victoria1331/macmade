-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 23, 2023 at 11:27 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `macmadee`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin1234');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity_in_stock` int(11) NOT NULL,
  `image_item` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `quantity_in_stock`, `image_item`) VALUES
(1, 'Marshmallow Green', '104.00', 9, '../img/mar1.png'),
(2, 'Marshmallow Gray', '87.00', 14, '../img/mar2.png'),
(3, 'Marshmallow Purple', '99.00', 14, '../img/mar3.png'),
(4, 'Marshmallow Blue', '99.00', 14, '../img/mars.png'),
(6, 'Infinity Green', '70.00', 14, '../img/oreo7.png'),
(7, 'Infinity White', '70.00', 14, '../img/qwe.jpg'),
(8, 'Infinity Coffee', '70.00', 14, '../img/oreo2.png'),
(9, 'Pink Dream', '59.00', 14, '../img/ele1.png'),
(10, 'Blue Dream', '59.00', 14, '../img/ele2.png'),
(11, 'Sky Dream', '59.00', 14, '../img/ele3.png'),
(12, 'Lime Dream', '59.00', 14, '../img/lime.jpg'),
(16, 'Infinity Blue', '50.00', 20, '../img/blue.png'),
(27, 'Rucsac Caramel', '100.00', 10, '../img/rucsac caramel.jpg'),
(28, 'Rucsac Purple', '100.00', 10, '../img/rucsac mov2.jpg'),
(29, 'Rucsac Lime', '80.00', 20, '../img/rucsac lime.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_method` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `delivery_cost` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `fk_orders_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `firstname`, `lastname`, `city`, `address`, `phone`, `email`, `delivery_method`, `payment_method`, `total_amount`, `delivery_cost`) VALUES
(17, 1, 'Didenco', 'Adiela', 'Bucuresti', 'asdfghj', '0123456789', 'adiela@gmail.com', 'FanCurier', 'Cash', '102.00', '15.00'),
(18, 1, 'Didenco', 'Adiela', 'Bucuresti', 'asdfghj', '0123456789', 'adiela@gmail.com', 'FanCurier', 'Cash', '102.00', '15.00'),
(19, 1, 'Didenco', 'Adiela', 'Bucuresti', 'asdfghj', '0123456789', 'adiela@gmail.com', 'FanCurier', 'Cash', '102.00', '15.00'),
(20, 1, 'Didenco', 'Victoria', 'Bucuresti', 'asdfghj', '0123456789', 'didi@gmail.com', 'FanCurier', 'Cash', '102.00', '15.00'),
(21, 1, 'Craciun', 'Ionela', 'Bucuresti', 'Bulevardul 15 Noiembrie ', '0123456789', 'ionela@gmail.com', 'FanCurier', 'Cash', '114.00', '15.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `city`, `address`, `phone`, `email`, `password`, `date_created`) VALUES
(1, 'Victoria', 'Didenco', 'BRASOV', 'Brasov', '0734869490', 'vykentya@gmail.com', '0ddc7d8e369c572720c291609e5f1fc3', '2023-06-07 12:07:21'),
(2, 'Macarie', 'Maria', 'BRASOV', 'Bulevardul 15 noiembrie', '0734869490', 'maria@gmail.com', '0ddc7d8e369c572720c291609e5f1fc3', '2023-06-07 12:26:39'),
(3, 'Ursu', 'Elena', 'BRASOV', 'Bulevardul 15 noiembrie', '0734869904', 'elena@gmail.com', '0ddc7d8e369c572720c291609e5f1fc3', '2023-06-07 12:45:56'),
(4, 'Dragan', 'Anastasia', 'BRASOV', 'Bulevardul 15 noiembrie', '0734869490', 'anastasia@gmail.com', '0ddc7d8e369c572720c291609e5f1fc3', '2023-06-07 19:59:14'),
(5, 'Craciun', 'Ionela', 'Brasov', 'Bulevardul 15 Noiembrie ', '0123456789', 'ionela@gmail.com', '0ddc7d8e369c572720c291609e5f1fc3', '2023-06-14 11:54:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_item`
--

DROP TABLE IF EXISTS `user_item`;
CREATE TABLE IF NOT EXISTS `user_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `status` enum('Added to cart','Confirmed','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_item_ibfk_2` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_item`
--

INSERT INTO `user_item` (`id`, `user_id`, `item_id`, `status`, `date_time`) VALUES
(36, 1, 2, 'Added to cart', '2023-06-18 14:56:45');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
