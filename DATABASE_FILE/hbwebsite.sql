-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2026 at 01:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hbwebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_pass`) VALUES
(2, 'penghong', '123');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`sr_no`, `booking_id`, `room_name`, `price`, `total_pay`, `room_no`, `user_name`, `phonenum`, `address`) VALUES
(18, 18, '1 King Bed', 190, 190, NULL, 'Menglong', '0129493932', 'Phnom Penh'),
(19, 19, '2 Twin Beds', 70, 70, NULL, 'Menglong', '0129493932', 'Phnom Penh'),
(20, 20, '2 Twin Beds', 70, 140, NULL, 'Menglong', '0129493932', 'Phnom Penh'),
(21, 21, '1 King Bed', 190, 190, '1', 'Menglong', '0129493932', 'Phnom Penh'),
(22, 22, '2 Twin Beds', 70, 70, '2', 'Menglong', '0129493932', 'Phnom Penh'),
(23, 23, 'Deluxe Double Room', 70, 70, '3', 'Menglong', '0129493932', 'Phnom Penh'),
(24, 24, 'Deluxe Twin Room', 100, 100, '4', 'Menglong', '0129493932', 'Phnom Penh'),
(25, 25, 'Residence Suite', 50, 50, '5', 'Menglong', '0129493932', 'Phnom Penh'),
(26, 26, 'Deluxe Double Room', 70, 70, NULL, 'Menglong', '0129493932', 'Phnom Penh'),
(27, 27, '2 Twin Beds with Garden View', 170, 170, NULL, 'Menglong', '0129493932', 'Phnom Penh'),
(28, 28, 'Deluxe Double Room', 70, 560, NULL, 'Menglong', '0129493932', 'Phnom Penh'),
(29, 29, 'Deluxe Triple Room', 150, 150, '1', 'Menglong', '0129493932', 'Phnom Penh'),
(30, 30, 'Residence Suite', 50, 50, '1', 'Penghong', '011111111', 'Siemreap'),
(31, 31, 'Family Suite Room', 1000, 1000, NULL, 'Penghong', '011111111', 'Siemreap'),
(32, 32, '1 King Bed', 190, 380, NULL, 'Penghong', '011111111', 'Siemreap'),
(33, 33, '2 Twin Beds', 70, 70, '2', 'Penghong', '011111111', 'Siemreap'),
(34, 34, '2 Twin Beds with Garden View', 170, 170, '3', 'Penghong', '011111111', 'Siemreap'),
(35, 35, 'Deluxe Double Room', 70, 140, '3', 'Penghong', '011111111', 'Siemreap'),
(36, 36, '2 Twin Beds', 70, 140, NULL, 'Penghong', '011111111', 'Siemreap'),
(37, 37, '1 King Bed', 190, 1520, '4', 'David', '012345678', 'SIEMREAP'),
(38, 38, '1 King Bed', 190, 190, '1', 'David', '012345678', 'SIEMREAP'),
(39, 39, 'Deluxe Triple Room', 150, 1050, NULL, 'David', '012345678', 'SIEMREAP'),
(40, 40, '1 King Bed', 190, 190, NULL, 'David', '012345678', 'SIEMREAP'),
(41, 41, '2 Twin Beds', 70, 140, '4', 'Zavong', '012345098', 'Russia'),
(42, 42, 'Family Suite Room', 1000, 10000, NULL, 'Zavong', '012345098', 'Russia'),
(43, 43, '2 Twin Beds', 70, 1330, NULL, 'Zavong', '012345098', 'Russia'),
(44, 44, 'Deluxe Triple Room', 150, 1350, NULL, 'Zavong', '012345098', 'Russia'),
(45, 45, '2 Twin Beds with Garden View', 170, 510, NULL, 'Zavong', '012345098', 'Russia'),
(46, 46, 'Residence Suite', 50, 250, NULL, 'Zavong', '012345098', 'Russia'),
(47, 47, 'Deluxe Triple Room', 150, 1800, NULL, 'Zavong', '012345098', 'Russia'),
(48, 48, '1 King Bed', 190, 3230, NULL, 'Zavong', '012345098', 'Russia'),
(49, 49, '1 King Bed', 190, 1330, NULL, 'Penghong', '011111111', 'Siemreap'),
(50, 50, 'Deluxe Twin Room', 100, 600, NULL, 'Penghong', '011111111', 'Siemreap'),
(51, 51, '1 King Bed', 190, 1330, NULL, 'Menglong', '0129493932', 'Phnom Penh'),
(52, 52, '2 Twin Beds with Garden View', 170, 170, NULL, 'Penghong', '011111111', 'Siemreap'),
(53, 53, '2 Twin Beds with Garden View', 170, 340, NULL, 'Penghong', '011111111', 'Siemreap'),
(54, 54, '2 Twin Beds with Garden View', 170, 1190, NULL, 'Penghong', '011111111', 'Siemreap'),
(55, 55, '2 Twin Beds with Garden View', 170, 170, NULL, 'Penghong', '011111111', 'Siemreap');

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `arrival` int(11) NOT NULL DEFAULT 0,
  `refund` int(11) DEFAULT NULL,
  `booking_status` varchar(100) NOT NULL DEFAULT 'pending',
  `order_id` varchar(150) NOT NULL,
  `trans_id` varchar(200) DEFAULT NULL,
  `trans_amt` int(11) NOT NULL,
  `trans_status` varchar(100) NOT NULL DEFAULT 'pending',
  `trans_resp_msg` varchar(200) DEFAULT NULL,
  `rate_review` int(11) DEFAULT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `room_id`, `check_in`, `check_out`, `arrival`, `refund`, `booking_status`, `order_id`, `trans_id`, `trans_amt`, `trans_status`, `trans_resp_msg`, `rate_review`, `datentime`) VALUES
(18, 7, 14, '2026-03-05', '2026-03-06', 0, NULL, 'pending', 'ORD_77755945', NULL, 190, 'pending', NULL, NULL, '2026-03-05 17:00:17'),
(19, 7, 15, '2026-03-08', '2026-03-09', 0, NULL, 'pending', 'ORD_78835086', NULL, 70, 'pending', NULL, NULL, '2026-03-08 21:15:20'),
(20, 7, 15, '2026-03-08', '2026-03-10', 0, NULL, 'payment failed', 'ORD_73773900', 'DEMO_FAIL_1772979345', 140, 'TXN_FAILURE', 'Demo payment failed (simulated)', NULL, '2026-03-08 21:15:38'),
(21, 7, 14, '2026-03-08', '2026-03-09', 1, NULL, 'booked', 'ORD_72668180', 'DEMO_TXN_1772979491', 190, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', 1, '2026-03-08 21:18:09'),
(22, 7, 15, '2026-03-08', '2026-03-09', 1, NULL, 'booked', 'ORD_73372823', 'DEMO_TXN_1772980108', 70, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', 1, '2026-03-08 21:28:25'),
(23, 7, 8, '2026-03-08', '2026-03-09', 1, NULL, 'booked', 'ORD_71755015', 'DEMO_TXN_1772980196', 70, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', 1, '2026-03-08 21:29:54'),
(24, 7, 9, '2026-03-09', '2026-03-10', 1, NULL, 'booked', 'ORD_74460426', 'DEMO_TXN_1772980261', 100, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', 1, '2026-03-08 21:30:58'),
(25, 7, 11, '2026-03-09', '2026-03-10', 1, NULL, 'booked', 'ORD_79850161', 'DEMO_TXN_1772980301', 50, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', 1, '2026-03-08 21:31:39'),
(26, 7, 8, '2026-03-12', '2026-03-13', 0, NULL, 'pending', 'ORD_75986882', NULL, 70, 'pending', NULL, NULL, '2026-03-11 11:31:19'),
(27, 7, 13, '2026-03-12', '2026-03-13', 0, 0, 'cancelled', 'ORD_78358258', 'DEMO_TXN_1773203987', 170, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', NULL, '2026-03-11 11:39:44'),
(28, 7, 8, '2026-03-13', '2026-03-21', 0, NULL, 'pending', 'ORD_78303039', NULL, 560, 'pending', NULL, NULL, '2026-03-13 08:18:24'),
(29, 7, 10, '2026-03-13', '2026-03-14', 1, NULL, 'booked', 'ORD_75169218', 'DEMO_TXN_1773381717', 150, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', 0, '2026-03-13 13:01:55'),
(30, 6, 11, '2026-03-21', '2026-03-22', 1, NULL, 'booked', 'ORD_65639900', 'DEMO_TXN_1774056607', 50, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', 1, '2026-03-21 08:30:00'),
(31, 6, 12, '2026-03-21', '2026-03-22', 0, 0, 'cancelled', 'ORD_62130310', 'DEMO_TXN_1774056656', 1000, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', NULL, '2026-03-21 08:30:54'),
(32, 6, 14, '2026-03-22', '2026-03-24', 0, 0, 'cancelled', 'ORD_65433571', 'DEMO_TXN_1774056744', 380, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', NULL, '2026-03-21 08:31:27'),
(33, 6, 15, '2026-03-21', '2026-03-22', 1, NULL, 'booked', 'ORD_66732359', 'DEMO_TXN_1774056799', 70, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', 1, '2026-03-21 08:33:16'),
(34, 6, 13, '2026-03-21', '2026-03-22', 1, NULL, 'booked', 'ORD_69904582', 'DEMO_TXN_1774057084', 170, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', 1, '2026-03-21 08:38:01'),
(35, 6, 8, '2026-03-28', '2026-03-30', 1, NULL, 'booked', 'ORD_65761413', 'DEMO_TXN_1774057157', 140, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', 0, '2026-03-21 08:39:07'),
(36, 6, 15, '2026-03-21', '2026-03-23', 0, NULL, 'payment failed', 'ORD_67565111', 'DEMO_FAIL_1774057175', 140, 'TXN_FAILURE', 'Demo payment failed (simulated)', NULL, '2026-03-21 08:39:32'),
(37, 8, 14, '2026-03-22', '2026-03-30', 1, NULL, 'booked', 'ORD_87047975', 'DEMO_TXN_1774057358', 1520, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', 1, '2026-03-21 08:42:27'),
(38, 8, 14, '2026-03-22', '2026-03-23', 1, NULL, 'booked', 'ORD_81283500', 'DEMO_TXN_1774057470', 190, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', 0, '2026-03-21 08:44:26'),
(39, 8, 10, '2026-03-24', '2026-03-31', 0, NULL, 'booked', 'ORD_82347164', 'DEMO_TXN_1774057555', 1050, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', NULL, '2026-03-21 08:45:53'),
(40, 8, 14, '2026-03-22', '2026-03-23', 0, NULL, 'booked', 'ORD_81299182', 'DEMO_TXN_1774057752', 190, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', NULL, '2026-03-21 08:49:09'),
(41, 9, 15, '2026-03-21', '2026-03-23', 1, NULL, 'booked', 'ORD_94236503', 'DEMO_TXN_1774057933', 140, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', 1, '2026-03-21 08:52:10'),
(42, 9, 12, '2026-03-22', '2026-04-01', 0, NULL, 'booked', 'ORD_93761447', 'DEMO_TXN_1774057953', 10000, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', NULL, '2026-03-21 08:52:30'),
(43, 9, 15, '2026-03-21', '2026-04-09', 0, NULL, 'booked', 'ORD_95316449', 'DEMO_TXN_1774057974', 1330, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', NULL, '2026-03-21 08:52:51'),
(44, 9, 10, '2026-03-21', '2026-03-30', 0, 0, 'cancelled', 'ORD_93576906', 'DEMO_TXN_1774057996', 1350, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', NULL, '2026-03-21 08:53:14'),
(45, 9, 13, '2026-04-05', '2026-04-08', 0, 0, 'cancelled', 'ORD_99153700', 'DEMO_TXN_1774058010', 510, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', NULL, '2026-03-21 08:53:28'),
(46, 9, 11, '2026-03-25', '2026-03-30', 0, NULL, 'payment failed', 'ORD_91141408', 'DEMO_FAIL_1774058026', 250, 'TXN_FAILURE', 'Demo payment failed (simulated)', NULL, '2026-03-21 08:53:43'),
(47, 9, 10, '2026-03-26', '2026-04-07', 0, NULL, 'payment failed', 'ORD_91183006', 'DEMO_FAIL_1774058039', 1800, 'TXN_FAILURE', 'Demo payment failed (simulated)', NULL, '2026-03-21 08:53:56'),
(48, 9, 14, '2026-03-21', '2026-04-07', 0, NULL, 'booked', 'ORD_98046782', 'DEMO_TXN_1774058067', 3230, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', NULL, '2026-03-21 08:54:23'),
(49, 6, 14, '2026-04-01', '2026-04-08', 0, NULL, 'booked', 'ORD_61369330', 'DEMO_TXN_1774058898', 1330, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', NULL, '2026-03-21 09:08:05'),
(50, 6, 9, '2026-03-23', '2026-03-29', 0, NULL, 'pending', 'ORD_63831367', NULL, 600, 'pending', NULL, NULL, '2026-03-22 15:58:07'),
(51, 7, 14, '2026-03-25', '2026-04-01', 0, NULL, 'pending', 'ORD_72693610', NULL, 1330, 'pending', NULL, NULL, '2026-03-23 16:41:56'),
(52, 6, 13, '2026-03-23', '2026-03-24', 0, NULL, 'pending', 'ORD_67679759', NULL, 170, 'pending', NULL, NULL, '2026-03-23 16:45:40'),
(53, 6, 13, '2026-03-23', '2026-03-25', 0, NULL, 'pending', 'ORD_67418642', NULL, 340, 'pending', NULL, NULL, '2026-03-23 16:46:51'),
(54, 6, 13, '2026-03-23', '2026-03-30', 0, NULL, 'payment failed', 'ORD_67017378', 'DEMO_FAIL_1774259290', 1190, 'TXN_FAILURE', 'Demo payment failed (simulated)', NULL, '2026-03-23 16:48:00'),
(55, 6, 13, '2026-03-23', '2026-03-24', 0, NULL, 'booked', 'ORD_61774410', 'DEMO_TXN_1774259319', 170, 'TXN_SUCCESS', 'Demo payment successful (no real transaction)', NULL, '2026-03-23 16:48:33');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(4, 'IMG_62045.png'),
(5, 'IMG_93127.png'),
(6, 'IMG_99736.png'),
(8, 'IMG_40905.png'),
(9, 'IMG_55677.png');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` bigint(20) NOT NULL,
  `pn2` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`, `fb`, `insta`, `tw`, `iframe`) VALUES
(1, 'Opposite Angkor High School, Siem Reap Municipalit', 'https://maps.app.goo.gl/y8MLBiDUV1KBNQLd7', 69427730, 69427730, 'bophapalace.rep@bophahotels.com', 'https://www.facebook.com/share/1DQdzXzMjc/?mibextid=wwXIfr', 'https://www.youtube.com/watch?v=xZcRlA3lt6c', 'https://youtu.be/4oS53XSFRzc?si=FqBEDW6pjOnY6kI_', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3224.8876998947007!2d103.86180240970609!3d13.350494886946567!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311017793e991fc3:0x106790c63625b714!2sUniversity of South-East Asia!5e1!3m2!1sen!2skh!4v1772519326237!5m2!1sen!2skh');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(13, 'IMG_43553.svg', 'Wifi', 'Enjoy complimentary high-speed Wi-Fi access in all rooms and public areas, allowing you to stay connected for work, entertainment, and communication anytime during your stay.'),
(14, 'IMG_49949.svg', 'Air conditioner', 'Each room is equipped with a modern air conditioning system to ensure a cool and comfortable environment, no matter the weather outside.'),
(15, 'IMG_41622.svg', 'Television', 'Relax with a flat-screen television offering a variety of local and international channels for your entertainment.'),
(17, 'IMG_47816.svg', 'Spa', 'Rejuvenate your body and mind with our professional spa services, designed to provide relaxation and complete wellness during your stay.'),
(18, 'IMG_96423.svg', 'Room Heater', 'Our rooms include a reliable heating system to keep you warm and comfortable during colder seasons.'),
(19, 'IMG_27079.svg', 'Geyser', 'Enjoy 24/7 hot water supply through our modern geyser system, ensuring a refreshing shower whenever you need it.');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(14, 'balcony'),
(15, 'kitchen'),
(17, 'sofa'),
(18, 'Fresh Flowers'),
(20, 'Luxury 100% Cotton Bed Linen'),
(21, 'A la Carte Mini Bar'),
(22, 'DVD Player (on request)'),
(23, 'Imported Teas'),
(24, 'Make-up Vanity Mirror'),
(25, 'Electronic Bathroom Scales'),
(26, 'Battery Torch'),
(28, 'Coffee making facilities'),
(29, 'Hairdryer'),
(30, 'Nightly turn down service'),
(32, 'Daily Complimentary Water'),
(33, 'Writing Desk Lamp'),
(34, 'Bathrobes and Slippers'),
(35, 'Personal In- Room Safe');

-- --------------------------------------------------------

--
-- Table structure for table `rating_review`
--

CREATE TABLE `rating_review` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(200) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating_review`
--

