-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2023 at 10:18 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `username` varchar(30) NOT NULL,
  `title` varchar(5) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `contact` text NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `title`, `name`, `address`, `contact`, `password`) VALUES
('admin011', 'นาย', 'ผู้ดูแลระบบ', '-', '-', '898234ab981156ab00485ce1ca225071'),
('roris123', 'นาย', 'ธาดา อาจหาญ', '141414/4444', 'sisiiss', 'f7c824604ffd6a33574041413c7aa82a'),
('tada1234', 'นาย', 'ธาดา อาจหาญ', '141414/4444', 'sisiiss', 'd51e15e23cccf179e48e0698ba6cec46'),
('tada12345', 'นาย', 'ธาดา อาจหาญ', '141414/4444', 'sisiiss', '846c7f1b5d6afdaaa665824caa6723e5'),
('tada123456', 'นาย', 'ธาดา อาจหาญ', '141414/4444', 'sisiiss', 'fece48f4f5325f024c4c43c9e36c188f'),
('tester012', 'นาย', 'มาลี', '130/44 ถ.ห้วยขวาง สามเสน กรุงเทพ 10400', '0842133366', 'bf1a62a354d0c0e4780bca939c2ac726'),
('tester013', 'นาย', 'tester', '-', '-', '19592fec979d8355b1260f432a33dfb5');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `cid` varchar(7) NOT NULL,
  `NofCompany` varchar(20) NOT NULL,
  `price` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`cid`, `NofCompany`, `price`) VALUES
('CM0001', 'KERRY EXPRESS', '40.00'),
('CM0002', 'ไปรษณีย์ไทย', '20.00'),
('CM0003', 'Ninja Van', '30.00');

-- --------------------------------------------------------

--
-- Table structure for table `orderpd`
--

CREATE TABLE `orderpd` (
  `tid` varchar(20) NOT NULL,
  `pid` varchar(20) NOT NULL,
  `size` varchar(5) NOT NULL,
  `quantity` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `statusPD` varchar(30) NOT NULL,
  `tracking` varchar(20) NOT NULL,
  `DtoOrder` char(10) NOT NULL,
  `Cid` char(6) NOT NULL,
  `timeOrder` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderpd`
--

INSERT INTO `orderpd` (`tid`, `pid`, `size`, `quantity`, `username`, `statusPD`, `tracking`, `DtoOrder`, `Cid`, `timeOrder`) VALUES
('TD20211107012248', 'PD20211028054801', 'L', 6, 'tester012', 'ยังไม่ได้จัดส่ง', 'ยังไม่ระบุ', '07/11/2021', 'CM0001', '01:22:48am'),
('TD20211107012248', 'PD20211029112616', 'S', 9, 'tester012', 'ยังไม่ได้จัดส่ง', 'ยังไม่ระบุ', '07/11/2021', 'CM0001', '01:22:48am'),
('TD20211107012248', 'PD20211029121649', 'M', 8, 'tester012', 'ยังไม่ได้จัดส่ง', 'ยังไม่ระบุ', '07/11/2021', 'CM0001', '01:22:48am'),
('TD20211107012248', 'PD20211029121649', 'S', 7, 'tester012', 'ยังไม่ได้จัดส่ง', 'ยังไม่ระบุ', '07/11/2021', 'CM0001', '01:22:48am'),
('TD20211107012555', 'PD20211028054801', 'S', 6, 'tester012', 'ยังไม่ได้จัดส่ง', 'ยังไม่ระบุ', '07/11/2021', 'CM0001', '01:25:55am'),
('TD20211107012555', 'PD20211029112616', 'XL', 15, 'tester012', 'ยังไม่ได้จัดส่ง', 'ยังไม่ระบุ', '07/11/2021', 'CM0001', '01:25:55am'),
('TD20211107012555', 'PD20211029121649', 'L', 8, 'tester012', 'ยังไม่ได้จัดส่ง', 'ยังไม่ระบุ', '07/11/2021', 'CM0001', '01:25:55am'),
('TD20211107012555', 'PD20211029121649', 'S', 8, 'tester012', 'ยังไม่ได้จัดส่ง', 'ยังไม่ระบุ', '07/11/2021', 'CM0001', '01:25:55am'),
('TD20211107013650', 'PD20211029121649', 'M', 7, 'tester012', 'ยังไม่ได้จัดส่ง', 'ยังไม่ระบุ', '07/11/2021', 'CM0001', '01:36:50am');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productid` char(16) NOT NULL,
  `productname` varchar(40) NOT NULL,
  `size` varchar(4) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `detail` text DEFAULT NULL,
  `stock` int(100) NOT NULL,
  `NumofSell` int(120) NOT NULL,
  `NumofView` int(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productid`, `productname`, `size`, `price`, `picture`, `detail`, `stock`, `NumofSell`, `NumofView`) VALUES
('PD20211028054801', 'เสื้อยืด', 'L', '230.00', 'PIC-617ac6317e7f18.66085735.png', '', 50, 0, 5),
('PD20211028054801', 'เสื้อยืด', 'S', '230.00', 'PIC-617ac6317e7f18.66085735.png', '', 50, 6, 5),
('PD20211028054801', 'เสื้อยืด', 'XL', '230.00', 'PIC-617ac6317e7f18.66085735.png', '', 50, 0, 5),
('PD20211029112616', 'เสื้อยืด', 'S', '700.00', 'PIC-617bbe385cd748.28505387.jpg', 'ดฟหดฆโฆฤ', 50, 0, 2),
('PD20211029112616', 'เสื้อยืด', 'XL', '700.00', 'PIC-617bbe385cd748.28505387.jpg', 'ดฟหดฆโฆฤ', 35, 15, 2),
('PD20211029121649', 'เสื้อเชิร์ต', 'L', '600.00', 'PIC-617b21510c48e8.30261841.jpg', '', 42, 8, 8),
('PD20211029121649', 'เสื้อเชิร์ต', 'M', '600.00', 'PIC-617b21510c48e8.30261841.jpg', '', 43, 7, 8),
('PD20211029121649', 'เสื้อเชิร์ต', 'S', '600.00', 'PIC-617b21510c48e8.30261841.jpg', '', 42, 8, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `orderpd`
--
ALTER TABLE `orderpd`
  ADD PRIMARY KEY (`tid`,`pid`,`size`),
  ADD KEY `pid` (`pid`),
  ADD KEY `username` (`username`),
  ADD KEY `Cid` (`Cid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`,`size`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderpd`
--
ALTER TABLE `orderpd`
  ADD CONSTRAINT `orderpd_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`productid`),
  ADD CONSTRAINT `orderpd_ibfk_2` FOREIGN KEY (`username`) REFERENCES `account` (`username`),
  ADD CONSTRAINT `orderpd_ibfk_3` FOREIGN KEY (`Cid`) REFERENCES `company` (`cid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
