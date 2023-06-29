-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 04:53 PM
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
-- Database: `apotek_syifa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_batch`
--

CREATE TABLE `tb_batch` (
  `id` int(11) NOT NULL,
  `obat_id` int(11) DEFAULT NULL,
  `no_batch` varchar(45) DEFAULT NULL,
  `tgl_exp` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_det_pembelian`
--

CREATE TABLE `tb_det_pembelian` (
  `id` varchar(45) NOT NULL,
  `obat_id` int(11) NOT NULL,
  `pembelian_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `satuan_id` int(11) NOT NULL,
  `harga` double DEFAULT NULL,
  `diskon` int(11) NOT NULL,
  `potongan` double DEFAULT NULL,
  `bayar` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_det_penjualan`
--

CREATE TABLE `tb_det_penjualan` (
  `id` int(11) NOT NULL,
  `obat_id` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `harga` double DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `total_harga` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_distributor`
--

CREATE TABLE `tb_distributor` (
  `id` int(11) NOT NULL,
  `nama_distributor` varchar(125) DEFAULT NULL,
  `alamat_distributor` text DEFAULT NULL,
  `telepon_distributor` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_distributor`
--

INSERT INTO `tb_distributor` (`id`, `nama_distributor`, `alamat_distributor`, `telepon_distributor`) VALUES
(1, 'PT ANUGRAH ARGON MEDIC', 'Jl. Gubernur Subarjo, Banjarmasin Selatan', '08123455644'),
(2, 'PT.ANUGERAH PHARMINDO LESTARI', 'Banjarmasin', '08123455666');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `id` int(11) NOT NULL,
  `nama_karyawan` varchar(75) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id`, `nama_karyawan`, `username`, `password`) VALUES
(1, 'admin', 'admin', '$2a$12$PzJNtu14Hye49aP9xO4aiujfOc2l46TomLfpY7k0emo6uGaOK9346'),
(2, 'maisa', 'mais', '$2a$12$2OEBwEetDnvvtg8IDJzTVefgBzbnRfIAgew7jhzgTThmzgauQSXqW');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id`, `nama_kategori`) VALUES
(1, 'Keras'),
(2, 'Bebas'),
(3, 'Bebas Terbatas'),
(4, 'Umum'),
(5, 'Herbal'),
(6, 'Vitamin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_obat`
--

CREATE TABLE `tb_obat` (
  `id` int(11) NOT NULL,
  `kode_obat` varchar(45) DEFAULT NULL,
  `nama_obat` varchar(125) DEFAULT NULL,
  `distributor_id` int(11) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `satuan_id` int(11) DEFAULT NULL,
  `harga_beli` double DEFAULT NULL,
  `harga_jual` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_obat`
--

INSERT INTO `tb_obat` (`id`, `kode_obat`, `nama_obat`, `distributor_id`, `kategori_id`, `satuan_id`, `harga_beli`, `harga_jual`) VALUES
(1, '123', 'LIPITOR 20 MG', 1, 3, 2, 10000, 12000),
(2, 'MCNE050NP', 'NEUROBION CT 50', 2, 6, 1, 10000, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(125) DEFAULT NULL,
  `tgl_pembelian` date DEFAULT NULL,
  `tgl_jatuh_tempo` date DEFAULT NULL,
  `status` enum('LUNAS','BELUM LUNAS') DEFAULT NULL,
  `total_harga` double DEFAULT NULL,
  `total_bayar` double DEFAULT NULL,
  `sisa_bayar` double DEFAULT NULL,
  `distributor_id` int(11) DEFAULT NULL,
  `karyawan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id` int(11) NOT NULL,
  `no_struk` varchar(45) DEFAULT NULL,
  `tgl_penjualan` date DEFAULT NULL,
  `total_harga` double DEFAULT NULL,
  `total_bayar` double DEFAULT NULL,
  `kembali` double DEFAULT NULL,
  `karyawan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id` int(11) NOT NULL,
  `nama_satuan` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_satuan`
--

INSERT INTO `tb_satuan` (`id`, `nama_satuan`) VALUES
(1, 'Tablet'),
(2, 'Box'),
(3, 'Botol'),
(4, 'Pcs'),
(5, 'Strip'),
(6, 'Sachet'),
(7, 'Tube'),
(8, 'Ampul'),
(9, 'Vial'),
(10, 'Capsule'),
(11, 'Pot');

-- --------------------------------------------------------

--
-- Table structure for table `tb_stok`
--

CREATE TABLE `tb_stok` (
  `id` int(11) NOT NULL,
  `obat_id` int(11) DEFAULT NULL,
  `batch_id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah_masuk` int(11) DEFAULT NULL,
  `jumlah_keluar` int(11) DEFAULT NULL,
  `stok_akhir` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_batch`
--
ALTER TABLE `tb_batch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `obat_idx` (`obat_id`);

--
-- Indexes for table `tb_det_pembelian`
--
ALTER TABLE `tb_det_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_obats_has_pembelians_pembelians1_idx` (`pembelian_id`),
  ADD KEY `fk_obats_has_pembelians_obats1_idx` (`obat_id`),
  ADD KEY `FK_DetPembelian_Batch` (`batch_id`),
  ADD KEY `satuan_id` (`satuan_id`);

--
-- Indexes for table `tb_det_penjualan`
--
ALTER TABLE `tb_det_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_obats_has_penjualans_penjualans1_idx` (`penjualan_id`),
  ADD KEY `fk_obats_has_penjualans_obats1_idx` (`obat_id`),
  ADD KEY `FK_DetPenjualan_Batch` (`batch_id`);

--
-- Indexes for table `tb_distributor`
--
ALTER TABLE `tb_distributor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distributor_id_idx` (`distributor_id`),
  ADD KEY `satuan_id_idx` (`satuan_id`),
  ADD KEY `kategori_id_idx` (`kategori_id`);

--
-- Indexes for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id_idx` (`karyawan_id`),
  ADD KEY `distributor_id_idx` (`distributor_id`);

--
-- Indexes for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawan_idx` (`karyawan_id`);

--
-- Indexes for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_stok`
--
ALTER TABLE `tb_stok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `obat_idx` (`obat_id`),
  ADD KEY `FK_Stok_Batch` (`batch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_batch`
--
ALTER TABLE `tb_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_distributor`
--
ALTER TABLE `tb_distributor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_obat`
--
ALTER TABLE `tb_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_stok`
--
ALTER TABLE `tb_stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_batch`
--
ALTER TABLE `tb_batch`
  ADD CONSTRAINT `obat` FOREIGN KEY (`obat_id`) REFERENCES `tb_obat` (`id`);

--
-- Constraints for table `tb_det_pembelian`
--
ALTER TABLE `tb_det_pembelian`
  ADD CONSTRAINT `FK_DetPembelian_Batch` FOREIGN KEY (`batch_id`) REFERENCES `tb_batch` (`id`),
  ADD CONSTRAINT `fk_obats_has_pembelians_obats1` FOREIGN KEY (`obat_id`) REFERENCES `tb_obat` (`id`),
  ADD CONSTRAINT `fk_obats_has_pembelians_pembelians1` FOREIGN KEY (`pembelian_id`) REFERENCES `tb_pembelian` (`id`),
  ADD CONSTRAINT `tb_det_pembelian_ibfk_1` FOREIGN KEY (`satuan_id`) REFERENCES `tb_satuan` (`id`);

--
-- Constraints for table `tb_det_penjualan`
--
ALTER TABLE `tb_det_penjualan`
  ADD CONSTRAINT `FK_DetPenjualan_Batch` FOREIGN KEY (`batch_id`) REFERENCES `tb_batch` (`id`),
  ADD CONSTRAINT `fk_obats_has_penjualans_obats1` FOREIGN KEY (`obat_id`) REFERENCES `tb_obat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_obats_has_penjualans_penjualans1` FOREIGN KEY (`penjualan_id`) REFERENCES `tb_penjualan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD CONSTRAINT `distributor_id` FOREIGN KEY (`distributor_id`) REFERENCES `tb_distributor` (`id`),
  ADD CONSTRAINT `kategori_id` FOREIGN KEY (`kategori_id`) REFERENCES `tb_kategori` (`id`),
  ADD CONSTRAINT `satuan_id` FOREIGN KEY (`satuan_id`) REFERENCES `tb_satuan` (`id`);

--
-- Constraints for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD CONSTRAINT `pembelian_distributor_id` FOREIGN KEY (`distributor_id`) REFERENCES `tb_distributor` (`id`),
  ADD CONSTRAINT `pembelian_karyawan_id` FOREIGN KEY (`karyawan_id`) REFERENCES `tb_karyawan` (`id`);

--
-- Constraints for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD CONSTRAINT `karyawan` FOREIGN KEY (`karyawan_id`) REFERENCES `tb_karyawan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_stok`
--
ALTER TABLE `tb_stok`
  ADD CONSTRAINT `FK_Stok_Batch` FOREIGN KEY (`batch_id`) REFERENCES `tb_batch` (`id`),
  ADD CONSTRAINT `stok_obat` FOREIGN KEY (`obat_id`) REFERENCES `tb_obat` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
