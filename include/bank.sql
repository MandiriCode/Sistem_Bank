-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 31, 2025 at 10:15 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `alamat_admin` varchar(255) NOT NULL,
  `email_admin` varchar(255) NOT NULL,
  `password_admin` varchar(50) NOT NULL,
  `no_telp_admin` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `alamat_admin`, `email_admin`, `password_admin`, `no_telp_admin`) VALUES
(1, 'yusrin', 'kendari', 'yusrinmongkito@gmail.com', '12345', 1213428231);

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE `nasabah` (
  `id_nasabah` int NOT NULL,
  `nama_nasabah` varchar(50) NOT NULL,
  `no_hp_nasabah` varchar(15) NOT NULL,
  `alamat_nasabah` varchar(255) NOT NULL,
  `no_rek_nasabah` int NOT NULL,
  `password_nasabah` varchar(100) NOT NULL,
  `saldo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`id_nasabah`, `nama_nasabah`, `no_hp_nasabah`, `alamat_nasabah`, `no_rek_nasabah`, `password_nasabah`, `saldo`) VALUES
(8, 'sukma', '12324', 'KEndadri', 123456, '23456', 389000),
(9, 'Yusrin', '81213428231', 'Kendari\r\n', 10101, 'yusrin123', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `tipe` enum('tambah','tarik','transfer_keluar','transfer_masuk') DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `nama_nasabah` varchar(100) DEFAULT NULL,
  `id_nasabah` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tipe`, `jumlah`, `tanggal`, `keterangan`, `nama_nasabah`, `id_nasabah`) VALUES
(17, 'tambah', 1000000, '2025-05-29 20:28:11', NULL, 'nami', 7),
(18, 'tambah', 1000000, '2025-05-29 20:28:20', NULL, 'nami', 7),
(20, 'tarik', 10000, '2025-05-29 20:32:25', NULL, 'sukma', 8),
(21, 'tarik', 100000, '2025-05-30 13:12:13', NULL, 'sukma', 8),
(22, 'tarik', 500000, '2025-05-30 13:12:21', NULL, 'sukma', 8),
(23, 'tarik', 500000, '2025-05-30 14:09:05', NULL, 'Yusrin', 9),
(24, 'transfer_keluar', 100000, '2025-05-30 14:27:09', '123456', 'Yusrin', 9),
(25, 'transfer_masuk', 100000, '2025-05-30 14:27:09', '10101', 'sukma', 8),
(26, 'tarik', 100000, '2025-05-30 14:29:29', NULL, 'Yusrin', 9),
(27, 'transfer_keluar', 100000, '2025-05-30 14:29:39', '123456', 'Yusrin', 9),
(28, 'transfer_masuk', 100000, '2025-05-30 14:29:39', '10101', 'sukma', 8),
(29, 'tarik', 100000, '2025-05-30 22:32:35', NULL, 'sukma', 8),
(30, 'tarik', 100000, '2025-05-30 18:15:36', NULL, 'Yusrin', 9),
(31, 'tarik', 100000, '2025-05-30 18:18:05', NULL, 'Yusrin', 9),
(32, 'transfer_keluar', 100000, '2025-05-30 18:28:59', '10101', 'sukma', 8),
(33, 'transfer_masuk', 100000, '2025-05-30 18:28:59', '123456', 'Yusrin', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`id_nasabah`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nasabah`
--
ALTER TABLE `nasabah`
  MODIFY `id_nasabah` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
