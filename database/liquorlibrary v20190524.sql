-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 24, 2019 at 01:50 AM
-- Server version: 8.0.15
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `liquorlibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `password` varchar(20) DEFAULT NULL,
  `whID` int(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `whID` (`whID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `password`, `whID`) VALUES
(1, '1234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `backorderitems`
--

DROP TABLE IF EXISTS `backorderitems`;
CREATE TABLE IF NOT EXISTS `backorderitems` (
  `boItemID` int(20) NOT NULL AUTO_INCREMENT,
  `boID` int(20) NOT NULL,
  `quantity` int(20) DEFAULT '0',
  PRIMARY KEY (`boItemID`),
  KEY `boID` (`boID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `backorders`
--

DROP TABLE IF EXISTS `backorders`;
CREATE TABLE IF NOT EXISTS `backorders` (
  `backorderID` int(20) NOT NULL AUTO_INCREMENT,
  `out_whID` int(20) NOT NULL,
  `in_whID` int(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`backorderID`),
  KEY `out_whID` (`out_whID`),
  KEY `in_whID` (`in_whID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `brandID` int(20) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(45) NOT NULL,
  `img` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`brandID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandID`, `brandName`, `img`) VALUES
(1, 'ASAHI', NULL),
(2, 'Sawmill', NULL),
(3, 'Heineken', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `categoryID` int(20) NOT NULL AUTO_INCREMENT,
  `parentCategoryID` int(20) DEFAULT NULL,
  `categoryName` varchar(45) NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `parentCategoryID`, `categoryName`) VALUES
(1, NULL, 'beer'),
(2, 1, 'IPA'),
(3, 1, 'APA'),
(4, 1, 'Pale Ale'),
(5, NULL, 'Cider'),
(6, NULL, 'Wine'),
(7, 6, 'Red'),
(8, 6, 'White'),
(9, 6, 'Sparkling'),
(10, 6, 'Champagne'),
(11, NULL, 'Spirits'),
(12, 11, 'Gin'),
(13, 11, 'Vodka'),
(14, 11, 'Rum'),
(15, 11, 'Tequila'),
(16, 11, 'Bourbon'),
(17, 11, 'Brandy'),
(18, 11, 'Others'),
(19, NULL, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

DROP TABLE IF EXISTS `orderitems`;
CREATE TABLE IF NOT EXISTS `orderitems` (
  `itemID` int(20) NOT NULL,
  `orderID` int(20) NOT NULL,
  `quantity` int(20) NOT NULL,
  `totalprice` double DEFAULT NULL,
  PRIMARY KEY (`itemID`,`orderID`),
  KEY `orderID` (`orderID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`itemID`, `orderID`, `quantity`, `totalprice`) VALUES
(10003, 1, 1, 0),
(10005, 1, 1, 0),
(10003, 10, 1, 0),
(10005, 10, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderID` int(20) NOT NULL AUTO_INCREMENT,
  `buyerID` int(20) NOT NULL,
  `whID` int(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`orderID`),
  KEY `buyerID` (`buyerID`),
  KEY `whID` (`whID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `buyerID`, `whID`, `date`, `status`) VALUES
(1, 1, 1, '2019-05-16 09:34:38', 0),
(2, 1, 1, '2019-05-16 09:34:38', 1),
(10, 2, 0, '2019-05-24 01:39:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `productID` int(20) NOT NULL AUTO_INCREMENT,
  `productName` varchar(45) NOT NULL,
  `price` double DEFAULT NULL,
  `discountprice` double DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `categoryID` int(20) NOT NULL,
  `brandID` int(20) NOT NULL,
  PRIMARY KEY (`productID`),
  KEY `categoryID` (`categoryID`),
  KEY `brandID` (`brandID`)
) ENGINE=MyISAM AUTO_INCREMENT=10023 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `price`, `discountprice`, `img`, `categoryID`, `brandID`) VALUES
(10003, 'Sawmill Signiture', 12.5, 9.5, 'coolslight.png', 3, 2),
(10004, 'Asahi light', 8.5, 7.5, 'asahi.png', 2, 1),
(10005, 'Asahi can', 8, 6.5, 'asahican.png', 3, 2),
(10006, 'Blanche Classic', 13, 9.5, 'blanche.png', 1, 3),
(10007, 'Tranditional Blond', 13, 10.5, 'traditionalblond.png', 1, 3),
(10009, 'Sawmill Signiture', 12.5, 9.5, 'coolslight.png', 2, 2),
(10010, 'Asahi light', 8.5, 7.5, 'asahi.png', 1, 1),
(10011, 'Asahi can', 8, 6.5, 'asahican.png', 1, 2),
(10012, 'Blanche Classic', 13, 9.5, 'blanche.png', 3, 3),
(10013, 'Tranditional Blond', 13, 10.5, 'traditionalblond.png', 1, 3),
(10014, 'IPA Ca,den Classic', 9, 8.5, 'camden.png', 3, 3),
(10015, 'punky brew Classic', 7, 6.5, 'punk.png', 1, 2),
(10016, 'punky brew Classic', 7, 6.5, 'punk.png', 3, 2),
(10017, 'Mollys Cradle', 25, 18, 'MollysCradle.png', 7, 1),
(10018, 'Mollys shiraz', 25, 19.5, 'CradleShiraz.png', 7, 1),
(10019, 'Mollys Cradle', 25, 18, 'MathieClaudine.png', 7, 1),
(10020, 'Mollys Merlot', 27, 22, 'MollysMerlot.png', 7, 1),
(10021, 'Mollys bundle', 95, 85, 'ChineseNewyearbundle.png', 7, 2),
(10022, 'Tranditional Blond', 13, 0, 'traditionalblond.png', 1, 3);

--
-- Triggers `product`
--
DROP TRIGGER IF EXISTS `after_product_inserted`;
DELIMITER $$
CREATE TRIGGER `after_product_inserted` AFTER INSERT ON `product` FOR EACH ROW begin
			insert into stocklist (productID, whID)
            values (new.productID, 1), (new.productID, 2), (new.productID, 3), (new.productID, 4), (new.productID, 5), (new.productID, 6), (new.productID, 7), (new.productID, 8), (new.productID, 9), (new.productID, 10), (new.productID, 11);
		end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `specials`
--

DROP TABLE IF EXISTS `specials`;
CREATE TABLE IF NOT EXISTS `specials` (
  `specialId` int(20) NOT NULL AUTO_INCREMENT,
  `specialName` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `specialType` tinyint(4) NOT NULL,
  `specialPrice` double DEFAULT NULL,
  `specialInfo` text NOT NULL,
  `specialImg` varchar(20) NOT NULL,
  `startTime` varchar(20) DEFAULT NULL,
  `finishTime` varchar(20) DEFAULT NULL,
  `productID` int(20) DEFAULT NULL,
  PRIMARY KEY (`specialId`),
  KEY `productID` (`productID`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `specials`
--

INSERT INTO `specials` (`specialId`, `specialName`, `specialType`, `specialPrice`, `specialInfo`, `specialImg`, `startTime`, `finishTime`, `productID`) VALUES
(1, NULL, 1, 30, 'Meet your massive deals here', 'liquor17.jpg', NULL, NULL, NULL),
(3, NULL, 1, 13, '2+1 Event! get you authentic liquor', 'liquor1.jpg', NULL, NULL, NULL),
(51, 'dada', 1, 200, 'Check', 'liquor3.jpg', NULL, NULL, NULL),
(54, 'James... Damn Speical', 1, 500, 'Check this out Yash!!!', 'liquor3.jpg', NULL, NULL, NULL),
(36, 'Sawmill Signiture', 2, 9.5, '2+1= Event! check your cart', 'coolslight.png', NULL, NULL, 10003),
(47, 'Tranditional Blond', 2, 10.5, 'Traditional house beer with no 20% off', 'traditionalblond.png', NULL, NULL, 10013),
(38, 'Asahi light', 2, 7.5, 'text input', 'asahi.png', NULL, NULL, 10004),
(53, 'punky brew Classic', 2, 6.5, 'James Damn!!', 'punk.png', NULL, NULL, 10015),
(41, 'Asahi can', 2, 6.5, 'Authentic Japanese beer Event\r\nfine more now!', 'asahican.png', NULL, NULL, 10005);

-- --------------------------------------------------------

--
-- Table structure for table `stocklist`
--

DROP TABLE IF EXISTS `stocklist`;
CREATE TABLE IF NOT EXISTS `stocklist` (
  `listIndex` int(20) NOT NULL AUTO_INCREMENT,
  `productID` int(20) NOT NULL,
  `quantity` int(20) DEFAULT NULL,
  `whID` int(20) NOT NULL,
  PRIMARY KEY (`listIndex`),
  KEY `productID` (`productID`),
  KEY `whID` (`whID`)
) ENGINE=MyISAM AUTO_INCREMENT=342 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stocklist`
--

INSERT INTO `stocklist` (`listIndex`, `productID`, `quantity`, `whID`) VALUES
(1, 10003, NULL, 1),
(2, 10003, NULL, 2),
(3, 10003, NULL, 3),
(4, 10003, NULL, 4),
(5, 10003, NULL, 5),
(6, 10003, NULL, 6),
(7, 10003, NULL, 7),
(8, 10003, NULL, 8),
(9, 10003, NULL, 9),
(10, 10003, NULL, 10),
(11, 10003, NULL, 11),
(12, 10004, NULL, 1),
(13, 10004, NULL, 2),
(14, 10004, NULL, 3),
(15, 10004, NULL, 4),
(16, 10004, NULL, 5),
(17, 10004, NULL, 6),
(18, 10004, NULL, 7),
(19, 10004, NULL, 8),
(20, 10004, NULL, 9),
(21, 10004, NULL, 10),
(22, 10004, NULL, 11),
(23, 10005, NULL, 1),
(24, 10005, NULL, 2),
(25, 10005, NULL, 3),
(26, 10005, NULL, 4),
(27, 10005, NULL, 5),
(28, 10005, NULL, 6),
(29, 10005, NULL, 7),
(30, 10005, NULL, 8),
(31, 10005, NULL, 9),
(32, 10005, NULL, 10),
(33, 10005, NULL, 11),
(34, 10006, NULL, 1),
(35, 10006, NULL, 2),
(36, 10006, NULL, 3),
(37, 10006, NULL, 4),
(38, 10006, NULL, 5),
(39, 10006, NULL, 6),
(40, 10006, NULL, 7),
(41, 10006, NULL, 8),
(42, 10006, NULL, 9),
(43, 10006, NULL, 10),
(44, 10006, NULL, 11),
(45, 10007, NULL, 1),
(46, 10007, NULL, 2),
(47, 10007, NULL, 3),
(48, 10007, NULL, 4),
(49, 10007, NULL, 5),
(50, 10007, NULL, 6),
(51, 10007, NULL, 7),
(52, 10007, NULL, 8),
(53, 10007, NULL, 9),
(54, 10007, NULL, 10),
(55, 10007, NULL, 11),
(56, 10009, NULL, 1),
(57, 10009, NULL, 2),
(58, 10009, NULL, 3),
(59, 10009, NULL, 4),
(60, 10009, NULL, 5),
(61, 10009, NULL, 6),
(62, 10009, NULL, 7),
(63, 10009, NULL, 8),
(64, 10009, NULL, 9),
(65, 10009, NULL, 10),
(66, 10009, NULL, 11),
(67, 10010, NULL, 1),
(68, 10010, NULL, 2),
(69, 10010, NULL, 3),
(70, 10010, NULL, 4),
(71, 10010, NULL, 5),
(72, 10010, NULL, 6),
(73, 10010, NULL, 7),
(74, 10010, NULL, 8),
(75, 10010, NULL, 9),
(76, 10010, NULL, 10),
(77, 10010, NULL, 11),
(78, 10011, NULL, 1),
(79, 10011, NULL, 2),
(80, 10011, NULL, 3),
(81, 10011, NULL, 4),
(82, 10011, NULL, 5),
(83, 10011, NULL, 6),
(84, 10011, NULL, 7),
(85, 10011, NULL, 8),
(86, 10011, NULL, 9),
(87, 10011, NULL, 10),
(88, 10011, NULL, 11),
(89, 10012, NULL, 1),
(90, 10012, NULL, 2),
(91, 10012, NULL, 3),
(92, 10012, NULL, 4),
(93, 10012, NULL, 5),
(94, 10012, NULL, 6),
(95, 10012, NULL, 7),
(96, 10012, NULL, 8),
(97, 10012, NULL, 9),
(98, 10012, NULL, 10),
(99, 10012, NULL, 11),
(100, 10013, NULL, 1),
(101, 10013, NULL, 2),
(102, 10013, NULL, 3),
(103, 10013, NULL, 4),
(104, 10013, NULL, 5),
(105, 10013, NULL, 6),
(106, 10013, NULL, 7),
(107, 10013, NULL, 8),
(108, 10013, NULL, 9),
(109, 10013, NULL, 10),
(110, 10013, NULL, 11),
(111, 10014, NULL, 1),
(112, 10014, NULL, 2),
(113, 10014, NULL, 3),
(114, 10014, NULL, 4),
(115, 10014, NULL, 5),
(116, 10014, NULL, 6),
(117, 10014, NULL, 7),
(118, 10014, NULL, 8),
(119, 10014, NULL, 9),
(120, 10014, NULL, 10),
(121, 10014, NULL, 11),
(122, 10015, NULL, 1),
(123, 10015, NULL, 2),
(124, 10015, NULL, 3),
(125, 10015, NULL, 4),
(126, 10015, NULL, 5),
(127, 10015, NULL, 6),
(128, 10015, NULL, 7),
(129, 10015, NULL, 8),
(130, 10015, NULL, 9),
(131, 10015, NULL, 10),
(132, 10015, NULL, 11),
(133, 10003, NULL, 1),
(134, 10003, NULL, 2),
(135, 10003, NULL, 3),
(136, 10003, NULL, 4),
(137, 10003, NULL, 5),
(138, 10003, NULL, 6),
(139, 10003, NULL, 7),
(140, 10003, NULL, 8),
(141, 10003, NULL, 9),
(142, 10003, NULL, 10),
(143, 10003, NULL, 11),
(144, 10004, NULL, 1),
(145, 10004, NULL, 2),
(146, 10004, NULL, 3),
(147, 10004, NULL, 4),
(148, 10004, NULL, 5),
(149, 10004, NULL, 6),
(150, 10004, NULL, 7),
(151, 10004, NULL, 8),
(152, 10004, NULL, 9),
(153, 10004, NULL, 10),
(154, 10004, NULL, 11),
(155, 10005, NULL, 1),
(156, 10005, NULL, 2),
(157, 10005, NULL, 3),
(158, 10005, NULL, 4),
(159, 10005, NULL, 5),
(160, 10005, NULL, 6),
(161, 10005, NULL, 7),
(162, 10005, NULL, 8),
(163, 10005, NULL, 9),
(164, 10005, NULL, 10),
(165, 10005, NULL, 11),
(166, 10006, NULL, 1),
(167, 10006, NULL, 2),
(168, 10006, NULL, 3),
(169, 10006, NULL, 4),
(170, 10006, NULL, 5),
(171, 10006, NULL, 6),
(172, 10006, NULL, 7),
(173, 10006, NULL, 8),
(174, 10006, NULL, 9),
(175, 10006, NULL, 10),
(176, 10006, NULL, 11),
(177, 10007, NULL, 1),
(178, 10007, NULL, 2),
(179, 10007, NULL, 3),
(180, 10007, NULL, 4),
(181, 10007, NULL, 5),
(182, 10007, NULL, 6),
(183, 10007, NULL, 7),
(184, 10007, NULL, 8),
(185, 10007, NULL, 9),
(186, 10007, NULL, 10),
(187, 10007, NULL, 11),
(188, 10009, NULL, 1),
(189, 10009, NULL, 2),
(190, 10009, NULL, 3),
(191, 10009, NULL, 4),
(192, 10009, NULL, 5),
(193, 10009, NULL, 6),
(194, 10009, NULL, 7),
(195, 10009, NULL, 8),
(196, 10009, NULL, 9),
(197, 10009, NULL, 10),
(198, 10009, NULL, 11),
(199, 10010, NULL, 1),
(200, 10010, NULL, 2),
(201, 10010, NULL, 3),
(202, 10010, NULL, 4),
(203, 10010, NULL, 5),
(204, 10010, NULL, 6),
(205, 10010, NULL, 7),
(206, 10010, NULL, 8),
(207, 10010, NULL, 9),
(208, 10010, NULL, 10),
(209, 10010, NULL, 11),
(210, 10011, NULL, 1),
(211, 10011, NULL, 2),
(212, 10011, NULL, 3),
(213, 10011, NULL, 4),
(214, 10011, NULL, 5),
(215, 10011, NULL, 6),
(216, 10011, NULL, 7),
(217, 10011, NULL, 8),
(218, 10011, NULL, 9),
(219, 10011, NULL, 10),
(220, 10011, NULL, 11),
(221, 10012, NULL, 1),
(222, 10012, NULL, 2),
(223, 10012, NULL, 3),
(224, 10012, NULL, 4),
(225, 10012, NULL, 5),
(226, 10012, NULL, 6),
(227, 10012, NULL, 7),
(228, 10012, NULL, 8),
(229, 10012, NULL, 9),
(230, 10012, NULL, 10),
(231, 10012, NULL, 11),
(232, 10013, NULL, 1),
(233, 10013, NULL, 2),
(234, 10013, NULL, 3),
(235, 10013, NULL, 4),
(236, 10013, NULL, 5),
(237, 10013, NULL, 6),
(238, 10013, NULL, 7),
(239, 10013, NULL, 8),
(240, 10013, NULL, 9),
(241, 10013, NULL, 10),
(242, 10013, NULL, 11),
(243, 10014, NULL, 1),
(244, 10014, NULL, 2),
(245, 10014, NULL, 3),
(246, 10014, NULL, 4),
(247, 10014, NULL, 5),
(248, 10014, NULL, 6),
(249, 10014, NULL, 7),
(250, 10014, NULL, 8),
(251, 10014, NULL, 9),
(252, 10014, NULL, 10),
(253, 10014, NULL, 11),
(254, 10015, NULL, 1),
(255, 10015, NULL, 2),
(256, 10015, NULL, 3),
(257, 10015, NULL, 4),
(258, 10015, NULL, 5),
(259, 10015, NULL, 6),
(260, 10015, NULL, 7),
(261, 10015, NULL, 8),
(262, 10015, NULL, 9),
(263, 10015, NULL, 10),
(264, 10015, NULL, 11),
(265, 10016, NULL, 1),
(266, 10016, NULL, 2),
(267, 10016, NULL, 3),
(268, 10016, NULL, 4),
(269, 10016, NULL, 5),
(270, 10016, NULL, 6),
(271, 10016, NULL, 7),
(272, 10016, NULL, 8),
(273, 10016, NULL, 9),
(274, 10016, NULL, 10),
(275, 10016, NULL, 11),
(276, 10017, NULL, 1),
(277, 10017, NULL, 2),
(278, 10017, NULL, 3),
(279, 10017, NULL, 4),
(280, 10017, NULL, 5),
(281, 10017, NULL, 6),
(282, 10017, NULL, 7),
(283, 10017, NULL, 8),
(284, 10017, NULL, 9),
(285, 10017, NULL, 10),
(286, 10017, NULL, 11),
(287, 10018, NULL, 1),
(288, 10018, NULL, 2),
(289, 10018, NULL, 3),
(290, 10018, NULL, 4),
(291, 10018, NULL, 5),
(292, 10018, NULL, 6),
(293, 10018, NULL, 7),
(294, 10018, NULL, 8),
(295, 10018, NULL, 9),
(296, 10018, NULL, 10),
(297, 10018, NULL, 11),
(298, 10019, NULL, 1),
(299, 10019, NULL, 2),
(300, 10019, NULL, 3),
(301, 10019, NULL, 4),
(302, 10019, NULL, 5),
(303, 10019, NULL, 6),
(304, 10019, NULL, 7),
(305, 10019, NULL, 8),
(306, 10019, NULL, 9),
(307, 10019, NULL, 10),
(308, 10019, NULL, 11),
(309, 10020, NULL, 1),
(310, 10020, NULL, 2),
(311, 10020, NULL, 3),
(312, 10020, NULL, 4),
(313, 10020, NULL, 5),
(314, 10020, NULL, 6),
(315, 10020, NULL, 7),
(316, 10020, NULL, 8),
(317, 10020, NULL, 9),
(318, 10020, NULL, 10),
(319, 10020, NULL, 11),
(320, 10021, NULL, 1),
(321, 10021, NULL, 2),
(322, 10021, NULL, 3),
(323, 10021, NULL, 4),
(324, 10021, NULL, 5),
(325, 10021, NULL, 6),
(326, 10021, NULL, 7),
(327, 10021, NULL, 8),
(328, 10021, NULL, 9),
(329, 10021, NULL, 10),
(330, 10021, NULL, 11),
(331, 10022, NULL, 1),
(332, 10022, NULL, 2),
(333, 10022, NULL, 3),
(334, 10022, NULL, 4),
(335, 10022, NULL, 5),
(336, 10022, NULL, 6),
(337, 10022, NULL, 7),
(338, 10022, NULL, 8),
(339, 10022, NULL, 9),
(340, 10022, NULL, 10),
(341, 10022, NULL, 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(20) NOT NULL AUTO_INCREMENT,
  `typeID` int(20) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `companyName` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`userID`),
  KEY `typeID` (`typeID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `typeID`, `firstName`, `lastName`, `companyName`, `password`, `email`, `phone`, `address`) VALUES
(1, 3, 'James', 'Zhang', '', '123', 'junboz598@gmail.com', 1234123412, NULL),
(2, 0, 'test', 't', 't', '123', '18622271672@163.com', 34673345, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

DROP TABLE IF EXISTS `usertype`;
CREATE TABLE IF NOT EXISTS `usertype` (
  `typeID` int(20) NOT NULL AUTO_INCREMENT,
  `typeName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`typeID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`typeID`, `typeName`) VALUES
(1, 'Branch warehouse'),
(2, 'Business partner'),
(3, 'Individual');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

DROP TABLE IF EXISTS `warehouse`;
CREATE TABLE IF NOT EXISTS `warehouse` (
  `whID` int(20) NOT NULL AUTO_INCREMENT,
  `typeID` int(20) DEFAULT NULL,
  `whName` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`whID`),
  KEY `typeID` (`typeID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`whID`, `typeID`, `whName`, `address`, `phone`, `email`) VALUES
(1, 1, 'CBD', '6hobson', 0, 'hamfd@gmail.com'),
(2, 1, '4575abd', '1234567', 252144, 'abd@gmail.com'),
(3, 1, 'Newmarket', '7symonds', 252144, 'abd@gmail.com'),
(4, 1, 'Takapuna', 'bowman456', 252144, 'abd@gmail.com'),
(5, 1, 'Albany', '185 archers', 252144, 'abd@gmail.com'),
(6, 1, '6666', '2 asdf', 12341234, 'asdf@asdf.com'),
(7, 1, '7777', '45 Asdsdf', 1234567234, '23sdff@asdf.com'),
(8, 1, '8888', '75 wert', 12456734, '2435asdf@asdf.com'),
(9, 1, '9999', '67 zxcv', 12345234, '34534@asdf.com'),
(10, 1, '1010', '23 asdf', 15878834, '234sdf@asdf.com'),
(11, 1, '1010', '23 fdfddf', 2108216229, 'ham@asdf.com');

-- --------------------------------------------------------

--
-- Table structure for table `warehousetype`
--

DROP TABLE IF EXISTS `warehousetype`;
CREATE TABLE IF NOT EXISTS `warehousetype` (
  `typeID` int(20) NOT NULL AUTO_INCREMENT,
  `typeName` varchar(45) NOT NULL,
  PRIMARY KEY (`typeID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `warehousetype`
--

INSERT INTO `warehousetype` (`typeID`, `typeName`) VALUES
(1, 'branch');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
