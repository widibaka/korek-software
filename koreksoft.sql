-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2020 at 08:03 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koreksoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `link_previewer`
--

CREATE TABLE `link_previewer` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `jenis` varchar(60) NOT NULL,
  `request_remains` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `link_previewer`
--

INSERT INTO `link_previewer` (`id`, `order_id`, `email`, `jenis`, `request_remains`) VALUES
(2, 1, 'free@free', 'public', 990),
(6, 238493, 'widi.udb@gmail.com', 'free', 99),
(8, 238800, 'widi.udb@gmail.com', 'premium', 4990),
(9, 261984, 'widi.udb@gmail.com', 'premium', 5000),
(10, 261984, 'widi.udb@gmail.com', 'premium', 5000),
(11, 365834, 'widicahyo@yahoo.com', 'free', 100),
(12, 474349, 'widi_dwi@fikom.udb.ac.id', 'free', 100);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_id` int(21) NOT NULL,
  `subject` varchar(55) NOT NULL DEFAULT '''''',
  `content` varchar(255) NOT NULL DEFAULT '''''',
  `timestamp` datetime DEFAULT NULL,
  `read` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `user_id`, `subject`, `content`, `timestamp`, `read`) VALUES
(1, 2, 'Order telah dikonfirmasi', 'Premium Code kini telah aktif.', '2020-08-13 00:00:00', 1),
(2, 2, 'Order telah dikonfirmasi2', 'Premium Code kini telah aktif.2', '2020-08-13 00:00:00', 1),
(3, 2, 'Konfirmasi Diterima', 'Selamat! Kode premium Anda sudah aktif.', '2020-08-20 01:33:39', 1),
(4, 3, 'Free Code telah aktif', 'Anda telah mengaktifkan free code', '2020-08-20 02:37:14', 1),
(5, 4, 'Free Code telah aktif', 'Anda telah mengaktifkan free code', '2020-08-20 04:59:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `product_plan_id` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(10) NOT NULL,
  `timestamp` datetime NOT NULL,
  `image` varchar(20) NOT NULL,
  `is_active` int(1) NOT NULL,
  `expire` datetime NOT NULL,
  `cancel` int(11) NOT NULL,
  `premium_code` varchar(255) DEFAULT NULL,
  `free_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `product_plan_id`, `user_id`, `amount`, `timestamp`, `image`, `is_active`, `expire`, `cancel`, `premium_code`, `free_code`) VALUES
(238493, 2, 2, 0, '2020-08-19 19:01:33', '', 1, '2030-08-19 19:01:33', 0, NULL, 'd2lkaS51ZGJAZ21haWwuY29tQHNhcGFyYXRlQDIzODQ5Mw=='),
(238800, 5, 2, 1, '2020-08-19 19:06:40', '2-5-238800.JPG?15978', 1, '2020-11-19 19:08:52', 0, 'd2lkaS51ZGJAZ21haWwuY29tQHNhcGFyYXRlQDIzODgwMA==', NULL),
(261984, 5, 2, 1, '2020-08-20 01:33:04', '', 1, '2020-11-20 01:33:39', 0, 'd2lkaS51ZGJAZ21haWwuY29tQHNhcGFyYXRlQDI2MTk4NA==', NULL),
(365834, 2, 3, 0, '2020-08-20 02:37:14', '', 1, '2030-08-20 02:37:14', 0, NULL, 'd2lkaWNhaHlvQHlhaG9vLmNvbUBzYXBhcmF0ZUAzNjU4MzQ='),
(474349, 2, 4, 0, '2020-08-20 04:59:09', '', 1, '2030-08-20 04:59:09', 0, NULL, 'd2lkaV9kd2lAZmlrb20udWRiLmFjLmlkQHNhcGFyYXRlQDQ3NDM0OQ=='),
(475185, 5, 4, 3, '2020-08-20 05:13:05', '', 0, '0000-00-00 00:00:00', 0, '3@3@4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(56) NOT NULL,
  `ribbon_caption` varchar(20) NOT NULL,
  `link_download` varchar(255) NOT NULL,
  `user_docs` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `description`, `image`, `ribbon_caption`, `link_download`, `user_docs`) VALUES
