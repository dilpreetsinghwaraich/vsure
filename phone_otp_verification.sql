-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2018 at 04:33 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vsure`
--

-- --------------------------------------------------------

--
-- Table structure for table `phone_otp_verification`
--

CREATE TABLE `phone_otp_verification` (
  `otp_id` int(11) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `otp_code` bigint(20) DEFAULT NULL,
  `time` varchar(10) DEFAULT NULL,
  `otp_for` varchar(20) DEFAULT NULL,
  `otp_status` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phone_otp_verification`
--

INSERT INTO `phone_otp_verification` (`otp_id`, `phone`, `otp_code`, `time`, `otp_for`, `otp_status`, `created_at`, `updated_at`) VALUES
(6, '4234234234', 493231, '18:15:19', 'ServiceRequest', 'verify', '2018-12-02 18:16:19', '2018-12-02 18:17:30'),
(8, '9034831201', 771635, '18:24:18', 'ServiceRequest', 'sent', '2018-12-02 18:24:18', '2018-12-02 18:24:18'),
(10, '9034831200', 218686, '18:31:03', 'ServiceRequest', 'verify', '2018-12-02 18:31:03', '2018-12-02 18:31:15'),
(11, '4234234234', 234112, '18:40:31', 'ServiceRequest', 'verify', '2018-12-02 18:40:31', '2018-12-02 18:40:45'),
(12, '4234234234', 279499, '18:43:07', 'ServiceRequest', 'verify', '2018-12-02 18:43:07', '2018-12-02 18:43:20'),
(13, '4234234234', 936368, '18:45:53', 'ServiceRequest', 'verify', '2018-12-02 18:45:53', '2018-12-02 18:46:08'),
(14, '9034831200', 821285, '18:47:35', 'ServiceRequest', 'verify', '2018-12-02 18:47:35', '2018-12-02 18:48:05'),
(15, '42342342356', 547337, '19:45:12', 'ServiceRequest', 'sent', '2018-12-02 19:45:12', '2018-12-02 19:45:12'),
(16, '4234234234', 970083, '19:46:22', 'ServiceRequest', 'verify', '2018-12-02 19:46:22', '2018-12-02 19:46:40'),
(17, '1234567899', 961454, '19:47:40', 'ServiceRequest', 'verify', '2018-12-02 19:47:40', '2018-12-02 19:48:17'),
(18, '9034831255', 291215, '19:49:28', 'ServiceRequest', 'expired', '2018-12-02 19:49:28', '2018-12-02 19:53:41'),
(19, '9034831255', 355666, '19:53:49', 'ServiceRequest', 'verify', '2018-12-02 19:53:49', '2018-12-02 19:55:37'),
(20, '7894561239', 422443, '19:56:30', 'ServiceRequest', 'verify', '2018-12-02 19:56:30', '2018-12-02 19:56:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `phone_otp_verification`
--
ALTER TABLE `phone_otp_verification`
  ADD PRIMARY KEY (`otp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `phone_otp_verification`
--
ALTER TABLE `phone_otp_verification`
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
