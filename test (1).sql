-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2021 at 08:15 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_ID` int(11) NOT NULL,
  `shop_ID` int(11) NOT NULL,
  `Prices_ID` int(11) NOT NULL,
  `financial_statuses_ID` int(11) NOT NULL,
  `order_address_ID` int(11) NOT NULL,
  `closed_at` datetime,
  `created_at` datetime,
  `updated_at` datetime,
  `fulfillment_status` varchar(255) DEFAULT NULL,
  `total_items` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `id` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_financial_statuses`
--

CREATE TABLE `order_financial_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_financial_statuses`
--

INSERT INTO `order_financial_statuses` (`id`, `name`) VALUES
(1, 'paid'),
(2, 'pending'),
(3, 'refunded');

-- --------------------------------------------------------

--
-- Table structure for table `order_prices`
--

CREATE TABLE `order_prices` (
  `id` int(11) NOT NULL,
  `total_price` float(9,2) NOT NULL DEFAULT 0.00,
  `subtotal_price` float(9,2) NOT NULL DEFAULT 0.00,
  `total_production_cost` float(9,2) NOT NULL DEFAULT 0.00,
  `total_order_shipping_cost` float(9,2) NOT NULL DEFAULT 0.00,
  `total_order_handling_cost` float(9,2) NOT NULL DEFAULT 0.00,
  `total_discounts` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_info`
--

CREATE TABLE `shop_info` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shop_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_ID` (`shop_ID`,`Prices_ID`),
  ADD KEY `order_address_ID` (`order_address_ID`),
  ADD KEY `Prices_ID` (`Prices_ID`),
  ADD KEY `financial_statuses_ID` (`financial_statuses_ID`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_financial_statuses`
--
ALTER TABLE `order_financial_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_prices`
--
ALTER TABLE `order_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_info`
--
ALTER TABLE `shop_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `order_financial_statuses`
--
ALTER TABLE `order_financial_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_prices`
--
ALTER TABLE `order_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `shop_info`
--
ALTER TABLE `shop_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `Prices_ID` FOREIGN KEY (`Prices_ID`) REFERENCES `order_prices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `financial_statuses_ID` FOREIGN KEY (`financial_statuses_ID`) REFERENCES `order_financial_statuses` (`id`),
  ADD CONSTRAINT `order_address_ID` FOREIGN KEY (`order_address_ID`) REFERENCES `order_address` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shop_ID` FOREIGN KEY (`shop_ID`) REFERENCES `shop_info` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
