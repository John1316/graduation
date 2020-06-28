-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2020 at 04:42 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bisians`
--

-- --------------------------------------------------------

--
-- Table structure for table `accorders`
--

CREATE TABLE `accorders` (
  `accpt_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `cust_name` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `cust_phone` varchar(255) NOT NULL,
  `cust_add` varchar(1000) NOT NULL,
  `delivery_time` date NOT NULL,
  `quan` int(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `uprice` int(100) NOT NULL,
  `tprice` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `uname` varchar(150) NOT NULL,
  `pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `uname`, `pass`) VALUES
(1, 'admin1', 'A@tota1234'),
(2, 'admin2', 'A@shika852'),
(3, 'admin3', 'admin1234');

-- --------------------------------------------------------

--
-- Table structure for table `newprod`
--

CREATE TABLE `newprod` (
  `newprod_id` int(11) NOT NULL,
  `cust_name` varchar(150) NOT NULL,
  `cust_phone` int(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` int(150) NOT NULL,
  `quantity` int(150) NOT NULL,
  `cust_location` varchar(400) NOT NULL,
  `cust_desc` varchar(1000) NOT NULL,
  `image` varchar(150) NOT NULL,
  `expdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newprod`
--

INSERT INTO `newprod` (`newprod_id`, `cust_name`, `cust_phone`, `name`, `price`, `quantity`, `cust_location`, `cust_desc`, `image`, `expdate`) VALUES
(2, '', 0, 'john', 100, 2, 'sta', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo, officia voluptate? Neque nostrum quibusdam praesentium dolorum laboriosam animi amet iure et minus a debitis, voluptates natus fugiat vero dolores expedita!Tempora eos rem hic, atque veniam aliquid voluptas molestiae voluptatem. Laborum saepe molestiae distinctio accusamus cupiditate odio at et, sit facilis asperiores, corrupti, inventore nobis iste iusto omnis perferendis earum!\r\n', 'nex.jpg', '2021-07-28'),
(4, '', 0, 'john', 100, 10, '8 phoare jsajjjsjsjsjsj', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo, officia voluptate? Neque nostrum quibusdam praesentium dolorum laboriosam animi amet iure et minus a debitis, voluptates natus fugiat vero dolores expedita!Tempora eos rem hic, atque veniam aliquid voluptas molestiae voluptatem. Laborum saepe molestiae distinctio accusamus cupiditate odio at et, sit facilis asperiores, corrupti, inventore nobis iste iusto omnis perferendis earum!\r\n', 'statin.jpg', '2020-07-10'),
(6, 'john', 11111, 'statin', 222, 11, '8 phoare jsajjjsjsjsjsj', 'lorem', 'product-images/2.jpg', '2022-04-21'),
(10, 'ahmed', 1000000000, 'product', 66, 10, 'oba', 'dawa mtn7sh ', '1591909990-clem-onojeghuo-206832-600x500.jpg', '2020-06-25'),
(11, 'Berbara', 114963258, 'eltroxin 50', 60, 15, 'shobra', 'loremmmmmmm', '1592440843-eltro.jpg', '2021-04-22'),
(12, 'mary', 1222222222, 'Unitrixs', 11, 3, 'ain shmas', 'romatasm kber', '1592514146-WhatsApp Image 2020-05-24 at 9.48.16 PM.jpeg', '2020-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `cust_name` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cust_phone` int(100) NOT NULL,
  `cust_add` varchar(1000) NOT NULL,
  `quan` int(100) NOT NULL,
  `visa` varchar(150) NOT NULL,
  `cvv` varchar(150) NOT NULL,
  `code` varchar(100) NOT NULL,
  `uprice` int(100) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tprice` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `rate_id` int(11) NOT NULL,
  `scale` varchar(255) NOT NULL,
  `msg` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`rate_id`, `scale`, `msg`) VALUES
(1, '5', 'hahaysshahaysyshha'),
(5, '4', 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss'),
(6, '', 'website gamed'),
(7, '4', 'yaba a7la 5 stars'),
(8, '3', 'lorem loremaaaat'),
(9, '4', 'yaba a7la 5 stars'),
(10, '4', 'a7la a7la 3lek'),
(11, '5', 'website gamed'),
(12, '3', '3 ngom we 7aga fa5ma ');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `des` varchar(500) NOT NULL,
  `image` mediumtext NOT NULL,
  `price` double(10,2) NOT NULL,
  `expdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `age` int(100) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `cpass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accorders`
--
ALTER TABLE `accorders`
  ADD PRIMARY KEY (`accpt_id`),
  ADD KEY `cust_id` (`order_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `newprod`
--
ALTER TABLE `newprod`
  ADD PRIMARY KEY (`newprod_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accorders`
--
ALTER TABLE `accorders`
  MODIFY `accpt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `newprod`
--
ALTER TABLE `newprod`
  MODIFY `newprod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accorders`
--
ALTER TABLE `accorders`
  ADD CONSTRAINT `accorders_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
