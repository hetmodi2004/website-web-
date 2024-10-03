-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 03, 2024 at 04:14 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `decordb`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `package_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(20) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending ',
  PRIMARY KEY (`package_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`package_id`, `customer_name`, `customer_email`, `booking_date`, `booking_time`, `package_name`, `status`) VALUES
(1, 'Het Modi ', 'hetmodi206@gmail.com', '2024-09-30', '14:10:00', 'wedding decoration ', 'Pending'),
(2, 'nimesh modi ', 'nimesh@gmail.com', '2024-10-29', '01:50:00', 'wedding decoration ', 'Approved'),
(3, 'nimesh modi ', 'nimesh206@gmail.com', '2024-10-30', '13:30:00', 'wedding decoration ', 'Approved'),
(4, 'pradipsinh parmar ', 'pradip@gmail.com', '2024-11-05', '20:35:00', 'wedding decoration ', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `title` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`title`, `event_date`, `description`) VALUES
('magic show decoration ', '2024-09-28', 'magic is good'),
('government function decoration', '2024-09-30', 'nothing ');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

DROP TABLE IF EXISTS `package`;
CREATE TABLE IF NOT EXISTS `package` (
  `package_name` varchar(200) NOT NULL,
  `package_price` varchar(200) NOT NULL,
  `package_description` text NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_name`, `package_price`, `package_description`, `id`, `package_image`) VALUES
('wedding decoration ', '20000', 'Elegance meets romance. â¤ï¸ \r\nLove is in the details. âœ¨  ', 1, 'uploads/download.jpeg'),
('Birthday decoration ', '5000', 'Cake, candles, and lots of smiles!\r\n\r\nAnother 365 days of adventures await!', 2, 'uploads/birthday.jpeg'),
('baby shower', '12000', 'nothing ', 3, 'uploads/download (2).jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `email`) VALUES
('het modi', 'het2004', 'het206@gmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
