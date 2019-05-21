-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2019 at 07:01 PM
-- Server version: 10.1.38-MariaDB-0ubuntu0.18.04.2
-- PHP Version: 7.2.17-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurante`
--

-- --------------------------------------------------------

--
-- Table structure for table `bebidas`
--

CREATE TABLE `bebidas` (
  `b_id` int(16) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `precio` double NOT NULL,
  `azucar` tinyint(1) NOT NULL DEFAULT '1',
  `alcohol` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bebidas`
--

INSERT INTO `bebidas` (`b_id`, `nombre`, `precio`, `azucar`, `alcohol`) VALUES
(3, 'Fanta', 1.5, 1, 0),
(4, 'Jaggermeister', 3.5, 1, 1),
(5, 'Paulaner', 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `complementos`
--

CREATE TABLE `complementos` (
  `c_id` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `casero` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `historial_pedidos`
--

CREATE TABLE `historial_pedidos` (
  `id_pedido` int(11) NOT NULL,
  `pedido` varchar(4096) NOT NULL,
  `fecha` datetime NOT NULL,
  `total` double NOT NULL,
  `tipo_pago` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mesas`
--

CREATE TABLE `mesas` (
  `num_mesa` int(5) NOT NULL,
  `pedido_pendiente` varchar(1024) NOT NULL,
  `pedido_listo` varchar(1024) NOT NULL,
  `pedido_servido` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mesas`
--

INSERT INTO `mesas` (`num_mesa`, `pedido_pendiente`, `pedido_listo`, `pedido_servido`) VALUES
(1, '', '', ''),
(2, '', '', ''),
(3, '', '', ''),
(4, '', '', ''),
(5, '', '', ''),
(6, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `platos`
--

CREATE TABLE `platos` (
  `p_id` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `precio` double NOT NULL,
  `ingredientes` varchar(512) NOT NULL,
  `gluten` tinyint(1) NOT NULL DEFAULT '1',
  `lacteos` tinyint(1) NOT NULL DEFAULT '0',
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `item_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `tipo` varchar(512) NOT NULL,
  `minimo_notificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bebidas`
--
ALTER TABLE `bebidas`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `complementos`
--
ALTER TABLE `complementos`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `historial_pedidos`
--
ALTER TABLE `historial_pedidos`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indexes for table `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`num_mesa`);

--
-- Indexes for table `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bebidas`
--
ALTER TABLE `bebidas`
  MODIFY `b_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `complementos`
--
ALTER TABLE `complementos`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `historial_pedidos`
--
ALTER TABLE `historial_pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `platos`
--
ALTER TABLE `platos`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
