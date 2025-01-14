-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2022 at 04:41 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hardware_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Emp_id` char(5) NOT NULL,
  `Emp_name` varchar(100) NOT NULL,
  `E_password` varchar(6) NOT NULL,
  `Emp_department` varchar(100) NOT NULL,
  `Emp_gender` varchar(45) NOT NULL,
  `Emp_date` date NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL,
  `deletedAt` timestamp NULL DEFAULT NULL,
  `Major_id` char(3) NOT NULL,
  `Emp_Type_id` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Emp_id`, `Emp_name`, `E_password`, `Emp_department`, `Emp_gender`, `Emp_date`, `createdAt`, `updatedAt`, `deletedAt`, `Major_id`, `Emp_Type_id`) VALUES
('12345', 'Uraiporn', '123456', 'ฝ่ายขาย', 'male', '2022-03-17', '2022-03-21 08:50:17', NULL, NULL, '1', '2'),
('12346', 'Natthachai', '123123', 'ผู้จัดการ', 'male', '2022-03-02', '2022-03-21 08:50:49', NULL, NULL, '1', '1'),
('R0001', 'Chanakan', '456789', 'ผู้จัดการ', 'female', '2013-03-20', '2022-03-22 11:10:50', NULL, NULL, 'M02', '1');

-- --------------------------------------------------------

--
-- Table structure for table `employee_type`
--

