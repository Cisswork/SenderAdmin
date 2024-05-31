-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 31, 2024 at 11:36 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `wallet_amount` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `wallet_amount`) VALUES
(1, 'Admin', '123456', '18802.065');

-- --------------------------------------------------------

--
-- Table structure for table `AreaFromTo`
--

CREATE TABLE `AreaFromTo` (
  `id` int(11) NOT NULL,
  `RouteID` varchar(50) NOT NULL,
  `FromArea` varchar(20) NOT NULL,
  `ToArea` varchar(20) NOT NULL,
  `Enabled` tinyint(4) NOT NULL,
  `Price1` varchar(123) DEFAULT NULL,
  `Price2` varchar(123) DEFAULT NULL,
  `Price3` varchar(123) DEFAULT NULL,
  `Price4` varchar(123) DEFAULT NULL,
  `DateTimeCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `LastUpdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `AreaFromTo`
--

INSERT INTO `AreaFromTo` (`id`, `RouteID`, `FromArea`, `ToArea`, `Enabled`, `Price1`, `Price2`, `Price3`, `Price4`, `DateTimeCreated`, `LastUpdate`) VALUES
(1, '1', 'area 1', 'area 1', 1, '50', '100', '200', '400', '2024-02-16 05:48:13', '2024-03-18 06:21:15'),
(2, '21', 'indore', 'ujjain', 1, '50', '80', '100', '120', '2024-02-17 09:50:57', '2024-03-21 10:43:14'),
(3, '3', 'indore', 'dhamnod', 1, '50', '100', '150', '200', '2024-02-17 09:52:04', '2024-02-17 09:52:04'),
(4, '11', 'bholaram', 'area 3', 1, '500', '500', '1000', '2000', '2024-03-18 06:58:22', '2024-03-21 10:43:22'),
(5, '2', 'indore', 'dewas', 1, '55', '100', '200', '250', '2024-03-18 07:18:36', '2024-03-18 07:18:36'),
(7, '33', 'bholaram ustad marg,', 'dhamnod', 1, '10', '20', '30', '50', '2024-03-21 09:48:13', '2024-03-21 10:43:18'),
(8, '12', 'dewas', 'narwar', 1, '50', '65', '70', '80', '2024-03-22 06:20:05', '2024-03-22 06:20:05'),
(9, 'Route1', 'dewas', 'ujjain', 1, '50', '100', '200', '500', '2024-03-22 06:26:33', '2024-03-22 06:26:33'),
(10, 'NarwarToDewas', 'narwar', 'dewas', 1, '500', '800', '1000', '1200', '2024-04-16 06:06:46', '2024-04-16 06:06:46'),
(16, 'indoreToarea 3', 'indore', 'area 3', 1, '5', '3', '4', '5', '2024-05-09 09:38:12', '2024-05-09 09:38:12'),
(25, 'area 3Toarea 1', 'area 3', 'area 1', 1, '53.23', '45', '98', '45', '2024-05-09 11:54:00', '2024-05-09 11:54:00'),
(26, 'area 4Toarea 2', 'area 4', 'area 2', 1, '1.12', '54', '98', '100', '2024-05-15 13:43:38', '2024-05-15 13:43:38');

-- --------------------------------------------------------

--
-- Table structure for table `AreaList`
--

CREATE TABLE `AreaList` (
  `AreaID` int(11) NOT NULL,
  `AreaName` varchar(20) NOT NULL,
  `Enabled` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `AreaList`
--

INSERT INTO `AreaList` (`AreaID`, `AreaName`, `Enabled`) VALUES
(4, 'area 1', 1),
(5, 'area 2', 1),
(6, 'area 3', 1),
(7, 'area 4', 1),
(9, 'indore', 1),
(10, 'ujjain', 1),
(12, 'dhamnod', 1),
(16, 'dewas', 1),
(18, 'narwar', 1),
(19, 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `AreaZipCodes`
--

CREATE TABLE `AreaZipCodes` (
  `id` int(11) NOT NULL,
  `ZipCode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `AreaName` mediumtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `AreaZipCodes`
--

INSERT INTO `AreaZipCodes` (`id`, `ZipCode`, `AreaName`) VALUES
(1, '450665', 'area 1'),
(2, '450668', 'area 1'),
(4, '450664', 'area 1'),
(5, '450665', 'indore'),
(6, '450668', 'indore'),
(8, '450664', 'indore'),
(9, '456005', 'ujjain'),
(10, '456001', 'ujjain'),
(12, '456006', 'ujjain'),
(15, '454552', 'dhamnod'),
(20, '455001', 'dewas'),
(21, '452007', 'indore'),
(23, '452014', 'indore'),
(26, '452001', 'indore'),
(27, '455111', 'dewas'),
(28, '42001', 'indore'),
(33, '12345', 'test'),
(34, '450661', 'area 1');

-- --------------------------------------------------------

--
-- Table structure for table `canclebooking`
--

CREATE TABLE `canclebooking` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `driver_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `booking_time` varchar(200) NOT NULL,
  `cancel_time` time NOT NULL,
  `cancel_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `canclebooking`
--

INSERT INTO `canclebooking` (`id`, `user_id`, `company_id`, `driver_id`, `status`, `reason`, `booking_id`, `booking_time`, `cancel_time`, `cancel_date`) VALUES
(36, '126', 0, '76', 'cancle', 'Booked By Mistake', '35', '2022-03-03 17:23:27', '17:25:10', '2022-03-03'),
(172, '147', 0, '90', 'cancle', '', '278', '2023-02-14 17:32:07', '17:32:15', '2023-02-14'),
(269, '7', 175, '62', 'cancle', 'Wrong Location Booking', '376', '', '04:11:00', '2023-11-20'),
(180, '126', 0, '76', 'cancle', '', '297', '2023-02-17 17:06:14', '17:06:28', '2023-02-17'),
(179, '126', 0, '76', 'cancle', '', '296', '2023-02-17 16:58:31', '16:58:55', '2023-02-17'),
(169, '228', 0, '', 'cancle', '', '', '', '22:49:39', '2023-02-12'),
(170, '228', 0, '', 'cancle', '', '', '', '23:02:36', '2023-02-12'),
(171, '147', 0, '141', 'cancle', '', '272', '2023-02-14 15:13:37', '15:13:47', '2023-02-14'),
(18, '94', 0, '', 'cancle', 'Please Tell Us Why You Want To Cancel', '10', '', '18:40:28', '2022-01-22'),
(19, '94', 0, '', 'cancle', 'Please Tell Us Why You Want To Cancel', '10', '', '18:40:28', '2022-01-22'),
(20, '94', 0, '', 'cancle', 'Wrong location booking', '10', '', '18:41:17', '2022-01-22'),
(21, '94', 0, '', 'cancle', 'Please Tell Us Why You Want To Cancel', '10', '', '18:41:26', '2022-01-22'),
(168, '126', 0, '76', 'cancle', 'Booked By Mistake', '270', '2023-02-10 06:34:18', '09:17:23', '2023-02-10'),
(166, '228', 0, '', 'cancle', '', '', '', '23:32:47', '2023-02-08'),
(167, '126', 0, '76', 'cancle', 'Booked By Mistake', '268', '2023-02-10 06:04:19', '06:10:05', '2023-02-10'),
(25, '108', 0, '', 'cancle', '', '', '', '16:23:25', '2022-01-27'),
(27, '103', 0, '', 'cancle', 'Driver Arrived Late', '11', '', '18:57:07', '2022-01-27'),
(28, '103', 0, '', 'cancle', 'Driver Negotiating For The Price', '11', '', '11:30:07', '2022-01-28'),
(160, '126', 0, '140', 'cancle', 'Booked By Mistake', '264', '2023-01-28 13:30:18', '13:32:49', '2023-01-28'),
(161, '126', 0, '76', 'cancle', 'Booked By Mistake', '265', '2023-02-01 10:34:46', '10:35:47', '2023-02-01'),
(164, '228', 0, '', 'cancle', '', '', '', '23:27:06', '2023-02-08'),
(165, '228', 0, '', 'cancle', '', '', '', '23:30:30', '2023-02-08'),
(163, '126', 0, '76', 'cancle', '', '267', '2023-02-02 07:41:30', '07:42:29', '2023-02-02'),
(159, '224', 0, '76', 'cancle', 'Wrong location booking', '262', '2023-01-27 12:42:35', '12:46:03', '2023-01-27'),
(37, '126', 0, '76', 'cancle', 'Booked By Mistake', '36', '2022-03-03 22:05:11', '22:05:49', '2022-03-03'),
(38, '103', 0, '61', 'cancle', 'Booked By Mistake', '40', '2022-03-15 12:21:27', '12:22:15', '2022-03-15'),
(39, '103', 0, '61', 'cancle', 'Please Tell Us Why You Want To Cancel', '41', '2022-03-15 12:27:55', '12:28:13', '2022-03-15'),
(185, '231', 0, '', 'cancle', '', '', '', '13:19:34', '2023-03-01'),
(184, '231', 0, '', 'cancle', '', '', '', '13:19:00', '2023-03-01'),
(42, '126', 0, '76', 'cancle', 'Wrong location booking', '48', '2022-03-19 15:58:39', '16:01:31', '2022-03-19'),
(195, '167', 0, '', 'cancle', '', '339', '2023-03-09 16:31:24', '16:32:15', '2023-03-09'),
(139, '142', 0, '76', 'cancle', '', '197', '2022-12-02 09:26:43', '12:02:15', '2022-12-02'),
(49, '142', 0, '76', 'cancle', 'Driver Negotiating For The Price', '55', '2022-03-21 18:03:28', '18:04:33', '2022-03-21'),
(54, '123', 0, '76', 'cancle', 'Booked By Mistake', '64', '2022-03-30 10:23:49', '10:24:58', '2022-03-30'),
(138, '142', 0, '76', 'cancle', '', '196', '2022-12-01 14:34:24', '08:13:31', '2022-12-02'),
(173, '147', 0, '90', 'cancle', '', '279', '2023-02-14 17:33:48', '17:33:58', '2023-02-14'),
(252, '231', 0, '143', 'cancle', '', '434', '2023-03-31 17:02:04', '17:02:28', '2023-03-31'),
(158, '223', 0, '76', 'cancle', '', '258', '2023-01-23 10:16:13', '10:16:20', '2023-01-23'),
(60, '108', 0, '82', 'cancle', '', '101', '2022-04-01 19:14:18', '20:23:18', '2022-04-01'),
(61, '108', 0, '81', 'cancle', 'Driver Arrived Late', '121', '2022-04-02 19:23:33', '19:25:03', '2022-04-02'),
(62, '108', 0, '81', 'cancle', 'Driver Arrived Late', '122', '2022-04-02 19:54:14', '19:54:33', '2022-04-02'),
(194, '167', 0, '', 'cancle', '', '338', '2023-03-09 16:30:05', '16:30:31', '2023-03-09'),
(64, '150', 0, '90', 'cancle', 'Driver Arrived Late', '133', '2022-04-05 14:40:45', '14:41:09', '2022-04-05'),
(193, '167', 0, '', 'cancle', '', '337', '2023-03-09 16:28:31', '16:29:01', '2023-03-09'),
(192, '167', 0, '', 'cancle', '', '336', '2023-03-09 16:24:11', '16:24:49', '2023-03-09'),
(183, '231', 0, '', 'cancle', '', '', '', '13:11:35', '2023-03-01'),
(181, '126', 0, '76', 'cancle', '', '298', '2023-02-17 17:07:00', '17:07:05', '2023-02-17'),
(118, '142', 0, '', 'cancle', '', '', '', '11:04:16', '2022-11-24'),
(178, '126', 0, '76', 'cancle', 'Booked By Mistake', '294', '2023-02-17 11:49:58', '11:50:49', '2023-02-17'),
(174, '147', 0, '90', 'cancle', '', '283', '2023-02-17 15:07:49', '15:08:16', '2023-02-17'),
(175, '126', 0, '76', 'cancle', 'Booked By Mistake', '289', '2023-02-17 06:36:56', '06:38:09', '2023-02-17'),
(114, '145', 0, '76', 'cancle', '', '126', '2022-11-18 05:42:15', '05:42:55', '2022-11-18'),
(177, '126', 0, '76', 'cancle', '', '293', '2023-02-17 11:47:54', '11:48:09', '2023-02-17'),
(182, '167', 0, '76', 'cancle', '', '309', '2023-02-27 11:42:47', '11:42:55', '2023-02-27'),
(106, '118', 0, '', 'cancle', '', '', '', '11:23:20', '2022-06-01'),
(81, '153', 0, '', 'cancle', '', '', '', '19:47:12', '2022-05-02'),
(191, '167', 0, '', 'cancle', '', '335', '2023-03-09 16:22:33', '16:23:34', '2023-03-09'),
(190, '167', 0, '', 'cancle', '', '334', '2023-03-09 16:21:59', '16:22:29', '2023-03-09'),
(189, '167', 0, '', 'cancle', '', '333', '2023-03-09 16:21:42', '16:21:51', '2023-03-09'),
(128, '142', 0, '76', 'cancle', '', '176', '2022-11-30 13:29:32', '13:35:49', '2022-11-30'),
(127, '142', 0, '76', 'cancle', '', '175', '2022-11-30 13:27:26', '13:29:12', '2022-11-30'),
(109, '118', 0, '76', 'cancle', '', '111', '2022-06-13 08:38:45', '08:39:20', '2022-06-13'),
(105, '171', 0, '', 'cancle', '', '', '', '18:42:03', '2022-05-30'),
(162, '210', 0, '141', 'cancle', '', '266', '2023-02-02 18:09:12', '18:10:09', '2023-02-02'),
(103, '171', 0, '', 'cancle', '', '', '', '18:35:39', '2022-05-30'),
(102, '171', 0, '', 'cancle', '', '', '', '18:17:14', '2022-05-30'),
(107, '167', 0, '76', 'cancle', 'Booked By Mistake', '109', '2022-06-04 19:51:02', '19:52:45', '2022-06-04'),
(108, '167', 0, '76', 'cancle', 'Booked By Mistake', '110', '2022-06-04 19:53:26', '19:55:52', '2022-06-04'),
(188, '230', 0, '148', 'cancle', '', '332', '2023-03-04 19:08:42', '19:10:27', '2023-03-04'),
(187, '230', 0, '148', 'cancle', '', '331', '2023-03-04 19:04:17', '19:06:10', '2023-03-04'),
(186, '231', 0, '', 'cancle', '', '', '', '13:22:39', '2023-03-01'),
(251, '231', 0, '143', 'cancle', '', '433', '2023-03-31 16:48:49', '16:49:19', '2023-03-31'),
(153, '211', 0, '', 'cancle', '', '', '', '15:27:04', '2022-12-28'),
(154, '211', 0, '88', 'cancle', '', '243', '2023-01-03 13:43:20', '13:43:30', '2023-01-03'),
(155, '211', 0, '121', 'cancle', '', '245', '2023-01-03 13:51:36', '13:51:43', '2023-01-03'),
(196, '167', 0, '', 'cancle', '', '340', '2023-03-09 16:33:13', '16:33:26', '2023-03-09'),
(197, '167', 0, '', 'cancle', '', '341', '2023-03-09 16:35:29', '16:35:51', '2023-03-09'),
(198, '167', 0, '', 'cancle', '', '342', '2023-03-09 16:39:00', '16:40:32', '2023-03-09'),
(199, '167', 0, '', 'cancle', '', '343', '2023-03-09 16:41:00', '16:41:16', '2023-03-09'),
(200, '167', 0, '', 'cancle', '', '344', '2023-03-09 16:41:44', '16:44:21', '2023-03-09'),
(201, '167', 0, '', 'cancle', '', '345', '2023-03-09 16:53:10', '16:55:05', '2023-03-09'),
(202, '231', 0, '', 'cancle', '', '346', '2023-03-09 17:01:42', '17:02:26', '2023-03-09'),
(203, '167', 0, '', 'cancle', '', '347', '2023-03-10 12:25:06', '12:25:44', '2023-03-10'),
(204, '167', 0, '', 'cancle', '', '348', '2023-03-10 12:28:27', '12:29:26', '2023-03-10'),
(205, '167', 0, '', 'cancle', '', '349', '2023-03-10 12:30:34', '12:31:20', '2023-03-10'),
(206, '167', 0, '76', 'cancle', 'Booked By Mistake', '350', '2023-03-13 17:02:27', '17:04:13', '2023-03-13'),
(207, '222', 0, '', 'cancle', '', '352', '2023-03-13 18:11:47', '18:12:05', '2023-03-13'),
(208, '222', 0, '', 'cancle', '', '354', '2023-03-13 18:12:11', '18:12:15', '2023-03-13'),
(209, '167', 0, '', 'cancle', '', '353', '2023-03-13 18:11:57', '18:12:48', '2023-03-13'),
(210, '222', 0, '', 'cancle', '', '355', '2023-03-13 18:13:12', '18:13:52', '2023-03-13'),
(211, '167', 0, '', 'cancle', '', '356', '2023-03-13 18:15:21', '18:15:59', '2023-03-13'),
(263, '245', 0, '158', 'cancle', '', '456', '2023-04-10 16:05:43', '16:07:42', '2023-04-10'),
(213, '167', 0, '', 'cancle', '', '359', '2023-03-13 18:30:06', '18:30:29', '2023-03-13'),
(214, '167', 0, '', 'cancle', '', '361', '2023-03-13 18:31:40', '18:31:46', '2023-03-13'),
(249, '126', 0, '76', 'cancle', 'Booked By Mistake', '423', '2023-03-18 06:09:13', '06:11:25', '2023-03-18'),
(262, '245', 0, '158', 'cancle', 'Booked By Mistake', '453', '2023-04-10 16:00:17', '16:01:29', '2023-04-10'),
(218, '222', 0, '', 'cancle', '', '364', '2023-03-13 18:38:43', '18:40:10', '2023-03-13'),
(219, '222', 0, '', 'cancle', '', '365', '2023-03-13 18:40:13', '18:40:35', '2023-03-13'),
(220, '222', 0, '', 'cancle', '', '366', '2023-03-13 18:40:38', '18:40:55', '2023-03-13'),
(221, '222', 0, '', 'cancle', '', '367', '2023-03-13 18:41:01', '18:41:34', '2023-03-13'),
(222, '222', 0, '', 'cancle', '', '368', '2023-03-13 18:42:07', '18:42:51', '2023-03-13'),
(224, '222', 0, '', 'cancle', '', '370', '2023-03-13 18:45:03', '18:45:18', '2023-03-13'),
(261, '231', 0, '143', 'cancle', '', '449', '2023-04-06 13:02:17', '13:02:24', '2023-04-06'),
(246, '126', 0, '76', 'cancle', '6yyu', '410', '2023-03-16 11:13:43', '22:38:59', '2023-03-17'),
(259, '231', 0, '143', 'cancle', '', '447', '2023-04-06 12:44:18', '12:44:21', '2023-04-06'),
(260, '231', 0, '143', 'cancle', '', '448', '2023-04-06 12:46:19', '12:46:23', '2023-04-06'),
(258, '231', 0, '143', 'cancle', '', '446', '2023-04-06 12:44:09', '12:44:12', '2023-04-06'),
(256, '126', 0, '154', 'cancle', '', '442', '2023-04-03 14:13:05', '14:13:50', '2023-04-03'),
(257, '231', 0, '143', 'cancle', '', '445', '2023-04-06 12:41:20', '12:41:35', '2023-04-06'),
(255, '126', 0, '76', 'cancle', 'Mistake ', '440', '2023-04-02 18:29:21', '18:33:29', '2023-04-02'),
(254, '231', 0, '141', 'cancle', '', '439', '2023-04-01 09:19:31', '09:19:37', '2023-04-01'),
(253, '231', 0, '143', 'cancle', '', '435', '2023-03-31 17:03:53', '17:04:14', '2023-03-31'),
(264, '245', 0, '158', 'cancle', '', '458', '2023-04-10 16:19:05', '16:19:26', '2023-04-10'),
(265, '245', 0, '158', 'cancle', '', '459', '2023-04-10 16:19:30', '09:24:04', '2023-04-12'),
(266, '222', 0, '', 'cancle', '', '371', '2023-03-13 18:45:21', '18:16:03', '2023-04-12'),
(267, '222', 0, '141', 'cancle', '', '462', '2023-04-13 18:23:24', '18:25:03', '2023-04-13'),
(268, '222', 0, '141', 'cancle', '', '463', '2023-04-13 18:25:08', '18:26:16', '2023-04-13'),
(270, '106', 196, '65', 'cancle', 'Wrong Location Booking', '382', '', '06:44:00', '2023-11-20'),
(271, '107', 196, '55', 'cancle', 'Please tell us Why You Want To Cancel', '414', '', '10:46:00', '2023-11-22'),
(272, '107', 196, '55', 'cancle', 'Hy', '415', '', '10:53:00', '2023-11-22'),
(273, '107', 196, '55', 'cancle', 'Mood change', '416', '', '10:58:00', '2023-11-22'),
(274, '107', 196, '55', 'cancle', 'Please tell us Why You Want To Cancel', '417', '', '11:03:00', '2023-11-22'),
(275, '107', 196, '55', 'cancle', 'Wrong Location Booking', '418', '', '11:06:00', '2023-11-22'),
(276, '107', 196, '55', 'cancle', 'Please tell us Why You Want To Cancel', '419', '', '11:10:00', '2023-11-22'),
(277, '107', 196, '55', 'cancle', 'CVV hagsg', '421', '', '11:29:00', '2023-11-22'),
(278, '107', 196, '65', 'cancle', 'Wrong Location Booking', '423', '', '05:26:00', '2023-11-22'),
(279, '107', 196, '65', 'cancle', 'Driver Arrived Late ', '424', '', '05:27:00', '2023-11-22'),
(280, '107', 196, '65', 'cancle', 'fggt', '425', '', '05:32:00', '2023-11-22'),
(281, '107', 196, '65', 'cancle', 'Booked By Mistake', '428', '', '06:46:00', '2023-11-22'),
(282, '107', 196, '65', 'cancle', 'Wrong Location Booking', '429', '', '11:51:00', '2023-11-23'),
(283, '107', 196, '65', 'cancle', 'Driver Negotiating For The Price', '431', '', '12:20:00', '2023-11-23'),
(284, '107', 196, '65', 'cancle', 'Wrong Location Booking', '435', '', '03:20:00', '2023-11-23'),
(285, '7', 175, '62', 'cancle', 'Driver Arrived Late ', '454', '', '07:08:00', '2023-12-01'),
(286, '7', 175, '62', 'cancle', 'Booked By Mistake', '456', '', '07:21:00', '2023-12-01'),
(287, '7', 175, '62', 'cancle', 'Booked By Mistake', '464', '', '12:24:00', '2023-12-04'),
(288, '111', 214, '72', 'cancle', 'other reason', '504', '', '12:38:00', '2023-12-28'),
(289, '111', 214, '72', 'cancle', 'Driver Negotiating For The Price', '524', '', '01:23:00', '2023-12-29'),
(290, '111', 216, '73', 'cancle', 'Driver Negotiating For The Price', '527', '', '03:08:00', '2023-12-29'),
(291, '111', 216, '73', 'cancle', 'Wrong Location Booking', '530', '', '05:50:00', '2023-12-29'),
(292, '127', 214, '79', 'cancle', 'Booked By Mistake', '555', '', '06:56:00', '2023-12-30'),
(293, '127', 214, '79', 'cancle', 'Driver Negotiating For The Price', '575', '', '12:45:00', '2024-01-02'),
(294, '15', 228, '81', 'cancle', 'Wrong Location Booking', '598', '', '05:59:00', '2024-01-02'),
(295, '127', 214, '72', 'cancle', 'Driver Negotiating For The Price', '613', '', '07:19:00', '2024-01-02'),
(296, '15', 214, '82', 'cancle', 'Wrong Location Booking', '615', '', '11:31:00', '2024-01-03'),
(297, '111', 213, '80', 'cancle', 'Driver Arrived Late ', '625', '', '04:12:00', '2024-01-03'),
(298, '15', 228, '81', 'cancle', 'Wrong Location Booking', '634', '', '06:21:00', '2024-01-03'),
(299, '24', 1, '41', 'cancle', 'fgf', '636', '', '11:22:00', '2024-01-04'),
(300, '111', 228, '84', 'cancle', 'Booked By Mistake', '695', '', '08:21:00', '2024-01-04'),
(301, '111', 213, '80', 'cancle', 'Driver Negotiating For The Price', '696', '', '08:49:00', '2024-01-04'),
(302, '134', 216, '73', 'cancle', 'Wrong Location Booking', '712', '', '04:42:00', '2024-01-05'),
(303, '24', 216, '73', 'cancle', 'Driver Arrived Late ', '743', '', '07:34:00', '2024-01-05'),
(304, '24', 216, '73', 'cancle', 'gf', '747', '', '08:14:00', '2024-01-05'),
(305, '133', 228, '84', 'cancle', 'Wrong Location Booking', '762', '', '01:40:00', '2024-01-06'),
(306, '127', 216, '73', 'cancle', 'Driver Arrived Late ', '769', '', '06:55:00', '2024-01-06'),
(307, '127', 214, '82', 'cancle', 'Driver Negotiating For The Price', '781', '', '12:40:00', '2024-01-08'),
(308, '133', 228, '84', 'cancle', 'Wrong Location Booking', '789', '', '07:44:00', '2024-01-09'),
(309, '127', 214, '82', 'cancle', 'Booked By Mistake', '793', '', '07:51:00', '2024-01-09'),
(310, '133', 228, '84', 'cancle', 'Booked By Mistake', '798', '', '08:31:00', '2024-01-09'),
(311, '133', 214, '82', 'cancle', 'Driver Negotiating For The Price', '796', '', '01:30:00', '2024-01-10'),
(312, '132', 216, '73', 'cancle', 'Booked By Mistake', '814', '', '01:41:00', '2024-01-10'),
(313, '132', 216, '73', 'cancle', 'Driver Arrived Late ', '815', '', '01:48:00', '2024-01-10'),
(316, '7', 0, '17', 'cancle', 'Driver Arrived Late', '4', '', '05:19:00', '2024-05-27'),
(315, '127', 214, '82', 'cancle', 'Booked By Mistake', '813', '', '03:13:00', '2024-01-10');

-- --------------------------------------------------------

--
-- Table structure for table `canclebooking_driver`
--

CREATE TABLE `canclebooking_driver` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `driver_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `cancel_time` varchar(215) NOT NULL,
  `cancel_date` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `canclebooking_driver`
--

INSERT INTO `canclebooking_driver` (`id`, `user_id`, `company_id`, `driver_id`, `status`, `reason`, `booking_id`, `cancel_time`, `cancel_date`) VALUES
(3, '', 164, '2', 'cancle', 'User not responsing', '2', '01:35 PM', '01-07-2023'),
(2, '', 164, '2', 'cancle', 'Not intersested', '1', '01:27 PM', '01-07-2023'),
(4, '', 167, '8', 'cancle', 'The user entered the wrong address', '5', '10:34 AM', '06-07-2023'),
(5, '', 164, '2', 'cancle', 'User not responding', '13', '07:13 AM', '10-07-2023'),
(6, '', 164, '2', 'cancle', 'User not responding', '15', '07:16 AM', '10-07-2023'),
(7, '', 164, '2', 'cancle', 'User not responding', '9', '08:17 AM', '10-07-2023'),
(8, '', 164, '2', 'cancle', 'The user entered the wrong address', '11', '10:45 AM', '10-07-2023'),
(9, '', 164, '2', 'cancle', 'The user did not arrive', '14', '05:29 AM', '11-07-2023'),
(10, '', 164, '2', 'cancle', 'The user entered the wrong address', '16', '04:25 PM', '11-07-2023'),
(11, '', 164, '2', 'cancle', 'User not responding', '57', '03:04 PM', '28-07-2023'),
(12, '', 167, '11', 'cancle', 'The user did not arrive', '76', '06:32 PM', '02-08-2023'),
(13, '', 164, '2', 'cancle', 'The user did not arrive', '85', '04:54 PM', '07-08-2023'),
(14, '', 164, '2', 'cancle', 'The user entered the wrong address', '85', '04:58 PM', '07-08-2023'),
(15, '', 164, '2', 'cancle', 'Please tell us Why You Want To Cancel', '85', '05:06 PM', '07-08-2023'),
(16, '', 164, '2', 'cancle', 'User not responding', '85', '05:08 PM', '07-08-2023'),
(17, '', 164, '2', 'cancle', 'The user entered the wrong address', '85', '05:09 PM', '07-08-2023'),
(18, '', 164, '2', 'cancle', 'The user did not arrive', '85', '05:09 PM', '07-08-2023'),
(19, '', 164, '2', 'cancle', 'User not responding', '85', '05:11 PM', '07-08-2023'),
(20, '', 164, '2', 'cancle', 'User not responding', '1', '05:12 PM', '07-08-2023'),
(21, '', 164, '2', 'cancle', 'User not responding', '85', '05:12 PM', '07-08-2023'),
(22, '', 164, '2', 'cancle', 'User not responding', '85', '05:13 PM', '07-08-2023'),
(23, '', 164, '2', 'cancle', '', '85', '05:23 PM', '07-08-2023'),
(24, '', 164, '2', 'cancle', '', '85', '05:24 PM', '07-08-2023'),
(25, '', 164, '2', 'cancle', '', '85', '05:25 PM', '07-08-2023'),
(26, '', 164, '2', 'cancle', 'The user entered the wrong address', '87', '05:53 PM', '07-08-2023'),
(27, '', 164, '2', 'cancle', 'Please tell us Why You Want To Cancel', '104', '12:58 PM', '11-08-2023'),
(28, '', 164, '2', 'cancle', 'Please tell us Why You Want To Cancel', '105', '12:58 PM', '11-08-2023'),
(29, '', 164, '2', 'cancle', '', '105', '12:58 PM', '11-08-2023'),
(30, '', 164, '2', 'cancle', 'The user entered the wrong address', '1', '05:01 PM', '11-08-2023'),
(31, '', 164, '2', 'cancle', 'The user entered the wrong address', '4', '05:01 PM', '11-08-2023'),
(32, '', 164, '2', 'cancle', 'The user did not arrive', '5', '05:01 PM', '11-08-2023'),
(33, '', 164, '2', 'cancle', 'User not responding', '6', '05:01 PM', '11-08-2023'),
(34, '', 164, '2', 'cancle', 'The user entered the wrong address', '18', '03:02 PM', '14-08-2023'),
(35, '', 164, '2', 'cancle', '', '10', '03:08 PM', '14-08-2023'),
(36, '', 164, '2', 'cancle', 'The user did not arrive', '19', '03:08 PM', '14-08-2023'),
(37, '', 164, '2', 'cancle', 'The user entered the wrong address', '8', '12:32 PM', '16-08-2023'),
(38, '', 164, '2', 'cancle', 'Please tell us Why You Want To Cancel', '24', '01:17 PM', '16-08-2023'),
(39, '', 164, '2', 'cancle', 'The user entered the wrong address', '23', '01:17 PM', '16-08-2023'),
(40, '', 164, '2', 'cancle', 'The user entered the wrong address', '50', '11:59 AM', '18-08-2023'),
(41, '', 164, '2', 'cancle', 'The user did not arrive', '62', '04:03 PM', '18-08-2023'),
(42, '', 164, '2', 'cancle', 'The user did not arrive', '63', '04:37 PM', '18-08-2023'),
(43, '', 164, '2', 'cancle', '', '66', '04:37 PM', '18-08-2023'),
(44, '', 164, '2', 'cancle', '', '67', '04:37 PM', '18-08-2023'),
(45, '', 164, '2', 'cancle', '', '65', '04:37 PM', '18-08-2023'),
(46, '', 164, '2', 'cancle', 'The user entered the wrong address', '72', '01:40 PM', '19-08-2023'),
(47, '', 164, '2', 'cancle', 'The user did not arrive', '71', '01:40 PM', '19-08-2023'),
(48, '', 164, '2', 'cancle', 'The user did not arrive', '76', '04:22 PM', '19-08-2023'),
(49, '', 164, '2', 'cancle', 'Please tell us Why You Want To Cancel', '97', '04:02 PM', '22-08-2023'),
(50, '', 164, '2', 'cancle', '', '97', '04:02 PM', '22-08-2023'),
(51, '', 164, '2', 'cancle', 'The user did not arrive', '96', '04:02 PM', '22-08-2023'),
(52, '', 164, '2', 'cancle', 'User not responding', '95', '04:02 PM', '22-08-2023'),
(53, '', 164, '2', 'cancle', 'The user did not arrive', '94', '04:02 PM', '22-08-2023'),
(54, '', 164, '2', 'cancle', 'The user entered the wrong address', '93', '04:02 PM', '22-08-2023'),
(55, '', 164, '2', 'cancle', 'User not responding', '92', '04:02 PM', '22-08-2023'),
(56, '', 164, '2', 'cancle', 'The user did not arrive', '91', '04:02 PM', '22-08-2023'),
(57, '', 164, '2', 'cancle', 'The user entered the wrong address', '90', '04:02 PM', '22-08-2023'),
(58, '', 164, '2', 'cancle', 'Please tell us Why You Want To Cancel', '89', '04:02 PM', '22-08-2023'),
(59, '', 164, '2', 'cancle', 'The user entered the wrong address', '88', '04:02 PM', '22-08-2023'),
(60, '', 164, '2', 'cancle', '', '87', '04:02 PM', '22-08-2023'),
(61, '', 164, '2', 'cancle', '', '81', '04:03 PM', '22-08-2023'),
(62, '', 164, '2', 'cancle', '', '83', '04:03 PM', '22-08-2023'),
(63, '', 164, '2', 'cancle', '', '84', '04:03 PM', '22-08-2023'),
(64, '', 164, '2', 'cancle', 'The user did not arrive', '85', '04:03 PM', '22-08-2023'),
(65, '', 164, '2', 'cancle', 'User not responding', '86', '04:03 PM', '22-08-2023'),
(66, '', 164, '2', 'cancle', 'The user entered the wrong address', '82', '04:03 PM', '22-08-2023'),
(67, '', 164, '2', 'cancle', '', '99', '04:05 PM', '22-08-2023'),
(68, '', 164, '2', 'cancle', 'Please tell us Why You Want To Cancel', '98', '04:05 PM', '22-08-2023'),
(69, '', 164, '17', 'cancle', 'The user did not arrive', '104', '01:09 PM', '23-08-2023'),
(70, '', 164, '2', 'cancle', 'The user did not arrive', '106', '02:54 PM', '23-08-2023'),
(71, '', 164, '2', 'cancle', 'User not responding', '110', '03:52 PM', '23-08-2023'),
(72, '', 164, '2', 'cancle', 'User not responding', '111', '03:54 PM', '23-08-2023'),
(73, '', 164, '2', 'cancle', '', '113', '04:00 PM', '23-08-2023'),
(74, '', 164, '2', 'cancle', '', '114', '04:00 PM', '23-08-2023'),
(75, '', 164, '2', 'cancle', '', '114', '04:31 PM', '23-08-2023'),
(76, '', 164, '2', 'cancle', 'User not responding', '116', '10:54 AM', '24-08-2023'),
(77, '', 164, '2', 'cancle', 'The user entered the wrong address', '125', '12:03 PM', '24-08-2023'),
(78, '', 164, '2', 'cancle', '', '127', '12:04 PM', '24-08-2023'),
(79, '', 164, '2', 'cancle', '', '128', '12:08 PM', '24-08-2023'),
(80, '', 164, '2', 'cancle', '', '129', '12:11 PM', '24-08-2023'),
(81, '', 164, '2', 'cancle', 'The user did not arrive', '0', '12:11 PM', '24-08-2023'),
(82, '', 164, '2', 'cancle', 'The user did not arrive', '131', '12:17 PM', '24-08-2023'),
(83, '', 164, '2', 'cancle', 'Please tell us Why You Want To Cancel', '130', '12:17 PM', '24-08-2023'),
(84, '', 164, '2', 'cancle', 'Please tell us Why You Want To Cancel', '133', '12:37 PM', '24-08-2023'),
(85, '', 164, '2', 'cancle', 'The user entered the wrong address', '132', '12:37 PM', '24-08-2023'),
(86, '', 164, '2', 'cancle', '', '134', '12:45 PM', '24-08-2023'),
(87, '', 164, '2', 'cancle', 'The user did not arrive', '138', '03:50 PM', '24-08-2023'),
(88, '', 169, '20', 'cancle', 'Please tell us Why You Want To Cancel', '146', '01:43 AM', '29-08-2023'),
(89, '', 169, '20', 'cancle', 'Please tell us Why You Want To Cancel', '148', '10:59 AM', '01-09-2023'),
(90, '', 164, '17', 'cancle', 'The user did not arrive', '154', '12:32 PM', '02-09-2023'),
(91, '', 164, '17', 'cancle', '', '145', '12:33 PM', '02-09-2023'),
(92, '', 164, '17', 'cancle', 'User not responding', '148', '12:33 PM', '02-09-2023'),
(93, '', 164, '17', 'cancle', 'The user did not arrive', '147', '12:33 PM', '02-09-2023'),
(94, '', 164, '17', 'cancle', 'Please tell us Why You Want To Cancel', '146', '12:33 PM', '02-09-2023'),
(95, '', 164, '17', 'cancle', 'User not responding', '158', '12:38 PM', '02-09-2023'),
(96, '', 164, '17', 'cancle', 'The user did not arrive', '159', '12:53 PM', '02-09-2023'),
(97, '', 164, '17', 'cancle', 'Please tell us Why You Want To Cancel', '160', '12:53 PM', '02-09-2023'),
(98, '', 164, '17', 'cancle', 'Please tell us Why You Want To Cancel', '161', '12:54 PM', '02-09-2023'),
(99, '', 164, '17', 'cancle', 'The user entered the wrong address', '162', '12:56 PM', '02-09-2023'),
(100, '', 164, '2', 'cancle', 'The user did not arrive', '157', '01:17 PM', '02-09-2023'),
(101, '', 164, '2', 'cancle', '', '156', '01:17 PM', '02-09-2023'),
(102, '', 164, '2', 'cancle', '', '155', '01:17 PM', '02-09-2023'),
(103, '', 164, '2', 'cancle', 'The user entered the wrong address', '181', '12:36 PM', '04-09-2023'),
(104, '', 164, '2', 'cancle', 'cancel', '183', '12:57 PM', '04-09-2023'),
(105, '', 164, '2', 'cancle', 'cancel', '185', '12:57 PM', '04-09-2023'),
(106, '', 164, '2', 'cancle', 'cancel', '184', '12:57 PM', '04-09-2023'),
(107, '', 164, '2', 'cancle', 'cancel', '182', '12:59 PM', '04-09-2023'),
(108, '', 164, '2', 'cancle', 'cancel', '187', '01:04 PM', '04-09-2023'),
(109, '', 164, '2', 'cancle', 'cancel', '186', '01:04 PM', '04-09-2023'),
(110, '', 164, '2', 'cancle', 'cancel', '188', '01:12 PM', '04-09-2023'),
(111, '', 164, '2', 'cancle', 'cancel', '197', '01:45 PM', '04-09-2023'),
(112, '', 164, '13', 'cancle', 'The user did not arrive', '101', '06:32 PM', '04-09-2023'),
(113, '', 164, '13', 'cancle', 'cancel', '264', '04:32 PM', '08-09-2023'),
(114, '', 164, '13', 'cancle', 'cancel', '258', '04:33 PM', '08-09-2023'),
(115, '', 164, '13', 'cancle', 'cancel', '257', '04:33 PM', '08-09-2023'),
(116, '', 164, '13', 'cancle', 'cancel', '266', '05:12 PM', '08-09-2023'),
(117, '', 164, '13', 'cancle', 'cancel', '267', '05:18 PM', '08-09-2023'),
(118, '', 164, '2', 'cancle', 'cancel', '283', '06:48 PM', '12-09-2023'),
(119, '', 164, '2', 'cancle', 'cancel', '286', '06:48 PM', '12-09-2023'),
(120, '', 164, '2', 'cancle', 'cancel', '287', '06:48 PM', '12-09-2023'),
(121, '', 164, '2', 'cancle', 'cancel', '291', '06:51 PM', '12-09-2023'),
(122, '', 164, '2', 'cancle', 'Please tell us Why You Want To Cancel', '325', '01:15 PM', '22-09-2023'),
(123, '', 164, '2', 'cancle', 'Please tell us Why You Want To Cancel', '337', '12:53 PM', '26-09-2023'),
(124, '', 164, '2', 'cancle', 'Please tell us Why You Want To Cancel', '336', '12:53 PM', '26-09-2023'),
(125, '', 164, '2', 'cancle', '', '333', '12:53 PM', '26-09-2023'),
(126, '', 164, '2', 'cancle', '', '333', '12:53 PM', '26-09-2023'),
(127, '', 164, '2', 'cancle', 'Please tell us Why You Want To Cancel', '333', '12:53 PM', '26-09-2023'),
(128, '', 164, '2', 'cancle', 'The user entered the wrong address', '330', '12:57 PM', '26-09-2023'),
(129, '', 164, '2', 'cancle', 'Please tell us Why You Want To Cancel', '331', '04:36 PM', '26-09-2023'),
(130, '7', 175, '51', 'cancle', 'Please tell us Why You Want To Cancel', '349', '04:13 PM', '2023-11-04'),
(131, '7', 175, '58', 'cancle', 'Please tell us Why You Want To Cancel', '350', '03:27 PM', '2023-11-06'),
(132, '', 196, '55', 'cancle', 'The user did not arrive', '352', '04:00 PM', '08-11-2023'),
(133, '', 196, '55', 'cancle', 'Please tell us Why You Want To Cancel', '353', '04:00 PM', '08-11-2023'),
(134, '', 0, '59', 'cancle', 'Please tell us Why You Want To Cancel', '359', '01:42 PM', '09-11-2023'),
(135, '', 196, '61', 'cancle', 'The user entered the wrong address', '367', '05:08 PM', '09-11-2023'),
(136, '7', 175, '62', 'cancle', 'The user entered the wrong address', '375', '03:21 PM', '2023-11-20'),
(137, '', 196, '65', 'cancle', 'The user did not arrive', '378', '06:42 PM', '20-11-2023'),
(138, '', 196, '65', 'cancle', 'The user entered the wrong address', '388', '10:42 AM', '21-11-2023'),
(139, '7', 175, '62', 'cancle', 'bbn', '389', '10:47 AM', '2023-11-21'),
(140, '', 196, '65', 'cancle', 'The user entered the wrong address', '392', '10:48 AM', '21-11-2023'),
(141, '7', 175, '62', 'cancle', 'The user did not arrive', '396', '11:00 AM', '2023-11-21'),
(142, '7', 175, '62', 'cancle', 'The user entered the wrong address', '397', '11:04 AM', '2023-11-21'),
(143, '7', 175, '62', 'cancle', 'The user entered the wrong address', '398', '11:11 AM', '2023-11-21'),
(144, '', 196, '65', 'cancle', '', '399', '01:00 PM', '21-11-2023'),
(145, '', 196, '65', 'cancle', '', '401', '01:04 PM', '21-11-2023'),
(146, '', 196, '65', 'cancle', '', '402', '01:07 PM', '21-11-2023'),
(147, '', 196, '65', 'cancle', 'The user entered the wrong address', '403', '01:21 PM', '21-11-2023'),
(148, '', 196, '65', 'cancle', '', '404', '01:24 PM', '21-11-2023'),
(149, '', 196, '65', 'cancle', '', '405', '01:28 PM', '21-11-2023'),
(150, '', 196, '55', 'cancle', 'User not pickup the phone', '420', '11:12 AM', '22-11-2023'),
(151, '', 196, '65', 'cancle', 'User not come on time', '411', '05:09 PM', '22-11-2023'),
(152, '', 196, '65', 'cancle', 'The user did not arrive', '438', '04:07 PM', '23-11-2023'),
(153, '', 175, '62', 'cancle', 'bb', '446', '11:35 AM', '28-11-2023'),
(154, '', 175, '62', 'cancle', 'The user entered the wrong address', '459', '07:39 PM', '01-12-2023'),
(155, '', 175, '62', 'cancle', 'bbb', '451', '07:39 PM', '01-12-2023'),
(156, '', 175, '62', 'cancle', 'The user entered the wrong address', '461', '04:21 PM', '02-12-2023'),
(157, '', 175, '62', 'cancle', 'The user did not arrive', '462', '04:21 PM', '02-12-2023'),
(158, '7', 175, '62', 'cancle', 'The user did not arrive', '463', '04:31 PM', '2023-12-02'),
(159, '125', 209, '70', 'cancle', 'uh', '474', '01:00 AM', '2023-12-23'),
(160, '125', 209, '70', 'cancle', 'The user did not arrive', '474', '01:00 AM', '2023-12-23'),
(161, '125', 209, '70', 'cancle', 'The user entered the wrong address', '474', '01:00 AM', '2023-12-23'),
(162, '24', 1, '41', 'cancle', 'bull', '480', '06:10 PM', '2023-12-25'),
(163, '24', 1, '41', 'cancle', 'vvv', '493', '12:29 PM', '2023-12-27'),
(164, '125', 209, '70', 'cancle', 'no longer interested ', '477', '09:49 AM', '2023-12-28'),
(165, '111', 214, '72', 'cancle', 'hy', '501', '11:10 AM', '2023-12-28'),
(166, '111', 214, '72', 'cancle', 'traffic jam', '512', '04:53 PM', '2023-12-28'),
(167, '', 216, '73', 'cancle', 'User not responding', '511', '11:18 AM', '29-12-2023'),
(168, '', 216, '73', 'cancle', 'The user did not arrive', '513', '11:19 AM', '29-12-2023'),
(169, '', 216, '73', 'cancle', 'The user entered the wrong address', '515', '11:19 AM', '29-12-2023'),
(170, '', 216, '73', 'cancle', 'no reason', '517', '11:19 AM', '29-12-2023'),
(171, '', 216, '73', 'cancle', 'The user entered the wrong address', '518', '11:19 AM', '29-12-2023'),
(172, '111', 214, '72', 'cancle', 'The user entered the wrong address', '529', '03:26 PM', '2023-12-29'),
(173, '', 214, '72', 'cancle', 'The user did not arrive', '519', '03:27 PM', '29-12-2023'),
(174, '', 216, '73', 'cancle', 'The user did not arrive', '526', '04:52 PM', '29-12-2023'),
(175, '', 214, '72', 'cancle', 'The user entered the wrong address', '546', '06:07 PM', '30-12-2023'),
(176, '', 214, '79', 'cancle', 'The user did not arrive', '553', '06:51 PM', '30-12-2023'),
(177, '127', 214, '79', 'cancle', 'The user entered the wrong address', '567', '11:17 AM', '2024-01-02'),
(178, '', 214, '79', 'cancle', 'The user entered the wrong address', '569', '11:21 AM', '02-01-2024'),
(179, '127', 214, '79', 'cancle', 'The user did not arrive', '574', '01:10 PM', '2024-01-02'),
(180, '127', 214, '79', 'cancle', 'User not responding', '585', '03:48 PM', '2024-01-02'),
(181, '', 228, '81', 'cancle', 'The user entered the wrong address', '589', '03:57 PM', '02-01-2024'),
(182, '', 228, '81', 'cancle', 'bb', '590', '04:10 PM', '02-01-2024'),
(183, '', 228, '81', 'cancle', 'The user entered the wrong address', '582', '04:10 PM', '02-01-2024'),
(184, '', 228, '81', 'cancle', 'The user entered the wrong address', '582', '04:10 PM', '02-01-2024'),
(185, '', 228, '81', 'cancle', 'The user entered the wrong address', '580', '04:10 PM', '02-01-2024'),
(186, '', 228, '81', 'cancle', 'The user entered the wrong address', '577', '04:11 PM', '02-01-2024'),
(187, '', 228, '81', 'cancle', 'jj', '599', '06:07 PM', '02-01-2024'),
(188, '', 228, '81', 'cancle', 'The user did not arrive', '607', '11:19 AM', '03-01-2024'),
(189, '', 228, '81', 'cancle', 'The user entered the wrong address', '605', '11:19 AM', '03-01-2024'),
(190, '', 228, '81', 'cancle', 'User not responding', '605', '11:20 AM', '03-01-2024'),
(191, '', 228, '81', 'cancle', 'The user entered the wrong address', '609', '11:20 AM', '03-01-2024'),
(192, '', 228, '81', 'cancle', 'The user did not arrive', '608', '11:20 AM', '03-01-2024'),
(193, '', 228, '81', 'cancle', 'The user entered the wrong address', '606', '11:20 AM', '03-01-2024'),
(194, '', 228, '81', 'cancle', 'The user entered the wrong address', '597', '11:20 AM', '03-01-2024'),
(195, '', 228, '81', 'cancle', 'The user entered the wrong address', '597', '11:20 AM', '03-01-2024'),
(196, '', 228, '81', 'cancle', 'User not responding', '597', '11:20 AM', '03-01-2024'),
(197, '', 228, '81', 'cancle', 'The user entered the wrong address', '596', '11:20 AM', '03-01-2024'),
(198, '127', 214, '82', 'cancle', 'The user entered the wrong address', '607', '11:53 AM', '2024-01-03'),
(199, '', 213, '80', 'cancle', 'fdgfgffdgfgf', '584', '11:54 AM', '03-01-2024'),
(200, '', 214, '72', 'cancle', 'User not responding', '619', '01:15 PM', '03-01-2024'),
(201, '', 213, '80', 'cancle', 'dfgfgfdfgfgf', '624', '04:07 PM', '03-01-2024'),
(202, '', 213, '80', 'cancle', 'The user entered the wrong address', '619', '04:12 PM', '03-01-2024'),
(203, '129', 213, '80', 'cancle', 'The user entered the wrong address', '627', '04:25 PM', '2024-01-03'),
(204, '111', 214, '83', 'cancle', 'The user entered the wrong address', '631', '05:43 PM', '2024-01-03'),
(205, '', 213, '80', 'cancle', 'The user did not arrive', '628', '11:01 AM', '04-01-2024'),
(206, '127', 213, '80', 'cancle', 'The user did not arrive', '641', '12:53 PM', '2024-01-04'),
(207, '', 228, '81', 'cancle', 'The user entered the wrong address', '643', '03:06 PM', '04-01-2024'),
(208, '', 228, '81', 'cancle', 'The user entered the wrong address', '637', '03:06 PM', '04-01-2024'),
(209, '', 214, '72', 'cancle', 'The user did not arrive', '665', '03:12 PM', '04-01-2024'),
(210, '', 214, '72', 'cancle', 'The user did not arrive', '664', '03:12 PM', '04-01-2024'),
(211, '', 214, '72', 'cancle', 'The user entered the wrong address', '659', '03:12 PM', '04-01-2024'),
(212, '', 214, '72', 'cancle', 'The user did not arrive', '658', '03:13 PM', '04-01-2024'),
(213, '', 214, '72', 'cancle', 'The user did not arrive', '657', '03:13 PM', '04-01-2024'),
(214, '', 214, '72', 'cancle', 'The user did not arrive', '656', '03:13 PM', '04-01-2024'),
(215, '', 214, '72', 'cancle', 'The user entered the wrong address', '653', '03:13 PM', '04-01-2024'),
(216, '', 214, '72', 'cancle', 'gggg', '652', '03:13 PM', '04-01-2024'),
(217, '', 228, '81', 'cancle', 'The user did not arrive', '678', '03:36 PM', '04-01-2024'),
(218, '', 228, '81', 'cancle', 'The user entered the wrong address', '677', '03:36 PM', '04-01-2024'),
(219, '', 228, '81', 'cancle', 'The user entered the wrong address', '639', '03:36 PM', '04-01-2024'),
(220, '', 213, '80', 'cancle', 'faltu booking na karefaltu booking na kare', '680', '03:42 PM', '04-01-2024'),
(221, '111', 213, '80', 'cancle', 'The user entered the wrong address', '694', '07:06 AM', '2024-01-04'),
(222, '111', 214, '72', 'cancle', 'qyagqyag', '697', '02:32 AM', '2024-01-05'),
(223, '', 216, '73', 'cancle', 'User not responding', '721', '05:36 AM', '05-01-2024'),
(224, '', 228, '84', 'cancle', 'The user entered the wrong address', '746', '07:56 AM', '05-01-2024'),
(225, '', 228, '84', 'cancle', 'The user entered the wrong address', '748', '07:58 AM', '05-01-2024'),
(226, '24', 216, '73', 'cancle', 'h', '751', '08:25 AM', '2024-01-05'),
(227, '', 216, '73', 'cancle', 'The user entered the wrong address', '742', '08:26 AM', '05-01-2024'),
(228, '', 216, '73', 'cancle', 'The user entered the wrong address', '754', '12:49 AM', '06-01-2024'),
(229, '', 228, '84', 'cancle', 'The user entered the wrong address', '749', '01:14 AM', '06-01-2024'),
(230, '133', 228, '84', 'cancle', 'User not responding', '760', '01:25 AM', '2024-01-06'),
(231, '', 213, '80', 'cancle', 'The user entered the wrong address', '757', '07:30 AM', '06-01-2024'),
(232, '', 213, '80', 'cancle', 'The user did not arrive', '754', '07:30 AM', '06-01-2024'),
(233, '', 213, '80', 'cancle', 'The user did not arrive', '752', '07:30 AM', '06-01-2024'),
(234, '', 213, '80', 'cancle', 'The user did not arrive', '742', '07:30 AM', '06-01-2024'),
(235, '', 213, '80', 'cancle', 'The user entered the wrong address', '741', '07:30 AM', '06-01-2024'),
(236, '', 213, '80', 'cancle', 'The user entered the wrong address', '737', '07:30 AM', '06-01-2024'),
(237, '', 213, '80', 'cancle', 'The user entered the wrong address', '724', '07:31 AM', '06-01-2024'),
(238, '', 213, '80', 'cancle', 'The user did not arrive', '721', '07:31 AM', '06-01-2024'),
(239, '', 213, '80', 'cancle', 'The user did not arrive', '714', '07:31 AM', '06-01-2024'),
(240, '', 213, '80', 'cancle', 'The user entered the wrong address', '713', '07:31 AM', '06-01-2024'),
(241, '', 213, '80', 'cancle', 'The user entered the wrong address', '708', '07:31 AM', '06-01-2024'),
(242, '', 213, '80', 'cancle', 'The user did not arrive', '702', '07:31 AM', '06-01-2024'),
(243, '133', 228, '84', 'cancle', 'The user entered the wrong address', '777', '02:20 AM', '2024-01-09'),
(244, '', 228, '84', 'cancle', 'The user did not arrive', '784', '06:07 AM', '09-01-2024'),
(245, '127', 214, '82', 'cancle', 'Mood changeMood change', '790', '07:13 AM', '2024-01-09'),
(246, '127', 214, '82', 'cancle', 'mood changemood change', '791', '07:21 AM', '2024-01-09'),
(247, '', 228, '84', 'cancle', 'The user entered the wrong address', '805', '01:29 AM', '10-01-2024'),
(248, '', 228, '84', 'cancle', 'The user did not arrive', '802', '01:29 AM', '10-01-2024'),
(249, '', 228, '84', 'cancle', 'The user did not arrive', '801', '01:29 AM', '10-01-2024'),
(250, '', 228, '84', 'cancle', 'The user did not arrive', '801', '01:29 AM', '10-01-2024'),
(251, '', 228, '84', 'cancle', 'The user did not arrive', '801', '01:29 AM', '10-01-2024'),
(252, '', 228, '84', 'cancle', 'User not responding', '794', '01:29 AM', '10-01-2024'),
(253, '', 228, '84', 'cancle', 'User not responding', '788', '01:29 AM', '10-01-2024'),
(254, '', 228, '84', 'cancle', 'User not responding', '800', '01:29 AM', '10-01-2024'),
(255, '', 228, '84', 'cancle', 'The user did not arrive', '797', '01:30 AM', '10-01-2024'),
(256, '', 228, '84', 'cancle', 'The user did not arrive', '795', '01:30 AM', '10-01-2024'),
(257, '132', 216, '73', 'cancle', 'The user entered the wrong address', '816', '01:51 AM', '2024-01-10'),
(258, '132', 214, '86', 'cancle', 'The user did not arrive', '818', '03:06 AM', '2024-01-10'),
(259, '133', 228, '84', 'cancle', 'User not responding', '812', '03:08 AM', '2024-01-10'),
(260, '133', 228, '84', 'cancle', 'User not responding', '820', '03:12 AM', '2024-01-10'),
(261, '', 214, '86', 'cancle', 'The user entered the wrong address', '832', '04:37 AM', '10-01-2024'),
(262, '133', 214, '82', 'cancle', '  ', '795', '05:08 AM', '2024-01-10'),
(263, '', 0, '4', 'cancle', '', '4', '04:59 PM', '16-03-2024'),
(264, '1', 0, '4', 'cancle', 'The user did not arrive', '8', '06:22 PM', '2024-03-16'),
(265, '1', 0, '4', 'cancle', 'The user entered the wrong address', '10', '06:31 PM', '2024-03-16'),
(266, '', 0, '4', 'cancle', '', '20', '04:40 PM', '18-03-2024'),
(267, '', 0, '4', 'cancle', '', '19', '04:40 PM', '18-03-2024'),
(268, '', 0, '4', 'cancle', '', '18', '04:40 PM', '18-03-2024'),
(269, '', 0, '4', 'cancle', '', '16', '04:41 PM', '18-03-2024'),
(270, '', 0, '4', 'cancle', '', '9', '04:41 PM', '18-03-2024'),
(271, '', 0, '4', 'cancle', '', '12', '04:41 PM', '18-03-2024'),
(272, '', 0, '4', 'cancle', '', '13', '04:41 PM', '18-03-2024'),
(273, '', 0, '4', 'cancle', '', '14', '04:41 PM', '18-03-2024'),
(274, '', 0, '4', 'cancle', '', '15', '04:41 PM', '18-03-2024'),
(275, '', 0, '4', 'cancle', '', '21', '04:55 PM', '18-03-2024'),
(276, '', 0, '23', 'cancle', '', '57', '05:21 PM', '21-03-2024'),
(277, '', 0, '27', 'cancle', '', '97', '10:09 AM', '21-04-2024'),
(278, '15', 0, '27', 'cancle', 'The user did not arrive', '96', '10:20 AM', '2024-04-21'),
(279, '15', 0, '27', 'cancle', 'ggb k', '95', '10:23 AM', '2024-04-21'),
(280, '18', 0, '17', 'cancle', 'User not responding', '107', '07:15 PM', '2024-05-04'),
(281, '18', 0, '17', 'cancle', 'The user did not arrive', '106', '07:15 PM', '2024-05-04'),
(282, '18', 0, '17', 'cancle', 'The user did not arrive', '105', '07:16 PM', '2024-05-04'),
(283, '17', 0, '31', 'cancle', 'User not responding', '121', '08:26 AM', '2024-05-07'),
(284, '17', 0, '31', 'cancle', 'The user entered the wrong address', '120', '05:44 PM', '2024-05-07'),
(285, '18', 0, '32', 'cancle', 'bb', '125', '03:04 PM', '2024-05-08'),
(286, '7', 0, '17', 'cancle', 'The user did not arrive', '4', '05:30 PM', '2024-05-27');

-- --------------------------------------------------------

--
-- Table structure for table `canclebooking_driver_new`
--

CREATE TABLE `canclebooking_driver_new` (
  `id` int(11) NOT NULL,
  `driver_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `cancel_time` varchar(215) NOT NULL,
  `cancel_date` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `canclebooking_driver_new`
--

INSERT INTO `canclebooking_driver_new` (`id`, `driver_id`, `status`, `type`, `booking_id`, `cancel_time`, `cancel_date`) VALUES
(8, '32', 'cancle', 'Ride_now', '130', '05:47 PM', '08-05-2024'),
(7, '32', 'cancle', 'Ride_now', '127', '04:42 PM', '08-05-2024'),
(9, '32', 'cancle', 'Ride_now', '128', '05:47 PM', '08-05-2024'),
(10, '29', 'cancle', 'Ride_now', '131', '08:05 AM', '09-05-2024'),
(11, '29', 'cancle', 'Ride_now', '130', '08:05 AM', '09-05-2024'),
(13, '29', 'cancle', 'Ride_now', '6', '05:01 PM', '29-05-2024'),
(14, '29', 'cancle', 'Ride_now', '5', '05:01 PM', '29-05-2024'),
(15, '17', 'cancle', 'Ride_now', '8', '05:46 PM', '29-05-2024');

-- --------------------------------------------------------

--
-- Table structure for table `chat_info`
--

CREATE TABLE `chat_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_info`
--

INSERT INTO `chat_info` (`id`, `user_id`, `host_id`, `booking_id`, `date`, `time`, `user`, `owner`) VALUES
(1, 79, 80, 156, '01/25/2023', '05:05 PM', 1, 1),
(3, 68, 69, 159, '01/25/2023', '07:39 PM', 0, 0),
(4, 68, 69, 160, '01/27/2023', '05:17 AM', 0, 0),
(5, 79, 80, 161, '01/27/2023', '01:07 PM', 1, 1),
(6, 79, 80, 162, '01/27/2023', '01:35 PM', 1, 1),
(7, 68, 69, 163, '01/31/2023', '09:16 PM', 0, 0),
(8, 68, 69, 164, '01/31/2023', '09:23 PM', 0, 0),
(9, 79, 80, 165, '02/01/2023', '07:00 PM', 1, 1),
(10, 70, 81, 166, '02/02/2023', '11:10 AM', 0, 0),
(11, 70, 81, 167, '02/02/2023', '12:21 PM', 0, 0),
(12, 70, 81, 168, '02/02/2023', '02:57 PM', 0, 0),
(13, 68, 69, 169, '02/02/2023', '04:52 PM', 0, 0),
(14, 68, 69, 170, '02/02/2023', '04:52 PM', 0, 0),
(15, 68, 69, 171, '02/02/2023', '04:53 PM', 0, 0),
(16, 68, 69, 172, '02/02/2023', '04:53 PM', 0, 0),
(17, 68, 69, 173, '02/02/2023', '04:57 PM', 0, 0),
(18, 68, 69, 174, '02/02/2023', '04:58 PM', 0, 0),
(19, 68, 69, 175, '02/02/2023', '04:58 PM', 0, 0),
(20, 79, 81, 176, '02/02/2023', '05:05 PM', 0, 0),
(21, 70, 81, 177, '02/02/2023', '05:07 PM', 0, 0),
(22, 79, 81, 178, '02/02/2023', '05:10 PM', 0, 0),
(23, 70, 81, 179, '02/02/2023', '05:10 PM', 0, 0),
(24, 70, 81, 180, '02/02/2023', '05:15 PM', 0, 0),
(25, 68, 69, 181, '02/02/2023', '05:15 PM', 0, 0),
(26, 1, 0, 182, '02/02/2023', '05:16 PM', 0, 0),
(27, 1, 0, 183, '02/02/2023', '05:16 PM', 0, 0),
(28, 70, 81, 184, '02/02/2023', '05:17 PM', 0, 0),
(29, 79, 81, 185, '02/02/2023', '05:40 PM', 0, 0),
(30, 1, 0, 186, '02/02/2023', '05:41 PM', 0, 0),
(31, 70, 0, 187, '02/02/2023', '05:42 PM', 0, 0),
(32, 70, 81, 188, '02/02/2023', '05:43 PM', 0, 0),
(33, 70, 81, 189, '02/02/2023', '05:48 PM', 0, 0),
(34, 70, 81, 190, '02/02/2023', '05:50 PM', 0, 0),
(35, 70, 81, 191, '02/02/2023', '06:20 PM', 0, 0),
(36, 70, 81, 192, '02/02/2023', '06:28 PM', 0, 0),
(37, 70, 81, 193, '02/02/2023', '07:01 PM', 0, 0),
(38, 70, 81, 194, '02/02/2023', '07:03 PM', 0, 0),
(39, 70, 81, 195, '02/02/2023', '07:06 PM', 0, 0),
(40, 69, 83, 196, '02/02/2023', '08:36 PM', 0, 1),
(41, 69, 83, 197, '02/02/2023', '08:39 PM', 0, 1),
(42, 83, 83, 198, '02/03/2023', '11:57 AM', 0, 1),
(43, 83, 83, 199, '02/03/2023', '11:59 AM', 0, 1),
(44, 81, 83, 200, '02/03/2023', '01:55 PM', 1, 1),
(45, 95, 98, 201, '02/03/2023', '03:26 PM', 0, 0),
(46, 95, 98, 202, '02/03/2023', '03:41 PM', 0, 0),
(47, 95, 98, 203, '02/03/2023', '03:55 PM', 0, 0),
(48, 95, 98, 204, '02/03/2023', '04:06 PM', 0, 0),
(49, 98, 83, 205, '02/03/2023', '04:46 PM', 0, 1),
(50, 98, 83, 206, '02/03/2023', '04:46 PM', 0, 1),
(51, 98, 83, 207, '02/03/2023', '04:46 PM', 0, 1),
(52, 98, 83, 208, '02/03/2023', '04:46 PM', 0, 1),
(53, 98, 83, 209, '02/03/2023', '04:46 PM', 0, 1),
(54, 99, 83, 210, '02/03/2023', '05:19 PM', 0, 1),
(55, 99, 83, 211, '02/03/2023', '05:19 PM', 0, 1),
(56, 99, 83, 212, '02/03/2023', '05:19 PM', 0, 1),
(57, 99, 83, 213, '02/03/2023', '05:19 PM', 0, 1),
(58, 99, 83, 214, '02/03/2023', '05:19 PM', 0, 1),
(59, 99, 83, 215, '02/03/2023', '05:19 PM', 0, 1),
(60, 99, 83, 216, '02/03/2023', '05:42 PM', 0, 1),
(61, 81, 83, 217, '02/03/2023', '06:53 PM', 1, 1),
(62, 99, 83, 230, '02/07/2023', '02:54 PM', 0, 1),
(63, 99, 83, 232, '02/07/2023', '03:02 PM', 0, 1),
(64, 99, 83, 234, '02/07/2023', '03:09 PM', 0, 1),
(65, 99, 83, 235, '02/07/2023', '03:12 PM', 0, 1),
(66, 81, 83, 237, '02/07/2023', '04:34 PM', 1, 1),
(67, 81, 83, 238, '02/07/2023', '04:38 PM', 1, 1),
(68, 81, 83, 239, '02/07/2023', '04:41 PM', 1, 1),
(69, 81, 83, 240, '02/07/2023', '04:43 PM', 1, 1),
(70, 81, 83, 241, '02/07/2023', '04:44 PM', 1, 1),
(71, 81, 83, 242, '02/07/2023', '04:45 PM', 1, 1),
(72, 81, 83, 243, '02/07/2023', '04:47 PM', 1, 1),
(73, 81, 83, 244, '02/07/2023', '04:52 PM', 1, 1),
(74, 81, 83, 245, '02/07/2023', '04:54 PM', 1, 1),
(75, 102, 104, 246, '02/09/2023', '12:27 PM', 1, 0),
(76, 102, 101, 247, '02/10/2023', '04:25 PM', 1, 0),
(77, 102, 101, 248, '02/10/2023', '05:22 PM', 1, 0),
(78, 96, 101, 249, '02/10/2023', '07:22 PM', 0, 0),
(79, 96, 101, 250, '02/10/2023', '07:23 PM', 0, 0),
(80, 104, 107, 251, '02/13/2023', '05:01 PM', 0, 0),
(81, 105, 107, 252, '02/13/2023', '06:35 PM', 0, 0),
(82, 95, 83, 253, '02/17/2023', '06:00 PM', 0, 1),
(83, 95, 83, 254, '02/17/2023', '06:01 PM', 0, 1),
(84, 95, 83, 255, '02/18/2023', '01:32 PM', 0, 1),
(85, 95, 83, 256, '02/18/2023', '01:34 PM', 0, 1),
(86, 95, 83, 257, '02/18/2023', '01:38 PM', 0, 1),
(87, 95, 83, 258, '02/18/2023', '01:38 PM', 0, 1),
(88, 95, 83, 259, '02/18/2023', '01:53 PM', 0, 1),
(89, 95, 83, 260, '02/18/2023', '03:05 PM', 0, 1),
(90, 95, 83, 261, '02/18/2023', '03:11 PM', 0, 1),
(91, 95, 83, 262, '02/18/2023', '03:13 PM', 0, 1),
(92, 95, 83, 263, '02/18/2023', '03:22 PM', 0, 1),
(93, 95, 83, 264, '02/18/2023', '03:25 PM', 0, 1),
(94, 95, 83, 265, '02/18/2023', '03:29 PM', 0, 1),
(95, 99, 104, 266, '02/20/2023', '10:58 AM', 0, 1),
(96, 99, 104, 267, '02/20/2023', '11:18 AM', 0, 1),
(97, 99, 104, 268, '02/20/2023', '11:19 AM', 0, 1),
(98, 99, 104, 269, '02/20/2023', '11:19 AM', 0, 1),
(99, 99, 104, 270, '02/20/2023', '12:07 PM', 0, 1),
(100, 99, 104, 271, '02/20/2023', '01:37 PM', 0, 1),
(101, 99, 104, 272, '02/20/2023', '01:39 PM', 0, 1),
(102, 99, 104, 273, '02/20/2023', '01:40 PM', 0, 1),
(103, 99, 104, 274, '02/20/2023', '01:42 PM', 0, 1),
(104, 99, 104, 275, '02/20/2023', '01:44 PM', 0, 1),
(105, 99, 104, 276, '02/20/2023', '01:49 PM', 0, 1),
(106, 99, 83, 277, '02/20/2023', '01:52 PM', 0, 1),
(107, 99, 83, 278, '02/20/2023', '01:53 PM', 0, 1),
(108, 99, 104, 279, '02/20/2023', '02:00 PM', 0, 1),
(109, 99, 104, 280, '02/20/2023', '02:00 PM', 0, 1),
(110, 99, 104, 281, '02/20/2023', '02:00 PM', 0, 1),
(111, 99, 104, 282, '02/20/2023', '02:01 PM', 0, 1),
(112, 99, 104, 283, '02/20/2023', '02:56 PM', 0, 1),
(113, 81, 83, 284, '02/22/2023', '07:15 PM', 1, 1),
(114, 81, 83, 285, '02/22/2023', '07:22 PM', 1, 1),
(115, 81, 104, 286, '02/23/2023', '05:37 PM', 1, 0),
(116, 81, 104, 287, '02/23/2023', '06:49 PM', 1, 0),
(117, 80, 83, 288, '02/23/2023', '08:37 PM', 0, 1),
(118, 81, 83, 289, '02/24/2023', '11:38 AM', 1, 1),
(119, 81, 83, 290, '02/24/2023', '11:38 AM', 1, 1),
(120, 81, 104, 291, '02/24/2023', '11:48 AM', 1, 0),
(121, 81, 83, 292, '02/24/2023', '03:14 PM', 1, 1),
(122, 80, 83, 293, '02/24/2023', '03:26 PM', 0, 1),
(123, 81, 83, 294, '02/24/2023', '04:22 PM', 1, 1),
(124, 81, 83, 295, '02/24/2023', '04:27 PM', 1, 1),
(125, 81, 83, 296, '02/24/2023', '04:36 PM', 1, 1),
(126, 80, 83, 297, '03/05/2023', '07:57 PM', 0, 1),
(127, 81, 83, 298, '03/07/2023', '11:38 AM', 1, 1),
(128, 81, 83, 299, '03/07/2023', '05:06 PM', 1, 1),
(129, 124, 101, 300, '03/09/2023', '07:08 PM', 0, 0),
(130, 124, 101, 301, '03/09/2023', '07:16 PM', 0, 0),
(131, 124, 101, 302, '03/09/2023', '07:29 PM', 0, 0),
(132, 126, 83, 300, '03/10/2023', '03:01 PM', 0, 1),
(133, 136, 139, 301, '03/10/2023', '05:29 PM', 0, 0),
(134, 136, 139, 302, '03/10/2023', '05:41 PM', 0, 0),
(135, 138, 139, 303, '03/10/2023', '06:37 PM', 1, 0),
(136, 138, 141, 304, '03/10/2023', '06:40 PM', 1, 0),
(137, 81, 83, 305, '03/16/2023', '03:03 PM', 1, 1),
(138, 81, 142, 306, '03/16/2023', '06:03 PM', 1, 0),
(139, 95, 83, 307, '03/16/2023', '06:13 PM', 0, 1),
(140, 95, 83, 308, '03/16/2023', '06:14 PM', 0, 1),
(141, 138, 83, 309, '03/16/2023', '06:30 PM', 1, 1),
(142, 95, 83, 310, '03/16/2023', '06:32 PM', 0, 1),
(143, 95, 83, 311, '03/16/2023', '06:37 PM', 0, 1),
(144, 95, 83, 312, '03/16/2023', '06:45 PM', 0, 1),
(145, 95, 83, 313, '03/16/2023', '06:55 PM', 0, 1),
(146, 95, 83, 314, '03/16/2023', '06:58 PM', 0, 1),
(147, 81, 142, 315, '03/17/2023', '02:44 PM', 1, 0),
(148, 81, 142, 316, '03/17/2023', '03:08 PM', 1, 0),
(149, 81, 83, 317, '03/17/2023', '05:24 PM', 1, 1),
(150, 141, 142, 318, '03/17/2023', '06:02 PM', 1, 1),
(151, 141, 142, 319, '03/17/2023', '06:18 PM', 1, 1),
(152, 141, 142, 320, '03/17/2023', '06:24 PM', 1, 1),
(153, 141, 142, 321, '03/17/2023', '06:34 PM', 1, 1),
(154, 141, 142, 322, '03/17/2023', '06:37 PM', 1, 1),
(155, 141, 142, 323, '03/17/2023', '07:00 PM', 1, 1),
(156, 141, 142, 324, '03/17/2023', '07:12 PM', 1, 1),
(157, 141, 142, 325, '03/17/2023', '07:16 PM', 1, 1),
(158, 81, 83, 326, '03/17/2023', '07:48 PM', 1, 1),
(159, 141, 142, 327, '03/18/2023', '03:15 PM', 1, 1),
(160, 141, 142, 328, '03/18/2023', '03:17 PM', 1, 1),
(161, 141, 142, 329, '03/18/2023', '03:36 PM', 1, 1),
(162, 141, 142, 330, '03/18/2023', '06:44 PM', 1, 1),
(163, 141, 142, 331, '03/20/2023', '06:51 PM', 1, 1),
(164, 141, 142, 332, '03/21/2023', '11:06 AM', 1, 0),
(165, 141, 142, 333, '03/21/2023', '11:31 AM', 1, 0),
(166, 141, 142, 334, '03/21/2023', '01:01 PM', 0, 0),
(167, 141, 142, 335, '03/21/2023', '01:46 PM', 0, 0),
(168, 141, 142, 336, '03/21/2023', '03:23 PM', 0, 0),
(169, 141, 104, 337, '03/21/2023', '03:49 PM', 1, 0),
(170, 141, 83, 338, '03/21/2023', '04:13 PM', 0, 1),
(171, 141, 83, 339, '03/27/2023', '02:57 PM', 0, 1),
(172, 141, 83, 340, '04/10/2023', '03:50 PM', 0, 1),
(173, 138, 83, 341, '04/11/2023', '12:15 PM', 1, 0),
(174, 138, 83, 342, '04/11/2023', '06:12 PM', 1, 0),
(175, 138, 83, 343, '04/11/2023', '06:16 PM', 1, 0),
(176, 138, 83, 344, '04/11/2023', '06:19 PM', 1, 0),
(177, 138, 83, 345, '04/12/2023', '12:57 PM', 1, 0),
(178, 138, 83, 346, '04/12/2023', '12:58 PM', 1, 0),
(179, 138, 142, 347, '04/12/2023', '03:35 PM', 0, 0),
(180, 138, 142, 348, '04/12/2023', '04:41 PM', 0, 0),
(181, 138, 142, 349, '04/12/2023', '05:23 PM', 0, 0),
(182, 138, 142, 350, '04/12/2023', '06:03 PM', 0, 0),
(183, 138, 142, 351, '04/13/2023', '04:32 PM', 0, 0),
(184, 81, 83, 348, '05/06/2023', '05:31 PM', 0, 0),
(185, 81, 83, 349, '05/06/2023', '06:11 PM', 0, 0),
(186, 81, 83, 350, '05/06/2023', '06:27 PM', 0, 0),
(187, 95, 83, 351, '05/11/2023', '12:33 PM', 0, 0),
(188, 95, 83, 352, '05/11/2023', '12:36 PM', 0, 0),
(189, 81, 83, 353, '05/12/2023', '12:17 PM', 0, 0),
(190, 81, 83, 354, '05/24/2023', '04:59 PM', 0, 0),
(191, 138, 83, 355, '05/26/2023', '05:49 PM', 1, 0),
(192, 138, 83, 356, '05/26/2023', '06:04 PM', 1, 0),
(193, 81, 83, 345, '06/15/2023', '01:35 PM', 0, 0),
(194, 81, 83, 346, '06/15/2023', '01:58 PM', 0, 0),
(195, 81, 83, 347, '06/15/2023', '02:41 PM', 0, 0),
(196, 81, 83, 359, '06/15/2023', '03:01 PM', 0, 0),
(197, 81, 83, 360, '06/16/2023', '11:14 AM', 0, 0),
(198, 81, 83, 348, '07/13/2023', '01:19 PM', 0, 0),
(199, 138, 142, 349, '07/17/2023', '06:49 PM', 0, 0),
(200, 138, 142, 350, '07/18/2023', '05:29 PM', 0, 0),
(201, 138, 142, 351, '07/20/2023', '04:14 PM', 0, 0),
(202, 138, 142, 352, '07/24/2023', '12:08 PM', 0, 0),
(203, 138, 142, 353, '07/24/2023', '05:30 PM', 0, 0),
(204, 138, 142, 354, '07/24/2023', '05:59 PM', 0, 0),
(205, 138, 142, 355, '07/25/2023', '02:52 PM', 0, 0),
(206, 138, 269, 356, '07/25/2023', '05:36 PM', 0, 1),
(207, 264, 269, 357, '07/25/2023', '06:42 PM', 0, 0),
(208, 263, 269, 358, '07/26/2023', '05:17 PM', 0, 0),
(209, 138, 272, 359, '07/28/2023', '04:45 PM', 0, 0),
(210, 138, 272, 360, '07/29/2023', '12:15 PM', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Drivers`
--

CREATE TABLE `Drivers` (
  `DriverID` int(11) NOT NULL,
  `FriendlyID` varchar(20) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(25) NOT NULL,
  `FirstName` varchar(25) NOT NULL,
  `LastName` varchar(25) NOT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `Address2` varchar(30) DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL,
  `State` varchar(20) DEFAULT NULL,
  `Zip` varchar(12) DEFAULT NULL,
  `Driver_lat` varchar(111) NOT NULL,
  `Driver_lng` varchar(111) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `country_code` varchar(50) NOT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Phone2` varchar(20) DEFAULT NULL,
  `Phone3` varchar(20) DEFAULT NULL,
  `OptIn` int(11) DEFAULT NULL,
  `Status` varchar(1) DEFAULT NULL,
  `NotifyType` int(11) DEFAULT NULL,
  `OptInChangeTime` datetime DEFAULT NULL,
  `TimeStampCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `LastUpdated` datetime DEFAULT NULL,
  `Notes` text,
  `InternalNote` text,
  `LicenseNum` varchar(20) DEFAULT NULL,
  `LicensePic` longblob,
  `image` varchar(500) NOT NULL,
  `Driver_device_id` mediumtext NOT NULL,
  `iosDriver_device_id` mediumtext NOT NULL,
  `device_status` varchar(11) NOT NULL,
  `wallet_balance` varchar(50) NOT NULL,
  `login_status` varchar(55) NOT NULL,
  `date` varchar(56) NOT NULL,
  `logout_time` varchar(56) NOT NULL,
  `login_device_key` varchar(100) NOT NULL,
  `access_token` varchar(215) NOT NULL,
  `last_login_time` varchar(50) NOT NULL,
  `zipcode_list` varchar(215) NOT NULL,
  `package_list` varchar(255) NOT NULL,
  `flag` varchar(50) NOT NULL,
  `available_status` varchar(50) NOT NULL,
  `rotation` varchar(111) NOT NULL,
  `driver_online_time` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Drivers`
--

INSERT INTO `Drivers` (`DriverID`, `FriendlyID`, `UserName`, `Password`, `FirstName`, `LastName`, `Address`, `Address2`, `City`, `State`, `Zip`, `Driver_lat`, `Driver_lng`, `Email`, `country_code`, `Phone`, `Phone2`, `Phone3`, `OptIn`, `Status`, `NotifyType`, `OptInChangeTime`, `TimeStampCreated`, `LastUpdated`, `Notes`, `InternalNote`, `LicenseNum`, `LicensePic`, `image`, `Driver_device_id`, `iosDriver_device_id`, `device_status`, `wallet_balance`, `login_status`, `date`, `logout_time`, `login_device_key`, `access_token`, `last_login_time`, `zipcode_list`, `package_list`, `flag`, `available_status`, `rotation`, `driver_online_time`) VALUES
(1, '', 'BP', '123456', 'Barkha', 'Patel', '206', 'bhawarkua', 'indore', 'Madhyapardesh', '452001', '76.6544356', '23.68586754', 'barkhapatelciss@gmail.com', '+1', '7889657898', '9854326565', '8545698523', 0, '0', 0, NULL, '2024-02-19 08:02:10', NULL, '', '', '459866', 0x6c706d6f6b30733633345f313731303933333339302e706e67, '', '', '', '', '0', '0', '2024-02-19 01:32:10', '', '', '', '', '1,2', '', '', '', '', ''),
(3, '', 'Naya driver ', '123456', 'driver', 'bhai', '210sai ram plaza ', 'mangal nagar indore ', 'Indore', 'Madhya Pradesh ', '452001', '', '', 'driver1245@gmail.com', '+1', '5886559886', '5965568896', '8966666585', 0, '0', 0, NULL, '2024-02-19 08:03:34', NULL, '', '', 'chjjffhj', 0x6a33416e4246304736395f313730383332393831342e6a7067, '', '', '', '', '0', '0', '05/08/2024 05:42:50', '', '', '', '', '', '', 'US', '', '', ''),
(4, '', 'driverbhai', '123456', 'driver', 'bhai', 'sai ram plaza ', 'mangal nagal indore', 'Indore', 'Madhya Pradesh ', '452001', '0', '0', 'driver@gmail.com', '+91', '7889657898', '5588888855', '8866666666', 0, '1', 1, NULL, '2024-02-19 11:16:49', NULL, '', '', '459866', 0x416e386a424871477a395f313730383334313430392e6a7067, '', '', '', '', '0', '0', '03/20/2024 06:22:56', '', 'CPH1809', 'dde5c5b0-e2da-1f22-b3b4-ff66f898f2e7', '', '2,3', '', 'IN', 'UnAvailable', '0', '2024-03-20 18:23:02 '),
(9, '', 'Driver Ad', '123456Aa', 'ad', 'sharma', 'jhbvghg', 'jgbhjgb', 'jgbhgbv', 'jgkjhg', '878', '', '', 'ad@gmail.com', '+1', '64578677', '4567987655', '76567567575', 0, '0', 0, NULL, '2024-02-22 13:44:13', NULL, '', '', '5498785', 0x6c7a4273787131356e345f313730383630393435332e6a7067, '', '', '', '', '0', '0', '2024-02-22 07:14:13', '', '', '', '', '', '', '', '', '', ''),
(10, '', 'HELLO', '123456789', 'l;jl;j', 'jlkjkl', 'kljkljkljlk', 'kljlkj', 'Bhopal', 'jh', '55877', '', '', '456456@456.com', '+1', '2126669999', '2128888555', '2125559999', 0, '1', 0, NULL, '2024-03-14 00:12:37', NULL, '', '', '123456789', 0x766c42457a6d4431366b5f313731303337353135372e6a7067, '', '', '', '', '0', '0', '2024-03-14 05:42:37', '', '', '', '', '1,2', '', 'US', '', '', ''),
(11, '', 'HELLO', '123456789', 'HELLO', 'HELLO', 'HELLO', 'HELLO', 'Ujjain', 'JHELLO', '258742', '0', '0', '123@123.com', '+1', '2124449696', '2124449696', '2124449696', 0, '0', 0, NULL, '2024-03-14 00:14:46', NULL, '', '', '123456789', 0x6a757642436b3571486f5f313731303337353238362e6a7067, 'BCu28lwHy3_1710375459.jpg', '', '', '', '0', '0', '04/08/2024 07:40:08', '', '', '', '', '1', '', 'US', 'UnAvailable', '0', '2024-03-20 08:44:08 '),
(13, '', 'abc', '123456Aa', 'abc', 'abc', 'gfhyt', 'yuk', 'yuk', 'uio', '7787', '', '', 'abc@gmail.com', '+91', '8787878787', '8787878787', '8787878787', 0, '1', 0, NULL, '2024-03-16 11:59:00', NULL, '', '', '8799', 0x696f7239713544316e705f313731303539303334302e4a504547, 'ljnHzi9vsD_1710590340.jpg', '', '', '', '0', '0', '2024-03-16 05:29:00', '', '', '', '', '', '', '', '', '', ''),
(14, '', 'xyz', '123456Aa', 'xyz', 'xyz', 'Navlakha', 'Navlakha', 'Indore', 'Madhya Pradesh', '452001', '', '', 'xyz@gmail.com', '+91', '9424522338', '9424522338', '9424522338', 0, '1', 0, NULL, '2024-03-16 12:01:33', NULL, '', '', '57657', 0x383241346c6a476d6e7a5f313731303539303439332e6a7067, 'EqGp5F3zC9_1710590493.jpg', '', '', '', '0', '0', '2024-03-16 05:31:33', '', '', '', '', '', '', '', '', '', ''),
(15, '', 'Savitaaa', '123456Aaaaaaaaaaaaaaaaaaa', 'Savitaaa', 'Gangwal', 'ghgfhgf', 'ghfggf', 'gfhhhh', 'gfhhhhhhh', '123456', '', '', 'savitaaa@gmail.com', '+1', '68769789780', '5565655656', '54444444566', 0, '1', 0, NULL, '2024-03-18 06:29:28', NULL, '', '', '45444', 0x72446d374845737534775f313731303734333336382e6a7067, 'nqpuAD275l_1710743368.JPEG', '', '', '', '0', '0', '2024-03-18 11:59:28', '', '', '', '', '', '', '', '', '', ''),
(16, '', 'BG', '123456Aa', 'BG', 'NH', 'indore', 'indore', 'khandwa', 'madhya pradesh', '450001', '', '', 'bpg@gmail.com', '+1', '216578985', '2132654598', '213265898', 0, '0', 0, NULL, '2024-03-18 06:43:28', NULL, '', '', '346547567', 0x304443773976757271375f313731303734343230382e706e67, '598Gkz6qsD_1710744208.png', '', '', '', '0', '0', '2024-03-18 12:13:28', '', '', '', '', '', '', '', '', '', ''),
(17, '', 'Driver', '123456', 'Driver', 'Dr', 'Indore ', 'Dewas', 'Indore', 'Madhya Pradesh ', '452001', '0', '0', 'driver1@gmail.com', '+91', '9876543225', '9876345684', '8655588885', 0, '1', 0, NULL, '2024-03-18 07:29:43', NULL, '', '', '123', 0x7436707969416d3875455f313731303934323039322e6a7067, '', '', '', '', '0', '0', '05/30/2024 05:37:40', '', '', '', '', '3,21,1,11', '', 'IN', 'UnAvailable', '0', '2024-05-30 17:37:47 '),
(18, '', 'Ankush', '123456', 'Ramesh', 'Sharma', 'jahhaah', 'babab', 'Indore', 'mp', '452001', '22.6856556', '75.8597525', 'ramesh@gmail.com', '+1', '7584643358', '8754236265', '8527413256', 0, '1', 0, NULL, '2024-03-18 09:57:43', NULL, '', '', '123', 0x426a393269757877746c5f313731303735353836332e6a7067, '2qjv791okn_1710756861.jpg', '', '', '', '0', '1', '03/18/2024 04:19:08', '', '', '', '', '', '', 'US', 'Available', '115.50365447998047', '2024-03-18 16:19:09 '),
(19, '', 'Newdriver', '123456', 'Newdriver', 'Driver', 'sairam plaza', 'Mangal nagar ', 'Indore', 'Madhya Pradesh', '452001', '22.6856691', '75.85973', 'newdriver@gmail.com', '+91', '5855699855', '9635888555', '3698111445', 0, '1', 0, NULL, '2024-03-18 10:54:55', NULL, '', '', '123456', 0x6f336b386e36694335315f313731303735393239352e6a7067, '', '', '', '', '0', '0', '03/18/2024 04:48:46', '', '', '', '', '3,2', '', 'IN', 'Available', '329.96783447265625', '2024-03-18 16:48:45 '),
(20, '', 'Lalit', '123456', 'Lalit', 'Patel', 'Navlakha ', 'Mangal Nagar ', 'Indore', 'MP', '452001', '22.6856866', '75.8596581', 'lalit@gmail.com', '+91', '7583816688', '7583816688', '7583816688', 0, '1', 0, NULL, '2024-03-19 07:06:29', NULL, '', '', '123456', 0x4469476d3731337532795f313731303833313938392e6a7067, '', '', '', '', '0', '1', '03/21/2024 05:25:43', '', 'CPH1809', 'a465c8c0-d568-1f25-9691-7590286d6937', '', '', '', 'IN', 'Available', '248.9341278076172', '2024-03-21 17:26:45 '),
(21, '', 'abc', '123456', 'Tarun', 'Birla', 'Shivaji Vatika', 'Near I bus stop', 'Indore', 'Madhya Pradesh', '452001', '22.6856872', '75.8596598', 'tarun@gmail.com', '+1', '4845691784', '5588888854', '8866666664', 0, '1', 0, NULL, '2024-03-20 06:15:40', NULL, '', '', 'A123', 0x6d354272784143337a705f313731303931353334302e6a7067, '', '', '', '', '0', '0', '03/21/2024 05:25:26', '', '', '', '', '3', '', 'US', 'Available', '62.364131927490234', '2024-03-21 17:25:17 '),
(22, '', 'kakka', '123456', 'hqhag', 'kkkjjj', 'gaga', 'gahah', 'Indore', 'kakka', '452014', '22.6856859', '75.8596536', 'kakka@gmail.com', '+91', '9424522558', '9424522575', '9424522994', 0, '1', 0, NULL, '2024-03-21 08:13:36', NULL, '', '', '1515', 0x6f30416a7736426c38735f313731313030383831362e6a7067, '', '', '', '', '0', '1', '03/21/2024 05:55:49', '', '', '', '', '3,2', '', 'IN', 'Available', '304.61114501953125', '2024-03-21 17:55:50 '),
(23, '', 'Abhishek', '123456', 'Abhishek', 'Gupta', 'Mangal Nagar ', 'Rajiv Gandhi ', 'Indore', 'MP', '452001', '22.6856641', '75.8596711', 'abhishek@gmail.com', '+91', '8527645456', '9635576648', '9578454254', 0, '1', 1, NULL, '2024-03-21 10:36:33', NULL, '', '', '1234', 0x47443275734169746d765f313731313031373339332e6a7067, '', '', '', '', '0', '1', '03/22/2024 05:08:06', '', 'Redmi Note 8 Pro', '', '', '3,2', '', 'IN', 'Available', '90.0', '2024-03-28 14:53:00 '),
(24, '', '', '123456', 'vishnu', 'prajapati', 'Indore, Madhya Pradesh, India', 'Indore, Madhya Pradesh, India', 'Bhopal', 'Madhya Pradesh ', '458775', '', '', 'vishnuprajapati1@gmail.com', '+91', '1234567899', '', '', 0, '0', 0, NULL, '2024-04-11 06:33:03', NULL, '', '', '1234567', 0x6c6a334534467a6e31775f313731323831373138332e6a7067, '', '', '', '', '0', '0', '2024-04-11 12:03:03', '', '', '', '', '21,33', '', 'IN', '', '', ''),
(25, '', '', '123456', 'dheeraj', 'singh', 'Indore, Madhya Pradesh, India', 'Indore, Madhya Pradesh, India', 'Indore', 'mp', '452020', '22.6857222', '75.8595569', 'dheerajkumars430@gmail.com', '+91', '9752115634', '', '', 0, '1', 0, NULL, '2024-04-11 06:44:20', NULL, '', '', 'hhgg', 0x7074763038333145737a5f313731323831373836302e6a7067, '', '', '', '', '0', '0', '04/11/2024 12:20:23', '', '', '', '', '33,1,3,21,11,2,12,Route1', '', 'IN', 'Available', '0.0', '2024-04-11 12:18:50 '),
(26, '', '', '123456', 'vvvvv', 'ggggg', 'Indore, Madhya Pradesh, India', 'gggggg', 'gyyyt', 'ggvggg', '452020', '', '', 'devidbrusli@gmail.com', '+91', '7089612536', '', '', 0, '0', 0, NULL, '2024-04-12 08:10:23', NULL, '', '', '666666', 0x32466d74697a713630355f313731323930393432332e6a7067, '', '', '', '', '0', '0', '2024-04-12 01:40:23', '', '', '', '', '1,21,3', '', 'IN', '', '', ''),
(29, '', '', '123456789', 'test', 'testd', '45665 Tlajomulco de Zúñiga, Jalisco, Mexico', 'ugg', 'gcg', 'vv', '11234', '', '', '123456@123456.com', '+1', '2122222222', '', '', 0, '1', 0, NULL, '2024-05-07 00:31:16', NULL, '', '', 'staff', 0x3046423234706f31776b5f313731353034313837362e706e67, '', '', '', '', '0', '1', '05/09/2024 07:22:12', '', 'moto g pure', 'b1eec7e0-f1fb-1fba-b31c-9bd704b0677b', '', '11,3,1,21,2', '', 'US', '', '', ''),
(30, '', '', '123456789', 'mooooo', 'dooooo', '45664 Jalisco, Mexico', 'fhgj', 'ggg', 'ghg', '123466', '', '', '1112@112.com', '+1', '2122552222', '', '', 0, '0', 0, NULL, '2024-05-07 00:33:44', NULL, '', '', 'off yy', 0x76427733366c463130485f313731353034323032342e706e67, '', '', '', '', '0', '0', '2024-05-07 06:03:44', '', '', '', '', '21,3,11', '', 'US', '', '', ''),
(31, '', '', '123456789', 'newdriver', 'now', 'Indianapolis, IN, USA', 'hyg', 'hvj', 'dgj', '12345 ', '0', '0', '1212@1212.com', '+1', '2124443366', '', '', 0, '1', 0, NULL, '2024-05-07 00:52:30', NULL, '', '', '2156', 0x397634424533463043485f313731353034333135302e706e67, '', '', '', '', '0', '0', '05/07/2024 06:23:25', '', 'moto g pure', 'e30e64f0-b06d-1fb4-bfbb-3d9ea979d1fd', '', '1', '', 'US', 'UnAvailable', '0', '2024-05-07 17:27:37 '),
(32, '', '', '123456', 'vishnu ', 'prajapati ', 'Indore, Madhya Pradesh, India', 'indore', 'indore', 'Madhya Pradesh ', '452001', '0', '0', 'vishnuprajapati@gmail.com', '+91', '8982411736', '', '', 0, '1', 0, NULL, '2024-05-08 07:51:04', NULL, '', '', 'gjjhyuhvijbct', 0x727839776f456d386e345f313731353135343636342e706e67, '', '', '', '', '0', '0', '05/23/2024 02:51:39', '', '', '', '', '3,21', '', 'IN', 'UnAvailable', '0', '2024-05-23 14:51:42 '),
(33, '', '', '123456789', 'test once', 'test', 'GHJGHJGHJG, Bhel Chowk, Karanpur, Dehradun, Uttara', 'hhh', 'hhj', 'hhh', '25255', '', '', '12121212@12121212.com', '+1', '2125556666', '', '', 0, '0', 0, NULL, '2024-05-09 01:47:23', NULL, '', '', '123456789', 0x453343357875366f347a5f313731353231393234332e706e67, '', '', '', '', '0', '0', '2024-05-09 07:17:23', '', '', '', '', '1', '', 'US', '', '', ''),
(34, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0', 0, NULL, '2024-05-23 06:41:25', NULL, '', '', '', 0x30436a6c3841713433745f31373136343436343835, '', '', '', '', '0', '0', '2024-05-23 12:11:25', '', '', '', '', '', '', '', '', '', ''),
(35, '', '', '123456', 'fgg', 'fgh', 'Indore, Madhya Pradesh, India', 'txxttc', 'indore', 'mp', '66853', '', '', 'vvv@gmail.com', '+1', '5665358666', '', '', 0, '0', 0, NULL, '2024-05-23 09:22:34', NULL, '', '', 'guufgyuuu', 0x7545376f44776d6c48475f313731363435363135342e706e67, '', '', '', '', '0', '0', '2024-05-23 02:52:34', '', '', '', '', '1', '', 'US', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `driver_faq`
--

CREATE TABLE `driver_faq` (
  `df_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `ques` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver_faq`
--

INSERT INTO `driver_faq` (`df_id`, `type_id`, `type`, `ques`, `answer`) VALUES
(1, 0, 'Admin', 'Decide how you\'ll organize the FAQ pages. Update', 'Update - As you\'ll see from the examples below, not every FAQ page looks the same. Depending on what your company is selling and how many products it offers, your FAQ page might consist of a single page with a list of questions or several pages linked together. What\'s best for your business will vary based on the needs of your customers and how easy it is to troubleshoot your products.'),
(5, 164, 'Company', 'Decide how you\'ll organize the FAQ pages.', 'As you\'ll see from the examples below, not every FAQ page looks the same. Depending on what your company is selling and how many products it offers, your FAQ page might consist of a single page with a list of questions or several pages linked together. What\'s best for your business will vary based on the needs of your customers and how easy it is to troubleshoot your products.'),
(22, 0, 'Admin', 'Question', 'Answer'),
(23, 0, 'Admin', 'ecide how you\'ll organiz', 'ut it simply, Sender Delivery Appis a ride-sharing app-based platform that makes hiring and taking available rides to your journey very simple. It is an online Ridesharing booking platform that provides a lot of flexible o'),
(24, 0, 'Admin', 'dgfdffff', 'et etre rt yrttuty tr urtu tgjn ryh g'),
(25, 0, 'Admin', ' the FAQ', 'what your company is selling and how ');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `f_id` int(10) NOT NULL,
  `type_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `ques` blob NOT NULL,
  `answer` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`f_id`, `type_id`, `type`, `ques`, `answer`) VALUES
(1, 0, 'Admin', 0x576861742069732053656e6465722044656c697665727920417070203f, 0x546f207075742069742073696d706c792c2053656e6465722044656c6976657279204170706973206120726964652d73686172696e67206170702d626173656420706c6174666f726d2074686174206d616b657320686972696e6720616e642074616b696e6720617661696c61626c6520726964657320746f20796f7572206a6f75726e657920766572792073696d706c652e20497420697320616e206f6e6c696e65205269646573686172696e6720626f6f6b696e6720706c6174666f726d20746861742070726f76696465732061206c6f74206f6620666c657869626c65206f7074696f6e7320666f7220686972696e6720612064726976657220616e6420616c736f2064656c6976657273206120677265617420726964696e6720657870657269656e63652077697468206c69766520747261636b696e672061732077656c6c206173206172726976616c20616e64206465706172747572652074696d65732e),
(2, 0, 'Admin', 0x57686174206973207468652070726f63657373206f6620626f6f6b696e6720612052696465206f6e2053656e6465722044656c6976657279204170703f, 0x412075736572206e6565647320746f2063726561746520612070726f66696c6520776974682062617369632064657461696c73206c696b6520636f6e74616374206e756d6265722c20652d6d61696c2069642c20616e64207061796d656e74206d6574686f642066697273742e20416674657220746869732c20746865792063616e2063686f6f7365207468656972207069636b2d757020616e642064726f702d6f6666206c6f636174696f6e7320666f72206120726964652e2054686520617661696c61626c652064726976657220696e2074686520766963696e69747920676574732073656c65637465642061742072616e646f6d20746f207069636b20757020746865207573657220616e642067657420746865207269646573686172696e6720657870657269656e636520636f6d706c6574656420617420796f75722075747465726d6f737420636f6d666f72746162696c697479),
(3, 0, 'Admin', 0x57696c6c20492067657420746865206472697665722064657461696c7320616c6c6f7474656420746f206d6520647572696e67206d7920747269703f, 0x5965732e20466f722065766572792074726970207468617420796f7520626f6f6b2077697468207573206f6e2053656e6465722044656c6976657279204170702c206f6e6365206120647269766572206163636570747320796f757220726964652c20796f752077696c6c20726563656976652064657461696c73206c696b6520746865206e616d652c20636f6e74616374206e756d6265722c20616e6420616e206176657261676520726174696e67206f662074686520647269766572206261736564206f6e20726964657220726576696577732066726f6d207468652070726576696f75732074726970732e),
(5, 0, 'Admin', 0x576861742061726520746865207061796d656e74206d6f64657320737570706f72746564206f6e20796f757220706c6174666f726d3f, 0x417420436572626572202c2077652061726520616c6c2061626f75742070726f766964696e6720616e20657874656e73697665206c6576656c206f6620666c65786962696c69747920616e6420637573746f6d657220636f6e76656e69656e636520746f20616c6c2e20546869732069732077687920776520686176652061206e756d626572206f6620646966666572656e74207061796d656e74206d6f6465732066726f6d20776869636820612072696465722063616e2063686f6f73652061732070657220746865697220636f6e76656e69656e6365202d204361736820616e642044656269742f63726564697420636172642e3c6272202f3e3c6272202f3e0d0a3c6272202f3e3c6272202f3e0d0a596f752063616e2074616b6520796f7572207069636b2c20616e642074686520657870657269656e63652077696c6c206265207365616d6c65737320696e20657665727920636173652e),
(7, 0, 'Admin', 0x57686174206966206d7920647269766572206163636570747320746865207269646520616e64207468656e2069732061206e6f2d73686f773f, 0x53656e6465722044656c6976657279204170702074616b6573206974732070726f6d69736520746f20637573746f6d657273207665727920736572696f75736c792c20616e642074686572652069732061206e6f2d73686f772e3c6272202f3e3c6272202f3e3c6272202f3e3c6272202f3e0d0a506c656173652072656c617820616e6420646f206e6f742070616e69632062656361757365206f7572206e6574776f726b2077696c6c206d616b65207375726520796f752067657420616e6f74686572206472697665722077697468696e20746865206e65617265737420706f737369626c652074696d652e2052656d656d6265722077652061726520696e207468697320627573696e65737320746f20736572766520796f752e20546875732073657276696e6720796f75206973206f7572206d6f737420696d706f7274616e74206f626c69676174696f6e2e),
(33, 0, 'Admin', 0x6768686969, 0x69696969),
(35, 0, 'Admin', 0x6767686a207468667467756866672074757475797979797979797979797979797979797979797979797979797979797979797979797979797979797979792079, 0x7479797979797979797975206975757575373737373737373737373720756c6b6c6c6c6c6c6c6c6c6c6c6c6c6c6c6c6c6c6c6c20686b6a6a206b6a202079696969696969696969696969696969696969696969696969696969696969696920686a6a6a6a6a6a6a6a6a6a6a6a6a6a6a6a6a6a6a6a6a67687261737a7a7a7a7a6668676767676767676767676767676767676767206767676767676767676a6b);

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_table`
--

CREATE TABLE `inquiry_table` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(200) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inquiry_table`
--

INSERT INTO `inquiry_table` (`id`, `type_id`, `email`, `contact`, `type`) VALUES
(1, 0, 'admin@gmail.com', '875676', 'Admin'),
(2, 164, '123ciss@gmail.com', '78', 'Company'),
(6, 0, 'xyz@outlook.com', '', 'Admin_new');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `date` varchar(22) NOT NULL,
  `time` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `date`, `time`) VALUES
(1, 4, 4, 'hy', '18-03-2024', '04:57 PM'),
(2, 4, 23, 'hello user', '21-03-2024', '05:09 PM'),
(3, 23, 4, 'heyy Abhishek', '21-03-2024', '05:09 PM'),
(4, 23, 4, ',', '21-03-2024', '05:10 PM'),
(5, 4, 23, ',', '21-03-2024', '05:10 PM'),
(6, 23, 4, '488', '21-03-2024', '05:10 PM'),
(7, 4, 23, '(', '21-03-2024', '05:10 PM'),
(8, 4, 23, '\";()1', '21-03-2024', '05:10 PM'),
(9, 4, 23, '?ah-;;:;$()()', '21-03-2024', '05:10 PM'),
(10, 23, 4, 'hy', '28-03-2024', '01:25 PM');

-- --------------------------------------------------------

--
-- Table structure for table `panding_booking_request_driver`
--

CREATE TABLE `panding_booking_request_driver` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `total_price` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `ride_type` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `source_city` varchar(215) COLLATE utf8_unicode_ci NOT NULL,
  `destination_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `admin_commission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trip_fare` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `total_fare` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `discount` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `coupen_id` int(11) NOT NULL,
  `notes` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `panding_booking_request_driver`
--

INSERT INTO `panding_booking_request_driver` (`id`, `trip_id`, `user_id`, `driver_id`, `total_price`, `ride_type`, `source_city`, `destination_city`, `city_status`, `status`, `date`, `time`, `admin_commission`, `trip_fare`, `total_fare`, `discount`, `coupen_id`, `notes`) VALUES
(1, 11, 7, 4, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '30-05-2024', '12:10 PM', '', '', '200', '0.0', 0, 'svdvdrbthrbntn'),
(2, 11, 7, 17, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:10 PM', '', '', '200', '0.0', 0, 'svdvdrbthrbntn'),
(3, 11, 7, 19, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:10 PM', '', '', '200', '0.0', 0, 'svdvdrbthrbntn'),
(4, 11, 7, 21, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:11 PM', '', '', '200', '0.0', 0, 'svdvdrbthrbntn'),
(5, 11, 7, 22, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:11 PM', '', '', '200', '0.0', 0, 'svdvdrbthrbntn'),
(6, 11, 7, 23, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:11 PM', '', '', '200', '0.0', 0, 'svdvdrbthrbntn'),
(7, 11, 7, 25, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:11 PM', '', '', '200', '0.0', 0, 'svdvdrbthrbntn'),
(8, 11, 7, 29, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:11 PM', '', '', '200', '0.0', 0, 'svdvdrbthrbntn'),
(9, 11, 7, 32, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:11 PM', '', '', '200', '0.0', 0, 'svdvdrbthrbntn'),
(10, 12, 7, 4, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '30-05-2024', '12:20 PM', '', '', '200', '0.0', 0, ''),
(11, 12, 7, 17, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:20 PM', '', '', '200', '0.0', 0, ''),
(12, 12, 7, 19, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:20 PM', '', '', '200', '0.0', 0, ''),
(13, 12, 7, 21, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:20 PM', '', '', '200', '0.0', 0, ''),
(14, 12, 7, 22, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:20 PM', '', '', '200', '0.0', 0, ''),
(15, 12, 7, 23, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:20 PM', '', '', '200', '0.0', 0, ''),
(16, 12, 7, 25, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:20 PM', '', '', '200', '0.0', 0, ''),
(17, 12, 7, 29, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:20 PM', '', '', '200', '0.0', 0, ''),
(18, 12, 7, 32, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:20 PM', '', '', '200', '0.0', 0, ''),
(19, 13, 7, 4, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '30-05-2024', '12:27 PM', '', '', '200', '0.0', 0, 'ghh'),
(20, 13, 7, 17, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:27 PM', '', '', '200', '0.0', 0, 'ghh'),
(21, 13, 7, 19, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:27 PM', '', '', '200', '0.0', 0, 'ghh'),
(22, 13, 7, 21, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:27 PM', '', '', '200', '0.0', 0, 'ghh'),
(23, 13, 7, 22, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:27 PM', '', '', '200', '0.0', 0, 'ghh'),
(24, 13, 7, 23, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:27 PM', '', '', '200', '0.0', 0, 'ghh'),
(25, 13, 7, 25, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:27 PM', '', '', '200', '0.0', 0, 'ghh'),
(26, 13, 7, 29, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:27 PM', '', '', '200', '0.0', 0, 'ghh'),
(27, 13, 7, 32, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:27 PM', '', '', '200', '0.0', 0, 'ghh'),
(28, 14, 7, 4, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '30-05-2024', '12:36 PM', '', '', '200', '0.0', 0, 'vvb'),
(29, 14, 7, 17, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:36 PM', '', '', '200', '0.0', 0, 'vvb'),
(30, 14, 7, 19, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:36 PM', '', '', '200', '0.0', 0, 'vvb'),
(31, 14, 7, 21, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:36 PM', '', '', '200', '0.0', 0, 'vvb'),
(32, 14, 7, 22, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:36 PM', '', '', '200', '0.0', 0, 'vvb'),
(33, 14, 7, 23, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:36 PM', '', '', '200', '0.0', 0, 'vvb'),
(34, 14, 7, 25, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:36 PM', '', '', '200', '0.0', 0, 'vvb'),
(35, 14, 7, 29, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:36 PM', '', '', '200', '0.0', 0, 'vvb'),
(36, 14, 7, 32, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:36 PM', '', '', '200', '0.0', 0, 'vvb'),
(37, 15, 7, 4, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '30-05-2024', '12:51 PM', '', '', '200', '0.0', 0, ''),
(38, 15, 7, 17, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:51 PM', '', '', '200', '0.0', 0, ''),
(39, 15, 7, 19, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:51 PM', '', '', '200', '0.0', 0, ''),
(40, 15, 7, 21, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:51 PM', '', '', '200', '0.0', 0, ''),
(41, 15, 7, 22, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:51 PM', '', '', '200', '0.0', 0, ''),
(42, 15, 7, 23, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:51 PM', '', '', '200', '0.0', 0, ''),
(43, 15, 7, 25, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:51 PM', '', '', '200', '0.0', 0, ''),
(44, 15, 7, 29, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:51 PM', '', '', '200', '0.0', 0, ''),
(45, 15, 7, 32, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:51 PM', '', '', '200', '0.0', 0, ''),
(46, 16, 7, 4, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '30-05-2024', '12:53 PM', '', '', '200', '0.0', 0, ''),
(47, 16, 7, 17, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:53 PM', '', '', '200', '0.0', 0, ''),
(48, 16, 7, 19, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:53 PM', '', '', '200', '0.0', 0, ''),
(49, 16, 7, 21, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:53 PM', '', '', '200', '0.0', 0, ''),
(50, 16, 7, 22, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:53 PM', '', '', '200', '0.0', 0, ''),
(51, 16, 7, 23, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:53 PM', '', '', '200', '0.0', 0, ''),
(52, 16, 7, 25, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:53 PM', '', '', '200', '0.0', 0, ''),
(53, 16, 7, 29, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:53 PM', '', '', '200', '0.0', 0, ''),
(54, 16, 7, 32, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:53 PM', '', '', '200', '0.0', 0, ''),
(55, 17, 7, 4, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '30-05-2024', '12:57 PM', '', '', '200', '0.0', 0, ''),
(56, 17, 7, 17, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:57 PM', '', '', '200', '0.0', 0, ''),
(57, 17, 7, 19, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:57 PM', '', '', '200', '0.0', 0, ''),
(58, 17, 7, 21, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:57 PM', '', '', '200', '0.0', 0, ''),
(59, 17, 7, 22, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:57 PM', '', '', '200', '0.0', 0, ''),
(60, 17, 7, 23, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:57 PM', '', '', '200', '0.0', 0, ''),
(61, 17, 7, 25, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:57 PM', '', '', '200', '0.0', 0, ''),
(62, 17, 7, 29, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:57 PM', '', '', '200', '0.0', 0, ''),
(63, 17, 7, 32, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:57 PM', '', '', '200', '0.0', 0, ''),
(64, 18, 7, 4, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '30-05-2024', '12:57 PM', '', '', '200', '0.0', 0, ''),
(65, 18, 7, 17, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:57 PM', '', '', '200', '0.0', 0, ''),
(66, 18, 7, 19, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:57 PM', '', '', '200', '0.0', 0, ''),
(67, 18, 7, 21, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:57 PM', '', '', '200', '0.0', 0, ''),
(68, 18, 7, 22, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:57 PM', '', '', '200', '0.0', 0, ''),
(69, 18, 7, 23, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:57 PM', '', '', '200', '0.0', 0, ''),
(70, 18, 7, 25, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:57 PM', '', '', '200', '0.0', 0, ''),
(71, 18, 7, 29, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:57 PM', '', '', '200', '0.0', 0, ''),
(72, 18, 7, 32, '200.00', 'Ride_now', 'indore', 'dhamnod', 'Out City', 'New Booking', '2024-05-30', '12:57 PM', '', '', '200', '0.0', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `Senders`
--

CREATE TABLE `Senders` (
  `SenderID` int(11) NOT NULL,
  `FriendlyID` varchar(20) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(25) NOT NULL,
  `FirstName` varchar(25) NOT NULL,
  `LastName` varchar(25) NOT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `Address2` varchar(30) DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL,
  `State` varchar(20) DEFAULT NULL,
  `Zip` varchar(12) DEFAULT NULL,
  `Email` varchar(40) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Phone2` varchar(20) DEFAULT NULL,
  `Phone3` varchar(20) DEFAULT NULL,
  `Status` varchar(1) NOT NULL,
  `PreferredPayment` varchar(20) DEFAULT NULL,
  `ForceAuth` tinyint(4) DEFAULT NULL,
  `NotifyType` varchar(20) DEFAULT NULL,
  `TimeStampCreated` datetime DEFAULT NULL,
  `LastUpdated` datetime DEFAULT NULL,
  `Stripe_CustomerId` varchar(45) DEFAULT NULL,
  `country_code` varchar(50) NOT NULL,
  `country_flag` varchar(50) NOT NULL,
  `user_wallet` varchar(225) NOT NULL,
  `device_id` longtext NOT NULL,
  `iosdevice_id` longtext NOT NULL,
  `device_status` longtext NOT NULL,
  `id_proof_image` text NOT NULL,
  `id_expiry_date` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `company_id` text NOT NULL,
  `image` mediumtext NOT NULL,
  `social_id` int(11) NOT NULL,
  `social_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Senders`
--

INSERT INTO `Senders` (`SenderID`, `FriendlyID`, `UserName`, `Password`, `FirstName`, `LastName`, `Address`, `Address2`, `City`, `State`, `Zip`, `Email`, `Phone`, `Phone2`, `Phone3`, `Status`, `PreferredPayment`, `ForceAuth`, `NotifyType`, `TimeStampCreated`, `LastUpdated`, `Stripe_CustomerId`, `country_code`, `country_flag`, `user_wallet`, `device_id`, `iosdevice_id`, `device_status`, `id_proof_image`, `id_expiry_date`, `gender`, `company_id`, `image`, `social_id`, `social_type`) VALUES
(7, 'SEND492879', '', '123456', 'Goa', 'Kk', 'Sai Ram Plaza, Mangal Nagar Road, Mangal Nagar, In', '', '', '', '', 'goa@gmail.com', '8085059285', '', '', 'A', '', 0, '', '2024-05-23 00:00:00', '0000-00-00 00:00:00', 'cus_Q9svkJHP4JUIMO', '+91', 'IN', '0', 'cBF93r8aR8Ga0oxoB83BRy:APA91bEGw4uj8i0_MRGvLZ6wnJp2VyJoV3aEFkV01ZsrnSp-IRnLgQrllDpjco7u7v2LvtQScAp-lurS8Qq8H5URd47Q030jlmampADC6J-_5O6ibCfpBe84kv4s_LIxVp6bjgtvZUCd', '', 'Android', 'AG8pskEi71_1716461173', '', 'Male', '', '', 0, ''),
(8, 'SEND878836', '', '123456Aa', 'barkha', 'patel', '', '', '', '', '', 'bp@gmail.com', '4565789845', '', '', 'D', '', 0, '', '2024-05-27 00:00:00', '0000-00-00 00:00:00', 'cus_QBJqbzmnmyxzSN', '+1', '', '0', '', '', '', 'Em2Fk7A8jr_1716791913.jpg', '2024-06-01', '', '', 'g31q92ywnf_1716796167.png', 0, ''),
(9, 'SEND864798', '', '123456789', 'Test', 'Sender', 'Gös Eriks väg 123, Borlänge, Sweden', '', '', '', '', '123123@123.com', '2122122222', '', '', 'A', '', 0, '', '2024-05-29 00:00:00', '0000-00-00 00:00:00', 'cus_QC8mGQrcSVOJSx', '+1', 'US', '0', 'eIwfq3thSQ2WLFNpult3Kn:APA91bHcASGx9Nos3DjI7Z7aXb_KabToRLg5Oa-caeRyB0pyUbn4ZU3hlY59oI_ulxac0wlSkffK3W6aM892z0IdLYI_AQHeodNOw6GfdfUfhFs1G6X-EnDW90N3wFv8gL2R_1Q3e4MG', '', 'Android', 'uBm4z5kp71_1716981439', '', 'Male', '', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `sys_trip_status`
--

CREATE TABLE `sys_trip_status` (
  `trip_status_id` char(50) NOT NULL DEFAULT '',
  `trip_status_name` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_trip_status`
--

INSERT INTO `sys_trip_status` (`trip_status_id`, `trip_status_name`) VALUES
('A', 'Accepted'),
('B', 'BakedOutDriver'),
('C', 'Completed'),
('D', 'DroppedOff'),
('N', 'CanceledSender'),
('P', 'PickedUp'),
('R', 'Requested');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_about_us`
--

CREATE TABLE `tbl_about_us` (
  `about_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `ques` blob NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_about_us`
--

INSERT INTO `tbl_about_us` (`about_id`, `type_id`, `ques`, `type`) VALUES
(5, 164, 0x3c703e746869732069732061626f757420757320706167653c2f703e0d0a, 'Company'),
(6, 1, 0x3c703e6d792064656d6f20646174613c2f703e0d0a, 'Company'),
(7, 0, 0x3c703e41626f7574206974206b6c66646a676b6664266e6273703b206a6b636e766b632069646a676b6c76206b6e647620676b76676b7620676b76676b76676b7620676b76676b76676b206e676a6d6b266e6273703b3c2f703e0d0a, 'Admin'),
(8, 173, 0x3c703e6a68626768793c2f703e0d0a, 'Company'),
(9, 197, 0x3c703e446d6f20746578743c2f703e0d0a, 'Company'),
(10, 196, 0x3c703e6a6b7567666666666666666666666666683c2f703e0d0a, 'Company');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cancel_reason`
--

CREATE TABLE `tbl_cancel_reason` (
  `reason_id` int(11) NOT NULL,
  `reason_for` varchar(255) NOT NULL,
  `cancel_reason` varchar(500) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cancel_reason`
--

INSERT INTO `tbl_cancel_reason` (`reason_id`, `reason_for`, `cancel_reason`, `status`) VALUES
(5, 'User', 'Booked By Mistake', 'Deactivate'),
(6, 'User', 'Driver Negotiating For The Price', 'Activated'),
(7, 'User', 'Wrong location booking', 'Activated'),
(9, 'Driver', 'User not responding', 'Activated'),
(10, 'Driver', 'The user did not arrive', 'Activated'),
(11, 'Driver', 'The user entered the wrong address', 'Activated'),
(12, 'Driver', 'fd', 'Activated'),
(13, 'Driver', 'Booked wrongly', 'Activated'),
(14, 'User', 'Booked wrongly by the kid', 'Deactivate'),
(15, 'User', 'Booked wrongly by the kid', 'Activated'),
(16, 'Driver', 'Booked wrongly by the kid - Driver', 'Activated'),
(17, 'User', 'Because of Delay ', 'Activated'),
(18, 'Driver', 'dummy', 'Activated'),
(22, 'Driver', 'User not come', 'Deactivate'),
(23, 'User', 'Booked wrongly by the kid, please cancel', 'Activated'),
(24, 'User', 'Booked by mistake', 'Activated'),
(27, 'User', 'ccd', 'Activated'),
(28, 'Driver', 'hhk', 'Activated'),
(29, 'User', 'No', 'Activated');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complain_list`
--

CREATE TABLE `tbl_complain_list` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `compain_text` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_complain_list`
--

INSERT INTO `tbl_complain_list` (`id`, `driver_id`, `user_id`, `booking_id`, `title`, `compain_text`, `image`, `type`, `date`, `time`) VALUES
(1, 23, 0, 56, 'driver...', 'driver complaint report', '4qB5Fkn8vC_1711094033.jpg', 'Driver', '2024-03-22', '01:23 PM'),
(2, 23, 0, 56, 'hhyy', 'hhhhhhhhgg', '37s6rG1lH4_1711107110.jpg', 'Driver', '2024-03-22', '05:01 PM'),
(3, 31, 0, 119, 'test this compain', 'this is a test complain', 'ru1p0Eol5m_1715047835.png', 'Driver', '2024-05-07', '07:40 AM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driver_privacy`
--

CREATE TABLE `tbl_driver_privacy` (
  `pid` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `privacy_policy` blob NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_driver_privacy`
--

INSERT INTO `tbl_driver_privacy` (`pid`, `type_id`, `privacy_policy`, `type`) VALUES
(2, 164, 0x3c703e41205072697661637920506f6c69637920697320612073746174656d656e74206f722061206c6567616c20646f63756d656e7420746861742073746174657320686f77206120636f6d70616e79206f722077656273697465266e6273703b3c7374726f6e673e636f6c6c656374733c2f7374726f6e673e2c266e6273703b3c7374726f6e673e68616e646c65733c2f7374726f6e673e266e6273703b616e64266e6273703b3c7374726f6e673e70726f63657373657320646174613c2f7374726f6e673e266e6273703b6f662069747320637573746f6d65727320616e642076697369746f72732e204974206578706c696369746c79206465736372696265732077686574686572207468617420696e666f726d6174696f6e206973206b65707420636f6e666964656e7469616c2c206f72206973207368617265642077697468206f7220736f6c6420746f20746869726420706172746965732e266e6273703b3c2f703e0d0a, 'Company'),
(4, 0, 0x3c703e41205072697661637920506f6c69637920697320612073746174656d656e74206f722061206c6567616c20646f63756d656e7420746861742073746174657320686f77206120636f6d70616e79206f722077656273697465266e6273703b3c7374726f6e673e636f6c6c656374733c2f7374726f6e673e2c266e6273703b3c7374726f6e673e68616e646c65733c2f7374726f6e673e266e6273703b616e64266e6273703b3c7374726f6e673e70726f63657373657320646174613c2f7374726f6e673e266e6273703b6f662069747320637573746f6d65727320616e642076697369746f72732e204974206578706c696369746c79206465736372696265732077686574686572207468617420696e666f726d6174696f6e206973206b65707420636f6e666964656e7469616c2c206f72206973207368617265642077697468206f7220736f6c6420746f20746869726420706172746965732e266e6273703b3c2f703e0d0a0d0a3c703e736461646173646164736164736461646173643c2f703e0d0a, 'Admin'),
(7, 0, 0x3c703e736461736461736461643c2f703e0d0a, 'Admin'),
(20, 0, 0x3c703e6867686a79666a6879756667743c2f703e0d0a, 'Admin'),
(21, 0, 0x3c703e626776666b7968673c2f703e0d0a, 'Admin'),
(23, 0, 0x3c703e6866676a6866667662766a6866797566796779683c2f703e0d0a, 'Admin'),
(25, 0, 0x3c703e74797979797979797979793c2f703e0d0a, 'Admin'),
(33, 0, 0x3c703e75693c2f703e0d0a, 'Admin'),
(37, 197, 0x3c703e66787368646866673c2f703e0d0a, 'Company'),
(41, 196, 0x3c703e5072697661637920506f6c6963793c2f703e0d0a, 'Company'),
(43, 0, 0x3c703e436f6d70616e79205072697661637920506f6c6963793c2f703e0d0a, 'Admin'),
(44, 0, 0x3c703e54686973204461746120436f6c6c656374696f6e20616e64205072697661637920506f6c69637920282671756f743b506f6c6963792671756f743b29206f75746c696e6573207468652070726163746963657320616e642070726f636564757265733c6272202f3e0d0a666f6c6c6f776564206279204c7570696e6520546563686e6f6c6f67696573204c696d697465642c207468652070726f7669646572206f662074686520436572627220726964652d6861696c696e67206170706c69636174696f6e3c6272202f3e0d0a282671756f743b4170702671756f743b292c20726567617264696e672074686520636f6c6c656374696f6e2c207573652c2073746f726167652c20616e642070726f74656374696f6e206f66207573657220646174612e204279207573696e67207468652043657262723c6272202f3e0d0a4170702c20796f7520616772656520746f20746865207465726d7320616e6420636f6e646974696f6e732073746174656420696e207468697320506f6c6963792e3c2f703e0d0a0d0a3c703e312e204461746120436f6c6c656374696f6e3a3c2f703e0d0a, 'Admin'),
(45, 0, 0x3c703e41205072697661637920506f6c69637920697320612073746174656d656e74206f722061206c6567616c20646f63756d656e7420746861742073746174657320686f77206120636f6d70616e79206f722077656273697465266e6273703b3c7374726f6e673e636f6c6c656374733c2f7374726f6e673e2c266e6273703b3c7374726f6e673e68616e646c65733c2f7374726f6e673e266e6273703b616e64266e6273703b3c7374726f6e673e70726f63657373657320646174613c2f7374726f6e673e266e6273703b6f662069747320637573746f6d65727320616e642076697369746f72732e204974206578706c696369746c79206465736372696265732077686574686572207468617420696e666f726d6174696f6e206973206b65707420636f6e666964656e7469616c2c206f72206973207368617265642077697468206f7220736f6c6420746f20746869726420706172746965732e266e6273703b3c2f703e0d0a0d0a3c703e41205072697661637920506f6c69637920697320612073746174656d656e74206f722061206c6567616c20646f63756d656e7420746861742073746174657320686f77206120636f6d70616e79206f722077656273697465266e6273703b3c7374726f6e673e636f6c6c656374733c2f7374726f6e673e2c266e6273703b3c7374726f6e673e68616e646c65733c2f7374726f6e673e266e6273703b616e64266e6273703b3c7374726f6e673e70726f63657373657320646174613c2f7374726f6e673e266e6273703b6f662069747320637573746f6d65727320616e642076697369746f72732e204974206578706c696369746c79206465736372696265732077686574686572207468617420696e666f726d6174696f6e206973206b65707420636f6e666964656e7469616c2c206f72206973207368617265642077697468206f7220736f6c6420746f20746869726420706172746965732e266e6273703b3c2f703e0d0a, 'Admin'),
(46, 0, 0x3c703e34363534363735727465656565656565656565656565656565656565656565656565656565656565656565656565656565656565656565656565656565656565656565656565656565656565656565656565656565656565653c2f703e0d0a, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driver_terms_condition`
--

CREATE TABLE `tbl_driver_terms_condition` (
  `tid` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `terms_condition` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_driver_terms_condition`
--

INSERT INTO `tbl_driver_terms_condition` (`tid`, `type_id`, `terms_condition`, `type`) VALUES
(31, 0, '<p>Terms &amp; Conditions</p>\r\n', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification_list`
--

CREATE TABLE `tbl_notification_list` (
  `noti_id` int(11) NOT NULL,
  `trip_id` varchar(255) NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(255) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notification_list`
--

INSERT INTO `tbl_notification_list` (`noti_id`, `trip_id`, `user_id`, `driver_id`, `title`, `message`, `date`, `time`, `type`) VALUES
(1, '11', '', '4', 'New Booking Request!', 'Booking #11 successfully placed', '2024-05-30', '12:10 PM', 'System'),
(2, '11', '', '17', 'New Booking Request!', 'Booking #11 successfully placed', '2024-05-30', '12:10 PM', 'System'),
(3, '11', '', '19', 'New Booking Request!', 'Booking #11 successfully placed', '2024-05-30', '12:11 PM', 'System'),
(4, '11', '', '21', 'New Booking Request!', 'Booking #11 successfully placed', '2024-05-30', '12:11 PM', 'System'),
(5, '11', '', '22', 'New Booking Request!', 'Booking #11 successfully placed', '2024-05-30', '12:11 PM', 'System'),
(6, '11', '', '23', 'New Booking Request!', 'Booking #11 successfully placed', '2024-05-30', '12:11 PM', 'System'),
(7, '11', '', '25', 'New Booking Request!', 'Booking #11 successfully placed', '2024-05-30', '12:11 PM', 'System'),
(8, '11', '', '29', 'New Booking Request!', 'Booking #11 successfully placed', '2024-05-30', '12:11 PM', 'System'),
(9, '11', '', '32', 'New Booking Request!', 'Booking #11 successfully placed', '2024-05-30', '12:11 PM', 'System'),
(10, '11', '7', '', 'New booking request', 'Booking #11 successfully placed', '2024-05-30', '12:11 PM', 'System'),
(11, '12', '', '4', 'New Booking Request!', 'Booking #12 successfully placed', '2024-05-30', '12:20 PM', 'System'),
(12, '12', '', '17', 'New Booking Request!', 'Booking #12 successfully placed', '2024-05-30', '12:20 PM', 'System'),
(13, '12', '', '19', 'New Booking Request!', 'Booking #12 successfully placed', '2024-05-30', '12:20 PM', 'System'),
(14, '12', '', '21', 'New Booking Request!', 'Booking #12 successfully placed', '2024-05-30', '12:20 PM', 'System'),
(15, '12', '', '22', 'New Booking Request!', 'Booking #12 successfully placed', '2024-05-30', '12:20 PM', 'System'),
(16, '12', '', '23', 'New Booking Request!', 'Booking #12 successfully placed', '2024-05-30', '12:20 PM', 'System'),
(17, '12', '', '25', 'New Booking Request!', 'Booking #12 successfully placed', '2024-05-30', '12:20 PM', 'System'),
(18, '12', '', '29', 'New Booking Request!', 'Booking #12 successfully placed', '2024-05-30', '12:20 PM', 'System'),
(19, '12', '', '32', 'New Booking Request!', 'Booking #12 successfully placed', '2024-05-30', '12:20 PM', 'System'),
(20, '12', '7', '', 'New booking request', 'Booking #12 successfully placed', '2024-05-30', '12:20 PM', 'System'),
(21, '13', '', '4', 'New Booking Request!', 'Booking #13 successfully placed', '2024-05-30', '12:27 PM', 'System'),
(22, '13', '', '17', 'New Booking Request!', 'Booking #13 successfully placed', '2024-05-30', '12:27 PM', 'System'),
(23, '13', '', '19', 'New Booking Request!', 'Booking #13 successfully placed', '2024-05-30', '12:27 PM', 'System'),
(24, '13', '', '21', 'New Booking Request!', 'Booking #13 successfully placed', '2024-05-30', '12:27 PM', 'System'),
(25, '13', '', '22', 'New Booking Request!', 'Booking #13 successfully placed', '2024-05-30', '12:27 PM', 'System'),
(26, '13', '', '23', 'New Booking Request!', 'Booking #13 successfully placed', '2024-05-30', '12:27 PM', 'System'),
(27, '13', '', '25', 'New Booking Request!', 'Booking #13 successfully placed', '2024-05-30', '12:27 PM', 'System'),
(28, '13', '', '29', 'New Booking Request!', 'Booking #13 successfully placed', '2024-05-30', '12:27 PM', 'System'),
(29, '13', '', '32', 'New Booking Request!', 'Booking #13 successfully placed', '2024-05-30', '12:27 PM', 'System'),
(30, '13', '7', '', 'New booking request', 'Booking #13 successfully placed', '2024-05-30', '12:27 PM', 'System'),
(31, '14', '', '4', 'New Booking Request!', 'Booking #14 successfully placed', '2024-05-30', '12:36 PM', 'System'),
(32, '14', '', '17', 'New Booking Request!', 'Booking #14 successfully placed', '2024-05-30', '12:36 PM', 'System'),
(33, '14', '', '19', 'New Booking Request!', 'Booking #14 successfully placed', '2024-05-30', '12:36 PM', 'System'),
(34, '14', '', '21', 'New Booking Request!', 'Booking #14 successfully placed', '2024-05-30', '12:36 PM', 'System'),
(35, '14', '', '22', 'New Booking Request!', 'Booking #14 successfully placed', '2024-05-30', '12:36 PM', 'System'),
(36, '14', '', '23', 'New Booking Request!', 'Booking #14 successfully placed', '2024-05-30', '12:36 PM', 'System'),
(37, '14', '', '25', 'New Booking Request!', 'Booking #14 successfully placed', '2024-05-30', '12:36 PM', 'System'),
(38, '14', '', '29', 'New Booking Request!', 'Booking #14 successfully placed', '2024-05-30', '12:36 PM', 'System'),
(39, '14', '', '32', 'New Booking Request!', 'Booking #14 successfully placed', '2024-05-30', '12:36 PM', 'System'),
(40, '14', '7', '', 'New booking request', 'Booking #14 successfully placed', '2024-05-30', '12:36 PM', 'System'),
(41, '15', '', '4', 'New Booking Request!', 'Booking #15 successfully placed', '2024-05-30', '12:51 PM', 'System'),
(42, '15', '', '17', 'New Booking Request!', 'Booking #15 successfully placed', '2024-05-30', '12:51 PM', 'System'),
(43, '15', '', '19', 'New Booking Request!', 'Booking #15 successfully placed', '2024-05-30', '12:51 PM', 'System'),
(44, '15', '', '21', 'New Booking Request!', 'Booking #15 successfully placed', '2024-05-30', '12:51 PM', 'System'),
(45, '15', '', '22', 'New Booking Request!', 'Booking #15 successfully placed', '2024-05-30', '12:51 PM', 'System'),
(46, '15', '', '23', 'New Booking Request!', 'Booking #15 successfully placed', '2024-05-30', '12:51 PM', 'System'),
(47, '15', '', '25', 'New Booking Request!', 'Booking #15 successfully placed', '2024-05-30', '12:51 PM', 'System'),
(48, '15', '', '29', 'New Booking Request!', 'Booking #15 successfully placed', '2024-05-30', '12:51 PM', 'System'),
(49, '15', '', '32', 'New Booking Request!', 'Booking #15 successfully placed', '2024-05-30', '12:51 PM', 'System'),
(50, '15', '7', '', 'New booking request', 'Booking #15 successfully placed', '2024-05-30', '12:51 PM', 'System'),
(51, '16', '', '4', 'New Booking Request!', 'Booking #16 successfully placed', '2024-05-30', '12:53 PM', 'System'),
(52, '16', '', '17', 'New Booking Request!', 'Booking #16 successfully placed', '2024-05-30', '12:53 PM', 'System'),
(53, '16', '', '19', 'New Booking Request!', 'Booking #16 successfully placed', '2024-05-30', '12:53 PM', 'System'),
(54, '16', '', '21', 'New Booking Request!', 'Booking #16 successfully placed', '2024-05-30', '12:53 PM', 'System'),
(55, '16', '', '22', 'New Booking Request!', 'Booking #16 successfully placed', '2024-05-30', '12:53 PM', 'System'),
(56, '16', '', '23', 'New Booking Request!', 'Booking #16 successfully placed', '2024-05-30', '12:53 PM', 'System'),
(57, '16', '', '25', 'New Booking Request!', 'Booking #16 successfully placed', '2024-05-30', '12:53 PM', 'System'),
(58, '16', '', '29', 'New Booking Request!', 'Booking #16 successfully placed', '2024-05-30', '12:53 PM', 'System'),
(59, '16', '', '32', 'New Booking Request!', 'Booking #16 successfully placed', '2024-05-30', '12:53 PM', 'System'),
(60, '16', '7', '', 'New booking request', 'Booking #16 successfully placed', '2024-05-30', '12:53 PM', 'System'),
(61, '17', '', '17', 'New Booking Request!', 'Booking #17 successfully placed', '2024-05-30', '12:57 PM', 'System'),
(62, '17', '7', '', 'New booking request', 'Booking #17 successfully placed', '2024-05-30', '12:57 PM', 'System'),
(63, '18', '', '17', 'New Booking Request!', 'Booking #18 successfully placed', '2024-05-30', '12:57 PM', 'System'),
(64, '18', '7', '', 'New booking request', 'Booking #18 successfully placed', '2024-05-30', '12:57 PM', 'System');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package`
--

CREATE TABLE `tbl_package` (
  `id` int(200) NOT NULL,
  `package_name` varchar(200) NOT NULL,
  `capacity` varchar(200) NOT NULL,
  `image` varchar(500) NOT NULL,
  `size` varchar(255) NOT NULL,
  `service_charge` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_package`
--

INSERT INTO `tbl_package` (`id`, `package_name`, `capacity`, `image`, `size`, `service_charge`, `status`) VALUES
(43, 'Extra extra large', '25', 'zEjH2tsniC_1710983062.jpg', '50', '', 'Approve'),
(26, 'Mini', '20', 'Gj9BuqC2p0_1707220663.jpg', '20X20', '200', 'Approve'),
(27, 'Small', '40', 'Gj9BuqC2p0_1707220663.jpg', '40X40', '300', 'Approve'),
(33, 'Large', '60', 'Gj9BuqC2p0_1707220663.jpg', '60X60', '400', 'Approve'),
(34, 'Extra Large', '100', 'Gj9BuqC2p0_1707220663.jpg', '100X100', '500', 'Approve');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `rate_id` int(200) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `driver_id` varchar(200) NOT NULL,
  `booking_id` varchar(200) NOT NULL,
  `u_feedback_to_driver` text CHARACTER SET utf8 NOT NULL,
  `d_feedback_to_user` text CHARACTER SET utf8 NOT NULL,
  `user_rated` varchar(255) NOT NULL,
  `driver_rated` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(215) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rating`
--

INSERT INTO `tbl_rating` (`rate_id`, `company_id`, `user_id`, `driver_id`, `booking_id`, `u_feedback_to_driver`, `d_feedback_to_user`, `user_rated`, `driver_rated`, `date`, `time`) VALUES
(1, 0, '1', '4', '7', 'good thisk', '', '', '4.0', '2024-03-16', '05:01 PM'),
(2, 0, '1', '4', '11', 'good raja ram', '', '', '3.0', '2024-03-16', '06:42 PM'),
(3, 0, '4', '23', '52', '', '', '', '5.0', '2024-03-21', '04:34 PM'),
(4, 0, '4', '23', '56', 'fast delivery', '', '', '4.0', '2024-03-21', '05:12 PM'),
(5, 0, '4', '23', '56', '', '', '', '2.0', '2024-03-22', '01:20 PM'),
(6, 0, '4', '23', '56', 'jji', '', '', '4.0', '2024-03-22', '04:13 PM'),
(7, 0, '4', '23', '56', 'iii', '', '', '3.0', '2024-03-22', '04:13 PM'),
(8, 0, '1', '4', '11', 'ds', '', '', '2.0', '2024-03-22', '04:22 PM'),
(9, 0, '1', '4', '11', 'dffdfdf', '', '', '4.0', '2024-03-22', '04:27 PM'),
(10, 0, '1', '4', '11', 's', '', '', '3.0', '2024-03-22', '04:29 PM'),
(11, 0, '1', '4', '11', 'dsd', '', '', '4.0', '2024-03-22', '04:29 PM'),
(12, 0, '1', '4', '11', 'dfd', '', '', '4.0', '2024-03-22', '04:30 PM'),
(13, 0, '4', '23', '56', '', '', '', '4.0', '2024-03-22', '05:58 PM'),
(14, 0, '4', '', '57', '', '', '', '5.0', '2024-03-28', '12:32 PM'),
(15, 0, '16', '', '90', '', '', '', '5.0', '2024-04-10', '11:27 AM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_terms_condition`
--

CREATE TABLE `tbl_terms_condition` (
  `term_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `terms_condition` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_terms_condition`
--

INSERT INTO `tbl_terms_condition` (`term_id`, `type_id`, `type`, `terms_condition`) VALUES
(68, 0, 'Admin', '<p>User T&amp;C&nbsp;</p>\r\n\r\n<p>Terms and Conditions (T&amp;C) for a delivery app outline the rules and agreements between the app provider and the users/customers who utilize the app&#39;s services. Here&#39;s an explanation of the key elements typically found in T&amp;C for a delivery app:</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p><strong>Service Description:</strong> This section describes what the delivery app offers, such as providing a platform for users to request and receive delivery services for various items. It sets the expectations for users regarding the app&#39;s functionalities.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>User Eligibility:</strong> The T&amp;C will specify who is eligible to use the app, usually stating that users must be of legal age (18 years or older) in their jurisdiction to use the service.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Account Creation:</strong> Users may need to create an account to access the full features of the app. This section outlines the responsibilities of users in creating and maintaining their accounts, including keeping their login credentials secure.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Service Fees:</strong> If the delivery app charges fees for its services, this section will explain how and when these fees are applied. It may also include details about payment methods accepted by the app.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Delivery Guidelines:</strong> Users are typically required to provide specific details when requesting deliveries, such as pickup/drop-off locations, item descriptions, and any special instructions. This section ensures that users understand the information they need to provide for successful deliveries.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Delivery Agents:</strong> Some delivery apps connect users with independent delivery agents or drivers. The T&amp;C will clarify the relationship between the app provider, users, and delivery agents, including responsibilities, liabilities, and dispute resolution mechanisms.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>User Conduct:</strong> This section outlines the expected behavior of users while using the app. It prohibits illegal, fraudulent, abusive, or discriminatory actions and may include penalties or account suspension for violating these terms.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Intellectual Property:</strong> The app provider&#39;s ownership of intellectual property rights, such as logos, text, graphics, and software, is stated here. Users are typically prohibited from using, reproducing, or modifying these elements without permission.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Privacy Policy:</strong> Users&#39; privacy rights and the app&#39;s data collection, use, and protection practices are explained in the privacy policy section. Users are required to agree to the privacy policy when using the app.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Disclaimer of Liability:</strong> This section limits the app provider&#39;s liability for certain issues, such as delays, damages, or losses during deliveries, unless such limitations are prohibited by law. It helps protect the app provider from legal claims.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Modification of Terms:</strong> The app provider reserves the right to update or modify the T&amp;C at any time. Users are usually notified of changes, and continued use of the app implies acceptance of the revised terms.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Governing Law:</strong> The T&amp;C specifies the jurisdiction and laws that govern the agreement between the app provider and users. It also outlines the process for resolving disputes through appropriate legal channels.</p>\r\n	</li>\r\n</ol>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_card`
--

CREATE TABLE `tbl_user_card` (
  `card_id` int(11) NOT NULL,
  `customer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exp_month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exp_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_card`
--

INSERT INTO `tbl_user_card` (`card_id`, `customer_id`, `payment_method_id`, `card_number`, `exp_month`, `exp_year`) VALUES
(5, 'cus_PqRKlgohr4mS3b', 'pm_1P16F0Ihs7ZBuE9xqLgTwOou', '4444', '12', '2028'),
(6, 'cus_PqRKlgohr4mS3b', 'pm_1P177PIhs7ZBuE9xB22OYd9q', '4242', '4', '2026'),
(7, 'cus_PqRKlgohr4mS3b', 'pm_1P17NEIhs7ZBuE9xQKmoHnpW', '5100', '12', '2028'),
(10, 'cus_PqRKlgohr4mS3b', 'pm_1P1SHBIhs7ZBuE9xQIYcub1e', '0004', '12', '2029'),
(12, 'cus_PqRKlgohr4mS3b', 'pm_1P1Sh9Ihs7ZBuE9xtcQKBFvx', '4242', '12', '2045'),
(13, 'cus_PqRKlgohr4mS3b', 'pm_1P1SrgIhs7ZBuE9xMYBZ3f9R', '4242', '2', '2052'),
(14, 'cus_PqRKlgohr4mS3b', 'pm_1P1SsaIhs7ZBuE9xe6rfhJne', '4242', '4', '2026'),
(16, 'cus_PqRKlgohr4mS3b', 'pm_1P1T39Ihs7ZBuE9xlhdGSG8h', '4242', '4', '2029'),
(17, 'cus_PqRKlgohr4mS3b', 'pm_1P1TCwIhs7ZBuE9xkDLeRWjH', '4242', '4', '2025'),
(18, 'cus_PqRKlgohr4mS3b', 'pm_1P1TNzIhs7ZBuE9xqtnjx3gn', '4242', '4', '2055'),
(19, 'cus_PqRKlgohr4mS3b', 'pm_1P1TxYIhs7ZBuE9xEPcsTujq', '4242', '4', '2036'),
(20, 'cus_PqRKlgohr4mS3b', 'pm_1P1U5GIhs7ZBuE9x1PitIhdG', '4242', '4', '2029'),
(21, 'cus_PqRKlgohr4mS3b', 'pm_1P1UA1Ihs7ZBuE9xwe4YkA4s', '4242', '4', '2025'),
(22, 'cus_PqRKlgohr4mS3b', 'pm_1P1UAXIhs7ZBuE9xD24uOShx', '4242', '4', '2055'),
(24, 'cus_PqRKlgohr4mS3b', 'pm_1P1UBWIhs7ZBuE9xVvm4QHnt', '4242', '4', '2059'),
(26, 'cus_PqRKlgohr4mS3b', 'pm_1P1iiyIhs7ZBuE9xlMOJIiWa', '4242', '4', '2029'),
(27, 'cus_PqRKlgohr4mS3b', 'pm_1P1ilCIhs7ZBuE9x6zaNUFiQ', '4242', '4', '2054'),
(28, 'cus_PqRKlgohr4mS3b', 'pm_1P1imVIhs7ZBuE9xDQLJ51uG', '4242', '4', '2025'),
(30, 'cus_PqRKlgohr4mS3b', 'pm_1P1iwyIhs7ZBuE9xEbU5dYgb', '4242', '4', '2029'),
(31, 'cus_PqRKlgohr4mS3b', 'pm_1P1ixpIhs7ZBuE9xsXkUFuf3', '4242', '4', '2029'),
(32, 'cus_PqRKlgohr4mS3b', 'pm_1P1jG4Ihs7ZBuE9x87vXPZ2d', '4242', '4', '2029'),
(33, 'cus_PqRKlgohr4mS3b', 'pm_1P1jayIhs7ZBuE9xb2IGnd02', '4242', '4', '2025'),
(34, 'cus_PqRKlgohr4mS3b', 'pm_1P1jddIhs7ZBuE9xxgdZZcuc', '4242', '4', '2055'),
(35, 'cus_PqRKlgohr4mS3b', 'pm_1P1jeRIhs7ZBuE9xiO8YEOhD', '4242', '4', '2029'),
(37, 'cus_PqRKlgohr4mS3b', 'pm_1P1jxBIhs7ZBuE9xM6pzTWhn', '4242', '4', '2045'),
(38, 'cus_PqRKlgohr4mS3b', 'pm_1P1lPLIhs7ZBuE9x8HmSP0se', '4242', '4', '2029'),
(44, 'cus_PssEdOAHjDXhCW', 'pm_1P3TBJIhs7ZBuE9x8oqkyzeq', '4242', '12', '2025'),
(45, 'cus_PssEdOAHjDXhCW', 'pm_1P3TE2Ihs7ZBuE9xRpZ8SH5H', '1117', '12', '2025'),
(46, 'cus_PssEdOAHjDXhCW', 'pm_1P3W3hIhs7ZBuE9xUt0Vz6J7', '4242', '11', '2029'),
(47, 'cus_PssEdOAHjDXhCW', 'pm_1P3W47Ihs7ZBuE9x9OXEia8M', '4242', '4', '2029'),
(49, 'cus_PvsR1satZTDXuK', 'pm_1P61dXIhs7ZBuE9xi8Pj4Owb', '0341', '12', '2028'),
(50, 'cus_PvsR1satZTDXuK', 'pm_1P61fZIhs7ZBuE9xDJJmGwxK', '2685', '1', '2035'),
(51, 'cus_PvsR1satZTDXuK', 'pm_1P61j3Ihs7ZBuE9xUwPOcw1F', '4242', '12', '2026'),
(52, 'cus_PssEdOAHjDXhCW', 'pm_1P7sUrIhs7ZBuE9x7SOi7GNl', '1117', '12', '2029'),
(53, 'cus_PssEdOAHjDXhCW', 'pm_1P7sVWIhs7ZBuE9xzY0eDcDu', '9424', '12', '2029'),
(54, 'cus_PssEdOAHjDXhCW', 'pm_1P7sXMIhs7ZBuE9xo9aMqsIb', '0505', '12', '2029'),
(55, 'cus_Q1E7wA7hKeZqcS', 'pm_1PBBh8Ihs7ZBuE9xHNd6u24n', '4242', '5', '2029'),
(56, 'cus_Q1E7wA7hKeZqcS', 'pm_1PCfkYIhs7ZBuE9xZk9soJIl', '4242', '12', '2028'),
(57, 'cus_Q1E7wA7hKeZqcS', 'pm_1PCflOIhs7ZBuE9xUEyxIH3A', '4242', '4', '2025'),
(58, 'cus_PvsR1satZTDXuK', 'pm_1PDmhlIhs7ZBuE9xTADf1yIu', '4242', '12', '2025'),
(59, 'cus_Q1E7wA7hKeZqcS', 'pm_1PJTvUIhs7ZBuE9x6GZ5zyUF', '4242', '4', '2029'),
(60, 'cus_Q9svkJHP4JUIMO', 'pm_1PJZEfIhs7ZBuE9xJqXZw5an', '4242', '4', '2036'),
(61, 'cus_QC8mGQrcSVOJSx', 'pm_1PLkWpIhs7ZBuE9xan6i0fYv', '4242', '4', '2029');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_privacy`
--

CREATE TABLE `tbl_user_privacy` (
  `term_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `privacy_policy` blob NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_privacy`
--

INSERT INTO `tbl_user_privacy` (`term_id`, `type_id`, `privacy_policy`, `type`) VALUES
(2, 164, 0x3c703e41205072697661637920506f6c69637920697320612073746174656d656e74206f722061206c6567616c20646f63756d656e7420746861742073746174657320686f77206120636f6d70616e79206f722077656273697465266e6273703b3c7374726f6e673e636f6c6c656374733c2f7374726f6e673e2c266e6273703b3c7374726f6e673e68616e646c65733c2f7374726f6e673e266e6273703b616e64266e6273703b3c7374726f6e673e70726f63657373657320646174613c2f7374726f6e673e266e6273703b6f662069747320637573746f6d65727320616e642076697369746f72732e204974206578706c696369746c79206465736372696265732077686574686572207468617420696e666f726d6174696f6e206973206b65707420636f6e666964656e7469616c2c206f72206973207368617265642077697468206f7220736f6c6420746f20746869726420706172746965732e266e6273703b3c2f703e0d0a, 'Company'),
(28, 0, '', 'Company'),
(29, 196, 0x3c703e79667475797968746768666666666766676664666466646664666466647974753c2f703e0d0a, 'Company'),
(32, 197, 0x3c703e666867676767676767676767676767676767676767643c2f703e0d0a, 'Company'),
(35, 196, 0x3c703e666766673c2f703e0d0a, 'Company'),
(36, 196, 0x3c703e626262626262626262626262626262666766673c2f703e0d0a, 'Company'),
(38, 0, 0x3c703e45666665637469766520446174653a204a616e756172792030312c20323032333c2f703e0d0a0d0a3c703e54686973204461746120436f6c6c656374696f6e20616e64205072697661637920506f6c69637920282671756f743b506f6c6963792671756f743b29206f75746c696e6573207468652070726163746963657320616e642070726f636564757265733c6272202f3e0d0a666f6c6c6f776564206279204c7570696e6520546563686e6f6c6f67696573204c696d697465642c207468652070726f7669646572206f662074686520436572627220726964652d6861696c696e67206170706c69636174696f6e3c6272202f3e0d0a282671756f743b4170702671756f743b292c20726567617264696e672074686520636f6c6c656374696f6e2c207573652c2073746f726167652c20616e642070726f74656374696f6e206f66207573657220646174612e204279207573696e67207468652043657262723c6272202f3e0d0a4170702c20796f7520616772656520746f20746865207465726d7320616e6420636f6e646974696f6e732073746174656420696e207468697320506f6c6963792e3c2f703e0d0a0d0a3c703e312e204461746120436f6c6c656374696f6e3a3c2f703e0d0a0d0a3c703e312e3120506572736f6e616c20496e666f726d6174696f6e3a3c6272202f3e0d0a4c7570696e6520546563686e6f6c6f67696573204c696d6974656420636f6c6c6563747320616e642073746f7265732074686520666f6c6c6f77696e6720706572736f6e616c20696e666f726d6174696f6e207768656e20796f753c6272202f3e0d0a726567697374657220616e6420757365206f7572204365726272204170703a3c6272202f3e0d0a2d204e616d653c6272202f3e0d0a2d20456d61696c20616464726573733c6272202f3e0d0a2d2050686f6e65206e756d6265723c6272202f3e0d0a2d205061796d656e7420696e666f726d6174696f6e3c6272202f3e0d0a2d2050726f66696c6520706963747572653c6272202f3e0d0a2d205472697020686973746f72793c2f703e0d0a0d0a3c703e312e32204c6f636174696f6e20496e666f726d6174696f6e3a3c6272202f3e0d0a546f2070726f766964652074686520726964652d6861696c696e6720736572766963652c204c7570696e6520546563686e6f6c6f67696573204c696d697465642072657175697265732061636365737320746f20796f75723c6272202f3e0d0a646576696365262333393b73206c6f636174696f6e20696e666f726d6174696f6e2e20576520636f6c6c65637420616e642073746f726520796f7572204750532064617461207768656e20796f752075736520746865204365726272204170702c3c6272202f3e0d0a696e636c7564696e6720796f7572207069636b757020616e642064726f702d6f6666206c6f636174696f6e732e3c2f703e0d0a0d0a3c703e312e3320557361676520496e666f726d6174696f6e3a3c6272202f3e0d0a4c7570696e6520546563686e6f6c6f67696573204c696d69746564206d617920636f6c6c65637420616e642073746f726520646174612061626f757420796f757220696e746572616374696f6e2077697468207468652043657262723c6272202f3e0d0a4170702c20696e636c7564696e673a3c6272202f3e0d0a2d2044657669636520696e666f726d6174696f6e2028652e672e2c20646576696365206d6f64656c2c206f7065726174696e672073797374656d293c6272202f3e0d0a2d2041707020757361676520646174612028652e672e2c20747269702064657461696c732c2074696d65206f66207573616765293c6272202f3e0d0a2d204c6f6720646174612028652e672e2c20495020616464726573732c2062726f777365722074797065293c2f703e0d0a0d0a3c703e322e20557365206f6620446174613a3c2f703e0d0a0d0a3c703e322e3120536572766963652050726f766973696f6e3a3c6272202f3e0d0a4c7570696e6520546563686e6f6c6f67696573204c696d6974656420757365732074686520636f6c6c6563746564206461746120746f2070726f7669646520616e6420696d70726f7665206f757220726964652d6861696c696e673c6272202f3e0d0a73657276696365207468726f75676820746865204365726272204170702c20696e636c7564696e673a3c6272202f3e0d0a2d204d61746368696e6720796f752077697468206e656172627920647269766572733c6272202f3e0d0a2d2050726f63657373696e67207061796d656e74733c6272202f3e0d0a2d20436f6d6d756e69636174696e67207769746820796f752061626f757420796f75722074726970733c6272202f3e0d0a2d20416e616c797a696e6720616e6420656e68616e63696e672074686520706572666f726d616e6365206f6620746865204365726272204170703c2f703e0d0a0d0a3c703e322e3220437573746f6d657220537570706f72743a3c6272202f3e0d0a5765206d61792075736520796f757220706572736f6e616c20696e666f726d6174696f6e20746f20726573706f6e6420746f20796f757220696e717569726965732c206164647265737320636f6e6365726e732c20616e643c6272202f3e0d0a70726f7669646520637573746f6d657220737570706f72742072656c6174656420746f20746865204365726272204170702e3c2f703e0d0a0d0a3c703e322e33204d61726b6574696e6720616e642050726f6d6f74696f6e733a3c6272202f3e0d0a4c7570696e6520546563686e6f6c6f67696573204c696d69746564206d61792075736520796f757220656d61696c2061646472657373206f722070686f6e65206e756d62657220746f2073656e6420796f753c6272202f3e0d0a70726f6d6f74696f6e616c206f66666572732c207570646174657320616e642072656c6576616e7420696e666f726d6174696f6e2061626f7574206f757220736572766963657320616e6420706172746e657273686970732e3c2f703e0d0a0d0a3c703e322e34204c6567616c20436f6d706c69616e636520616e64205361666574793a3c6272202f3e0d0a5765206d61792075736520796f757220696e666f726d6174696f6e20746f20636f6d706c792077697468206170706c696361626c65206c6177732c20726567756c6174696f6e732c206f72206c6567616c2070726f63656564696e67732e3c6272202f3e0d0a4164646974696f6e616c6c792c204c7570696e6520546563686e6f6c6f67696573204c696d69746564206d6179207574696c697a65206461746120746f20656e68616e6365207468652073616665747920616e64207365637572697479206f663c6272202f3e0d0a6f757220757365727320616e6420746865204365726272204170702c2073756368206173206d6f6e69746f72696e6720666f72206672617564756c656e74206f7220737573706963696f75732061637469766974792e3c2f703e0d0a0d0a3c703e332e20446174612053686172696e673a3c2f703e0d0a0d0a3c703e332e312053686172696e67207769746820447269766572733a3c6272202f3e0d0a546f20666163696c6974617465207269646520626f6f6b696e67732c204c7570696e6520546563686e6f6c6f67696573204c696d697465642073686172657320796f7572206e616d652c2070726f66696c6520706963747572652c20616e643c6272202f3e0d0a7069636b75702f64726f702d6f6666206c6f636174696f6e2064657461696c7320776974682074686520647269766572732077686f2061636365707420796f75722072696465207265717565737473207468726f756768207468652043657262723c2f703e0d0a0d0a3c703e332e322054686972642d506172747920536572766963652050726f7669646572733a3c6272202f3e0d0a5765206d617920656e6761676520747275737465642074686972642d706172747920736572766963652070726f76696465727320746f2061737369737420757320696e2064656c69766572696e67206f75722073657276696365732c3c6272202f3e0d0a696e636c7564696e67207061796d656e742070726f636573736f72732c20636c6f75642073746f726167652070726f7669646572732c2073656375726974792070726f76696465727320616e6420637573746f6d657220737570706f72743c6272202f3e0d0a736f6674776172652e2054686573652070726f76696465727320686176652061636365737320746f20706572736f6e616c20696e666f726d6174696f6e206f6e6c79206173206e656365737361727920746f20706572666f726d2074686569723c6272202f3e0d0a66756e6374696f6e7320616e64206d7573742061646865726520746f2073747269637420636f6e666964656e7469616c697479206f626c69676174696f6e732e3c2f703e0d0a0d0a3c703e332e33204c6567616c20526571756972656d656e74733a3c6272202f3e0d0a4c7570696e6520546563686e6f6c6f67696573204c696d69746564206d617920646973636c6f736520796f757220696e666f726d6174696f6e20746f20636f6d706c792077697468206c6567616c206f626c69676174696f6e732c3c6272202f3e0d0a726573706f6e6420746f206c617766756c2072657175657374732c20656e666f726365206f757220706f6c69636965732c206f722070726f7465637420746865207269676874732c2070726f70657274792c206f7220736166657479206f663c6272202f3e0d0a4c7570696e6520546563686e6f6c6f67696573204c696d697465642c206f75722075736572732c206f72206f74686572732e3c2f703e0d0a0d0a3c703e342e20446174612053656375726974793a3c2f703e0d0a0d0a3c703e4c7570696e6520546563686e6f6c6f67696573204c696d69746564207072696f726974697a657320746865207365637572697479206f6620796f757220706572736f6e616c20696e666f726d6174696f6e2e2057653c6272202f3e0d0a696d706c656d656e7420726561736f6e61626c6520746563686e6963616c20616e64206f7267616e697a6174696f6e616c206d6561737572657320746f2070726f7465637420616761696e737420756e617574686f72697a65643c6272202f3e0d0a6163636573732c20616c7465726174696f6e2c20646973636c6f737572652c206f72206465737472756374696f6e206f6620646174612e20486f77657665722c206e6f206d6574686f64206f66207472616e736d697373696f6e206f7665723c6272202f3e0d0a74686520696e7465726e6574206f7220656c656374726f6e69632073746f7261676520697320656e746972656c79207365637572652c20616e642077652063616e6e6f742067756172616e746565206162736f6c7574652073656375726974792e3c2f703e0d0a0d0a3c703e352e204461746120526574656e74696f6e3a3c2f703e0d0a0d0a3c703e4c7570696e6520546563686e6f6c6f67696573204c696d697465642072657461696e7320796f757220706572736f6e616c20696e666f726d6174696f6e20666f72206173206c6f6e67206173206e656365737361727920746f2066756c66696c6c3c6272202f3e0d0a74686520707572706f736573206f75746c696e656420696e207468697320506f6c6963792c20756e6c6573732061206c6f6e67657220726574656e74696f6e20706572696f64206973207265717569726564206f72207065726d69747465642062793c6272202f3e0d0a6c61772e3c2f703e0d0a0d0a3c703e362e204368696c6472656e262333393b7320507269766163793a3c2f703e0d0a0d0a3c703e546865204365726272204170702070726f7669646564206279204c7570696e6520546563686e6f6c6f67696573204c696d69746564206973206e6f7420696e74656e64656420666f722075736520627920696e646976696475616c733c6272202f3e0d0a756e6465722074686520616765206f662031382e20576520646f206e6f74206b6e6f77696e676c7920636f6c6c65637420706572736f6e616c20696e666f726d6174696f6e2066726f6d206368696c6472656e2e2049662077653c6272202f3e0d0a6265636f6d652061776172652074686174207765206861766520696e616476657274656e746c7920636f6c6c656374656420696e666f726d6174696f6e2066726f6d2061206368696c642c2077652077696c6c2074616b653c6272202f3e0d0a696d6d65646961746520737465707320746f2064656c657465207468617420696e666f726d6174696f6e2066726f6d206f7572207265636f7264732e3c2f703e0d0a0d0a3c703e372e204368616e67657320746f2074686520506f6c6963793a3c6272202f3e0d0a4c7570696e6520546563686e6f6c6f67696573204c696d69746564206d617920757064617465207468697320506f6c6963792066726f6d2074696d6520746f2074696d6520746f207265666c656374206368616e67657320696e206f75723c6272202f3e0d0a64617461207072616374696365732e2057652077696c6c206e6f7469667920796f75206f6620616e79206d6174657269616c206368616e67657320627920706f7374696e6720746865207570646174656420506f6c696379206f6e207468653c6272202f3e0d0a436572627220417070206f72206279206f74686572206d65616e73206f6620636f6d6d756e69636174696f6e2e20576520656e636f757261676520796f7520746f20726576696577207468697320506f6c6963793c6272202f3e0d0a706572696f646963616c6c7920666f7220746865206d6f73742075702d746f2d6461746520696e666f726d6174696f6e2061626f7574206f7572206461746120636f6c6c656374696f6e20616e642070726976616379207072616374696365732e3c2f703e0d0a, 'Admin'),
(39, 0, 0x3c703e55736572205072697661637920506f6c6963793c2f703e0d0a, 'Admin'),
(40, 0, 0x3c703e4e6f2055736572205072697661637920506f6c6963793c2f703e0d0a, 'Admin'),
(42, 0, 0x3c703e54686973204461746120436f6c6c656374696f6e20616e64205072697661637920506f6c69637920282671756f743b506f6c6963792671756f743b29206f75746c696e6573207468652070726163746963657320616e642070726f636564757265733c6272202f3e0d0a666f6c6c6f776564206279204c7570696e6520546563686e6f6c6f67696573204c696d697465642c207468652070726f7669646572206f662074686520436572627220726964652d6861696c696e67206170706c69636174696f6e3c6272202f3e0d0a282671756f743b4170702671756f743b292c20726567617264696e672074686520636f6c6c656374696f6e2c207573652c2073746f726167652c20616e642070726f74656374696f6e206f66207573657220646174612e204279207573696e67207468652043657262723c6272202f3e0d0a4170702c20796f7520616772656520746f20746865207465726d7320616e6420636f6e646974696f6e732073746174656420696e207468697320506f6c6963792e3c2f703e0d0a0d0a3c703e312e204461746120436f6c6c656374696f6e3a3c2f703e0d0a, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_write_support`
--

CREATE TABLE `tbl_user_write_support` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_user_write_support`
--

INSERT INTO `tbl_user_write_support` (`id`, `user_id`, `driver_id`, `fullname`, `email`, `subject`, `message`, `type`, `date`, `time`) VALUES
(1, 0, 17, 'd1', 'driver1@gmail.com', 'haba', 'vVvavavaba haha yay', 'Driver', '2024-03-18', '01:48 PM'),
(2, 4, 0, 'Bsbsb', 'avi@gmail.com', 'VH', 'gH', 'User', '2024-03-18', '01:49 PM'),
(3, 3, 0, 'Tes', '123@123.com', 'Test Test', 'this is a test', 'User', '2024-03-19', '08:24 AM'),
(4, 4, 0, 'Avii', 'Avii@gmail.Com', 'Sub 1', 'msg hshshsjh', 'User', '2024-03-22', '01:07 PM'),
(5, 0, 23, 'hshsh', 'gsgsg@gmail.com', 'gagsgsggsts', 'yaysgsgsg\n', 'Driver', '2024-03-22', '01:09 PM'),
(6, 0, 23, 'Abhishek', 'abhishek@gmail.com', 'bbvav', 'vvvvcx\n', 'Driver', '2024-03-22', '01:10 PM'),
(7, 4, 0, 'Hhh', 'hhh@gmail.com', 'Hh', 'hhh', 'User', '2024-03-27', '10:50 AM');

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
(4, 17, 7, 'Goa Kk', '315, Mangal Nagar Road, Mangal Nagar, Indore, Madh', '', 'indore', '', '452014', '22.6856603', '75.8596392', 'Dhamnod, Madhya Pradesh, India', '', 'dhamnod', '', '454552', '22.2138885', '75.4723411', '27-05-2024 05:15 PM', '', '', '', 'B', 0, '27-05-2024 05:15 PM', '', 'dryu', '', 0, '3', 0, 'Extra Large', 200.00, 200.00, '0.0', 0, 'Card', 0, 'pi_3PL1zwIhs7ZBuE9x2mK2bZUt', 'pm_1PJZEfIhs7ZBuE9xJqXZw5an', 'Ride_now', 'Out City', '', 'Driver', 'The user did not arrive', '+18085056666', '+15566666666', '', '', '', 0, 0, '', ''),
(5, 0, 9, 'Test Sender', 'Pandhana, Madhya Pradesh 450661, India', '', 'neemkheda', '', '450661', '21.6762056', '76.1551866', 'Pandhana, Madhya Pradesh 450661, India', '', 'neemkheda', '', '450661', '21.6762056', '76.1551866', '29-05-2024 04:48 PM', '', '', '', 'R', 0, '29-05-2024 04:48 PM', '', 'drop-off at front door', '', 0, '1', 0, 'Extra Large', 400.00, 400.00, '0.0', 0, 'Card', 0, 'pi_3PLkWyIhs7ZBuE9x1It6VYcs', 'pm_1PLkWpIhs7ZBuE9xan6i0fYv', 'Ride_now', 'In City', '', '', '', '+12122222222', '+12122222222', '', '', '', 0, 0, '', ''),
(6, 0, 9, 'Test Sender', 'Pandhana, Madhya Pradesh 450661, India', '', 'neemkheda', '', '450661', '21.6762056', '76.1551866', 'Pandhana, Madhya Pradesh 450661, India', '', 'neemkheda', '', '450661', '21.6762056', '76.1551866', '29-05-2024 04:55 PM', '', '', '', 'R', 0, '29-05-2024 04:55 PM', '', 'test notification ', '', 0, '1', 0, 'Large', 200.00, 200.00, '0.0', 0, 'Card', 0, 'pi_3PLkdaIhs7ZBuE9x1rob9YAm', 'pm_1PLkWpIhs7ZBuE9xan6i0fYv', 'Ride_now', 'In City', '', '', '', '+12122122222', '+12122222222', '', '', '', 0, 0, '', ''),
(7, 0, 9, 'Test Sender', 'Pandhana, Madhya Pradesh 450661, India', '', 'neemkheda', '', '450661', '21.6762056', '76.1551866', 'Pandhana, Madhya Pradesh 450661, India', '', 'neemkheda', '', '450661', '21.6762056', '76.1551866', '29-05-2024 04:58 PM', '', '', '', 'R', 0, '29-05-2024 04:58 PM', '', 'test neighborhood ', '', 0, '1', 0, 'Extra Large', 400.00, 400.00, '0.0', 0, 'Card', 0, 'pi_3PLkgcIhs7ZBuE9x2MdGq9cJ', 'pm_1PLkWpIhs7ZBuE9xan6i0fYv', 'Ride_now', 'In City', '', '', '', '+12122222222', '+12122222222', '', '', '', 0, 0, '', ''),
(8, 0, 7, 'Goa Kk', 'Sai Ram Plaza, Mangal Nagar Road, Mangal Nagar, In', '', 'indore', '', '452014', '22.6857147', '75.8595282', 'Dhamnod, Madhya Pradesh, India', '', 'dhamnod', '', '454552', '22.2138885', '75.4723411', '29-05-2024 05:33 PM', '', '', '', 'R', 0, '29-05-2024 05:33 PM', '', ' vvvv', '', 0, '3', 0, 'Extra Large', 200.00, 200.00, '0.0', 0, 'Card', 0, 'pi_3PLlE6Ihs7ZBuE9x1mGCPAaH', 'pm_1PJZEfIhs7ZBuE9xJqXZw5an', 'Ride_now', 'Out City', '', '', '', '+11234567898', '+15255885585', '', '', '', 0, 0, '', ''),
(9, 0, 7, 'Goa Kk', 'Sai Ram Plaza, Mangal Nagar Road, Mangal Nagar, In', '', 'indore', '', '452014', '22.6857098', '75.8595383', 'Dhamnod, Madhya Pradesh, India', '', 'dhamnod', '', '454552', '22.2138885', '75.4723411', '29-05-2024 05:47 PM', '', '', '', 'R', 0, '29-05-2024 05:47 PM', '', 'vbbb', '', 0, '3', 0, 'Extra Large', 200.00, 200.00, '0.0', 0, 'Card', 0, 'pi_3PLlRyIhs7ZBuE9x0JQqhrNn', 'pm_1PJZEfIhs7ZBuE9xJqXZw5an', 'Ride_now', 'Out City', '', '', '', '+15556998855', '+15555888888', '', '', '', 0, 0, '', ''),
(10, 0, 7, 'Goa Kk', 'Sai Ram Plaza, G1-B, Mangal Nagar Road, Vishnu Pur', '', 'indore', '', '452014', '22.6856687', '75.8596577', 'Dhamnod, Madhya Pradesh, India', '', 'dhamnod', '', '454552', '22.2138885', '75.4723411', '30-05-2024 12:09 PM', '', '', '', 'R', 0, '30-05-2024 12:09 PM', '', 'bzbsbzbs', '', 0, '3', 0, 'Extra Large', 200.00, 200.00, '0.0', 0, 'Card', 0, 'pi_3PM2dyIhs7ZBuE9x23PV4NW4', 'pm_1PJZEfIhs7ZBuE9xJqXZw5an', 'Ride_now', 'Out City', '', '', '', '+1+19497979794', '+1+14994944949', '', '', '', 0, 0, '', ''),
(11, 0, 7, 'Goa Kk', 'Sai Ram Plaza, G1-B, Mangal Nagar Road, Vishnu Pur', '', 'indore', '', '452014', '22.6856638', '75.8596721', 'Dhamnod, Madhya Pradesh, India', '', 'dhamnod', '', '454552', '22.2138885', '75.4723411', '30-05-2024 12:10 PM', '', '', '', 'R', 0, '30-05-2024 12:10 PM', '', 'svdvdrbthrbntn', '', 0, '3', 0, 'Extra Large', 200.00, 200.00, '0.0', 0, 'Card', 0, 'pi_3PM2fUIhs7ZBuE9x1urTraOJ', 'pm_1PJZEfIhs7ZBuE9xJqXZw5an', 'Ride_now', 'Out City', '', '', '', '+1+15595955984', '+1+14848495959', '', '', '', 0, 0, '', ''),
(12, 0, 7, 'Goa Kk', 'MVP5+7V4, Mangal Nagar, Indore, Madhya Pradesh 452', '', 'indore', '', '452014', '22.6856578', '75.8596627', 'Dhamnod, Madhya Pradesh, India', '', 'dhamnod', '', '454552', '22.2138885', '75.4723411', '30-05-2024 12:20 PM', '', '', '', 'R', 0, '30-05-2024 12:20 PM', '', '', '', 0, '3', 0, 'Extra Large', 200.00, 200.00, '0.0', 0, 'Card', 0, 'pi_3PM2ouIhs7ZBuE9x0ylV6VgZ', 'pm_1PJZEfIhs7ZBuE9xJqXZw5an', 'Ride_now', 'Out City', '', '', '', '+1+18085059284', '+1+15566668656', '', '', '', 0, 0, '', ''),
(13, 0, 7, 'Goa Kk', 'MVP5+7V4, Mangal Nagar, Indore, Madhya Pradesh 452', '', 'indore', '', '452014', '22.6856596', '75.8596612', 'Dhamnod, Madhya Pradesh, India', '', 'dhamnod', '', '454552', '22.2138885', '75.4723411', '30-05-2024 12:27 PM', '', '', '', 'R', 0, '30-05-2024 12:27 PM', '', 'ghh', '', 0, '3', 0, 'Extra Large', 200.00, 200.00, '0.0', 0, 'Card', 0, 'pi_3PM2vFIhs7ZBuE9x2aSbgnqw', 'pm_1PJZEfIhs7ZBuE9xJqXZw5an', 'Ride_now', 'Out City', '', '', '', '+1+18855525555', '+1+18522555555', '', '', '', 0, 0, '', ''),
(14, 0, 7, 'Goa Kk', 'MVP5+7V4, Mangal Nagar, Indore, Madhya Pradesh 452', '', 'indore', '', '452014', '22.6856586', '75.8596665', 'Dhamnod, Madhya Pradesh, India', '', 'dhamnod', '', '454552', '22.2138885', '75.4723411', '30-05-2024 12:36 PM', '', '', '', 'R', 0, '30-05-2024 12:36 PM', '', 'vvb', '', 0, '3', 0, 'Extra Large', 200.00, 200.00, '0.0', 0, 'Card', 0, 'pi_3PM346Ihs7ZBuE9x288CUMMp', 'pm_1PJZEfIhs7ZBuE9xJqXZw5an', 'Ride_now', 'Out City', '', '', '', '+1+15665533668', '+1+18999855666', '', '', '', 0, 0, '', ''),
(15, 0, 7, 'Goa Kk', 'MVP5+7V4, Mangal Nagar, Indore, Madhya Pradesh 452', '', 'indore', '', '452014', '22.6856586', '75.8596665', 'Dhamnod, Madhya Pradesh, India', '', 'dhamnod', '', '454552', '22.2138885', '75.4723411', '30-05-2024 12:51 PM', '', '', '', 'R', 0, '30-05-2024 12:51 PM', '', '', '', 0, '3', 0, 'Extra Large', 200.00, 200.00, '0.0', 0, 'Card', 0, 'pi_3PM346Ihs7ZBuE9x288CUMMp', 'pm_1PJZEfIhs7ZBuE9xJqXZw5an', 'Ride_now', 'Out City', '', '', '', '+1+15665533668', '+1+18999855666', '', '', '', 0, 0, '', ''),
(16, 0, 7, 'Goa Kk', 'MVP5+7V4, Mangal Nagar, Indore, Madhya Pradesh 452', '', 'indore', '', '452014', '22.6856586', '75.8596665', 'Dhamnod, Madhya Pradesh, India', '', 'dhamnod', '', '454552', '22.2138885', '75.4723411', '30-05-2024 12:53 PM', '', '', '', 'R', 0, '30-05-2024 12:53 PM', '', '', '', 0, '3', 0, 'Extra Large', 200.00, 200.00, '0.0', 0, 'Card', 0, 'pi_3PM346Ihs7ZBuE9x288CUMMp', 'pm_1PJZEfIhs7ZBuE9xJqXZw5an', 'Ride_now', 'Out City', '', '', '', '+1+15665533668', '+1+18999855666', '', '', '', 0, 0, '', ''),
(17, 0, 7, 'Goa Kk', 'MVP5+7V4, Mangal Nagar, Indore, Madhya Pradesh 452', '', 'indore', '', '452014', '22.6856586', '75.8596665', 'Dhamnod, Madhya Pradesh, India', '', 'dhamnod', '', '454552', '22.2138885', '75.4723411', '30-05-2024 12:57 PM', '', '', '', 'R', 0, '30-05-2024 12:57 PM', '', '', '', 0, '3', 0, 'Extra Large', 200.00, 200.00, '0.0', 0, 'Card', 0, 'pi_3PM346Ihs7ZBuE9x288CUMMp', 'pm_1PJZEfIhs7ZBuE9xJqXZw5an', 'Ride_now', 'Out City', '', '', '', '+1+15665533668', '+1+18999855666', '', '', '', 0, 0, '', ''),
(18, 0, 7, 'Goa Kk', 'MVP5+7V4, Mangal Nagar, Indore, Madhya Pradesh 452', '', 'indore', '', '452014', '22.6856586', '75.8596665', 'Dhamnod, Madhya Pradesh, India', '', 'dhamnod', '', '454552', '22.2138885', '75.4723411', '30-05-2024 12:57 PM', '', '', '', 'R', 0, '30-05-2024 12:57 PM', '', '', '', 0, '3', 0, 'Extra Large', 200.00, 200.00, '0.0', 0, 'Card', 0, 'pi_3PM346Ihs7ZBuE9x288CUMMp', 'pm_1PJZEfIhs7ZBuE9xJqXZw5an', 'Ride_now', 'Out City', '', '', '', '+1+15665533668', '+1+18999855666', '', '', '', 0, 0, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `AreaFromTo`
--
ALTER TABLE `AreaFromTo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `RouteID` (`RouteID`);

--
-- Indexes for table `AreaList`
--
ALTER TABLE `AreaList`
  ADD PRIMARY KEY (`AreaID`),
  ADD UNIQUE KEY `AreaName` (`AreaName`);

--
-- Indexes for table `AreaZipCodes`
--
ALTER TABLE `AreaZipCodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `canclebooking`
--
ALTER TABLE `canclebooking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `canclebooking_driver`
--
ALTER TABLE `canclebooking_driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `canclebooking_driver_new`
--
ALTER TABLE `canclebooking_driver_new`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_info`
--
ALTER TABLE `chat_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Drivers`
--
ALTER TABLE `Drivers`
  ADD PRIMARY KEY (`DriverID`);

--
-- Indexes for table `driver_faq`
--
ALTER TABLE `driver_faq`
  ADD PRIMARY KEY (`df_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `inquiry_table`
--
ALTER TABLE `inquiry_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `panding_booking_request_driver`
--
ALTER TABLE `panding_booking_request_driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Senders`
--
ALTER TABLE `Senders`
  ADD PRIMARY KEY (`SenderID`);

--
-- Indexes for table `sys_trip_status`
--
ALTER TABLE `sys_trip_status`
  ADD PRIMARY KEY (`trip_status_id`) USING BTREE;

--
-- Indexes for table `tbl_about_us`
--
ALTER TABLE `tbl_about_us`
  ADD PRIMARY KEY (`about_id`);

--
-- Indexes for table `tbl_cancel_reason`
--
ALTER TABLE `tbl_cancel_reason`
  ADD PRIMARY KEY (`reason_id`);

--
-- Indexes for table `tbl_complain_list`
--
ALTER TABLE `tbl_complain_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_driver_privacy`
--
ALTER TABLE `tbl_driver_privacy`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `tbl_driver_terms_condition`
--
ALTER TABLE `tbl_driver_terms_condition`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `tbl_notification_list`
--
ALTER TABLE `tbl_notification_list`
  ADD PRIMARY KEY (`noti_id`);

--
-- Indexes for table `tbl_package`
--
ALTER TABLE `tbl_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `tbl_terms_condition`
--
ALTER TABLE `tbl_terms_condition`
  ADD PRIMARY KEY (`term_id`);

--
-- Indexes for table `tbl_user_card`
--
ALTER TABLE `tbl_user_card`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `tbl_user_privacy`
--
ALTER TABLE `tbl_user_privacy`
  ADD PRIMARY KEY (`term_id`);

--
-- Indexes for table `tbl_user_write_support`
--
ALTER TABLE `tbl_user_write_support`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `AreaFromTo`
--
ALTER TABLE `AreaFromTo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `AreaList`
--
ALTER TABLE `AreaList`
  MODIFY `AreaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `AreaZipCodes`
--
ALTER TABLE `AreaZipCodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `canclebooking`
--
ALTER TABLE `canclebooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;

--
-- AUTO_INCREMENT for table `canclebooking_driver`
--
ALTER TABLE `canclebooking_driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT for table `canclebooking_driver_new`
--
ALTER TABLE `canclebooking_driver_new`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `chat_info`
--
ALTER TABLE `chat_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `Drivers`
--
ALTER TABLE `Drivers`
  MODIFY `DriverID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `driver_faq`
--
ALTER TABLE `driver_faq`
  MODIFY `df_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `f_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `inquiry_table`
--
ALTER TABLE `inquiry_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `panding_booking_request_driver`
--
ALTER TABLE `panding_booking_request_driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `Senders`
--
ALTER TABLE `Senders`
  MODIFY `SenderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_about_us`
--
ALTER TABLE `tbl_about_us`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_cancel_reason`
--
ALTER TABLE `tbl_cancel_reason`
  MODIFY `reason_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_complain_list`
--
ALTER TABLE `tbl_complain_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_driver_privacy`
--
ALTER TABLE `tbl_driver_privacy`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_driver_terms_condition`
--
ALTER TABLE `tbl_driver_terms_condition`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_notification_list`
--
ALTER TABLE `tbl_notification_list`
  MODIFY `noti_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_package`
--
ALTER TABLE `tbl_package`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `rate_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_terms_condition`
--
ALTER TABLE `tbl_terms_condition`
  MODIFY `term_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_user_card`
--
ALTER TABLE `tbl_user_card`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_user_privacy`
--
ALTER TABLE `tbl_user_privacy`
  MODIFY `term_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_user_write_support`
--
ALTER TABLE `tbl_user_write_support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Trips`
--
ALTER TABLE `Trips`
  MODIFY `TripID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
