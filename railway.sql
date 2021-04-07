-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 07, 2021 at 05:20 PM
-- Server version: 8.0.23-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `railway`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `uid` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `trn_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `uid`, `phone`, `password`, `trn_date`) VALUES
(1, 'admin', '8928561564', '21232f297a57a5a743894a0e4a801fc3', '2021-04-03 10:59:48');

-- --------------------------------------------------------

--
-- Table structure for table `passbooking`
--

CREATE TABLE `passbooking` (
  `uid` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `via` varchar(255) NOT NULL,
  `class` int NOT NULL,
  `duration` int NOT NULL,
  `valid_from` varchar(255) NOT NULL,
  `valid_to` varchar(255) NOT NULL,
  `fare` int NOT NULL,
  `booking_time` varchar(255) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `passgeneration`
--

CREATE TABLE `passgeneration` (
  `uid` varchar(255) NOT NULL,
  `ticket_no` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `via` varchar(255) NOT NULL,
  `class` int NOT NULL,
  `duration` int NOT NULL,
  `valid_from` varchar(255) NOT NULL,
  `valid_to` varchar(255) NOT NULL,
  `fare` int NOT NULL,
  `booking_time` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `ticketbooking`
--

CREATE TABLE `ticketbooking` (
  `uid` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `via` varchar(100) NOT NULL,
  `class` int NOT NULL,
  `type` varchar(255) NOT NULL,
  `no_of_ticket` int NOT NULL,
  `fare` int NOT NULL,
  `boarding_time` varchar(255) NOT NULL,
  `booking_time` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `ticketgeneration`
--

CREATE TABLE `ticketgeneration` (
  `ticket_no` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `class` int NOT NULL,
  `type` varchar(255) NOT NULL,
  `no_of_ticket` int NOT NULL,
  `fare` int NOT NULL,
  `boarding_time` varchar(255) NOT NULL,
  `booking_time` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `uid` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `trn_date` datetime NOT NULL
);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uid`, `phone`, `password`, `trn_date`) VALUES
(1, 'test', '1234567890', 'da866cabf093419a02d56b080e03072f', '2021-04-07 17:20:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passgeneration`
--
ALTER TABLE `passgeneration`
  ADD PRIMARY KEY (`barcode`);

--
-- Indexes for table `ticketgeneration`
--
ALTER TABLE `ticketgeneration`
  ADD PRIMARY KEY (`barcode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
