-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2023 at 10:34 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` char(40) NOT NULL,
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `first_name`, `last_name`, `email`, `password`, `registration_date`) VALUES
(1, 'Ahmad', 'Admin', 'ahmad@admin.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2023-06-08 21:13:38'),
(2, 'ajwad', 'aqhari', 'ajwad@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2023-06-08 21:48:23'),
(13, 'ahmad', 'adam', 'ahmad@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2023-06-11 16:01:55'),
(14, 'Aqil', 'Akmal', 'aqil@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2023-06-11 16:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` mediumint(8) UNSIGNED NOT NULL,
  `occasion` varchar(15) NOT NULL,
  `e_date` date DEFAULT NULL,
  `e_time` time DEFAULT NULL,
  `e_budget` int(11) DEFAULT NULL,
  `e_pax` int(11) DEFAULT NULL,
  `e_address` varchar(100) DEFAULT NULL,
  `location` varchar(15) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `special_req` varchar(100) DEFAULT NULL,
  `promo_code` varchar(10) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `newsletter_subscription` varchar(5) DEFAULT NULL,
  `total_budget` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `occasion`, `e_date`, `e_time`, `e_budget`, `e_pax`, `e_address`, `location`, `name`, `phone`, `email`, `special_req`, `promo_code`, `company`, `newsletter_subscription`, `total_budget`) VALUES
(1, 'Birthday', '2023-06-10', '10:14:00', 10, 5, 'Lot 18, Jalan Tandok, Sentul', 'Selangor', 'Ajwad', '0179519690', 'ajwad123@gmail.com', 'Add present more', 'UNIKL2023', 'ajwad.co', 'no', NULL),
(8, 'Party', '2023-06-11', '16:50:00', 4, 10, 'Dewan Quill City Mall', 'Kuala Lumpur', 'Jenny', '0179519690', 'jenny@gmail.com', 'Prepare balloons and cakes', 'UNIKL2023', 'jenny.co', 'yes', NULL),
(9, 'Buffet', '2023-06-24', '11:49:00', 5, 6, 'No 90, Taman Sri Tanjung, Setapak', 'Kuala Lumpur', 'Jihan', '0179519690', 'jihan@gmail.com', 'Add lamb meat', 'UNIKL2023', 'jihan.co', 'yes', '0.00'),
(10, 'Party', '2023-06-10', '21:00:00', 5, 60, 'Dewan Besar Uniten, Putrajaya', 'Selangor', 'Nik', '0179519690', 'nik@gmail.com', 'Please add an RGB lamp and sound bar', 'UNIKL2023', 'nik.co', 'yes', '0.00'),
(11, 'Weeding', '2023-06-24', '20:30:00', 20, 4, 'Seoul Garden Setapak Sentral Mall', 'Selangor', 'Afqah', '0179519690', 'afiqah', 'Need VIP room', 'UNIKL2023', 'afiqah.co', 'yes', '80.00'),
(12, 'Buffet', '2023-06-11', '12:30:00', 40, 6, 'Nandos Setapak Centrall Mall', 'Kuala Lumpur', 'Afiqah', '0179519690', 'afiqah@gmail.com', 'VIP room', 'UNIKL2023', 'afiqah.co', 'no', '240.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `user_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
