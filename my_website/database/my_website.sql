-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2023 at 02:35 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(10, ' Loke Lunarius', 'Lunarius I', '25f9e794323b453885f5181f1b624d0b'),
(13, 'Sun Wukong', 'Wukong', '6ebe76c9fb411be97b3b0d48b791a7c9'),
(14, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `img_name`, `featured`, `active`) VALUES
(16, 'Burger', 'burger.jpg', 'Yes', 'Yes'),
(17, 'Pizza', 'pizza.jpg', 'Yes', 'Yes'),
(18, 'Beverages', 'Beverages_2.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `img_name`, `category_id`, `featured`, `active`) VALUES
(13, 'Big Mac', ' Giant beef burger with exclusive sauce.   ', '50000.00', 'big_mac_2.png', 16, 'Yes', 'Yes'),
(14, 'Cheese Burger', ' ', '30000.00', 'chese_burger_deluxe_2.png', 16, 'No', 'Yes'),
(15, 'Chicken Burger', ' ', '30000.00', 'chicken_burger_2.png', 16, 'No', 'Yes'),
(16, 'Chicken Burger Spicy', ' ', '40000.00', 'chicken_burger_spicy_2.png', 16, 'Yes', 'Yes'),
(17, 'French Chicken Burger', ' ', '55000.00', 'chicken_burger_french_2.png', 16, 'Yes', 'Yes'),
(19, 'Chicken Pizza', ' ', '120000.00', 'Chicken_Pizza_2.jpg', 17, 'Yes', 'Yes'),
(20, 'Beef Pizza', ' ', '120000.00', 'Beef_Pizza_2.jpg', 17, 'Yes', 'Yes'),
(21, 'Sea Pizza', ' ', '150000.00', 'Seafood_Pizza_2.jpg', 17, 'Yes', 'Yes'),
(22, 'Mix Pizza', ' ', '150000.00', 'Mix_Pizza_2.jpg', 17, 'No', 'Yes'),
(23, 'Vegetable Pizza', ' ', '90000.00', 'Vegetable_Pizza_2.jpg', 17, 'No', 'Yes'),
(25, 'Coca Cola', ' ', '10000.00', 'Coca-cola-2.jpg', 18, 'Yes', 'Yes'),
(26, 'Sprite', ' ', '10000.00', 'Sprite-2.jpg', 18, 'Yes', 'Yes'),
(27, 'Pepsi', ' ', '10000.00', 'Pepsi_2.jpg', 18, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(60) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(30) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(4, 'Big Mac', '50000.00', 1, '50000.00', '2021-12-05 04:17:26', 'Ordered', 'LOc', '767967', 'loc@gmail.com', 'Viet Nam'),
(5, 'Cheese Burger', '30000.00', 1, '30000.00', '2021-12-05 04:30:59', 'Ordered', 'Loc', '767967', 'loc@gmail.com', 'Viet Nam'),
(6, 'Big Mac', '50000.00', 1, '50000.00', '2023-03-13 08:19:42', 'Ordered', 'Loc dai hiep', '123456789', 'loclocloc@gmail', 'BK hcm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


CREATE TABLE tbl_hashed_web_content (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  file_path VARCHAR(255) NOT NULL,
  hashed_content TEXT,
  result VARCHAR(15),
  PRIMARY KEY (id)
);

CREATE TABLE `tbl_tracking_log` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL,
  `ip_address` varchar(60) NOT NULL,
  `url` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
