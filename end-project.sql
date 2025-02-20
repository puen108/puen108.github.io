-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2025 at 06:03 PM
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
-- Database: `end-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `ord_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sto_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_number` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `cart_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `ord_id`, `user_id`, `sto_id`, `product_id`, `product_number`, `product_price`, `cart_status`) VALUES
(69, 0, 3, 1, 1, 1, 1500, 'SELECT'),
(87, 0, 33, 3, 3, 1, 75, 'SELECT'),
(88, 0, 34, 3, 3, 1, 75, 'SELECT'),
(89, 0, 34, 4, 4, 1, 75, 'SELECT'),
(90, 0, 34, 2, 2, 1, 65, 'SELECT');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `order_status`) VALUES
(3, 30, '2024-08-28 17:54:31', 'Pending'),
(4, 30, '2024-08-28 18:42:37', 'Pending'),
(5, 37, '2025-02-16 12:29:56', 'Pending'),
(6, 37, '2025-02-16 12:32:26', 'Pending'),
(7, 37, '2025-02-16 12:33:05', 'Pending'),
(8, 41, '2025-02-16 12:58:20', 'Pending'),
(9, 42, '2025-02-17 04:41:23', 'Pending'),
(10, 46, '2025-02-17 05:40:44', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `product_id`, `quantity`, `price`, `total_price`) VALUES
(6, 5, 11, 1, 120, 120),
(7, 6, 2, 1, 65, 65),
(8, 7, 1, 1, 65, 65),
(9, 8, 4, 1, 75, 75),
(10, 9, 3, 1, 75, 75),
(11, 9, 3, 1, 75, 75),
(12, 10, 3, 1, 75, 75);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(10) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `product_photo` varchar(50) NOT NULL,
  `sto_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_type`, `product_photo`, `sto_id`) VALUES
(1, 'ข้าวผัด', 65, 'อาหารจานเดียว', 'kaow.jpg', 1),
(2, 'ข้าวผัดกะเพรา', 65, 'อาหารจานเดียว', 'kapaow.jpg', 2),
(3, 'ข้าวผัดผงกะหรี่', 75, 'อาหารจานเดียว', 'kari.jpg', 3),
(4, 'ข้าวผัดพริกเกลือ', 75, 'อาหารจานเดียว', 'sall.jpg', 4),
(5, 'ผัดพริกแกง', 80, 'กับข้าว', 'pring.jpg', 5),
(6, 'ปลาผัดน้ำมันหอย', 120, 'กับข้าว', 'pla.jpg', 6),
(7, 'ผัดคพน้าปลาเค็ม', 100, 'กับข้าว', 'kana.jpg', 7),
(8, 'ผัดผักบุ้งไฟแดง', 100, 'กับข้าว', 'boong.jpeg', 8),
(9, 'ตำถั่วฝักยาว', 70, 'กับแกล้ม', 'tamtuo.jpg', 9),
(10, 'พุงแซลมอนทอด', 130, 'อาหารทานเล่น', 'poong.jpg', 10),
(11, 'หมึกทอดกระเทียม', 120, 'อาหารทานเล่น', 'mueg.jpg', 11),
(12, 'ทอดมันกุ้ง', 150, 'อาหารทานเล่น', 'todmun.jpg', 12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `user_username` varchar(20) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_photo` longtext NOT NULL,
  `user_type` enum('Admin','User') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_name`, `user_photo`, `user_type`) VALUES
(1, 'admin', '1', 'Administrator', 'person2.png', 'Admin'),
(30, '555', '33333', '123', 'h1.png', 'User'),
(37, 'test', '123', 'รชต เดชากุลวัฒน์1', 'h1.png', 'User'),
(41, 'rachata', '123', 'รชต เดชากุลวัฒน์45', 'person2.png', 'User'),
(42, 'w', 'w', 'ww', 'person2.png', 'User'),
(46, '123', '123', 'รชต เดชากุลวัฒน์.0', 'h1.png', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
