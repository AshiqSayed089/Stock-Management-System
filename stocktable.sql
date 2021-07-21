-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2021 at 07:13 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `stocktable`
--

CREATE TABLE `stocktable` (
  `Product` varchar(255) NOT NULL,
  `N_Items` int(11) NOT NULL,
  `A_Price` decimal(10,0) NOT NULL,
  `Emails` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stocktable`
--

INSERT INTO `stocktable` (`Product`, `N_Items`, `A_Price`, `Emails`) VALUES
('PRODUCT1', 10, '100', 'm.ashiqsayed@gmail.com'),
('PRODUCT2', 10, '100', 'm.ashiqsayed@gmail.com'),
('PRODUCT3', 10, '100', 'm.ashiqsayed@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stocktable`
--
ALTER TABLE `stocktable`
  ADD PRIMARY KEY (`Product`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
