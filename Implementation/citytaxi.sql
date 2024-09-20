-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2024 at 07:27 PM
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
(1, '', '', '', '', '', '', '', '', '', '$2y$10$OQQwP4zlxAziIbNnW7knKeblE6svoAqgdfBwo1y7b.JGdv/DHN.2a'),
(2, '', '', '', '', '', '', '', '', '', '$2y$10$G/L8K1qbBj4.2R0BRU5LGOq36qrMbSO2mukFWi1iDU/BUYki8gCOq'),
(3, '', '', '', '', '', '', '', '', '', '$2y$10$bfJPLbFVdSvnTXQy0e8y/euXUAwYU4t5U4/b87ChekTgwWeAcJigy'),
(4, '', '', '', '', '', '', '', '', 'asd@gmail.com', '$2y$10$AoKus74x/bL0Bx.W26qJfO.nyeEvOq2ulz4/tdNuz/q3oPHbpONQy'),
(5, '', '', '', '', '', '', '', '', 'asd@gmail.com', '$2y$10$TAiWpLL1s9XckG1/Zw1j4OFOG0PlCdqppnugaENAzByAF9kohzlbi'),
(6, 'ta', 'h', '979', '879', 'asd', 'Threewheel', 'fullTime', '', 'tanz@e.com', '$2y$10$xjFhO2k4k61WByJKi/YAI.j8ZXxMJK0vMYD63M9WEDkLM/FKCUvr.'),
(7, 'yy', 'kk', '898899', '9090009', 'asdf', 'Threewheel', 'fullTime', 'upload/CVRfx2.png', 'tanz@gmail.com', '$2y$10$jGR1Jct1k/3wJSWMlzt0zeA7ZTUfVKjc2YH8XFQNiRqGnSwVNlkUe'),
(8, 'hh', 'jk', '78787', '897878676', 'sfdgfh', 'Threewheel', 'fullTime', 'upload/PngItem_4246197.png', 'tanz@e.com', '$2y$10$6B.ZJLIBq0veC7D0ZMZrA.zx6WOxL65EqvLp8cScWU..KQbV898Ra');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `passengerID` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `mobile` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`passengerID`, `name`, `mobile`, `email`, `password`) VALUES
(1, 'tanz', 2147483647, 'tanz@e.com', '$2y$10$5Z7viFvRmnrn9wIlsu.ceepmPqMJe4ZruYTc0Vn2X/0'),
(2, 'SAM', 1236547890, 'SAM@RAT.COM', '$2y$10$xfRpo/8gb2.xiVc57XLjO.LCMHelN5z80SwOnb4Cy2s'),
(3, 'asd', 2147483647, 'asd@gmail.com', '$2y$10$HrQAhkJv/iB4dd3quMjP0.U.eBVj5ictcr0eMOfta6Rd.JlgkOQ6W');

-- --------------------------------------------------------

--
-- Table structure for table `ride`
--

CREATE TABLE `ride` (
  `rideID` int(11) NOT NULL,
  `pickupLocation` varchar(255) NOT NULL,
  `dropLocation` varchar(255) NOT NULL,
  `distance` float NOT NULL,
  `fare` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ride`
--

INSERT INTO `ride` (`rideID`, `pickupLocation`, `dropLocation`, `distance`, `fare`) VALUES
(1, '79.854174,6.938961', '80.635015,7.293021', 0, 0),
(2, '79.854174,6.938961', '80.635015,7.293021', 141.05, 143.05),
(3, '79.995076,7.092644', '81.057063,6.989852', 206.33, 208.33),
(4, '80.635001,7.293024', '80.624531,7.321946', 4.5, 6.5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driverID`);

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
  MODIFY `driverID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `passengerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ride`
--
ALTER TABLE `ride`
  MODIFY `rideID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
