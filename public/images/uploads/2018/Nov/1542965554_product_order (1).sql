-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 15, 2018 at 12:25 AM
-- Server version: 5.6.40-84.0-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gkfriend_mlmdemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `product_order_id` int(11) NOT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `uuid` varchar(255) DEFAULT NULL,
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

INSERT INTO `product_order` (`product_order_id`, `order_number`, `user_id`, `uuid`, `employee_id`, `quantity`, `order_status`, `order_date`, `billing_address`, `shipping_address`, `customer_name`, `email`, `phone`, `purchase_details`, `product_package`, `products_details`, `amount_status`, `order_sub_total`, `order_tax`, `order_shipping`, `coupon_code`, `coupon_value`, `coupon_status`, `discount`, `grand_total`, `payment_id`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, '15367741571', 5, NULL, 0, 1, 'pending', '2018-09-12', '[]', '[]', 'MISS po p LIMPI PATHAK', '', '9678838136', '{\"_token\":\"sb5rb5Az7frtRsFlXbV5KJ4XCFlThKLoDbjh8WUs\",\"full_name\":\"MISS po p LIMPI PATHAK\",\"last_name\":\"PATHAK\",\"company_name\":\"dsf gsd\",\"email\":\"bhabendra_borah@rediffmail.com\",\"address\":\"LUKHURAKHANIA, P.O-KAZIRANGA, DIST-GOLAGHAT\",\"address2\":\"P.O-KAZIRANGA, DIST-GOLAGHAT\",\"city\":\"Karnal\",\"state\":\"Haryana\",\"postal_code\":\"hvjh\",\"country\":\"IN\",\"mobile_no\":\"9678838136\"}', '{\"639\":{\"qty\":1}}', '[{\"title\":\"MANGAT RAM CHANA DAAL 500GM\",\"slug\":\"mangat-ram-chana-daal\",\"description\":null,\"product_info_id\":639,\"product_id\":639,\"quantity\":30,\"weight\":\"500GM\",\"size\":null,\"color\":null,\"mrp\":\"46.00\",\"regular_price\":\"36.00\",\"discount_price\":null,\"purchase_price\":null,\"wholesale_price\":null,\"baar_code\":\"8906022204674\",\"expiry_date\":null,\"gst\":\"5.00\",\"gst_other\":\"0.00\",\"start_date\":null,\"end_date\":null,\"best_seller\":0,\"featured_product\":1,\"is_product_commission_able\":1,\"image\":{\"image\":\"assets\\/uploads\\/2018\\/Jul\\/1530521733_Baniyan White for Girls (Grade_ 1 to 10) - SFS, Bundgarden.html\"},\"price\":\"36.00\",\"qty\":1,\"total\":36}]', 'razarpay', '36.00', '0.00', '0.00', '', '0.00', '', '0.00', '36.00', '', '', '2018-09-12 23:12:37', '2018-09-12 23:12:37'),
(2, '15367766032', 5, NULL, 0, 1, 'pending', '2018-09-12', '[]', '[]', 'MISS po p LIMPI PATHAK', '', '9678838136', '{\"_token\":\"H96O7rb9B8VK9iYtprr43hupJaz0J7KS8vzjfN6I\",\"full_name\":\"MISS po p LIMPI PATHAK\",\"last_name\":\"PATHAK\",\"company_name\":\"dsf gsd\",\"email\":\"bhabendra_borah@rediffmail.com\",\"address\":\"LUKHURAKHANIA, P.O-KAZIRANGA, DIST-GOLAGHAT, P.O-KAZIRANGA, DIST-GOLAGHAT\",\"address2\":\"P.O-KAZIRANGA, DIST-GOLAGHAT\",\"city\":\"Karnal\",\"state\":\"Haryana\",\"postal_code\":\"hvjh\",\"country\":\"IN\",\"mobile_no\":\"9678838136\"}', '{\"642\":{\"qty\":1}}', '[{\"title\":\"LICHI JUSE\",\"slug\":\"lichi-juse\",\"description\":\"FRESA\",\"product_info_id\":\"642\",\"product_id\":\"642\",\"quantity\":\"5\",\"weight\":\"2LITER\",\"size\":null,\"color\":null,\"mrp\":null,\"regular_price\":\"120.00\",\"discount_price\":\"95.00\",\"purchase_price\":\"90.00\",\"wholesale_price\":null,\"baar_code\":null,\"expiry_date\":null,\"gst\":\"0.00\",\"gst_other\":\"0.00\",\"start_date\":null,\"end_date\":null,\"best_seller\":\"0\",\"featured_product\":\"1\",\"is_product_commission_able\":\"1\",\"image\":{\"image\":\"assets\\/uploads\\/2018\\/Jul\\/1530524053_1015567-fresca-litchi-juice.jpg\"},\"price\":\"120.00\",\"qty\":1,\"total\":120}]', 'razarpay', '120.00', '0.00', '0.00', '', '0.00', '', '0.00', '120.00', '', '', '2018-09-12 23:53:23', '2018-09-12 23:53:23'),
(3, '15368575533', 5, 'a921630a1eff92ffa651006801a25d5869742fd6', 0, 1, 'pending', '2018-09-13', '[]', '[]', 'gandhi', '', '02341324124', '{\"_token\":\"zJttVjnqw37s2cnckybaVCJ8RVfMEoXSdLr785SO\",\"full_name\":\"gandhi\",\"last_name\":\"PATHAK\",\"company_name\":\"dsf gsd\",\"email\":\"client@gmail.com\",\"address\":\"dummy\",\"address2\":\"P.O-KAZIRANGA, DIST-GOLAGHAT\",\"city\":\"Karnal\",\"state\":\"Haryana\",\"postal_code\":\"1324545\",\"country\":\"IN\",\"mobile_no\":\"02341324124\",\"method\":\"cachondelivery\"}', '{\"567\":{\"qty\":1}}', '[{\"title\":\"CHOCLATE MIXTURE\",\"slug\":\"choclate-mixture\",\"description\":null,\"product_info_id\":\"567\",\"product_id\":\"567\",\"quantity\":\"1\",\"weight\":null,\"size\":null,\"color\":null,\"mrp\":\"40.00\",\"regular_price\":\"25.00\",\"discount_price\":null,\"purchase_price\":null,\"wholesale_price\":null,\"baar_code\":\"90688180\",\"expiry_date\":null,\"gst\":\"18.00\",\"gst_other\":\"0.00\",\"start_date\":null,\"end_date\":null,\"best_seller\":\"0\",\"featured_product\":\"1\",\"is_product_commission_able\":\"1\",\"image\":{\"image\":\"assets\\/uploads\\/2018\\/May\\/1527314623_CHOCLATE-MIXTURE.jpg\"},\"price\":\"25.00\",\"qty\":1,\"total\":25}]', 'cachondelivery', '25.00', '0.00', '0.00', '', '0.00', '', '0.00', '25.00', '', '', '2018-09-13 22:22:33', '2018-09-13 22:22:33'),
(4, '15368575854', 5, '20a45f0dd7079a44b951982eadb9fb1f9322eebd', 0, 1, 'processing', '2018-09-13', '[]', '[]', 'gandhi', '', '02341324124', '{\"_token\":\"zJttVjnqw37s2cnckybaVCJ8RVfMEoXSdLr785SO\",\"full_name\":\"gandhi\",\"last_name\":\"PATHAK\",\"company_name\":\"dsf gsd\",\"email\":\"client@gmail.com\",\"address\":\"dummy\",\"address2\":\"P.O-KAZIRANGA, DIST-GOLAGHAT\",\"city\":\"Karnal\",\"state\":\"Haryana\",\"postal_code\":\"1324545\",\"country\":\"IN\",\"mobile_no\":\"02341324124\",\"method\":\"razarpay\"}', '{\"642\":{\"qty\":1}}', '[{\"title\":\"LICHI JUSE\",\"slug\":\"lichi-juse\",\"description\":\"FRESA\",\"product_info_id\":\"642\",\"product_id\":\"642\",\"quantity\":\"4\",\"weight\":\"2LITER\",\"size\":null,\"color\":null,\"mrp\":null,\"regular_price\":\"120.00\",\"discount_price\":\"95.00\",\"purchase_price\":\"90.00\",\"wholesale_price\":null,\"baar_code\":null,\"expiry_date\":null,\"gst\":\"0.00\",\"gst_other\":\"0.00\",\"start_date\":null,\"end_date\":null,\"best_seller\":\"0\",\"featured_product\":\"1\",\"is_product_commission_able\":\"1\",\"image\":{\"image\":\"assets\\/uploads\\/2018\\/Jul\\/1530524053_1015567-fresca-litchi-juice.jpg\"},\"price\":\"120.00\",\"qty\":1,\"total\":120}]', 'razarpay', '120.00', '0.00', '0.00', '', '0.00', '', '0.00', '120.00', 'pay_AxJx1fipiXMUmP', 'razarpay', '2018-09-13 22:23:05', '2018-09-13 22:23:05'),
(5, '15369398245', 5, 'd0c47e4ff350ba4e656f881750b30925056b658f', 0, 1, 'processing', '2018-09-14', '[]', '[]', 'gandhi', '', '02341324124', '{\"_token\":\"me7PFq4oiJ4GiR3ySTyw3PNGiKFtbvopCNtNhEjA\",\"full_name\":\"gandhi\",\"last_name\":\"PATHAK\",\"company_name\":\"dsf gsd\",\"email\":\"client@gmail.com\",\"address\":\"dummy\",\"address2\":\"P.O-KAZIRANGA, DIST-GOLAGHAT\",\"city\":\"Fatehabad\",\"state\":\"Haryana\",\"postal_code\":\"1324545\",\"country\":\"IN\",\"mobile_no\":\"02341324124\",\"method\":\"razarpay\"}', '{\"761\":{\"qty\":1}}', '[{\"title\":\"MUNGFALI GIRI 500GM\",\"slug\":\"mungfali-giri-500gm\",\"description\":null,\"product_info_id\":\"760\",\"product_id\":\"761\",\"quantity\":\"2\",\"weight\":\"500GM\",\"size\":null,\"color\":null,\"mrp\":\"95.00\",\"regular_price\":\"80.00\",\"discount_price\":null,\"purchase_price\":null,\"wholesale_price\":null,\"baar_code\":\"90688324\",\"expiry_date\":null,\"gst\":\"5.00\",\"gst_other\":\"0.00\",\"start_date\":null,\"end_date\":null,\"best_seller\":\"0\",\"featured_product\":null,\"is_product_commission_able\":\"1\",\"image\":null,\"price\":\"80.00\",\"qty\":1,\"total\":80}]', 'razarpay', '80.00', '0.00', '0.00', '', '0.00', '', '0.00', '80.00', 'pay_AxhIz9bc4TdhtZ', 'razarpay', '2018-09-14 21:13:44', '2018-09-14 21:13:44'),
(6, '15369400376', 5, 'd32c3b013e505da8267cb3a23bec33351802f30d', 0, 1, 'processing', '2018-09-14', '[]', '[]', 'gandhi', '', '02341324124', '{\"_token\":\"me7PFq4oiJ4GiR3ySTyw3PNGiKFtbvopCNtNhEjA\",\"full_name\":\"gandhi\",\"last_name\":\"PATHAK\",\"company_name\":\"dsf gsd\",\"email\":\"client@gmail.com\",\"address\":\"dummy\",\"address2\":\"P.O-KAZIRANGA, DIST-GOLAGHAT\",\"city\":\"Karnal\",\"state\":\"Haryana\",\"postal_code\":\"1324545\",\"country\":\"IN\",\"mobile_no\":\"02341324124\",\"method\":\"razarpay\"}', '{\"761\":{\"qty\":1}}', '[{\"title\":\"MUNGFALI GIRI 500GM\",\"slug\":\"mungfali-giri-500gm\",\"description\":null,\"product_info_id\":\"760\",\"product_id\":\"761\",\"quantity\":\"1\",\"weight\":\"500GM\",\"size\":null,\"color\":null,\"mrp\":\"95.00\",\"regular_price\":\"80.00\",\"discount_price\":null,\"purchase_price\":null,\"wholesale_price\":null,\"baar_code\":\"90688324\",\"expiry_date\":null,\"gst\":\"5.00\",\"gst_other\":\"0.00\",\"start_date\":null,\"end_date\":null,\"best_seller\":\"0\",\"featured_product\":null,\"is_product_commission_able\":\"1\",\"image\":null,\"price\":\"80.00\",\"qty\":1,\"total\":80}]', 'razarpay', '80.00', '0.00', '0.00', '', '0.00', '', '0.00', '80.00', 'pay_AxhMe8FFZ53H4W', 'razarpay', '2018-09-14 21:17:17', '2018-09-14 21:17:17');

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
  MODIFY `product_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
