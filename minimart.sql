-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2022 at 06:50 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minimart`
--

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE `buy` (
  `buy_id` int(3) NOT NULL,
  `buy_name` varchar(30) NOT NULL,
  `buy_date` date NOT NULL DEFAULT current_timestamp(),
  `buy_total` decimal(5,2) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `buy_item`
--

CREATE TABLE `buy_item` (
  `buy_item_id` int(10) NOT NULL,
  `buy_id` int(3) NOT NULL,
  `product_id` int(3) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(3) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `quantity` int(4) NOT NULL,
  `type_id` int(3) NOT NULL,
  `buy_price` decimal(5,2) NOT NULL,
  `sell_price` decimal(5,2) NOT NULL,
  `status` int(11) NOT NULL,
  `product_image` mediumtext NOT NULL,
  `warning` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `quantity`, `type_id`, `buy_price`, `sell_price`, `status`, `product_image`, `warning`) VALUES
(1, 'ดินสอ', 10, 1, '7.00', '10.00', 1, '../assests/images/stock/178961629562e2a91ce079a.png', 5),
(2, 'ปากกา', 13, 1, '6.00', '8.00', 1, '../assests/images/stock/65198333362e2af98df674.png', 6),
(3, 'ชาเขียว', 20, 17, '7.00', '12.00', 1, '../assests/images/stock/176129943162ec9fcb1e7b6.png', 4),
(4, 'น้ำอัดลม', 20, 17, '8.00', '15.00', 1, '../assests/images/stock/128801779362ec9ff53cf00.png', 5),
(5, 'ขนมซอง', 20, 8, '5.00', '6.00', 1, '../assests/images/stock/164492411262f27e58590d8.jpg', 5),
(6, 'โซดา', 20, 17, '8.00', '12.00', 1, '../assests/images/stock/140289205062f3124d127a7.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `sell_id` int(10) NOT NULL,
  `sell_date` date NOT NULL DEFAULT current_timestamp(),
  `sell_total` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`sell_id`, `sell_date`, `sell_total`) VALUES
(113, '2022-08-10', '10.00'),
(117, '2022-08-11', '90.00'),
(119, '2022-08-11', '18.00'),
(120, '2022-08-11', '18.00'),
(128, '2022-08-11', '10.00'),
(133, '2022-08-11', '10.00'),
(134, '2022-08-11', '116.00');

-- --------------------------------------------------------

--
-- Table structure for table `sell_item`
--

CREATE TABLE `sell_item` (
  `sell_item_id` int(10) NOT NULL,
  `sell_id` int(3) NOT NULL,
  `product_id` int(3) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sell_item`
--

INSERT INTO `sell_item` (`sell_item_id`, `sell_id`, `product_id`, `quantity`, `rate`, `total`) VALUES
(62, 113, 1, '1', '10.00', '10.00'),
(63, 117, 1, '9', '10.00', '90.00'),
(64, 118, 2, '1', '8.00', '8.00'),
(65, 119, 1, '1', '10.00', '10.00'),
(66, 120, 2, '1', '8.00', '8.00'),
(68, 128, 1, '1', '10.00', '10.00'),
(69, 133, 1, '1', '10.00', '10.00'),
(70, 134, 1, '10', '10.00', '100.00'),
(71, 134, 2, '2', '8.00', '16.00');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `type_id` int(3) NOT NULL,
  `type_name` varchar(25) NOT NULL,
  `product_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type_name`, `product_id`) VALUES
(1, 'เครื่องเขียน', 0),
(8, 'ขนม', 0),
(17, 'เครื่องดื่ม', 0),
(18, 'อุปกรณ์ทำสะอาด', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(3) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`buy_id`);

--
-- Indexes for table `buy_item`
--
ALTER TABLE `buy_item`
  ADD PRIMARY KEY (`buy_item_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`sell_id`);

--
-- Indexes for table `sell_item`
--
ALTER TABLE `sell_item`
  ADD PRIMARY KEY (`sell_item_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buy`
--
ALTER TABLE `buy`
  MODIFY `buy_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buy_item`
--
ALTER TABLE `buy_item`
  MODIFY `buy_item_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sell`
--
ALTER TABLE `sell`
  MODIFY `sell_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `sell_item`
--
ALTER TABLE `sell_item`
  MODIFY `sell_item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
