-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2023 at 08:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chrispizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(40) NOT NULL,
  `contact` varchar(40) DEFAULT NULL,
  `type` varchar(40) NOT NULL,
  `orders` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `password`, `email`, `address`, `contact`, `type`, `orders`) VALUES
(1, 'Ahmad Bin Abdullah', 'sghotpot', 'ahmad.abdullah@example.sg', '123 Orchard Road', '+65 9123 4567', 'member', NULL),
(2, 'Linda Tan', 'noodlelover', 'linda.tan@example.sg', '456 Serangoon Ave', '+65 9876 5432', 'guest', NULL),
(3, 'Siti Lim', 'singaporefood', 'siti.lim@example.sg', '789 Tampines St', '+65 8234 5678', 'member', NULL),
(4, 'Marcel Yap', NULL, 'Marcelyap31@gmail.com', '45 Brockhampton Drive', '97774668', 'guest', '654e7e085d567'),
(5, 'Yap Qi Long, Marcel', NULL, 'yapq0006@e.ntu.edu.sg', '45 Brockhampton Drive,', '', 'guest', '654bb9fcc433b'),
(6, 'heheh hahaha ', NULL, 'cz@gmail.com', '43 hiuhqdw drive', '80123780123', 'guest', '654bc04d62e15'),
(7, 'joel tan', '$2y$10$nD2CvVEoZDIReXZGeMM2peGIlirjtRo.8afecvf5dijUpVNh2lJ8S', 'Marcelyap32@gmail.com', '84 new address', '23131313', 'member', '654e890cd91a7'),
(8, 'Marcel Yap', '$2y$10$imwfGSZsxXv68kY7C6rbWuhOEXY9zDIaHa7zRp2K.wpzYDQo2y2yi', 'Marcelyap33@gmail.com', '45 Brockhampton Drive', '97774671', 'member', NULL),
(9, 'Marcel Yap', '$2y$10$D9W6ru8txMoBc3PUZPFtGeuLD9IKPwVpAe0.ncAT2ZZ5ej5NWidSK', 'Marcelyap39@gmail.com', '45 Brockhampton Drive', '97774671', 'member', NULL),
(10, 'Marcel Yap', '$2y$10$Ndx5pecqFnM2O5nVzRe5ye9zXOX7THLEwiu0cC/yzDjsdfs7j9Ovq', 'Marcelyap31@e.com', '45 Brockhampton Drive', '97774671', 'member', NULL),
(11, 'Marcel Yap', '$2y$10$b55O722XblFsSjmFu4cGg.moUKyagCgNDxjAU5xqu.2r9yo92sgKq', 'Marcelyap31@e.y', '45 Brockhampton Drive', '97774671', 'member', NULL),
(12, 'Marcel Yap', '$2y$10$Ky17SvGBH14Dxb0sTnD4XewNyxS5uPsuF/yA1nhxx7d87hsE0rOiG', 'u@e.y', '45 Brockhampton Drive', '97774671', 'member', NULL),
(14, 'eeeeeeeeeee', '$2y$10$1BfTD2r1jJLnlQPfiRhHh.ITdTaiBEtwjx7kXn83FlWF77FL8w/9q', 'eee@eee.wdw', '45 Brockhampton Drive', '97774671', 'member', NULL),
(15, 'eeeeweqwqweqw', '$2y$10$sethh7gvpCCMIgFroNL5cuYJxTzHEOflSynxW9/LFpfyJZgcoXb8m', 'e@e.eqewqweqwe', '45 Brockhampton Drive', '97774671', 'member', NULL),
(16, 'testuser', NULL, 'email@email.com', '1123 dqdqw ', '11212', 'guest', '654e7fdb47f07'),
(17, 'new guest', NULL, 'guest@gamil.com', 'guest address', '23132123', 'guest', '654e89561ab2b'),
(18, 'brandon', '$2y$10$Zjgi5IG88ORha8fOqJG5O.uNiLiJCnzg5vKgQQdOjFO5AY7.UFB0S', 'brandon@gmail.com', 'brandon address 2', '94824234', 'member', '654e89b7aa364');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `order_id` varchar(40) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `comments` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `order_id`, `customer_id`, `rating`, `comments`) VALUES
(1, '654bba74cfb3d', 4, 2, 'ee'),
(2, '654bba74cfb3d', 4, 2, 'ee'),
(3, '654bba74cfb3d', 4, 4, 'eee'),
(4, '654bc002d1605', 4, 3, '12`12`12');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `itemid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `itemprice` float NOT NULL,
  `size` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`itemid`, `name`, `itemprice`, `size`) VALUES
(1, 'Hawaiian', 12.99, 'regular'),
(2, 'Hawaiian', 16.99, 'large'),
(3, 'Chicken Galore', 11.49, 'regular'),
(4, 'Chicken Galore', 14.49, 'large'),
(5, 'Chris Special', 13.99, 'regular'),
(6, 'Chris Special', 16.99, 'large'),
(7, 'Chicken Curry', 10.99, 'regular'),
(8, 'Chicken Curry', 13.49, 'large'),
(9, 'Meat Lovers', 14.99, 'regular'),
(10, 'Meat Lovers', 17.99, 'large'),
(11, 'Pepperoni', 11.99, 'regular'),
(12, 'Pepperoni', 14.99, 'large'),
(13, 'Veggie Pizza', 11.49, 'regular'),
(14, 'Veggie Pizza', 14.49, 'large'),
(15, 'BBQ Chicken', 12.49, 'regular'),
(16, 'BBQ Chicken', 15.49, 'large'),
(17, 'Chocolate Waffle', 6.99, NULL),
(18, '10pc Drumlets', 9.99, NULL),
(19, 'Snack Platter', 15.99, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(40) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `topping1` int(11) DEFAULT NULL,
  `topping2` int(11) DEFAULT NULL,
  `topping3` int(11) DEFAULT NULL,
  `addon1` int(11) DEFAULT NULL,
  `addon2` int(11) DEFAULT NULL,
  `addon3` int(11) DEFAULT NULL,
  `sub_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `item_id`, `quantity`, `topping1`, `topping2`, `topping3`, `addon1`, `addon2`, `addon3`, `sub_total`) VALUES
