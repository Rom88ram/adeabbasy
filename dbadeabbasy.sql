-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2023 at 02:59 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbadeabbasy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password_2` varchar(200) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `username`, `password_2`, `nama`, `email`) VALUES
(1, 'romi', 'romi123', 'Romi Ramadhan', 'ramadhanromi77@gmail.com'),
(2, 'admin1', 'admin123', 'admin 1', 'admintest1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `idcustomer` int(10) UNSIGNED NOT NULL,
  `nama_cust` varchar(200) DEFAULT NULL,
  `alamat_cust` varchar(450) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`idcustomer`, `nama_cust`, `alamat_cust`, `no_hp`, `email`, `pass`) VALUES
(1, 'Testing 1', 'Solo', '08912922', 'test1@tesmail.com', 'tes1'),
(3, 'Testing 2', 'Solo', '084212379', 'test2@gmail.com', 'tes2'),
(4, 'romi', 'Solo', '081247743', 'romi@gmail.com', '123'),
(9, 'tes3', 'Solo', '082244444', 'tes3@gmail.com', 'tes3'),
(10, 'tes4', 'Solo', '082218246', 'tes4@gmail.com', 'tes4'),
(11, 'Ari', 'Solo', '082090421', 'arix@gmail.com', '123'),
(12, 'Jon', 'Solo', '08141412', 'Jon@gmail.com', '123'),
(13, 'romi', 'Solo', '0824134', 'romi123@gmail.com', '123'),
(14, 'dian', 'Solo', '082414242', 'dian@gmail.com', '123'),
(15, 'Rey2', 'Solo', '082314214', 'rey2@gmail.com', '123'),
(16, 'tesX', 'tesX', '0284124', 'fjdewkf@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `paket_layanan`
--

CREATE TABLE `paket_layanan` (
  `idpaket` int(10) UNSIGNED NOT NULL,
  `nama_paket` varchar(45) DEFAULT NULL,
  `deskripsi_paket` varchar(200) DEFAULT NULL,
  `harga_paket` int(10) UNSIGNED DEFAULT NULL,
  `gambar_paket` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket_layanan`
--

INSERT INTO `paket_layanan` (`idpaket`, `nama_paket`, `deskripsi_paket`, `harga_paket`, `gambar_paket`) VALUES
(1, 'Wedding 1', 'Dekorasi keseluruhan simple termasuk pelaminan, tenda, akad, dan gerbang pintu masuk.', 8500000, 'card1.jpg'),
(2, 'Wedding 2', 'Dekorasi keseluruhan mewah termasuk pelaminan, tenda, akad, dan gerbang pintu masuk.', 9500000, 'card2.jpg'),
(5, 'Tasyakuran', 'Dekorasi khusus untuk event Tasyakuran dan Siraman.', 1500000, 'tasyakrn.jpg'),
(6, 'Aqiqah', 'Dekorasi untuk acara Tasmiyah dan Aqiqah anak.', 1500000, 'aqiqah.jpg'),
(7, 'Ulang Tahun', 'Dekorasi untuk acara ulang tahun event birthday party.', 1500000, 'ultah.jpg'),
(8, 'Event Lainnya', 'Dekorasi untuk acara lainnya seperti wisuda dll.', 1500000, 'evntlain.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `idpembayaran` int(10) UNSIGNED NOT NULL,
  `pesanan_idpesanan` int(10) UNSIGNED NOT NULL,
  `bukti_bayar` varchar(200) DEFAULT NULL,
  `tanggal_konfirmasi` date DEFAULT NULL,
  `status_bayar` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`idpembayaran`, `pesanan_idpesanan`, `bukti_bayar`, `tanggal_konfirmasi`, `status_bayar`) VALUES
