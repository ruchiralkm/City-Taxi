-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2024 at 04:49 PM
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
  `regNo` varchar(255) NOT NULL,
  `vehicleBrand` varchar(255) NOT NULL,
  `vehicleModel` varchar(255) NOT NULL,
  `vYear` int(11) NOT NULL,
  `vColor` varchar(255) NOT NULL,
  `profilePicture` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driverID`, `firstName`, `lastName`, `mobile`, `licenceNumber`, `address`, `vehicle`, `employment`, `regNo`, `vehicleBrand`, `vehicleModel`, `vYear`, `vColor`, `profilePicture`, `email`, `password`) VALUES
(17, 'tahani', 'hareeth', '4546576', '0954321', 'badulla', 'Bike', 'fullTime', '0', '', '', 0, '', '', 'hareethg12@gmail.com', '$2y$10$jjIkmmEBrMyQPUFCAVZEpuigB9ExSsOj6z5jmGDtWzL.Ep8vg1gaG'),
(18, 'tani', 'Hareeth', '1234567890', '0987654321', 'kandy', 'Van', 'fullTime', '0', '', '', 0, '', '', 'hareethtahani@gmail.com', '$2y$10$Zegi1o5LsvW4nvcENByUxuxR3pb7LFQL0BTuU0wwU0dieQpdgU.fi'),
(19, 'kalani', 'samarakoon', '09887654321', '12567890', 'gampola, Kandy', 'Car', 'fullTime', '0', '', '', 0, '', 'upload/—Pngtree—self driving car vector_7031243.png', 'kalanisamarakoon13@gmail.com', '$2y$10$fKCPeiAftlGU3d8OgtTljen9cCJnWSe4XhaewVVajZgsWOVsawCXO'),
(20, 'Nirmani', 'Dhanasekara', '0713867679', '0987654321', 'Gampola, Kandy', 'Car', 'fullTime', 'AAA-1211', '', '', 0, '', 'upload/client-1295901_1280.png', 'duckyzam13@gmail.com', '$2y$10$8B4w6L6yjFNsq4BE3BPFZ.bfMOlJQKSDC8sNDYRq0vqfE40akxA3C');

-- --------------------------------------------------------

--
-- Table structure for table `driverratings`
--

CREATE TABLE `driverratings` (
  `id` int(11) NOT NULL,
  `driverID` int(11) NOT NULL,
  `total_ratings` int(11) DEFAULT 0,
  `rating_sum` int(11) DEFAULT 0,
  `rating_avg` decimal(3,2) GENERATED ALWAYS AS (`rating_sum` / nullif(`total_ratings`,0)) STORED,
  `last_rating` int(11) DEFAULT NULL,
  `last_rating_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driverratings`
--

INSERT INTO `driverratings` (`id`, `driverID`, `total_ratings`, `rating_sum`, `last_rating`, `last_rating_date`) VALUES
(1, 0, 1, 4, 4, '2024-09-29 14:23:04');

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
(2, 17, 7.27423, 80.6141, 'Busy', '2024-09-29 06:03:59'),
(3, 20, 6.9394, 79.8476, 'Busy', '2024-09-28 19:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notificationID` int(11) NOT NULL,
  `recipientType` varchar(111) NOT NULL,
  `recipientID` int(11) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notificationID`, `recipientType`, `recipientID`, `Message`, `status`, `timeStamp`) VALUES
(4, 'passenger', 2, 'Your ride with ID 21 has been accepted.', 0, '2024-09-26 16:10:15'),
(5, 'passenger', 2, 'Your ride with ID 21 has been rejected.', 0, '2024-09-26 16:32:40'),
(6, 'passenger', 2, 'Your ride with ID 17 has been accepted.', 0, '2024-09-27 11:04:11'),
(14, 'passenger', 3, 'Your ride with ID 26 has been accepted.', 0, '2024-09-28 14:25:38'),
(15, 'passenger', 2, 'Your ride with ID 31 has been accepted.', 1, '2024-09-29 06:20:11');

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
(2, 'tani', 'Hareeth', 1234567890, 'hareethg12@gmail.com', '$2y$10$MzeIqWqw9CRRT9AYOkOY/OCFBcvQn4hdIPmetmk2c2HM0UuS7Dv2G'),
(3, 'tahani', 'hareeth', 723328246, 'tahanihareeth4@gmail.com', '$2y$10$Fu2pFpDfCNqcEjgVbPMoOuFvZiZTp4cOK1fMj6SKo7QaIReyjwYdi');

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
  `passengerID` varchar(255) NOT NULL,
  `driverID` int(11) NOT NULL,
  `requestAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rideStatus` varchar(150) NOT NULL,
  `passengerType` varchar(255) NOT NULL,
  `passengerMobile` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ride`
