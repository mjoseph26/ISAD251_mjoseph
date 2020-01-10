-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: proj-mysql.uopnet.plymouth.ac.uk
-- Generation Time: Jan 10, 2020 at 09:21 AM
-- Server version: 8.0.16
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `isad251_mjoseph`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`ISAD251_MJoseph`@`%` PROCEDURE `AddCustomer` (IN `AtableNo` INT)  NO SQL
BEGIN 
INSERT INTO `customer` (TableNo) VALUES(AtableNo); 
END$$

CREATE DEFINER=`ISAD251_MJoseph`@`%` PROCEDURE `addOrder` (IN `AcustomerID` INT)  NO SQL
BEGIN
	INSERT INTO `order`
    (CustomerId)
    VALUES(AcustomerID);
END$$

CREATE DEFINER=`ISAD251_MJoseph`@`%` PROCEDURE `AddProduct` (IN `ItemNo` VARCHAR(255), IN `ItemDescription` VARCHAR(255), IN `ItemPrice` DECIMAL(8,2))  NO SQL
INSERT INTO `product`(`ProductName`,`ProductDesc`,`ProductPrice`,`ProductStock`) VALUES (ItemNo,ItemDescription,ItemPrice,'100')$$

CREATE DEFINER=`ISAD251_MJoseph`@`%` PROCEDURE `ProductToBuy` (IN `AorderId` INT, IN `AproductId` INT)  NO SQL
BEGIN 
INSERT INTO `order-product`(OrderId,ProductId) VALUES(AorderId,AproductId); 
END$$

CREATE DEFINER=`ISAD251_MJoseph`@`%` PROCEDURE `SetTime` (IN `AorderNumber` INT)  NO SQL
UPDATE `order` SET OrderTime=NOW()
WHERE `order`.`OrderId` = AorderNumber$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerId` int(11) NOT NULL,
  `TableNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerId`, `TableNo`) VALUES
(9, 3),
(10, 3),
(11, 1),
(12, 1),
(13, 3),
(14, 2),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 2),
(20, 3),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 1),
(27, 2),
(28, 3),
(29, 2),
(30, 1),
(31, 1),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 3),
(40, 2),
(41, 3),
(42, 2),
(43, 2),
(44, 3),
(45, 2),
(46, 2),
(47, 3),
(48, 3),
(49, 3),
(50, 3),
(51, 3),
(52, 3),
(53, 2),
(54, 4),
(55, 3),
(56, 2),
(57, 2),
(58, 2),
(59, 2),
(60, 3),
(61, 4),
(62, 4),
(63, 3);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderId` int(11) NOT NULL,
  `OrderTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CustomerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OrderId`, `CustomerId`) VALUES
(1, 36),
(2, 37),
(3, 38),
(4, 39),
(5, 40),
(6, 41),
(7, 42),
(8, 43),
(9, 44),
(10, 45),
(11, 46),
(12, 47),
(13, 48),
(14, 49),
(15, 50),
(16, 51),
(17, 52),
(18, 53),
(19, 54),
(20, 55),
(21, 56),
(22, 57),
(23, 58),
(24, 59),
(25, 60),
(26, 61),
(27, 62),
(28, 63);

-- --------------------------------------------------------

--
-- Table structure for table `order-product`
--

CREATE TABLE `order-product` (
  `OrderId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order-product`
--

INSERT INTO `order-product` (`OrderId`, `ProductId`) VALUES
(1, 3),
(9, 2),
(9, 8),
(10, 4),
(11, 4),
(12, 6),
(13, 4),
(14, 2),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 2),
(20, 2),
(21, 2),
(22, 3),
(23, 3),
(24, 6),
(28, 6);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductId` int(11) NOT NULL,
  `ProductName` varchar(25) NOT NULL,
  `ProductDesc` varchar(255) DEFAULT NULL,
  `ProductPrice` decimal(8,2) NOT NULL,
  `ProductStock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductId`, `ProductName`, `ProductDesc`, `ProductPrice`, `ProductStock`) VALUES
(1, 'Chai', 'Combination of black tea,steamed milk and various Indian herbs and spices', '15.50', 100),
(2, 'Yerba Matu', 'Energising South American tea made from Holly leaves', '20.00', 100),
(3, 'Pau d\' arco', 'Tea made from the Taheebo herb found in the Amazon rainforest', '30.00', 100),
(4, 'Chamomile', 'A relaxing and fragrant drink made with the essence of Chamomile flowers', '15.00', 100),
(5, 'Oolong', 'A tea with proven health benefits sourced from the leaves of the Camellia Sinensis plant', '19.00', 100),
(6, 'Pu-erh', 'Chinese tea produced through microbial fermentation from green and black tea  leaves', '25.00', 100),
(7, 'Moringa', 'A subtle and earthy tea made from the Moringa plant native to the Himalayas', '50.00', 100),
(8, 'Peppermint', 'A fresh,bold and flavourful tea created from the leaves of Peppermint plant', '30.00', 100);

-- --------------------------------------------------------

--
-- Stand-in structure for view `[customerorders]`
-- (See below for the actual view)
--
CREATE TABLE `[customerorders]` (
`OrderId` int(11)
,`OrderTime` datetime
,`ProductName` varchar(25)
,`ProductPrice` decimal(8,2)
,`TableNo` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `[customerorders]`
--
DROP TABLE IF EXISTS `[customerorders]`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ISAD251_MJoseph`@`%` SQL SECURITY DEFINER VIEW `[customerorders]`  AS  select `order`.`OrderId` AS `OrderId`,`customer`.`TableNo` AS `TableNo`,`product`.`ProductName` AS `ProductName`,`product`.`ProductPrice` AS `ProductPrice`,`order`.`OrderTime` AS `OrderTime` from (((`order` join `product`) join `customer`) join `order-product`) where ((`customer`.`CustomerId` = `order`.`CustomerId`) and (`order`.`OrderId` = `order-product`.`OrderId`) and (`order-product`.`ProductId` = `product`.`ProductId`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerId`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderId`),
  ADD KEY `CustomerId` (`CustomerId`);

--
-- Indexes for table `order-product`
--
ALTER TABLE `order-product`
  ADD PRIMARY KEY (`OrderId`,`ProductId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`CustomerId`) REFERENCES `customer` (`CustomerId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
