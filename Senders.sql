-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2024 at 05:22 PM
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
(8, 'SEND878836', '', '123456Aa', 'barkha', 'patel', '', '', '', '', '', 'bp@gmail.com', '4565789845', '', '', 'D', '', 0, '', '2024-05-27 00:00:00', '0000-00-00 00:00:00', 'cus_QBJqbzmnmyxzSN', '+1', '', '0', '', '', '', 'Em2Fk7A8jr_1716791913.jpg', '2024-06-01', '', '', 'g31q92ywnf_1716796167.png', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Senders`
--
ALTER TABLE `Senders`
  ADD PRIMARY KEY (`SenderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Senders`
--
ALTER TABLE `Senders`
  MODIFY `SenderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