(1, '654b6c02a5397', 6, 3, 2, 1, 3, 0, 2, 0, 79.95),
(2, '654b6c02a5397', 10, 2, 3, 2, 2, 0, 1, 0, 53.97),
(3, '654bb4ec42a5d', 8, 3, 3, 3, 1, 0, 2, 0, 72.45),
(4, '654bb4ec42a5d', 3, 3, 2, 3, 5, 0, 3, 0, 85.44),
(5, '654bb83783541', 7, 2, 4, 1, 1, 0, 2, 0, 47.96),
(6, '654bb9c2cbf7e', 6, 3, 4, 3, 1, 0, 2, 0, 85.95),
(7, '654bb9fcc433b', 7, 3, 1, 1, 1, 0, 2, 0, 52.95),
(8, '654bba74cfb3d', 4, 4, 3, 3, 0, 2, 0, 0, 105.94),
(9, '654bc002d1605', 5, 5, 3, 3, 3, 0, 3, 0, 129.92),
(10, '654bc002d1605', 8, 5, 0, 0, 0, 0, 2, 0, 87.43),
(11, '654bc002d1605', 11, 3, 3, 0, 1, 0, 0, 2, 55.95),
(12, '654bc04d62e15', 5, 3, 4, 1, 1, 0, 2, 0, 70.95),
(13, '654d30e863678', 8, 3, 2, 1, 1, 0, 2, 0, 63.45),
(14, '654d30e863678', 7, 2, 2, 4, 1, 0, 2, 2, 63.94),
(15, '654e7e085d567', 7, 2, 4, 4, 1, 0, 3, 0, 63.95),
(16, '654e7e085d567', 5, 3, 1, 3, 1, 0, 0, 2, 61.95),
(17, '654e7fdb47f07', 7, 3, 2, 1, 3, 0, 2, 0, 61.95),
(18, '654e884a6308d', 5, 3, 4, 2, 1, 0, 2, 0, 73.95),
(19, '654e884a6308d', 6, 2, 4, 1, 1, 0, 1, 0, 49.97),
(20, '654e88850352c', 6, 2, 4, 1, 1, 0, 2, 0, 59.96),
(21, '654e890cd91a7', 6, 3, 3, 3, 4, 0, 2, 0, 91.95),
(22, '654e890cd91a7', 8, 3, 0, 1, 3, 0, 2, 0, 66.45),
(23, '654e89561ab2b', 6, 3, 2, 3, 3, 0, 1, 0, 75.96),
(24, '654e89b7aa364', 5, 3, 3, 1, 1, 0, 3, 0, 77.94),
(25, '654e89b7aa364', 16, 3, 4, 1, 1, 0, 0, 2, 69.45);

