-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 26, 2023 at 05:30 PM
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
-- Database: `barang_k3lh`
--

-- --------------------------------------------------------

--
-- Table structure for table `management`
--

CREATE TABLE `management` (
  `id_management` int(11) NOT NULL,
  `nik` varchar(100) DEFAULT NULL,
  `otoritas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `management`
--

INSERT INTO `management` (`id_management`, `nik`, `otoritas`) VALUES
(1, '714220005-M Fachriza Farhan', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `kode_stock` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `jumlah_stock` int(11) DEFAULT 0,
  `satuan` varchar(10) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id_stock`, `kode_stock`, `nama_barang`, `jumlah_stock`, `satuan`, `foto`, `deskripsi`) VALUES
(1, 'A0001', 'Masker Medis', 0, 'pcs', '64ba63e65cc46.jpeg', 'test'),
(2, 'HG0001', 'Parfum', 35, 'kg', '64bb640ad8273.jpeg', 'Tes aja sih'),
(3, 'GH002', 'Sepatu Boot Karet', 5, 'box', '64bb691207167.jpeg', 'Tes lagi');

-- --------------------------------------------------------

--
-- Table structure for table `stok_keluar`
--

CREATE TABLE `stok_keluar` (
  `id_keluar` int(11) NOT NULL,
  `id_stock` int(11) DEFAULT NULL,
  `id_management` int(11) DEFAULT NULL,
  `jumlah_stock` int(11) DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_keluar`
--

INSERT INTO `stok_keluar` (`id_keluar`, `id_stock`, `id_management`, `jumlah_stock`, `satuan`, `tanggal_keluar`) VALUES
(1, 1, 1, 5, 'pcs', '2023-07-22');

-- --------------------------------------------------------

--
-- Table structure for table `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `id_masuk` int(11) NOT NULL,
  `id_stock` int(11) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `satuan` varchar(10) DEFAULT NULL,
  `keterangan` text NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_masuk`
--

INSERT INTO `stok_masuk` (`id_masuk`, `id_stock`, `tanggal_masuk`, `jumlah`, `satuan`, `keterangan`, `foto`) VALUES
(8, 2, '2023-07-15', 10, 'box', 'Test ubah', ''),
(11, 2, '2023-07-25', 20, 'pcs', 'Test', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nik`, `password`) VALUES
(1, '123456789', '$2y$10$/FwCbsWTdm2O4zlengXBw.otBNSJ7NLLC2oz72AO6c0ETpRmjXN0a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `management`
--
ALTER TABLE `management`
  ADD PRIMARY KEY (`id_management`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`);

--
-- Indexes for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `id_management` (`id_management`),
  ADD KEY `id_stock` (`id_stock`);

--
-- Indexes for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `id_stock` (`id_stock`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `management`
--
ALTER TABLE `management`
  MODIFY `id_management` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD CONSTRAINT `stok_keluar_ibfk_1` FOREIGN KEY (`id_management`) REFERENCES `management` (`id_management`),
  ADD CONSTRAINT `stok_keluar_ibfk_2` FOREIGN KEY (`id_stock`) REFERENCES `stock` (`id_stock`);

--
-- Constraints for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD CONSTRAINT `stok_masuk_ibfk_1` FOREIGN KEY (`id_stock`) REFERENCES `stock` (`id_stock`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
