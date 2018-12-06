-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2018 at 04:02 PM
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
-- Table structure for table `service_form`
--

CREATE TABLE `service_form` (
  `form_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_title` varchar(500) DEFAULT NULL,
  `form_fields` mediumtext,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_form`
--

INSERT INTO `service_form` (`form_id`, `service_id`, `service_title`, `form_fields`, `created_at`, `updated_at`) VALUES
(4, 2, 'Private Limited Company Incorporation', 'a:5:{i:0;a:2:{s:9:\"tab_title\";s:15:\"My Company Name\";s:5:\"field\";a:2:{i:0;a:1:{s:4:\"text\";a:1:{s:5:\"title\";s:4:\"Name\";}}i:1;a:1:{s:8:\"textarea\";a:1:{s:5:\"title\";s:32:\"Significance of the Company Name\";}}}}i:1;a:2:{s:9:\"tab_title\";s:15:\"Company Details\";s:5:\"field\";a:5:{i:0;a:1:{s:8:\"textarea\";a:1:{s:5:\"title\";s:26:\"Objectives of the Business\";}}i:1;a:1:{s:5:\"email\";a:1:{s:5:\"title\";s:16:\"Company Email ID\";}}i:2;a:1:{s:6:\"number\";a:1:{s:5:\"title\";s:15:\"Paid Up Capital\";}}i:3;a:1:{s:6:\"number\";a:1:{s:5:\"title\";s:20:\"Face Value of Shares\";}}i:4;a:1:{s:6:\"number\";a:1:{s:5:\"title\";s:19:\"Total no. of Shares\";}}}}i:2;a:2:{s:9:\"tab_title\";s:25:\"Registered Office Address\";s:5:\"field\";a:6:{i:0;a:1:{s:6:\"select\";a:2:{s:5:\"title\";s:20:\"Office Building Type\";s:5:\"value\";s:71:\"Rented/ Leased Property^Rented/ Leased Property^Rented/ Leased Property\";}}i:1;a:1:{s:4:\"text\";a:1:{s:5:\"title\";s:19:\"Property Owner Name\";}}i:2;a:1:{s:4:\"text\";a:1:{s:5:\"title\";s:14:\"Address Line 1\";}}i:3;a:1:{s:4:\"text\";a:1:{s:5:\"title\";s:7:\"Pincode\";}}i:4;a:1:{s:4:\"text\";a:1:{s:5:\"title\";s:40:\"Property Owner\'s Signing language in NOC\";}}i:5;a:1:{s:5:\"radio\";a:2:{s:5:\"title\";s:19:\"Total no. of Shares\";s:5:\"value\";s:6:\"Yes^NO\";}}}}i:3;a:2:{s:9:\"tab_title\";s:26:\"Directors and Shareholders\";s:5:\"field\";a:6:{i:1;a:2:{s:6:\"select\";a:2:{s:5:\"title\";s:36:\"Are you a Director or a Shareholder?\";s:5:\"value\";s:71:\"Rented/ Leased Property^Rented/ Leased Property^Rented/ Leased Property\";}s:4:\"text\";a:1:{s:5:\"title\";s:15:\"Name as per PAN\";}}i:2;a:1:{s:4:\"text\";a:1:{s:5:\"title\";s:15:\"Father’s Name\";}}i:3;a:1:{s:6:\"number\";a:1:{s:5:\"title\";s:13:\"Mobile Number\";}}i:4;a:1:{s:5:\"email\";a:1:{s:5:\"title\";s:8:\"Email Id\";}}i:5;a:1:{s:4:\"text\";a:1:{s:5:\"title\";s:13:\"Date of birth\";}}i:6;a:1:{s:5:\"radio\";a:2:{s:5:\"title\";s:11:\"Nationality\";s:5:\"value\";s:23:\"Indian^Foreign National\";}}}}i:4;a:2:{s:9:\"tab_title\";s:16:\"Submit Documents\";s:5:\"field\";a:2:{i:0;a:1:{s:6:\"select\";a:2:{s:5:\"title\";s:40:\"Electricity Bill (Less than 30 days old)\";s:5:\"value\";s:50:\"Electricity Bill^Electricity Bill^Electricity Bill\";}}i:1;a:1:{s:4:\"file\";a:1:{s:5:\"title\";s:14:\"MULTIPLE PAGES\";}}}}}', '2018-12-06 18:08:13', '2018-12-06 18:15:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `service_form`
--
ALTER TABLE `service_form`
  ADD PRIMARY KEY (`form_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `service_form`
--
ALTER TABLE `service_form`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
