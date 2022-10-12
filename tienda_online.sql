-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2022 at 06:38 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tienda_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `Id` int(11) NOT NULL,
  `Nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  `Activo` int(11) NOT NULL,
  `Descuento` tinyint(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`Id`, `Nombre`, `Descripcion`, `Precio`, `IdCategoria`, `Activo`, `Descuento`) VALUES
(1, 'Air Jordan 1 Low Se', 'Air Jordan 1 Low SE', '130.00', 1, 1, 8),
(2, 'Air Jordan 1 Mid', 'Air Jordan 1 Mid', '120.00', 1, 1, 10),
(3, 'Air Jordan 1 Utility', 'Air Jordan 1 Utility', '140.00', 1, 1, 0),
(4, 'Air Jordan 7 Retro Q', 'Air Jordan 7 Retro Q', '210.00', 1, 1, 0),
(5, 'Air Jordan Legacy 312 Low', 'Air Jordan Legacy 312 Low', '200.00', 1, 1, 0),
(6, 'Air Jordan XXXVI Low', 'Air Jordan XXXVI Low', '190.00', 1, 1, 0),
(7, 'Zion 1', 'Zion 1', '159.99', 1, 1, 0),
(8, 'Zion 2', 'Zion 2', '149.99', 1, 1, 0),
(9, 'Nike Air Force 1 Mid React', 'Nike Air Force 1 Mid React', '149.99', 1, 1, 0),
(10, 'Nike Air Force 1 \'07', 'Nike Air Force 1 \'07.', '239.99', 1, 1, 0),
(11, 'Air Jordan 1 Mid SE', 'Air Jordan 1 Mid SE', '80.00', 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