(1, 1, '64be8026b76dd.jpeg', '2023-05-25', 'Sudah Dibayar'),
(9, 9, '64be803a9bcaf.jpeg', '2023-06-05', 'Sudah Dibayar'),
(22, 22, '64be804b254a0.jpeg', '2023-07-31', 'Belum Dibayar'),
(23, 23, '64ba4aaa9ee64.jpg', '0000-00-00', 'Belum Dibayar'),
(26, 26, '64d5a9b692bf7.jpeg', '2023-08-11', 'Sudah Dibayar'),
(28, 28, '64d75ba036032.jpeg', '0000-00-00', 'Belum Dibayar'),
(32, 32, '64d87bbbe5027.jpeg', '0000-00-00', 'Belum Dibayar'),
(33, 33, 'none', '0000-00-00', 'Belum Dibayar');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `idpesanan` int(10) UNSIGNED NOT NULL,
  `paket_layanan_idpaket` int(10) UNSIGNED NOT NULL,
  `customer_idcustomer` int(10) UNSIGNED NOT NULL,
  `tambahan_idtambahan` int(10) UNSIGNED NOT NULL,
  `tanggal_pesanan` date DEFAULT NULL,
  `tanggal_acara` date DEFAULT NULL,
  `total_harga` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`idpesanan`, `paket_layanan_idpaket`, `customer_idcustomer`, `tambahan_idtambahan`, `tanggal_pesanan`, `tanggal_acara`, `total_harga`) VALUES
(1, 7, 1, 2, '2023-05-15', '2023-05-23', 1600000),
(9, 6, 3, 2, '2023-05-30', '2023-06-10', 1600000),
(22, 8, 3, 6, '2023-06-26', '2023-06-30', 1500000),
(23, 6, 10, 6, '2023-07-21', '2023-07-30', 1500000),
(26, 1, 13, 6, '2023-08-11', '2023-08-31', 8500000),
(28, 1, 3, 2, '2023-08-12', '2023-08-23', 8600000),
(32, 2, 3, 2, '2023-08-13', '2023-09-08', 9600000),
(33, 7, 11, 1, '2023-08-13', '2023-09-26', 1600000);

-- --------------------------------------------------------

--
-- Table structure for table `tambahan`
--

CREATE TABLE `tambahan` (
  `idtambahan` int(10) UNSIGNED NOT NULL,
  `nama_tambahan` varchar(150) NOT NULL,
  `deskripsi_tambahan` varchar(250) NOT NULL,
  `harga_tambahan` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tambahan`
--

INSERT INTO `tambahan` (`idtambahan`, `nama_tambahan`, `deskripsi_tambahan`, `harga_tambahan`) VALUES
(1, 'Dekorasi Lampu', 'Berupa penambahan dekorasi lampu untuk menambah nilai estetik.', 100000),
(2, 'Dekorasi Balon', 'Berupa penambahan dekorasi balon untuk menambah nilai estetik.', 100000),
(6, 'Tanpa Tambahan', 'Tidak memakai tambahan', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`idcustomer`);

--
-- Indexes for table `paket_layanan`
--
ALTER TABLE `paket_layanan`
  ADD PRIMARY KEY (`idpaket`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`idpembayaran`),
  ADD KEY `pembayaran_ibfk_1` (`pesanan_idpesanan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`idpesanan`),
  ADD UNIQUE KEY `pesanan_tgla` (`tanggal_acara`),
  ADD KEY `pesanan_FKIndex1` (`customer_idcustomer`),
  ADD KEY `pesanan_FKIndex2` (`paket_layanan_idpaket`),
  ADD KEY `pesanan_ibfk_3` (`tambahan_idtambahan`);

--
-- Indexes for table `tambahan`
--
ALTER TABLE `tambahan`
  ADD PRIMARY KEY (`idtambahan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `idcustomer` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `paket_layanan`
--
ALTER TABLE `paket_layanan`
  MODIFY `idpaket` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `idpesanan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tambahan`
--
ALTER TABLE `tambahan`
  MODIFY `idtambahan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`pesanan_idpesanan`) REFERENCES `pesanan` (`idpesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`customer_idcustomer`) REFERENCES `customer` (`idcustomer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`paket_layanan_idpaket`) REFERENCES `paket_layanan` (`idpaket`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`tambahan_idtambahan`) REFERENCES `tambahan` (`idtambahan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
