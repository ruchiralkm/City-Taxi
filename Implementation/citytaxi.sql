-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2024 at 10:09 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

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
(29, 'Tharushi', 'Jayasinghe', '0758564219', 'L3456789', 'Kandy', 'Car', 'fullTime', 'WP EFZ-7896', 'Nissan', 'Sunny', 2018, 'White', 'upload/9bq4jN9zE3PAXqV1lh0kxHEzLsq.jpg', 'tharushi.jayasinghe@mail.com', '$2y$10$.vJIGWAtRqa6eCwtL0PQtufsxlnKHgtPNgMs.ULfYhlacIWvvGfLe'),
(30, 'Sanduni', 'Perera', '0777123456', 'L1234567', 'Mawanella', 'Car', 'fullTime', 'CP BCD-4567', 'Toyota', 'Corolla', 2018, 'Red', 'upload/OIP.aP_qLOf-eCGl2d3Pmc_y-QHaJS.jpg', 'sanduni.perera@mail.com', '$2y$10$ol7nHdeliZnKFuIfWVJ1juaLYmfI6XjozX49VHWnNtzxTKXAIXFCa'),
(31, 'Nimesha', 'Bandara', '0717896543', 'L2345678', 'Katugasthota', 'Bike', 'fullTime', 'WP ABC-1234', 'Honda', 'Dio', 2017, 'Blue', 'upload/Akarsh-Byramudi.jpg', 'nimesha.bandara@mail.com', '$2y$10$/MqY7esv9cVg/cb9NZkdYue36PfoE4BWfsQuXj3q8.PtIH6QaJAdu'),
(32, 'Chamara', 'Gunasekara', '0716598241', 'L3456790', 'Kegalle', 'Bike', 'fullTime', 'WP EFG-9658', 'Honda', 'Dio', 2019, 'Red', 'upload/04.jpg', 'chamara.gunasekara@mail.com', '$2y$10$gLdGU3PUPvJm2K.KmtwBdu8NQS2hch5UCu4WAJeJlyr4SvD2xdhCK'),
(33, 'Kasun', 'Silva', '0775126589', 'L4567890', 'Kegalle', 'Threewheel', 'fullTime', 'WP GHI-1258', 'Bajaj', 'RE 205', 2017, 'Green', 'upload/R.13.jpg', 'kasun.silva@mail.com', '$2y$10$FuAM7QErp4vaGrEpxuaXAOu1zBZPT9RMMhZMpV2upenJytMc1bv06'),
(35, 'Dilan', 'Mendis', '0714852369', 'L6789012', 'Mawanella', 'Threewheel', 'fullTime', 'WP MNO-3478', 'TVS', 'King', 2019, 'Yellow', 'upload/male_portra.jpg', 'dilan.mendis@mail.com', '$2y$10$PK//7RWcvjMun8o/uy9qm.ORRfzHVJdOCqB1JPDS/JNMt6W1lG2dK'),
(36, 'Thilina', 'Pathirana', '0789541236', 'L7890123', 'Pilimathalawa', 'Van', 'partTime', 'WP PQR-4589', 'Toyota', 'HiAce', 2020, 'White', 'upload/sfsfw.jpg', 'thilina.pathirana@mail.com', '$2y$10$l0HlteNbM0HDm/uo2DASZeuDpDJEUIooZGHhInh.gEYh53tBNIEhm'),
(37, 'Lahiru', 'Ranasinghe', '0747859632', 'L0123456', 'Colombo', 'Van', 'fullTime', 'WP YZA-7895', 'Nissan', 'Caravan', 2018, 'Gray', 'upload/Arjun-Modia.jpg', 'lahiru.ranasinghe@mail.com', '$2y$10$0svwwculqRKLvxAzEwX1w.6CKHnM/bWR8XlGUrKV0TXZ68.AoAeo2');

-- --------------------------------------------------------

--
-- Table structure for table `driverfeedback`
--

CREATE TABLE `driverfeedback` (
  `id` int(11) NOT NULL,
  `driverID` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(11, 29, 7.2475, 80.3459, 'Available', '2024-10-10 05:38:41'),
(12, 30, 7.2475, 80.3459, 'Available', '2024-10-10 05:40:56'),
(13, 31, 7.2475, 80.3459, 'Available', '2024-10-10 05:41:27'),
(14, 32, 7.2475, 80.3459, 'Available', '2024-10-10 05:41:56'),
(15, 33, 7.2475, 80.3459, 'Available', '2024-10-10 05:42:20'),
(16, 35, 7.2475, 80.3459, 'Available', '2024-10-10 05:42:51'),
(17, 36, 7.2475, 80.3459, 'Available', '2024-10-10 05:43:18'),
(18, 37, 7.20496, 80.1736, 'Available', '2024-10-10 05:57:22');

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
(15, 'Ruchira', 'Lakmal', 777123456, 'kalusallis2002@gmail.com', '$2y$10$4p3sdsW65ts0w62MaogyN.Tfg1vq3JS9cs6s2Eq2naJz0w1Re46/O');

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
-- Indexes for dumped tables
--

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driverID`);

--
-- Indexes for table `driverfeedback`
--
ALTER TABLE `driverfeedback`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `driverID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `driverfeedback`
--
ALTER TABLE `driverfeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `driverratings`
--
ALTER TABLE `driverratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `driverstatuslist`
--
ALTER TABLE `driverstatuslist`
  MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `passengerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ride`
--
ALTER TABLE `ride`
  MODIFY `rideID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `unregpassengers`
--
ALTER TABLE `unregpassengers`
  MODIFY `unregPassengerID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
