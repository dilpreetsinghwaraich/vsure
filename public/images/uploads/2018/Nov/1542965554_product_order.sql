-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2018 at 08:20 PM
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
-- Database: `gkfriend`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `product_order_id` int(11) NOT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT '0',
  `quantity` int(11) DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `billing_address` text,
  `shipping_address` text,
  `customer_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `purchase_details` text,
  `product_package` text,
  `products_details` longtext,
  `amount_status` varchar(255) DEFAULT NULL,
  `order_sub_total` decimal(10,2) DEFAULT NULL,
  `order_tax` decimal(10,2) DEFAULT NULL,
  `order_shipping` decimal(10,2) DEFAULT NULL,
  `coupon_code` varchar(100) DEFAULT NULL,
  `coupon_value` decimal(10,2) DEFAULT NULL,
  `coupon_status` varchar(255) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `grand_total` decimal(10,2) DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`product_order_id`, `order_number`, `user_id`, `employee_id`, `quantity`, `order_status`, `order_date`, `billing_address`, `shipping_address`, `customer_name`, `email`, `phone`, `purchase_details`, `product_package`, `products_details`, `amount_status`, `order_sub_total`, `order_tax`, `order_shipping`, `coupon_code`, `coupon_value`, `coupon_status`, `discount`, `grand_total`, `payment_id`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, '15367741571', 5, 0, 1, 'pending', '2018-09-12', '[]', '[]', 'MISS po p LIMPI PATHAK', '', '9678838136', '{\"_token\":\"sb5rb5Az7frtRsFlXbV5KJ4XCFlThKLoDbjh8WUs\",\"full_name\":\"MISS po p LIMPI PATHAK\",\"last_name\":\"PATHAK\",\"company_name\":\"dsf gsd\",\"email\":\"bhabendra_borah@rediffmail.com\",\"address\":\"LUKHURAKHANIA, P.O-KAZIRANGA, DIST-GOLAGHAT\",\"address2\":\"P.O-KAZIRANGA, DIST-GOLAGHAT\",\"city\":\"Karnal\",\"state\":\"Haryana\",\"postal_code\":\"hvjh\",\"country\":\"IN\",\"mobile_no\":\"9678838136\"}', '{\"639\":{\"qty\":1}}', '[{\"title\":\"MANGAT RAM CHANA DAAL 500GM\",\"slug\":\"mangat-ram-chana-daal\",\"description\":null,\"product_info_id\":639,\"product_id\":639,\"quantity\":30,\"weight\":\"500GM\",\"size\":null,\"color\":null,\"mrp\":\"46.00\",\"regular_price\":\"36.00\",\"discount_price\":null,\"purchase_price\":null,\"wholesale_price\":null,\"baar_code\":\"8906022204674\",\"expiry_date\":null,\"gst\":\"5.00\",\"gst_other\":\"0.00\",\"start_date\":null,\"end_date\":null,\"best_seller\":0,\"featured_product\":1,\"is_product_commission_able\":1,\"image\":{\"image\":\"assets\\/uploads\\/2018\\/Jul\\/1530521733_Baniyan White for Girls (Grade_ 1 to 10) - SFS, Bundgarden.html\"},\"price\":\"36.00\",\"qty\":1,\"total\":36}]', 'razarpay', '36.00', '0.00', '0.00', '', '0.00', '', '0.00', '36.00', '', '', '2018-09-12 23:12:37', '2018-09-12 23:12:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`product_order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `product_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
