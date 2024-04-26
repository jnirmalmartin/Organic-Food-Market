-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2024 at 07:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logindatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product` varchar(100) NOT NULL,
  `sellerid` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customerissue`
--

CREATE TABLE `customerissue` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerissue`
--

INSERT INTO `customerissue` (`id`, `Name`, `issue`, `description`) VALUES
(1, 'shami', 'fgdfd@gmail.com', 'ffdgf'),
(2, 'shami', 'Product', 'gfhghf');

-- --------------------------------------------------------

--
-- Table structure for table `dairy`
--

CREATE TABLE `dairy` (
  `id` int(11) NOT NULL,
  `productname` varchar(100) DEFAULT NULL,
  `sellerid` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `sellerName` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fruits`
--

CREATE TABLE `fruits` (
  `id` int(11) NOT NULL,
  `productname` varchar(100) DEFAULT NULL,
  `sellerid` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `sellerName` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fruits`
--

INSERT INTO `fruits` (`id`, `productname`, `sellerid`, `price`, `sellerName`, `quantity`, `description`) VALUES
(4, 'Alphonso mangoes', '123456', 10.00, 'shdjgf', 10, 'mangoes'),
(8, 'Nagpur oranges', '123', 1.00, 'seller', 20, '123'),
(9, 'Papayas', '123456', 10.00, 'seller', 10, 'sdvaghdbs'),
(10, 'Alphonso mangoes', 'ORGSELL_813', 10.00, 'shami', 20, 'mangoes');

-- --------------------------------------------------------

--
-- Table structure for table `honey`
--

CREATE TABLE `honey` (
  `id` int(11) NOT NULL,
  `productname` varchar(100) DEFAULT NULL,
  `sellerid` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `sellerName` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meatandegg`
--

CREATE TABLE `meatandegg` (
  `id` int(11) NOT NULL,
  `productname` varchar(100) DEFAULT NULL,
  `sellerid` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `sellerName` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meatandegg`
--

INSERT INTO `meatandegg` (`id`, `productname`, `sellerid`, `price`, `sellerName`, `quantity`, `description`) VALUES
(1, 'Country chicken', 'ORGSELL_744', 10.00, 'shami', 10, 'Country Chicken');

-- --------------------------------------------------------

--
-- Table structure for table `oil`
--

CREATE TABLE `oil` (
  `id` int(11) NOT NULL,
  `productname` varchar(100) DEFAULT NULL,
  `sellerid` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `sellerName` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `cardname` varchar(100) DEFAULT NULL,
  `cardnumber` varchar(20) DEFAULT NULL,
  `cvv` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`ID`, `Name`, `email`, `address`, `city`, `state`, `pincode`, `cardname`, `cardnumber`, `cvv`) VALUES
(18, 'shami', 'fgd', 'fgd', 'gfd', 'bvc', '123456', NULL, NULL, NULL),
(19, 'shami', 'fgd@gmail.com', 'fgd', 'gfd', 'gfd', '1135', NULL, NULL, NULL),
(20, 'shami', 'fgd@gmail.com', 'fgd', 'gfd', 'ghf', '123456', NULL, NULL, NULL),
(21, 'shami', 'fgd@gmail.com', 'fgd', 'gfd', 'ghf', '123456', NULL, NULL, NULL),
(22, 'shami', 'fgd@gmail.com', 'fgd', 'gfd', 'ghf', '123456', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `paymenthistory`
--

CREATE TABLE `paymenthistory` (
  `id` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchasedate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymenthistory`
--

INSERT INTO `paymenthistory` (`id`, `userName`, `product`, `price`, `quantity`, `purchasedate`) VALUES
(4, 'shami', 'Mangoes', 10.00, 1, '2024-03-16 17:54:55'),
(5, '', 'Alphonso mangoes', 10.00, 8, '2024-03-20 21:48:56'),
(6, '', 'Papayas', 10.00, 1, '2024-03-20 21:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `saltandsugar`
--

CREATE TABLE `saltandsugar` (
  `id` int(11) NOT NULL,
  `productname` varchar(100) DEFAULT NULL,
  `sellerid` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `sellerName` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Age` int(11) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Organic_Certificate_Content` mediumblob NOT NULL,
  `sellerid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`ID`, `Name`, `Age`, `Phone`, `Address`, `Email`, `Username`, `Password`, `Organic_Certificate_Content`, `sellerid`) VALUES

-- --------------------------------------------------------

--
-- Table structure for table `sellerissue`
--
-- Error reading structure for table logindatabase.sellerissue: #1932 - Table 'logindatabase.sellerissue' doesn't exist in engine
-- Error reading data for table logindatabase.sellerissue: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `logindatabase`.`sellerissue`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Age` int(11) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Name`, `Age`, `Phone`, `Address`, `Email`, `Username`, `Password`) VALUES
(6, 'shami', 22, '6383594445', 'pallavillai', '12365@gmail.com', 'shami', 'shami');

-- --------------------------------------------------------

--
-- Table structure for table `vegetables`
--

CREATE TABLE `vegetables` (
  `id` int(11) NOT NULL,
  `productname` varchar(100) DEFAULT NULL,
  `sellerid` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `sellerName` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vegetables`
--

INSERT INTO `vegetables` (`id`, `productname`, `sellerid`, `price`, `sellerName`, `quantity`, `description`) VALUES
(3, 'tomatoes', '123', 10.00, 'seller', 20, '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerissue`
--
ALTER TABLE `customerissue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dairy`
--
ALTER TABLE `dairy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fruits`
--
ALTER TABLE `fruits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `honey`
--
ALTER TABLE `honey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meatandegg`
--
ALTER TABLE `meatandegg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oil`
--
ALTER TABLE `oil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `paymenthistory`
--
ALTER TABLE `paymenthistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saltandsugar`
--
ALTER TABLE `saltandsugar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `sellerid` (`sellerid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `vegetables`
--
ALTER TABLE `vegetables`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `customerissue`
--
ALTER TABLE `customerissue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dairy`
--
ALTER TABLE `dairy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fruits`
--
ALTER TABLE `fruits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `honey`
--
ALTER TABLE `honey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meatandegg`
--
ALTER TABLE `meatandegg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `oil`
--
ALTER TABLE `oil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `paymenthistory`
--
ALTER TABLE `paymenthistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `saltandsugar`
--
ALTER TABLE `saltandsugar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vegetables`
--
ALTER TABLE `vegetables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;