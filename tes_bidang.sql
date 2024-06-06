-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 09:41 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tes_bidang`
--

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `idjabatan` int(11) NOT NULL COMMENT 'id tabel jabatan',
  `nama_jabatan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tanggal_input` datetime NOT NULL DEFAULT current_timestamp(),
  `status_jabatan` char(1) NOT NULL DEFAULT 'Y' COMMENT 'Y=aktif N=nonaktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`idjabatan`, `nama_jabatan`, `tanggal_input`, `status_jabatan`) VALUES
(1, 'Staff', '2024-06-06 13:16:41', 'Y'),
(2, 'Manager', '2024-06-06 13:18:18', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `kontrak`
--

CREATE TABLE `kontrak` (
  `idkontrak` int(11) NOT NULL COMMENT 'id tabel kontrak',
  `idpegawai` int(11) NOT NULL COMMENT 'index idpegawai.pegawai',
  `idjabatan` int(11) NOT NULL COMMENT 'index idjabatan.jabatan',
  `tanggal_input` datetime NOT NULL DEFAULT current_timestamp(),
  `mulai_kontrak` datetime DEFAULT NULL,
  `lama_kontrak` int(11) NOT NULL COMMENT 'satuan dalam hari',
  `selesai_kontrak` datetime DEFAULT NULL,
  `status_kontrak` char(1) NOT NULL DEFAULT 'Y' COMMENT 'Y=aktif N=nonaktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kontrak`
--

INSERT INTO `kontrak` (`idkontrak`, `idpegawai`, `idjabatan`, `tanggal_input`, `mulai_kontrak`, `lama_kontrak`, `selesai_kontrak`, `status_kontrak`) VALUES
(1, 2, 1, '2024-06-06 13:39:59', '0000-00-00 00:00:00', -259199, '0000-00-00 00:00:00', 'N'),
(2, 2, 1, '2024-06-06 13:41:22', '2024-06-08 00:00:00', -2764799, '2024-07-09 23:59:59', 'N'),
(3, 2, 1, '2024-06-06 13:42:13', '2024-06-06 00:00:00', 1717586912, '2024-06-13 23:59:59', 'N'),
(4, 2, 1, '2024-06-06 13:47:14', '2024-06-08 00:00:00', 8, '2024-06-15 23:59:59', 'Y'),
(5, 2, 1, '2024-06-06 13:48:02', '2024-06-01 00:00:00', 8, '2024-06-08 23:59:59', 'Y'),
(6, 3, 1, '2024-06-06 13:48:43', '2024-06-01 00:00:00', 2, '2024-06-02 23:59:59', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `idpegawai` int(11) NOT NULL COMMENT 'id tabel pegawai',
  `nama_pegawai` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `alamat_pegawai` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email_pegawai` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tanggal_input` datetime NOT NULL DEFAULT current_timestamp(),
  `status_pegawai` char(1) NOT NULL DEFAULT 'Y' COMMENT 'Y=aktif N=nonaktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`idpegawai`, `nama_pegawai`, `alamat_pegawai`, `email_pegawai`, `tanggal_input`, `status_pegawai`) VALUES
(1, 'sad3', 'dsa3', 'asd@asd.ads3', '2024-06-06 13:01:03', 'N'),
(2, 'sad1', 'dsa1', 'asd@asd.ads1', '2024-06-06 13:12:04', 'Y'),
(3, 'sad2', 'dsa2', 'asd@asd.ads2', '2024-06-06 13:12:39', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`idjabatan`);

--
-- Indexes for table `kontrak`
--
ALTER TABLE `kontrak`
  ADD PRIMARY KEY (`idkontrak`),
  ADD KEY `idpegawai` (`idpegawai`),
  ADD KEY `idjabatan` (`idjabatan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`idpegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `idjabatan` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id tabel jabatan', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kontrak`
--
ALTER TABLE `kontrak`
  MODIFY `idkontrak` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id tabel kontrak', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `idpegawai` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id tabel pegawai', AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
