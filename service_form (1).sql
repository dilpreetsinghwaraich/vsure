-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2018 at 04:29 AM
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
(1, 7, 'Food License Registration', 'a:0:{}', '2018-12-04 13:27:36', '2018-12-04 13:27:36'),
(2, 3, 'LLP Incorporation', 'a:0:{}', '2018-12-04 13:27:57', '2018-12-04 13:27:57');

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
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
