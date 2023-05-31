-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 05:40 PM
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
  `description` varchar(100) NOT NULL,
  `buy_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buy`
--

INSERT INTO `buy` (`buy_id`, `buy_name`, `buy_date`, `buy_total`, `description`, `buy_time`) VALUES
(2, '', '2023-05-18', '8.00', '', '23:46:31'),
(3, '', '2023-05-19', '0.00', '', '15:00:32'),
(4, '', '2023-05-19', '100.00', '', '15:02:00'),
(5, '', '2023-05-19', '180.00', '', '15:59:40');

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

--
-- Dumping data for table `buy_item`
--

INSERT INTO `buy_item` (`buy_item_id`, `buy_id`, `product_id`, `quantity`, `rate`, `total`) VALUES
(1, 0, 3, '1', '7.00', '7.00'),
(2, 0, 3, '1', '7.00', '7.00'),
(3, 0, 3, '1', '7.00', '7.00'),
(4, 0, 2, '1', '6.00', '6.00'),
(5, 0, 1, '1', '7.00', '7.00'),
(6, 2, 4, '1', '8.00', '8.00'),
(7, 3, 7, '0', '20', '0'),
(8, 4, 7, '5', '20.00', '100.00'),
(9, 5, 8, '45', '4', '180');

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
(1, 'ดินสอ', 9, 1, '7.00', '10.00', 1, '../assests/images/stock/17981874376466578071f11.jpg', 5),
(2, 'ปากกา', 14, 1, '6.00', '8.00', 1, '../assests/images/stock/16331585766466578a5e214.jpg', 6),
(3, 'ชาเขียว', 22, 17, '7.00', '12.00', 1, '../assests/images/stock/48862962646657963ba08.jpg', 4),
(4, 'น้ำอัดลม', 20, 17, '8.00', '15.00', 1, '../assests/images/stock/1912279482646657a1e0774.jpg', 5),
(5, 'ขนมซอง', 17, 8, '5.00', '6.00', 1, '../assests/images/stock/1243836533646657adad0cf.jpg', 5),
(6, 'โซดา', 20, 17, '8.00', '12.00', 1, '../assests/images/stock/1499397867646657b7b5ddb.jpg', 5),
(7, 'ไม้กวาด', 4, 18, '20.00', '25.00', 3, '../assests/images/stock/46607191164672cda6fcb3.jpg', 5),
(8, 'ขนม', 45, 8, '4.00', '5.00', 1, '../assests/images/stock/173615401264673a92b0cab.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `sell_id` int(10) NOT NULL,
  `sell_date` date NOT NULL DEFAULT current_timestamp(),
  `sell_total` decimal(5,2) NOT NULL,
  `sell_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`sell_id`, `sell_date`, `sell_total`, `sell_time`) VALUES
(113, '2022-08-10', '10.00', '00:00:00'),
(117, '2022-08-11', '90.00', '00:00:00'),
(119, '2022-08-11', '18.00', '00:00:00'),
(120, '2022-08-11', '18.00', '00:00:00'),
(128, '2022-08-11', '10.00', '00:00:00'),
(133, '2022-08-11', '10.00', '00:00:00'),
(134, '2022-08-11', '116.00', '00:00:00'),
(135, '2023-05-18', '15.00', '23:48:17'),
(136, '2023-05-19', '6.00', '14:20:19'),
(137, '2023-05-19', '25.00', '16:00:16');

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
(71, 134, 2, '2', '8.00', '16.00'),
(72, 0, 1, '1', '10.00', '10.00'),
(73, 0, 1, '1', '10.00', '10.00'),
(74, 0, 3, '1', '12.00', '12.00'),
(75, 0, 5, '1', '6.00', '6.00'),
(76, 0, 5, '1', '6.00', '6.00'),
(77, 135, 4, '1', '15.00', '15.00'),
(78, 136, 5, '1', '6.00', '6.00'),
(79, 137, 7, '1', '25.00', '25.00');

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
  MODIFY `buy_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `buy_item`
--
ALTER TABLE `buy_item`
  MODIFY `buy_item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sell`
--
ALTER TABLE `sell`
  MODIFY `sell_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `sell_item`
--
ALTER TABLE `sell_item`
  MODIFY `sell_item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

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
