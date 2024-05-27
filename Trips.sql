-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2024 at 05:23 PM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cisswwy3_sender_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `Trips`
--

CREATE TABLE `Trips` (
  `TripID` int(11) NOT NULL,
  `DriverID` int(11) DEFAULT NULL,
  `SenderID` int(11) DEFAULT NULL,
  `u_name` varchar(215) NOT NULL,
  `FromAddress` varchar(50) DEFAULT NULL,
  `FromAddress2` varchar(50) DEFAULT NULL,
  `FromCity` varchar(20) DEFAULT NULL,
  `FromState` varchar(20) DEFAULT NULL,
  `FromZip` varchar(12) DEFAULT NULL,
  `source_lat` varchar(255) NOT NULL,
  `source_long` varchar(255) NOT NULL,
  `ToAddress` varchar(50) DEFAULT NULL,
  `ToAddress2` varchar(50) DEFAULT NULL,
  `ToCity` varchar(20) DEFAULT NULL,
  `ToState` varchar(20) DEFAULT NULL,
  `ToZip` varchar(12) DEFAULT NULL,
  `destination_lat` varchar(255) NOT NULL,
  `destination_long` varchar(255) NOT NULL,
  `RequestTime` text NOT NULL,
  `AcceptTime` text NOT NULL,
  `PickupTime` text NOT NULL,
  `DropoffTime` text NOT NULL,
  `Status` char(1) DEFAULT NULL,
  `PayStatus` int(11) DEFAULT NULL,
  `TimeStampCreated` text NOT NULL,
  `LastUpdated` text NOT NULL,
  `Notes` text,
  `InternalNotes` text,
  `Silent` int(11) DEFAULT NULL,
  `RouteID` varchar(50) DEFAULT NULL,
  `PkgID` int(11) NOT NULL,
  `package_name` varchar(111) NOT NULL,
  `Cost` decimal(10,2) DEFAULT NULL COMMENT 'trip_fare',
  `Price` decimal(10,2) DEFAULT NULL COMMENT 'total_fare',
  `discount` varchar(50) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `Paid` tinyint(1) DEFAULT '0',
  `payment_id` varchar(50) NOT NULL,
  `CaptureID` varchar(50) DEFAULT NULL COMMENT 'payment_method_id',
  `ride_type` varchar(255) NOT NULL,
  `city_status` varchar(55) NOT NULL,
  `confirmation_code` varchar(111) NOT NULL,
  `cancel_by` varchar(11) NOT NULL,
  `cancel_reason` text NOT NULL,
  `pickup_contact` varchar(25) NOT NULL,
  `drop_contact` varchar(25) NOT NULL,
  `driver_lat` varchar(50) NOT NULL,
  `driver_lng` varchar(50) NOT NULL,
  `d_address` text NOT NULL,
  `user_lat` int(50) NOT NULL,
  `user_lng` int(50) NOT NULL,
  `u_address` text NOT NULL,
  `total_duration` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Trips`
--

INSERT INTO `Trips` (`TripID`, `DriverID`, `SenderID`, `u_name`, `FromAddress`, `FromAddress2`, `FromCity`, `FromState`, `FromZip`, `source_lat`, `source_long`, `ToAddress`, `ToAddress2`, `ToCity`, `ToState`, `ToZip`, `destination_lat`, `destination_long`, `RequestTime`, `AcceptTime`, `PickupTime`, `DropoffTime`, `Status`, `PayStatus`, `TimeStampCreated`, `LastUpdated`, `Notes`, `InternalNotes`, `Silent`, `RouteID`, `PkgID`, `package_name`, `Cost`, `Price`, `discount`, `coupon_id`, `payment_mode`, `Paid`, `payment_id`, `CaptureID`, `ride_type`, `city_status`, `confirmation_code`, `cancel_by`, `cancel_reason`, `pickup_contact`, `drop_contact`, `driver_lat`, `driver_lng`, `d_address`, `user_lat`, `user_lng`, `u_address`, `total_duration`) VALUES
(1, 17, 7, 'Goa Kk', 'Sai Ram Plaza, G1-B, Mangal Nagar Road, Vishnu Pur', '', 'indore', '', '452014', '22.6856608', '75.8596255', 'Dhamnod, Madhya Pradesh, India', '', 'dhamnod', '', '454552', '22.2138885', '75.4723411', '23-05-2024 04:21 PM', '', '', '', 'R', 0, '23-05-2024 04:21 PM', '', 'ccgvh', '', 0, '3', 0, 'Extra Large', 200.00, 200.00, '0.0', 0, 'Card', 0, 'pi_3PJZEmIhs7ZBuE9x1qREX6Qa', 'pm_1PJZEfIhs7ZBuE9xJqXZw5an', 'Ride_now', 'Out City', '', 'User', 'Booked By Mistake', '+1+18085059284', '+1+19754853453', '', '', '', 0, 0, '', ''),
(2, 17, 7, 'Goa Kk', '315, Mangal Nagar Road, Mangal Nagar, Indore, Madh', '', 'indore', '', '452014', '22.6856582', '75.8596368', 'Dhamnod, Madhya Pradesh, India', '', 'dhamnod', '', '454552', '22.2138885', '75.4723411', '27-05-2024 04:42 PM', '05-27-2024  05:01 PM', '05-27-2024  05:07 PM', '05-27-2024  05:07 PM', 'C', 0, '27-05-2024 04:42 PM', '', 'chjkujh', '', 0, '3', 0, 'Extra Large', 200.00, 200.00, '0.0', 0, 'Card', 0, 'pi_3PL1TMIhs7ZBuE9x2VwfDWRr', 'pm_1PJZEfIhs7ZBuE9xJqXZw5an', 'Ride_now', 'Out City', '886065', '', '', '+1+19754853453', '+1+18085059288', '', '', '', 0, 0, '', '25'),
(3, 17, 7, 'Goa Kk', '315, Mangal Nagar Road, Mangal Nagar, Indore, Madh', '', 'indore', '', '452014', '22.685653', '75.8596405', 'Dhamnod, Madhya Pradesh, India', '', 'dhamnod', '', '454552', '22.2138885', '75.4723411', '27-05-2024 05:12 PM', '05-27-2024  05:14 PM', '05-27-2024  05:14 PM', '05-27-2024  05:14 PM', 'C', 0, '27-05-2024 05:12 PM', '', 'g,ydufufuf', '', 0, '3', 0, 'Extra Large', 200.00, 200.00, '0.0', 0, 'Card', 0, 'pi_3PL1wtIhs7ZBuE9x0Lex2v6f', 'pm_1PJZEfIhs7ZBuE9xJqXZw5an', 'Ride_now', 'Out City', '793694', '', '', '+18085059284', '+19754853453', '', '', '', 0, 0, '', '2'),
(4, 17, 7, 'Goa Kk', '315, Mangal Nagar Road, Mangal Nagar, Indore, Madh', '', 'indore', '', '452014', '22.6856603', '75.8596392', 'Dhamnod, Madhya Pradesh, India', '', 'dhamnod', '', '454552', '22.2138885', '75.4723411', '27-05-2024 05:15 PM', '', '', '', 'N', 0, '27-05-2024 05:15 PM', '', 'dryu', '', 0, '3', 0, 'Extra Large', 200.00, 200.00, '0.0', 0, 'Card', 0, 'pi_3PL1zwIhs7ZBuE9x2mK2bZUt', 'pm_1PJZEfIhs7ZBuE9xJqXZw5an', 'Ride_now', 'Out City', '', 'User', 'Driver Arrived Late', '+18085056666', '+15566666666', '', '', '', 0, 0, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Trips`
--
ALTER TABLE `Trips`
  ADD PRIMARY KEY (`TripID`),
  ADD KEY `DriverID` (`DriverID`),
  ADD KEY `SenderID` (`SenderID`),
  ADD KEY `AreaID` (`RouteID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Trips`
--
ALTER TABLE `Trips`
  MODIFY `TripID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