(2, 'KorekSubs Makina', 'CMS khusus konten anime dibuat menggunakan Codeigniter 3.1', '2-1.jpg', '', '#', '#'),
(3, 'Koreksoft Link Previewer', 'Untuk menanpilkan pratinjau dari link', '1-1.jpg; 1-2.jpg; 1-3.jpg', 'NEW', 'https://github.com/widibaka/', '#');

-- --------------------------------------------------------

--
-- Table structure for table `product_plan`
--

CREATE TABLE `product_plan` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `plan_title` varchar(50) NOT NULL,
  `feature` text NOT NULL,
  `rupiah_price` int(110) NOT NULL,
  `dollar_price` int(11) NOT NULL,
  `in_period` varchar(60) NOT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_plan`
--

INSERT INTO `product_plan` (`id`, `product_id`, `plan_title`, `feature`, `rupiah_price`, `dollar_price`, `in_period`, `color`) VALUES
(1, 3, 'Free', 'No-ads: NO; Request limit: 1000 / day (collective); Could Use The Data: NO', 0, 0, '', 'danger'),
(2, 3, 'Registered User', 'No-ads: YES; Request limit: 100 / day (for each user); Could Use The Data: YES', 155, 0, '', 'gray'),
(5, 3, 'Premium', 'No-ads: YES; Request limit: 5000/day (each user); Could Use The Data: YES', 10000, 1, '3', 'warning');

-- --------------------------------------------------------

--
-- Table structure for table `sidebar`
--

CREATE TABLE `sidebar` (
  `id` int(11) NOT NULL,
  `item` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sidebar`
--

INSERT INTO `sidebar` (`id`, `item`, `url`, `icon`) VALUES
(1, 'Home', 'home', 'fas fa-home'),
(2, 'Products', 'product', 'fas fa-book'),
(4, 'My Orders', 'order', 'fas fa-shopping-cart');

-- --------------------------------------------------------

--
-- Table structure for table `sidebar_admin`
--

CREATE TABLE `sidebar_admin` (
  `id` int(11) NOT NULL,
  `item` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sidebar_admin`
--

INSERT INTO `sidebar_admin` (`id`, `item`, `url`, `icon`) VALUES
(1, 'Home', 'home', 'fas fa-home'),
(2, 'Products', 'admin/product', 'fas fa-book'),
(4, 'Orders', 'admin/order', 'fas fa-shopping-cart');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT '''''',
  `username` varchar(100) NOT NULL DEFAULT '''''',
  `password` varchar(255) NOT NULL DEFAULT '''''',
  `register_time` timestamp NULL DEFAULT current_timestamp(),
  `role_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `username`, `password`, `register_time`, `role_id`) VALUES
(0, 'widibaka55@gmail.com', 'Widi Baka', '123', '2020-07-31 14:09:05', 1),
(2, 'widi.udb@gmail.com', 'Widi UDB', '123', '2020-07-31 14:09:05', 2),
(3, 'widicahyo@yahoo.com', 'widi cahyo', 'Passwordku123', '2020-08-19 19:33:48', 2),
(4, 'widi_dwi@fikom.udb.ac.id', 'WIDI DWI NURCAHYO', '12854', '2020-08-19 21:58:36', 2);

-- --------------------------------------------------------

--
-- Table structure for table `website`
--

CREATE TABLE `website` (
  `id` int(11) NOT NULL,
  `website_name` varchar(20) NOT NULL,
  `website_title` varchar(100) NOT NULL,
  `website_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `website`
--

INSERT INTO `website` (`id`, `website_name`, `website_title`, `website_description`) VALUES
(1, 'Korek Software', 'Korek Software - Snippet, Plugin, & Source-code', 'Korek Software menyediakan produk-produk snippet, plugin, dan source-code.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `link_previewer`
--
ALTER TABLE `link_previewer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`email`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_plan`
--
ALTER TABLE `product_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sidebar`
--
ALTER TABLE `sidebar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sidebar_admin`
--
ALTER TABLE `sidebar_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `website`
--
ALTER TABLE `website`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `link_previewer`
--
ALTER TABLE `link_previewer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_plan`
--
ALTER TABLE `product_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sidebar`
--
ALTER TABLE `sidebar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sidebar_admin`
--
ALTER TABLE `sidebar_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `website`
--
ALTER TABLE `website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