INSERT INTO `rating_review` (`sr_no`, `booking_id`, `room_id`, `user_id`, `rating`, `review`, `seen`, `datentime`) VALUES
(12, 21, 14, 7, 5, 'Absolutely loved my stay! The room was spotless and well-maintained. The bed was so comfortable I didn&#039;t want to leave. Staff were friendly, helpful, and went above and beyond. Great value for th', 1, '2026-03-08 21:27:19'),
(13, 22, 15, 7, 5, 'One of the best hotel experiences I&#039;ve had. Immaculate room, super comfortable bed, and staff who genuinely care. Worth every penny and then some!', 0, '2026-03-08 21:29:32'),
(14, 23, 8, 7, 4, 'Couldn&#039;t fault a single thing. The room was clean and well-presented, the bed was ultra-comfortable, and the team were friendly and attentive throughout. Great value too!', 0, '2026-03-08 21:30:22'),
(15, 24, 9, 7, 3, 'Exceeded all my expectations! Pristine room, amazing bed quality, and staff who made me feel right at home. Brilliant value for money — highly recommended!', 0, '2026-03-08 21:31:27'),
(16, 25, 11, 7, 2, 'Disappointing stay overall. The room was not as clean as expected and the bed was uncomfortable. Staff were not very helpful and felt the price didn&#039;t match the quality. Wouldn&#039;t rush to ret', 0, '2026-03-08 21:32:19'),
(17, 33, 15, 6, 4, 'Loved the room and the staff, but the restaurant was a bit pricey and slow.', 0, '2026-03-21 08:37:15'),
(18, 30, 11, 6, 5, 'The room smelled awful, sheets were stained, and there were bugs in the bathroom.', 0, '2026-03-21 08:37:29'),
(19, 34, 13, 6, 1, 'The front desk staff was dismissive and unhelpful from the moment we arrived.', 0, '2026-03-21 08:38:46'),
(20, 37, 14, 8, 5, 'Stunning rooms, world-class dining, a breathtaking spa, and service that made us feel like royalty. We&#039;ll be back!', 0, '2026-03-21 08:43:39'),
(21, 41, 15, 9, 1, 'Broken locks on the door, flickering lights, and no response from security when we complained.', 0, '2026-03-21 08:55:52');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`, `removed`) VALUES
(7, 'Deluxe Double Room', 50, 70, 10, 2, 1, 'All our Deluxe double rooms are in the Northern building and span the 1st through 3rd floors.\r\n\r\nEach has a Queen bed with ensuite shower room.\r\n\r\nEach room has a balcony although views vary from Pool view to urban view.\r\n\r\nAll are tastefully decorated with Cambodian artifacts and local crafts.', 1, 1),
(8, 'Deluxe Double Room', 50, 70, 10, 2, 10, 'All our Deluxe double rooms are in the Northern building and span the 1st through 3rd floors.\r\n\r\nEach has a Queen bed with ensuite shower room.\r\n\r\nEach room has a balcony although views vary from Pool view to urban view.\r\n\r\nAll are tastefully decorated with Cambodian artifacts and local crafts.', 1, 0),
(9, 'Deluxe Twin Room', 70, 100, 10, 2, 1, 'All our Deluxe twin rooms are in the Northern building and span the 1st and 2nd floors.\r\n\r\nEach has twin beds with ensuite shower room.\r\n\r\nEach room has a balcony although views vary from Pool view to urban view.\r\n\r\nAll are tastefully decorated with Cambodian artifacts and local crafts.', 1, 0),
(10, 'Deluxe Triple Room', 100, 150, 10, 2, 1, 'Our three Deluxe Triple rooms are on the 1st and 2nd floors.\r\n\r\nEach has a Queen bed and two single beds with ensuite.\r\n\r\nEach has a balcony although views vary.\r\n\r\nAll are tastefully decorated with Cambodian artifacts and local crafts.', 1, 0),
(11, 'Residence Suite', 67, 50, 10, 2, 1, 'Our ten Residence Suites are on the ground floor and provide easy access to the swimming pool.\r\n\r\nAll are wheelchair accessible.\r\n\r\nViews vary from urban view to pool view.\r\n\r\nAll are tastefully decorated with Cambodian artifacts and local crafts.', 1, 0),
(12, 'Family Suite Room', 168, 1000, 10, 2, 1, 'Our five Family suites are located at the East and West ends of the hotel. One can be found on the ground floor with direct pool access whilst the others are on the 1st and 2nd floors overlooking the swimming pool and/or sky bar.\r\n\r\nAll are tastefully decorated with Cambodian artifacts and local crafts.', 1, 0),
(13, '2 Twin Beds with Garden View', 376, 170, 10, 2, 2, 'At 35 sq m (376 sq ft), this twin-bedded room offers a delightful view, a cozy seating area, two plush twin beds and a lavish bathroom with double vanity, an oversized tub and a separate shower.', 1, 0),
(14, '1 King Bed', 376, 190, 10, 2, 1, 'Unwind in 35 sq m (376 sq ft) of space in contemporary Khmer art décor. Pamper yourself in an elegant bathroom in Italian white marble.', 1, 0),
(15, '2 Twin Beds', 376, 70, 10, 2, 1, 'Unwind in a twin-bedded 35 sq m (376 sq ft) space richly appointed in contemporary Khmer art décor. Pamper yourself in an elegant bathroom decked with Italian white marble for your luxury escape in Siem Reap.', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(124, 8, 13),
(125, 8, 14),
(126, 8, 15),
(127, 8, 17),
(128, 8, 18),
(129, 8, 19),
(130, 9, 13),
(131, 9, 14),
(132, 9, 15),
(133, 9, 17),
(134, 9, 18),
(135, 9, 19),
(136, 10, 13),
(137, 10, 14),
(138, 10, 15),
(139, 10, 17),
(140, 10, 18),
(141, 10, 19),
(142, 11, 13),
(143, 11, 14),
(144, 11, 15),
(145, 11, 17),
(146, 11, 18),
(147, 11, 19),
(148, 12, 13),
(149, 12, 14),
(150, 12, 15),
(151, 12, 17),
(152, 12, 18),
(153, 12, 19),
(154, 13, 13),
(155, 13, 14),
(156, 13, 15),
(157, 13, 17),
(158, 13, 18),
(159, 13, 19),
(160, 14, 18),
(161, 15, 13),
(162, 15, 14),
(163, 15, 15),
(164, 15, 18),
(165, 15, 19);

-- --------------------------------------------------------

--
-- Table structure for table `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(124, 8, 14),
(125, 8, 15),
(126, 9, 14),
(127, 9, 15),
(128, 9, 17),
(129, 9, 18),
(130, 9, 20),
(131, 9, 21),
(132, 9, 22),
(133, 9, 23),
(134, 9, 24),
(135, 9, 25),
(136, 9, 26),
(137, 9, 28),
(138, 9, 29),
(139, 9, 30),
(140, 9, 32),
(141, 9, 33),
(142, 9, 34),
(143, 9, 35),
(144, 10, 15),
(145, 10, 17),
(146, 10, 18),
(147, 10, 21),
(148, 10, 25),
(149, 10, 26),
(150, 10, 28),
(151, 10, 30),
(152, 11, 14),
(153, 11, 15),
(154, 11, 17),
(155, 11, 18),
(156, 11, 22),
(157, 12, 14),
(158, 12, 20),
(159, 12, 24),
(160, 12, 29),
(161, 12, 34),
(162, 12, 35),
(163, 13, 14),
(164, 13, 20),
(165, 13, 22),
(166, 13, 24),
(167, 13, 25),
(168, 13, 28),
(169, 13, 29),
(170, 13, 34),
(171, 14, 14),
(172, 14, 20),
(173, 14, 24),
(174, 14, 29),
(175, 15, 14),
(176, 15, 18);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
(34, 8, 'IMG_57299.jpg', 0),
(35, 8, 'IMG_65592.jpg', 0),
(36, 8, 'IMG_64127.jpg', 1),
(37, 8, 'IMG_19247.jpg', 0),
(38, 8, 'IMG_46149.jpg', 0),
(39, 8, 'IMG_12625.jpg', 0),
(40, 8, 'IMG_61236.jpg', 0),
(41, 8, 'IMG_71919.jpg', 0),
(42, 9, 'IMG_60130.jpg', 0),
(43, 9, 'IMG_53273.jpg', 1),
(44, 9, 'IMG_31795.jpg', 0),
(45, 9, 'IMG_39086.jpg', 0),
(46, 10, 'IMG_97253.jpg', 1),
(47, 10, 'IMG_77235.jpg', 0),
(48, 10, 'IMG_55948.jpg', 0),
(49, 10, 'IMG_17065.jpg', 0),
(50, 10, 'IMG_31592.jpg', 0),
(51, 10, 'IMG_68146.jpg', 0),
(52, 10, 'IMG_31281.jpg', 0),
(53, 11, 'IMG_83570.jpg', 0),
(54, 11, 'IMG_30130.jpg', 0),
(55, 11, 'IMG_33751.jpg', 1),
(56, 11, 'IMG_81828.jpg', 0),
(57, 11, 'IMG_93745.jpg', 0),
(58, 11, 'IMG_62513.jpg', 0),
(59, 12, 'IMG_84666.jpg', 0),
(60, 12, 'IMG_32592.jpg', 0),
(61, 12, 'IMG_92213.jpg', 0),
(62, 12, 'IMG_29877.jpg', 1),
(63, 12, 'IMG_70307.jpg', 0),
(64, 12, 'IMG_83376.jpg', 0),
(65, 12, 'IMG_62490.jpg', 0),
(66, 13, 'IMG_71022.webp', 1),
(67, 13, 'IMG_22901.webp', 0),
(68, 13, 'IMG_52512.webp', 0),
(69, 13, 'IMG_54015.webp', 0),
(70, 13, 'IMG_48137.jpg', 0),
(71, 14, 'IMG_14942.webp', 0),
(72, 14, 'IMG_16674.webp', 0),
(73, 14, 'IMG_26223.webp', 0),
(74, 14, 'IMG_93897.webp', 1),
(75, 14, 'IMG_47373.webp', 0),
(76, 15, 'IMG_40182.webp', 0),
(77, 15, 'IMG_69337.webp', 1),
(78, 15, 'IMG_44408.webp', 0),
(79, 15, 'IMG_19774.webp', 0),
(80, 15, 'IMG_53160.webp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(250) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'BOPHA  SR', 'Welcome to BOPHA SR a comfortable and modern hotel located in the heart of Phnom Penh. We provide a relaxing stay for both business and leisure travelers.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team_details`
--

CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_details`
--

INSERT INTO `team_details` (`sr_no`, `name`, `picture`) VALUES
(13, 'Mr.Hong', 'IMG_75831.jpg'),
(14, 'Mr.Long', 'IMG_61800.jpg'),
(15, 'Mr.Rathna', 'IMG_98673.jpg'),
(16, 'Mr.Dawei', 'IMG_92503.jpg'),
(17, 'Mr.Vong', 'IMG_60315.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(120) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(200) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `is_verified`, `token`, `t_expire`, `status`, `datentime`) VALUES
(6, 'Penghong', 'Penghongtesting@gmail.com', 'Siemreap', '011111111', 1111, '2005-10-02', 'IMG_66378.jpeg', '$2y$10$xCQGQsTS51HBssq6zUELh.1AmXcNNNYk8PG6R7F.d54zpk6ciLlQW', 1, NULL, NULL, 1, '2026-03-03 20:52:14'),
(7, 'Menglong', 'Menglongtesting@gmail.com', 'Phnom Penh', '0129493932', 123, '2006-10-02', 'IMG_17779.jpeg', '$2y$10$T.BIKIqR.A51jzLNaoLdgebyqFOa6uwVmkr5OsxsT80XJTSTMimeW', 1, NULL, NULL, 1, '2026-03-04 18:15:27'),
(8, 'David', 'Daweitesting@gmail.com', 'SIEMREAP', '012345678', 1234, '2026-03-03', 'IMG_22423.jpeg', '$2y$10$zuxuWAuez43zxvxAYEphj.BO3GVRAE3vh/lF2meqS4OLebxg3Mp.e', 1, NULL, NULL, 1, '2026-03-04 18:24:00'),
(9, 'Zavong', 'Zavongtesting@gmail.com', 'Russia', '012345098', 1111, '2004-10-04', 'IMG_24062.jpeg', '$2y$10$qd1VdXFy4WcX4KD1n3EFZeZLtF13tr04iIK8eAnEO38.oWHGB6oFC', 1, NULL, NULL, 1, '2026-03-05 07:23:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`sr_no`, `name`, `email`, `subject`, `message`, `datentime`, `seen`) VALUES
(13, 'Chiv Menglong', 'Menglongtesting@gmail.com', 'Booking Inquiry', 'Hello, I would like to check if there are any available rooms from April 10 to April 12. Please let me know the price and room types available. Thank you.', '2026-03-19 07:26:15', 1),
(14, 'Lav Penghong', 'penghong67@gmail.com', 'Reservation Help', 'Hi, I already made a booking but I want to change my check-in date. Can you assist me with this?', '2026-03-19 07:27:26', 1),
(15, 'Savong', 'Savongzinme@gmail.com', 'Payment Issue', 'Hello, I tried to make a payment but it failed. The amount was deducted from my account. Please help me check this issue', '2026-03-19 07:29:45', 0),
(16, 'Dawei', 'Dawei@gmail.com', 'Cancellation Request', 'I would like to cancel my booking due to a change in plans. Please let me know if I can get a refund.', '2026-03-19 07:30:26', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `facilities id` (`facilities_id`),
  ADD KEY `room id` (`room_id`);

--
-- Indexes for table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `features id` (`features_id`),
  ADD KEY `rm id` (`room_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `rating_review`
--
ALTER TABLE `rating_review`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team_details`
--
ALTER TABLE `team_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`);

--
-- Constraints for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`),
  ADD CONSTRAINT `booking_order_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD CONSTRAINT `rating_review_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`),
  ADD CONSTRAINT `rating_review_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `rating_review_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`);

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `rm id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