-- --------------------------------------------------------

--
-- Table structure for table `ordersummary`
--

CREATE TABLE `ordersummary` (
  `id` int(11) NOT NULL,
  `order_id` varchar(40) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `delivery_time` time DEFAULT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordersummary`
--

INSERT INTO `ordersummary` (`id`, `order_id`, `customer_id`, `total`, `date`, `delivery_time`, `status`) VALUES
(1, '654b6c02a5397', 4, 151.21, '2023-11-08 19:07:46', '19:37:46', 'In the Kitchen'),
(2, '654bb4ec42a5d', 4, 177.58, '2023-11-09 00:18:52', '00:48:52', 'Completed'),
(3, '654bb83783541', 4, 56.66, '2023-11-09 00:32:55', '01:02:55', 'In the Kitchen'),
(4, '654bb9c2cbf7e', 4, 98.45, '2023-11-09 00:39:30', '01:09:30', 'In the Kitchen'),
(5, '654bb9fcc433b', 5, 62.15, '2023-11-09 00:40:28', '01:10:28', 'In the Kitchen'),
(6, '654bba74cfb3d', 4, 120.43, '2023-11-09 00:42:28', '01:12:28', 'In the Kitchen'),
(7, '654bc002d1605', 4, 304.53, '2023-11-09 01:06:10', '01:36:10', 'In the Kitchen'),
(8, '654bc04d62e15', 6, 81.95, '2023-11-09 01:07:25', '01:37:25', 'In the Kitchen'),
(9, '654d30e863678', 7, 144.03, '2023-11-10 03:20:08', '03:50:08', 'In the Kitchen'),
(10, '654e7e085d567', 4, 142.39, '2023-11-11 03:01:28', '03:31:28', 'In the Kitchen'),
(11, '654e7fdb47f07', 16, 72.05, '2023-11-11 03:09:15', '03:39:15', 'In the Kitchen'),
(12, '654e884a6308d', 7, 140.21, '2023-11-11 03:45:14', '04:15:14', 'In the Kitchen'),
(13, '654e88850352c', 7, 69.86, '2023-11-11 03:46:13', '04:16:13', 'In the Kitchen'),
(14, '654e890cd91a7', 7, 178.14, '2023-11-11 03:48:28', '04:18:28', 'In the Kitchen'),
(15, '654e89561ab2b', 17, 87.46, '2023-11-11 03:49:42', '04:19:42', 'In the Kitchen'),
(16, '654e89b7aa364', 18, 166.03, '2023-11-11 03:51:19', '04:21:19', 'In the Kitchen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`itemid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `ordersummary`
--
ALTER TABLE `ordersummary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `itemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ordersummary`
--
ALTER TABLE `ordersummary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `ordersummary` (`order_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `menu` (`itemid`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `ordersummary` (`order_id`);

--
-- Constraints for table `ordersummary`
--
ALTER TABLE `ordersummary`
  ADD CONSTRAINT `ordersummary_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