CREATE TABLE `employee_type` (
  `Emp_Type_id` char(7) NOT NULL,
  `Emp_Type_name` varchar(100) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL,
  `deletedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_type`
--

INSERT INTO `employee_type` (`Emp_Type_id`, `Emp_Type_name`, `createdAt`, `updatedAt`, `deletedAt`) VALUES
('1', 'manager', '2022-03-21 07:13:09', NULL, NULL),
('2', 'cashier', '2022-03-21 16:01:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE `major` (
  `Major_id` char(3) NOT NULL,
  `Major_name` varchar(100) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL,
  `deletedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`Major_id`, `Major_name`, `createdAt`, `updatedAt`, `deletedAt`) VALUES
('1', 'khonkaen', '2022-03-21 07:12:33', NULL, NULL),
('M02', 'Roi-et', '2022-03-22 11:11:29', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_id` char(7) NOT NULL,
  `Product_photo` varchar(100) NOT NULL,
  `Product_Type` char(5) NOT NULL,
  `Product_Brand` char(10) NOT NULL,
  `Product_name` varchar(45) NOT NULL,
  `Product_price` float NOT NULL,
  `Product_detail` varchar(1000) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL,
  `deleteAt` timestamp NULL DEFAULT NULL,
  `Product_quantity` int(11) NOT NULL,
  `Product_promotion` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_id`, `Product_photo`, `Product_Type`, `Product_Brand`, `Product_name`, `Product_price`, `Product_detail`, `createdAt`, `updatedAt`, `deleteAt`, `Product_quantity`, `Product_promotion`) VALUES
('P000001', 'p1.jpg', 'T0001', 'B000000001', 'เมาส์ไร้สาย MI', 250, '(มีแบตในตัว) (ปุ่มเงียบ) (มีปุ่มปรับความไวเมาส์ DPI 1000-1600) Optical Rechargeable Wireless Mouse บลูทูธ', '2022-03-22 10:51:11', NULL, NULL, 50, 'BUY 1 GET 1'),
('P000002', 'p2.jpg', 'T0001', 'B000000003', '6Dเม้าส์ G5เมาส์เกมมิ่ง มีไฟ', 89, '【ส่งไวจากไทย】6Dเม้าส์ G5เมาส์เกมมิ่ง มีไฟ รุ่น เม้าส์ Optical Gaming Mouse เม้าส์แบบมีสาย Wired Mouse 4Speed DPI RGB', '2022-03-22 10:52:21', NULL, NULL, 100, 'BUY 1 GET 3'),
('P000003', 'p3.jpg', 'T0001', 'B000000006', 'เมาส์ไร้สายT1', 189, 'เมาส์ไร้สายT1 2.4G คุณภาพสูง เมาส์แบบกลไกเงียบ เมาส์เกมมิ่ง ชาร์จใหม่ได้ Macbook Ipad Wireless', '2022-03-22 10:53:11', NULL, NULL, 50, '-'),
('P000004', 'p4.jpg', 'T0001', 'B000000005', 'MINI Video Capture Card USB 2.0', 250, '【ส่งไวจากไทย】แบบพกพา MINI Video Capture Card USB 2.0 1080P HDMI Video Grabber บันทึกกล่อง FR PS4 เกม DVD Game/Video', '2022-03-22 14:33:02', NULL, NULL, 50, 'ฺ-');

-- --------------------------------------------------------

--
-- Table structure for table `product_brand`
--

CREATE TABLE `product_brand` (
  `Brand_id` char(10) NOT NULL,
  `Brand_name` varchar(45) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleteAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_brand`
--

INSERT INTO `product_brand` (`Brand_id`, `Brand_name`, `createdAt`, `updatedAt`, `deleteAt`) VALUES
('B000000001', 'MI', '2022-03-11 08:48:45', '2022-03-11 08:48:45', '2022-03-11 08:48:45'),
('B000000002', 'UGREEN', '2022-03-11 08:48:45', '2022-03-11 08:48:45', '2022-03-11 08:48:45'),
('B000000003', 'Xiaomi', '2022-03-11 08:48:45', '2022-03-11 08:48:45', '2022-03-11 08:48:45'),
('B000000004', 'Hxbg', '2022-03-11 08:48:45', '2022-03-11 08:48:45', '2022-03-11 08:48:45'),
('B000000005', 'Inphic', '2022-03-11 08:48:45', '2022-03-11 08:48:45', '2022-03-11 08:48:45'),
('B000000006', 'bonkyo', '2022-03-11 08:48:45', '2022-03-11 08:48:45', '2022-03-11 08:48:45'),
('B000000010', 'sds', '2022-03-21 11:09:13', '2022-03-21 11:09:13', '2022-03-21 11:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `Product_type_id` char(5) NOT NULL,
  `Product_type` varchar(45) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleteAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`Product_type_id`, `Product_type`, `createdAt`, `updatedAt`, `deleteAt`) VALUES
('T0001', 'input', '2022-03-11 08:52:28', '2022-03-11 08:52:28', '2022-03-11 08:52:28'),
('T0002', 'output', '2022-03-11 08:52:28', '2022-03-11 08:52:28', '2022-03-11 08:52:28'),
('T0003', 'process', '2022-03-11 08:53:03', '2022-03-11 08:53:03', '2022-03-11 08:53:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(13) NOT NULL,
  `fullname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(10) CHARACTER SET utf8 NOT NULL,
  `id_card` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `phone`, `id_card`) VALUES
(7, 'ชณากาล', '0621316491', '1459900857741'),
(8, 'ศรีสมร', '0855439082', '2147483647');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`Emp_id`),
  ADD KEY `Test` (`Emp_Type_id`),
  ADD KEY `Test1` (`Major_id`);

--
-- Indexes for table `employee_type`
--
ALTER TABLE `employee_type`
  ADD PRIMARY KEY (`Emp_Type_id`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`Major_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_id`),
  ADD KEY `product_Typeenroll` (`Product_Type`),
  ADD KEY `product_Brandenroll` (`Product_Brand`);

--
-- Indexes for table `product_brand`
--
ALTER TABLE `product_brand`
  ADD PRIMARY KEY (`Brand_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`Product_type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `Test1` FOREIGN KEY (`Major_id`) REFERENCES `major` (`Major_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_Brandenroll` FOREIGN KEY (`Product_Brand`) REFERENCES `product_brand` (`Brand_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
