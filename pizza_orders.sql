-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 08, 2018 at 08:20 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizza_orders`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pizza` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` varchar(10) NOT NULL,
  `ip` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(200) NOT NULL,
  `pizza` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` varchar(10) NOT NULL,
  `ip` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `code`, `pizza`, `qty`, `price`, `ip`) VALUES
(1, 'code-1', 1, 2, '800', '::1'),
(2, 'code-1', 2, 2, '700', '::1'),
(3, 'code-2', 1, 2, '800', '::1'),
(4, 'code-2', 2, 2, '700', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `order_payment`
--

DROP TABLE IF EXISTS `order_payment`;
CREATE TABLE IF NOT EXISTS `order_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(200) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `total_qty` varchar(20) NOT NULL,
  `total_amt` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_payment`
--

INSERT INTO `order_payment` (`id`, `code`, `ip`, `total_qty`, `total_amt`) VALUES
(1, 'code-1', '::1', '4', '1500'),
(2, 'code-2', '::1', '4', '1500');

-- --------------------------------------------------------

--
-- Table structure for table `pizza`
--

DROP TABLE IF EXISTS `pizza`;
CREATE TABLE IF NOT EXISTS `pizza` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(220) NOT NULL,
  `price` varchar(10) NOT NULL,
  `size` varchar(20) NOT NULL,
  `image` varchar(220) NOT NULL,
  `toppings` varchar(220) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pizza`
--

INSERT INTO `pizza` (`id`, `name`, `price`, `size`, `image`, `toppings`) VALUES
(1, 'Farmhouse', '400', 'medium', 'pizza1.jpg', 'Olive,Jalepino,Corn'),
(2, 'Veggie', '350', 'medium', 'pizza2.jpg', 'Olive,Jalepino,Corn,cheese'),
(3, 'Corn Pizza', '400', 'medium', 'pizza3.jpg', 'Olive,Jalepino,Corn'),
(4, 'Italian', '200', 'medium', 'pizza4.jpg', 'Olive,Jalepino,Corn'),
(5, 'Mexican Green', '300', 'medium', 'pizza5.jpg', 'Olive,Jalepino,Corn'),
(6, 'Delux Vegie', '250', 'medium', 'pizza6.jpg', 'Olive,Jalepino,Corn'),
(7, 'American Cheese', '360', 'medium', 'pizza7.jpg', 'Olive,Jalepino,Corn'),
(8, 'Double Cheese', '480', 'medium', 'pizza8.jpg', 'Olive,Jalepino,Corn');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
