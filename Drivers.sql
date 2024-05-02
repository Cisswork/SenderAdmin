-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 01, 2024 at 06:15 PM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.27

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
  `Driver_device_id` varchar(111) NOT NULL,
  `iosDriver_device_id` varchar(111) NOT NULL,
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
(1, '', 'BP', '123456', 'Barkha', 'Patel', '206', 'bhawarkua', 'indore', 'Madhyapardesh', '452001', '76.6544356', '23.68586754', 'barkhapatelciss@gmail.com', '+1', '7889657898', '9854326565', '8545698523', 0, '0', 0, NULL, '2024-02-19 08:02:10', NULL, '', '', '459866', 0x6c706d6f6b30733633345f313731303933333339302e706e67, '', '', '', '', '0', '0', '2024-02-19 01:32:10', '', '', '', '', '', '', '', '', '', ''),
(3, '', 'Naya driver ', '123456', 'driver', 'bhai', '210sai ram plaza ', 'mangal nagar indore ', 'Indore', 'Madhya Pradesh ', '452001', '', '', 'driver1245@gmail.com', '+1', '5886559886', '5965568896', '8966666585', 0, '0', 0, NULL, '2024-02-19 08:03:34', NULL, '', '', 'chjjffhj', 0x6a33416e4246304736395f313730383332393831342e6a7067, '', '', '', '', '0', '', '03/20/2024 07:09:49', '', '', '', '', '', '', 'US', '', '', ''),
(4, '', 'driverbhai', '123456', 'driver', 'bhai', 'sai ram plaza ', 'mangal nagal indore', 'Indore', 'Madhya Pradesh ', '452001', '0', '0', 'driver@gmail.com', '+91', '7889657898', '5588888855', '8866666666', 0, '1', 1, NULL, '2024-02-19 11:16:49', NULL, '', '', '459866', 0x416e386a424871477a395f313730383334313430392e6a7067, '', 'cm5B1nr3QQqPFGSls1IHRj:APA91bH2U69VuzxSmZ-aO71LusRYSX1-X6AZJhvgVa1ORBvNXQPUNn3od7jeNo10f4n1-PfJ3tlxv1gfqf8Ovqud', '', 'Android', '0', '0', '03/20/2024 06:22:56', '', 'CPH1809', 'dde5c5b0-e2da-1f22-b3b4-ff66f898f2e7', '', '2,3', '', 'IN', 'UnAvailable', '0', '2024-03-20 18:23:02 '),
(9, '', 'Driver Ad', '123456Aa', 'ad', 'sharma', 'jhbvghg', 'jgbhjgb', 'jgbhgbv', 'jgkjhg', '878', '', '', 'ad@gmail.com', '+1', '64578677', '4567987655', '76567567575', 0, '0', 0, NULL, '2024-02-22 13:44:13', NULL, '', '', '5498785', 0x6c7a4273787131356e345f313730383630393435332e6a7067, '', '', '', '', '0', '0', '2024-02-22 07:14:13', '', '', '', '', '', '', '', '', '', ''),
(10, '', 'HELLO', '123456789', 'l;jl;j', 'jlkjkl', 'kljkljkljlk', 'kljlkj', 'Bhopal', 'jh', '55877', '', '', '456456@456.com', '+1', '2126669999', '2128888555', '2125559999', 0, '1', 0, NULL, '2024-03-14 00:12:37', NULL, '', '', '123456789', 0x766c42457a6d4431366b5f313731303337353135372e6a7067, '', '', '', '', '0', '0', '2024-03-14 05:42:37', '', '', '', '', '1,2', '', 'US', '', '', ''),
(11, '', 'HELLO', '123456789', 'HELLO', 'HELLO', 'HELLO', 'HELLO', 'Ujjain', 'JHELLO', '258742', '0', '0', '123@123.com', '+1', '2124449696', '2124449696', '2124449696', 0, '0', 0, NULL, '2024-03-14 00:14:46', NULL, '', '', '123456789', 0x6a757642436b3571486f5f313731303337353238362e6a7067, 'BCu28lwHy3_1710375459.jpg', '', '', '', '0', '0', '04/08/2024 07:40:08', '', '', '', '', '1', '', 'US', 'UnAvailable', '0', '2024-03-20 08:44:08 '),
(13, '', 'abc', '123456Aa', 'abc', 'abc', 'gfhyt', 'yuk', 'yuk', 'uio', '7787', '', '', 'abc@gmail.com', '+91', '8787878787', '8787878787', '8787878787', 0, '1', 0, NULL, '2024-03-16 11:59:00', NULL, '', '', '8799', 0x696f7239713544316e705f313731303539303334302e4a504547, 'ljnHzi9vsD_1710590340.jpg', '', '', '', '0', '0', '2024-03-16 05:29:00', '', '', '', '', '', '', '', '', '', ''),
(14, '', 'xyz', '123456Aa', 'xyz', 'xyz', 'Navlakha', 'Navlakha', 'Indore', 'Madhya Pradesh', '452001', '', '', 'xyz@gmail.com', '+91', '9424522338', '9424522338', '9424522338', 0, '1', 0, NULL, '2024-03-16 12:01:33', NULL, '', '', '57657', 0x383241346c6a476d6e7a5f313731303539303439332e6a7067, 'EqGp5F3zC9_1710590493.jpg', '', '', '', '0', '0', '2024-03-16 05:31:33', '', '', '', '', '', '', '', '', '', ''),
(15, '', 'Savitaaa', '123456Aaaaaaaaaaaaaaaaaaa', 'Savitaaa', 'Gangwal', 'ghgfhgf', 'ghfggf', 'gfhhhh', 'gfhhhhhhh', '123456', '', '', 'savitaaa@gmail.com', '+1', '68769789780', '5565655656', '54444444566', 0, '1', 0, NULL, '2024-03-18 06:29:28', NULL, '', '', '45444', 0x72446d374845737534775f313731303734333336382e6a7067, 'nqpuAD275l_1710743368.JPEG', '', '', '', '0', '0', '2024-03-18 11:59:28', '', '', '', '', '', '', '', '', '', ''),
(16, '', 'BG', '123456Aa', 'BG', 'NH', 'indore', 'indore', 'khandwa', 'madhya pradesh', '450001', '', '', 'bpg@gmail.com', '+1', '216578985', '2132654598', '213265898', 0, '0', 0, NULL, '2024-03-18 06:43:28', NULL, '', '', '346547567', 0x304443773976757271375f313731303734343230382e706e67, '598Gkz6qsD_1710744208.png', '', '', '', '0', '0', '2024-03-18 12:13:28', '', '', '', '', '', '', '', '', '', ''),
(17, '', 'Driver', '123456', 'Driver', 'Dr', 'Indore ', 'Dewas', 'Indore', 'Madhya Pradesh ', '452001', '22.6856626', '75.8596471', 'driver1@gmail.com', '+91', '9876543225', '9876345684', '8655588885', 0, '1', 0, NULL, '2024-03-18 07:29:43', NULL, '', '', '123', 0x7436707969416d3875455f313731303934323039322e6a7067, '', 'fdn9lNzzRyORFh_vurCD25:APA91bEe_vRNxTvq_MNmDlPB73G3hFyKniF9FXfGzTeYVD8K544nsey0TdwfUIc3Fp-6UfllELCeQ-z4vk-EN9dY', '', 'Android', '0', '1', '04/30/2024 01:48:07', '', 'moto g04', '43a69c60-2685-1fa0-a66b-3bdbe711f922', '', '3,21', '', 'IN', 'Available', '102.07633972167969', '2024-04-30 15:06:10 '),
(18, '', 'Ankush', '123456', 'Ramesh', 'Sharma', 'jahhaah', 'babab', 'Indore', 'mp', '452001', '22.6856556', '75.8597525', 'ramesh@gmail.com', '+1', '7584643358', '8754236265', '8527413256', 0, '1', 0, NULL, '2024-03-18 09:57:43', NULL, '', '', '123', 0x426a393269757877746c5f313731303735353836332e6a7067, '2qjv791okn_1710756861.jpg', '', '', '', '0', '1', '03/18/2024 04:19:08', '', '', '', '', '', '', 'US', 'Available', '115.50365447998047', '2024-03-18 16:19:09 '),
(19, '', 'Newdriver', '123456', 'Newdriver', 'Driver', 'sairam plaza', 'Mangal nagar ', 'Indore', 'Madhya Pradesh', '452001', '22.6856691', '75.85973', 'newdriver@gmail.com', '+91', '5855699855', '9635888555', '3698111445', 0, '1', 0, NULL, '2024-03-18 10:54:55', NULL, '', '', '123456', 0x6f336b386e36694335315f313731303735393239352e6a7067, '', '', '', '', '0', '0', '03/18/2024 04:48:46', '', '', '', '', '3,2', '', 'IN', 'Available', '329.96783447265625', '2024-03-18 16:48:45 '),
(20, '', 'Lalit', '123456', 'Lalit', 'Patel', 'Navlakha ', 'Mangal Nagar ', 'Indore', 'MP', '452001', '22.6856866', '75.8596581', 'lalit@gmail.com', '+91', '7583816688', '7583816688', '7583816688', 0, '1', 0, NULL, '2024-03-19 07:06:29', NULL, '', '', '123456', 0x4469476d3731337532795f313731303833313938392e6a7067, '', 'eTNPcGv-Swegf2fJOfQrIz:APA91bFvMqYSODVtywSJ0Vogo1W_2Q1O4zKUr-YILFS4UakzYJJDonHDIEMfSpBsWHCNA_BOgvt9jvsb6N_PkYxC', '', 'Android', '0', '1', '03/21/2024 05:25:43', '', 'CPH1809', 'a465c8c0-d568-1f25-9691-7590286d6937', '', '', '', 'IN', 'Available', '248.9341278076172', '2024-03-21 17:26:45 '),
(21, '', 'abc', '123456', 'Tarun', 'Birla', 'Shivaji Vatika', 'Near I bus stop', 'Indore', 'Madhya Pradesh', '452001', '22.6856872', '75.8596598', 'tarun@gmail.com', '+1', '4845691784', '5588888854', '8866666664', 0, '1', 0, NULL, '2024-03-20 06:15:40', NULL, '', '', 'A123', 0x6d354272784143337a705f313731303931353334302e6a7067, '', '', '', '', '0', '0', '03/21/2024 05:25:26', '', '', '', '', '3', '', 'US', 'Available', '62.364131927490234', '2024-03-21 17:25:17 '),
(22, '', 'kakka', '123456', 'hqhag', 'kkkjjj', 'gaga', 'gahah', 'Indore', 'kakka', '452014', '22.6856859', '75.8596536', 'kakka@gmail.com', '+91', '9424522558', '9424522575', '9424522994', 0, '1', 0, NULL, '2024-03-21 08:13:36', NULL, '', '', '1515', 0x6f30416a7736426c38735f313731313030383831362e6a7067, '', '', '', '', '0', '1', '03/21/2024 05:55:49', '', '', '', '', '3,2', '', 'IN', 'Available', '304.61114501953125', '2024-03-21 17:55:50 '),
(23, '', 'Abhishek', '123456', 'Abhishek', 'Gupta', 'Mangal Nagar ', 'Rajiv Gandhi ', 'Indore', 'MP', '452001', '22.6856641', '75.8596711', 'abhishek@gmail.com', '+91', '8527645456', '9635576648', '9578454254', 0, '1', 1, NULL, '2024-03-21 10:36:33', NULL, '', '', '1234', 0x47443275734169746d765f313731313031373339332e6a7067, '', 'cDf_-wEqThm3ZKp0_94phV:APA91bGveE7VQ0WDgfbOQ_TOXCmDE0sQiiWHznAeyZkWZF2SgN8yTA34szEh6zfXMiN3NV_37T5SzbxnezYFF_yc', '', 'Android', '0', '1', '03/22/2024 05:08:06', '', 'Redmi Note 8 Pro', '', '', '3,2', '', 'IN', 'Available', '90.0', '2024-03-28 14:53:00 '),
(24, '', '', '123456', 'vishnu', 'prajapati', 'Indore, Madhya Pradesh, India', 'Indore, Madhya Pradesh, India', 'Bhopal', 'Madhya Pradesh ', '458775', '', '', 'vishnuprajapati1@gmail.com', '+91', '1234567899', '', '', 0, '0', 0, NULL, '2024-04-11 06:33:03', NULL, '', '', '1234567', 0x6c6a334534467a6e31775f313731323831373138332e6a7067, '', 'egesktIPSTqRt1ePMBPXFO:APA91bGyF09zYpZF9OtFmKJWKOGfCp94dR37QDoWFza_nnVevS_J-zwsKo_Pqk2PCGbhwYzB_sOZ2_zoklFYhjcW', '', 'Android', '0', '0', '2024-04-11 12:03:03', '', '', '', '', '21,33', '', 'IN', '', '', ''),
(25, '', '', '123456', 'dheeraj', 'singh', 'Indore, Madhya Pradesh, India', 'Indore, Madhya Pradesh, India', 'Indore', 'mp', '452020', '22.6857222', '75.8595569', 'dheerajkumars430@gmail.com', '+91', '9752115634', '', '', 0, '1', 0, NULL, '2024-04-11 06:44:20', NULL, '', '', 'hhgg', 0x7074763038333145737a5f313731323831373836302e6a7067, '', '', '', '', '0', '0', '04/11/2024 12:20:23', '', '', '', '', '33,1,3,21,11,2,12,Route1', '', 'IN', 'Available', '0.0', '2024-04-11 12:18:50 '),
(26, '', '', '123456', 'vvvvv', 'ggggg', 'Indore, Madhya Pradesh, India', 'gggggg', 'gyyyt', 'ggvggg', '452020', '', '', 'devidbrusli@gmail.com', '+91', '7089612536', '', '', 0, '0', 0, NULL, '2024-04-12 08:10:23', NULL, '', '', '666666', 0x32466d74697a713630355f313731323930393432332e6a7067, '', 'doe1ld01QzK4VRcr22dOep:APA91bEBFqYvBpL8Rx1OsaYeU9FFTEXG2k-kIYbfHEZbge6-5b8PvqwDDWlHxafYdbWdRmJPelmHkGRcQ71ANjXC', '', 'Android', '0', '0', '2024-04-12 01:40:23', '', '', '', '', '1,21,3', '', 'IN', '', '', ''),
(27, '', '', '12345678', 'fhgj', 'jojn', '199 Test Street, Council Bluffs, IA, USA', 'fhh', 'hbh', 'bbb', '255698', '40.7042672', '-73.9563534', '12345@12345.com', '+1', '2122222222', '', '', 0, '0', 0, NULL, '2024-04-17 14:19:18', NULL, '', '', '123', 0x6f754539786b6d3233435f313731333336333535382e706e67, '', 'eBmFgWf_SLitVLs25QfUuB:APA91bFS8NsK500RKYwvRV9I7F6g6-hIgAlLdpWqfPNrE3HOUmiTY4ArBn2o3Co_NZ-UfwKkzPO7DSsr9mCBtBdl', '', 'Android', '0', '1', '04/21/2024 11:20:55', '', 'moto g pure', '', '', '1,21,3,11,2,33,12', '', 'US', 'Available', '0.0', '2024-04-22 10:30:48 '),
(28, '', 'BP', '123456', 'Barkha', 'Patel', '206', 'bhawarkua', 'indore', 'Madhyapardesh', '452001', '76.6544356', '23.68586754', '', '+1', '7889657899', '9854326565', '8545698523', 0, '0', 0, NULL, '2024-04-19 06:01:29', NULL, '', '', '459866', 0x754869467a34727433365f313731333530363438392e706e67, '', '', '', '', '0', '0', '2024-04-19 11:31:29', '', '', '', '', '', '', 'US', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Drivers`
--
ALTER TABLE `Drivers`
  ADD PRIMARY KEY (`DriverID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Drivers`
--
ALTER TABLE `Drivers`
  MODIFY `DriverID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
