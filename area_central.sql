-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2020 at 04:03 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `area_central`
--

-- --------------------------------------------------------

--
-- Table structure for table `z_com_tb_produtos`
--

CREATE TABLE `z_com_tb_produtos` (
  `id_produto` int(11) NOT NULL,
  `nome_produto` varchar(50) DEFAULT NULL,
  `valor_produto` decimal(10,2) DEFAULT 0.00,
  `qtd_produto` int(11) DEFAULT NULL,
  `data_ultima_venda` datetime DEFAULT NULL,
  `valor_total_venda` decimal(10,2) DEFAULT 0.00,
  `codigo_barra` text DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `z_com_tb_produtos`
--

INSERT INTO `z_com_tb_produtos` (`id_produto`, `nome_produto`, `valor_produto`, `qtd_produto`, `data_ultima_venda`, `valor_total_venda`, `codigo_barra`, `created`, `modified`, `status`) VALUES
(1, 'Arroz', '1.99', 29, '2020-12-18 09:51:55', '19.90', '789123456000', '2020-12-16 05:17:28', '2020-12-18 10:17:08', 1),
(4, 'Feijao', '3.99', 23, NULL, '0.00', '9999848984984', '2020-12-18 04:35:34', '2020-12-18 10:35:39', 1),
(5, 'Batata Doce', '1.99', 16, NULL, '0.00', '789123654000', '2020-12-18 04:51:57', '2020-12-18 10:35:15', 1),
(6, 'Batata', '2.49', 31, NULL, '0.00', '7818912313', '2020-12-18 04:52:01', '2020-12-18 05:47:34', 1),
(7, 'Coca-Cola 2Lt.', '8.99', 108, '2020-12-18 10:09:31', '107.88', '78913521321000', '2020-12-18 10:08:57', '2020-12-18 10:48:44', 2),
(8, 'Picanha 1kg', '59.99', 33, NULL, '0.00', '11010100065461', '2020-12-18 10:11:40', '2020-12-18 10:32:25', 1),
(9, 'Cerveja Brahma Long Neck 500ml', '6.99', 299, NULL, '0.00', '7987987978798', '2020-12-18 10:13:00', '2020-12-18 10:35:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `z_com_tb_produto_vendido`
--

CREATE TABLE `z_com_tb_produto_vendido` (
  `id_produto_vendido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `valor_produto` decimal(10,2) DEFAULT 0.00,
  `qtd_produto_vendido` int(11) DEFAULT NULL,
  `data_ultima_venda` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `valor_total_venda` decimal(10,2) DEFAULT 0.00,
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `z_com_tb_produto_vendido`
--

INSERT INTO `z_com_tb_produto_vendido` (`id_produto_vendido`, `id_produto`, `valor_produto`, `qtd_produto_vendido`, `data_ultima_venda`, `valor_total_venda`, `modified`) VALUES
(1, 1, '1.99', 10, '2020-12-18 09:51:55', '19.90', NULL),
(2, 7, '8.99', 12, '2020-12-18 10:09:31', '107.88', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `z_com_tb_produtos`
--
ALTER TABLE `z_com_tb_produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Indexes for table `z_com_tb_produto_vendido`
--
ALTER TABLE `z_com_tb_produto_vendido`
  ADD PRIMARY KEY (`id_produto_vendido`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `z_com_tb_produtos`
--
ALTER TABLE `z_com_tb_produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `z_com_tb_produto_vendido`
--
ALTER TABLE `z_com_tb_produto_vendido`
  MODIFY `id_produto_vendido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