--

INSERT INTO `ride` (`rideID`, `pickupLocation`, `dropLocation`, `distance`, `fare`, `passengerID`, `driverID`, `requestAt`, `rideStatus`, `passengerType`, `passengerMobile`) VALUES
(13, '79.854174,6.938961', '80.635015,7.293021', 141.05, 143.05, '2', 18, '2024-09-24 19:05:56', '', '', 0),
(15, '80.625889,7.295167', '80.63307,7.302162', 2.34, 4.34, '2', 18, '2024-09-24 19:05:56', '', '', 0),
(16, '80.625889,7.295167', '80.684483,7.280455', 10.09, 12.09, '2', 17, '2024-09-24 19:05:56', '', '', 0),
(17, '81.057063,6.989852', '80.635015,7.293021', 115.75, 117.75, '2', 17, '2024-09-29 14:06:46', 'completed', '', 0),
(18, '80.366943,7.486254', '80.635015,7.293021', 41.97, 2225.38, '0', 17, '2024-09-24 19:25:58', '', '', 0),
(19, '80.635001,7.293024', '81.057063,6.989852', 115.84, 5919.17, '2', 18, '2024-09-24 19:46:06', '', '', 0),
(20, '80.635001,7.293024', '80.624956,7.322206', 4.35, 328.03, '2', 18, '2024-09-24 20:43:57', 'Pending', '', 0),
(21, '80.625889,7.295167', '79.854174,6.938961', 131.86, 6720.17, '2', 17, '2024-09-26 22:02:40', 'Rejected', '', 0),
(22, '', '', 0, 0, '4', 0, '2024-09-27 19:52:21', 'Pending', 'Unregistered', 0),
(23, '', '', 0, 0, '5', 0, '2024-09-27 19:52:58', 'Pending', 'Unregistered', 0),
(24, '', '', 0, 0, '6', 0, '2024-09-27 20:17:27', 'Pending', 'Unregistered', 0),
(25, '79.854174,6.938961', '79.893421,6.876999', 10.42, 647.92, '7', 0, '2024-09-27 20:40:16', 'Pending', 'Unregistered', 0),
(26, '80.635015,7.293021', '80.624956,7.322206', 4.47, 337.55, '3', 20, '2024-09-29 14:21:04', 'Accepted', '', 0),
(27, '80.635015,7.293021', '80.624956,7.322206', 4.47, 337.55, '<br />\r\n<b>Warning</b>:  Undefined array key ', 17, '2024-09-28 22:07:20', 'Pending', '', 0),
(28, '80.009254,9.665065', '80.410693,8.335092', 193.55, 9804.45, '<br />\r\n<b>Warning</b>:  Undefined array key ', 17, '2024-09-28 22:13:06', 'Pending', '', 0),
(29, '80.625889,7.295167', '80.624956,7.322206', 4.39, 331.51, '2', 17, '2024-09-29 05:56:57', 'Pending', '', 0),
(30, '80.009274,9.665051', '80.408426,9.384001', 64.17, 3335.32, '2', 17, '2024-09-29 06:00:45', 'Pending', '', 0),
(31, '80.624956,7.322206', '80.009274,9.665051', 314.83, 15868.6, '2', 17, '2024-09-29 14:22:58', 'Completed', '', 1234567890);

-- --------------------------------------------------------

--
-- Table structure for table `unregpassengers`
--

CREATE TABLE `unregpassengers` (
  `unregPassengerID` int(20) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `mobilenumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unregpassengers`
--

INSERT INTO `unregpassengers` (`unregPassengerID`, `firstName`, `lastName`, `mobilenumber`) VALUES
(1, 'tanz', 'hide', 1234567890),
(2, 'jk', 'kook', 123456789),
(3, 't', 'v', 2147483647),
(4, 'th', 'kk', 56789),
(5, 'th', 'kk', 56789),
(6, 'kalani', 'samarakoon', 986543),
(7, 'jk', 'v', 67676776);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driverID`);

--
-- Indexes for table `driverratings`
--
ALTER TABLE `driverratings`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `unregpassengers`
--
ALTER TABLE `unregpassengers`
  ADD PRIMARY KEY (`unregPassengerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driverID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `driverratings`
--
ALTER TABLE `driverratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `driverstatuslist`
--
ALTER TABLE `driverstatuslist`
  MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `passengerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ride`
--
ALTER TABLE `ride`
  MODIFY `rideID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `unregpassengers`
--
ALTER TABLE `unregpassengers`
  MODIFY `unregPassengerID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
