-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 12:33 PM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `footballboots`
--

CREATE TABLE `footballboots` (
  `boots_id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `producer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `footballboots`
--

INSERT INTO `footballboots` (`boots_id`, `name`, `price`, `image`, `producer_id`) VALUES
(5, ' PHANTOM LUNA II ELITE SE FG', 359, 'adidas-predator-elite-ll-removebg-preview.png', 2),
(10, 'ZOOM SUPERFLY 9 MDS ELITE FG', 264, 'nike-zoom-superfly-9-mds-elite-fg-714265-fj7186-309-removebg-preview.png', 1),
(11, 'FUTURE 7 ULTIMATE FG/AG', 246, 'puma-future-7-ultimate-fg-ag-740277-107599-07-removebg-preview.png', 3),
(12, 'X CRAZYFAST+ FG', 346, 'adidas-x-crazyfast-fg-737657-ie2416-removebg-preview.png', 2),
(13, 'PHANTOM GX II ELITE FG EH', 309, 'nike-phantom-gx-ii-elite-fg-eh-740001-hf6361-608-removebg-preview.png', 1),
(14, 'ULTRA PRO FG/AG', 235, 'puma-ultra-pro-fg-ag-741401-107750-09-removebg-preview.png', 3),
(15, 'COPA PURE 2 ELITE KT SG', 297, 'adidas-copa-pure-2-elite-kt-sg-738136-ie4981-removebg-preview.png', 2),
(16, 'PHANTOM LUNA II ELITE FG', 301, 'nike-phantom-luna-ii-elite-fg-702243-fj2572-100.png', 1),
(17, 'KING ULTIMATE FG/AG', 284, 'puma-king-ultimate-fg-ag-639076-107554-01-removebg-preview.png', 3),
(18, 'X CRAZYFAST ELITE FG MESSI', 237, 'adidas-x-crazyfast-elite-fg-messi-717870-id0710-removebg-preview.png', 2),
(19, 'ZOOM SUPERFLY 9 MDS ELITE FG', 297, 'nike-zoom-superfly-9-mds-elite-fg-677874-fd1157-608.png', 1),
(20, 'FUTURE 7 Ultimate FG/AG', 253, 'puma-future-7-ultimate-fg-ag-715669-107836-006.png', 3);

-- --------------------------------------------------------

--
-- Table structure for table `producers`
--

CREATE TABLE `producers` (
  `producer_id` int(11) NOT NULL,
  `producer_name` varchar(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `producers`
--

INSERT INTO `producers` (`producer_id`, `producer_name`) VALUES
(1, 'Nike'),
(2, 'Adidas'),
(3, 'Puma');

-- --------------------------------------------------------

--
-- Table structure for table `productscard`
--

CREATE TABLE `productscard` (
  `name` varchar(55) NOT NULL,
  `price` varchar(55) NOT NULL,
  `image` varchar(111) NOT NULL,
  `quantity` int(20) NOT NULL,
  `productscard_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reklama`
--

CREATE TABLE `reklama` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reklama`
--

INSERT INTO `reklama` (`id`, `image`) VALUES
(3, '749689-removebg-preview.png'),
(4, '750447-removebg-preview.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(6, 'Luda', 'luda@gmail.com', '$2y$10$8DJJERJIvodBho1WHnrL5OW0vJURvoyDeudqgDDtRhc1ELHHmTef2'),
(7, 'Uliana', 'zaluckaulana@gmail.com', '$2y$10$sNd9Lgu00/kDECEC3dHy5utSjnNa9IIdQ41bLvcIORMx8ODNSXOaa'),
(8, 'Bob', 'bob.smith@gmail.com', '$2y$10$f4nqz.j0/R1cUZvhs6wQmuZ1Gu/ROdSDnsXqctYp0sjbz047o5wMy'),
(9, 'Vika', 'vika@gmail.com', '$2y$10$7Okerl7RuFl5KhZsOH.R/u8Syjvm/Kgdkeo4KrEAqCS5UDtxkwpIu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `footballboots`
--
ALTER TABLE `footballboots`
  ADD PRIMARY KEY (`boots_id`),
  ADD KEY `producer_id` (`producer_id`);

--
-- Indexes for table `producers`
--
ALTER TABLE `producers`
  ADD PRIMARY KEY (`producer_id`);

--
-- Indexes for table `productscard`
--
ALTER TABLE `productscard`
  ADD PRIMARY KEY (`productscard_id`);

--
-- Indexes for table `reklama`
--
ALTER TABLE `reklama`
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
-- AUTO_INCREMENT for table `footballboots`
--
ALTER TABLE `footballboots`
  MODIFY `boots_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `producers`
--
ALTER TABLE `producers`
  MODIFY `producer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `productscard`
--
ALTER TABLE `productscard`
  MODIFY `productscard_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `reklama`
--
ALTER TABLE `reklama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `footballboots`
--
ALTER TABLE `footballboots`
  ADD CONSTRAINT `footballboots_ibfk_1` FOREIGN KEY (`producer_id`) REFERENCES `producers` (`producer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
