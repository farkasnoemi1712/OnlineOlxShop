-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2020 at 05:50 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `licenta`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Sport'),
(2, 'Imbracaminte'),
(3, 'Casa'),
(5, 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `firstname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `address` text CHARACTER SET utf8 NOT NULL,
  `email` varchar(20) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(14) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `date`, `firstname`, `lastname`, `address`, `email`, `phone`) VALUES
(11, '2020-01-29 15:33:22', 'Noemi', 'Farkas', 'str. sdasd nr 38 ', 'dsads@gmail.com', '0743455998'),
(16, '2018-07-21 21:00:00', 'David', 'FamDavid', 'str. ddsadsada', 'david@gmail.com', '0876543234'),
(19, '2018-07-21 21:00:00', 'Ultima', 'FUltima', 'str. dsadsa ultim', 'ult@dsada', '09876543'),
(26, '2020-02-12 21:38:02', 'noemmmi', 'dsadas', 'dsadas', 'sda', '54543');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) NOT NULL,
  `price` float UNSIGNED NOT NULL,
  `qty` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `product_id`, `order_id`, `price`, `qty`) VALUES
(1, 1, 11, 100, 3),
(2, 2, 11, 233, 4),
(3, 1, 23, 8889, 2),
(4, 2, 23, 233, 3),
(5, 2, 24, 322, 2),
(6, 8, 24, 543, 3),
(7, 2, 26, 322, 4),
(8, 8, 26, 543, 5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `photo_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `code` varchar(12) CHARACTER SET utf8 NOT NULL,
  `price` float UNSIGNED NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `photo_id`, `name`, `code`, `price`, `description`, `user_id`) VALUES
(1, 1, 5, 'Banda de alergat', '12345', 1300, 'dadsa', 3),
(7, 2, 10, 'Pantaloni', '123', 160, '4fdfs', 4),
(8, 3, 12, 'Scaun', '132321', 270, 'wewqec', 3),
(9, 5, 15, 'Microsoft Windows 10', '234', 320, 'fgdgdf', 4),
(10, 1, 18, 'Minge volei', '739688', 150, 'descr', 3),
(11, 2, 20, 'Jacheta impermeabila', '678967', 250, 'retsfh', 4),
(12, 3, 21, 'Lustra', '1414', 600, 'dasldas', 4),
(13, 1, 23, 'Minge fotbal', '1333', 330, 'dasdsad', 3),
(14, 5, 24, 'Casti audio Sony', '653', 70, 'dasdsadas', 3),
(15, 2, 26, 'Bluza cu aspect texturat', '454', 180, 'dsdsfrewf', 4),
(16, 3, 28, 'Set canapea fixa si doua fotolii', '6789', 3500, 'dsadsa', 4),
(17, 5, 32, 'Mouse Gaming ASUS', '45678', 120, 'gfhjkl', 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_photos`
--

CREATE TABLE `product_photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_photos`
--

INSERT INTO `product_photos` (`id`, `product_id`, `photo`) VALUES
(5, 1, 'b1.png'),
(6, 1, 'b2.png'),
(7, 1, 'b3.png'),
(8, 2, 'h1.png'),
(9, 2, 'h2.png'),
(10, 7, 'n1.jpg'),
(11, 7, 'n2.jpg'),
(12, 8, 's1.png'),
(13, 8, 's2.png'),
(14, 8, 's3.png'),
(15, 9, 'w1.png'),
(16, 9, 'w2.png'),
(17, 9, 'w3.png'),
(18, 10, 'm1.png'),
(19, 10, 'm2.png'),
(20, 11, 'j1.png'),
(21, 12, 'c1.jpg'),
(22, 12, 'c2.png'),
(23, 13, 'm01.png'),
(24, 14, 'casca1.png'),
(25, 14, 'casca2.png'),
(26, 15, 'bluza1.png'),
(27, 15, 'bluza2.png'),
(28, 16, 'canapea1.png'),
(29, 16, 'canapea2.png'),
(30, 16, 'canapea3.png'),
(31, 16, 'canapea4.png'),
(32, 17, 'mouse1.png'),
(33, 17, 'mouse2.png'),
(34, 17, 'mouse3.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `is_admin` int(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `is_admin`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1),
(3, 'Noemi', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0),
(4, 'Ana', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_photos`
--
ALTER TABLE `product_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_photos`
--
ALTER TABLE `product_photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
