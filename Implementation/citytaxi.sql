-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 06:30 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `citytaxi`
--

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driverID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `licenceNumber` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `vehicle` varchar(255) NOT NULL,
  `employment` varchar(255) NOT NULL,
  `profilePicture` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driverID`, `firstName`, `lastName`, `mobile`, `licenceNumber`, `address`, `vehicle`, `employment`, `profilePicture`, `email`, `password`) VALUES
(17, 'tahani', 'hareeth', '4546576', '0954321', 'badulla', 'Bike', 'fullTime', '', 'hareethg12@gmail.com', '$2y$10$jjIkmmEBrMyQPUFCAVZEpuigB9ExSsOj6z5jmGDtWzL.Ep8vg1gaG'),
(18, 'tani', 'Hareeth', '1234567890', '0987654321', 'kandy', 'Van', 'fullTime', '', 'hareethtahani@gmail.com', '$2y$10$Zegi1o5LsvW4nvcENByUxuxR3pb7LFQL0BTuU0wwU0dieQpdgU.fi');

-- --------------------------------------------------------

--
-- Table structure for table `driverstatuslist`
--

CREATE TABLE `driverstatuslist` (
  `statusID` int(11) NOT NULL,
  `driverID` int(11) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `status` varchar(100) NOT NULL,
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driverstatuslist`
--

INSERT INTO `driverstatuslist` (`statusID`, `driverID`, `latitude`, `longitude`, `status`, `updatedAt`) VALUES
(1, 0, 7, 80, 'available', '2024-09-23 20:40:39'),
(2, 17, 6.9354, 79.8981, 'available', '2024-09-23 20:49:48');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `passengerID` int(11) NOT NULL,
  `firstName` varchar(150) NOT NULL,
  `lastName` varchar(150) NOT NULL,
  `mobile` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`passengerID`, `firstName`, `lastName`, `mobile`, `email`, `password`) VALUES
(1, '', '', 123456, 'hareethtahani@gmail.com', '$2y$10$x8Ul1SAV02zfNi0ega.lt.nyCLrV36/r06Y6z0NVoUyS2BkThy4vq'),
(2, 'tani', 'Hareeth', 1234567890, 'hareethg12@gmail.com', '$2y$10$MzeIqWqw9CRRT9AYOkOY/OCFBcvQn4hdIPmetmk2c2HM0UuS7Dv2G');

-- --------------------------------------------------------

--
-- Table structure for table `ride`
--

CREATE TABLE `ride` (
  `rideID` int(11) NOT NULL,
  `pickupLocation` varchar(255) NOT NULL,
  `dropLocation` varchar(255) NOT NULL,
  `distance` float NOT NULL,
  `fare` float NOT NULL,
  `passengerID` int(11) NOT NULL,
  `driverID` int(11) NOT NULL,
  `requestAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rideStatus` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ride`
--

INSERT INTO `ride` (`rideID`, `pickupLocation`, `dropLocation`, `distance`, `fare`, `passengerID`, `driverID`, `requestAt`, `rideStatus`) VALUES
(13, '79.854174,6.938961', '80.635015,7.293021', 141.05, 143.05, 2, 18, '2024-09-24 19:05:56', ''),
(15, '80.625889,7.295167', '80.63307,7.302162', 2.34, 4.34, 2, 18, '2024-09-24 19:05:56', ''),
(16, '80.625889,7.295167', '80.684483,7.280455', 10.09, 12.09, 2, 17, '2024-09-24 19:05:56', ''),
(17, '81.057063,6.989852', '80.635015,7.293021', 115.75, 117.75, 2, 17, '2024-09-24 19:06:41', ''),
(18, '80.366943,7.486254', '80.635015,7.293021', 41.97, 2225.38, 0, 17, '2024-09-24 19:25:58', ''),
(19, '80.635001,7.293024', '81.057063,6.989852', 115.84, 5919.17, 2, 18, '2024-09-24 19:46:06', ''),
(20, '80.635001,7.293024', '80.624956,7.322206', 4.35, 328.03, 2, 18, '2024-09-24 20:43:57', 'Pending'),
(21, '80.625889,7.295167', '79.854174,6.938961', 131.86, 6720.17, 2, 17, '2024-09-25 16:22:14', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driverID`);

--
-- Indexes for table `driverstatuslist`
--
ALTER TABLE `driverstatuslist`
  ADD PRIMARY KEY (`statusID`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`passengerID`);

--
-- Indexes for table `ride`
--
ALTER TABLE `ride`
  ADD PRIMARY KEY (`rideID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driverID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `driverstatuslist`
--
ALTER TABLE `driverstatuslist`
  MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `passengerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ride`
--
ALTER TABLE `ride`
  MODIFY `rideID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
