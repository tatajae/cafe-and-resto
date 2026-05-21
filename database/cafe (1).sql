-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2026 at 05:23 AM
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
-- Database: `cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail`, `id_pesanan`, `id_produk`, `jumlah`, `harga`) VALUES
(45, 50, 8, 1, 20000),
(46, 51, 11, 1, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'coffe'),
(2, 'Noncoffe'),
(3, 'Makanan'),
(4, 'Dessert');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `metode` varchar(50) NOT NULL,
  `tanggal` datetime NOT NULL,
  `uang_bayar` int(11) DEFAULT 0,
  `kembalian` int(11) DEFAULT 0,
  `status` varchar(30) DEFAULT 'Berhasil'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `id_pesanan`, `nama_pemesan`, `total`, `metode`, `tanggal`, `uang_bayar`, `kembalian`, `status`) VALUES
(10, 50, 'cici', 20000, 'DANA', '2026-05-21 10:15:25', 20000, 0, 'Berhasil'),
(11, 51, 'jamal', 15000, 'Cash', '2026-05-21 10:20:00', 20000, 5000, 'Berhasil');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `metode` varchar(50) NOT NULL,
  `total` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `uang_bayar` int(11) DEFAULT NULL,
  `kembalian` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_pesanan`, `metode`, `total`, `nama`, `bukti`, `status`, `tanggal`, `uang_bayar`, `kembalian`) VALUES
(29, 50, 'DANA', 20000, 'cici', '1779333310_bukti.png', 'Berhasil', '2026-05-21 03:15:10', NULL, NULL),
(30, 51, 'Cash', 15000, 'jamal', NULL, 'Berhasil', '2026-05-21 03:20:00', 20000, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `meja` varchar(10) NOT NULL,
  `pembayaran` varchar(50) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `total` int(11) NOT NULL,
  `status` enum('pending','dibayar','diproses','selesai','dibatalkan') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_user`, `nama_pemesan`, `meja`, `pembayaran`, `tanggal`, `total`, `status`) VALUES
(50, 3, 'cici', '2', 'DANA', '2026-05-21 10:15:02', 20000, 'diproses'),
(51, 3, 'jamal', '8', 'Cash', '2026-05-21 10:18:01', 15000, 'diproses');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga`, `gambar`) VALUES
(4, 1, 'Coffe Latte', 25000, 'coffe latte.jfif'),
(6, 3, 'Sate Taichan', 45000, 'sate taichan.jfif'),
(7, 3, 'Sate Ayam', 40000, 'sate ayam.jfif'),
(8, 1, 'Americano', 20000, 'How To Make an Americano - Tastylicious.jfif'),
(9, 2, 'Matcha', 15000, 'matcha.jfif'),
(10, 3, 'Bakso', 20000, 'Bakso Kuah.jfif'),
(11, 3, 'Mie Ayam', 15000, 'Mie Ayam Ratu.jfif'),
(12, 4, 'CROSSAINT', 28000, 'download (24).jfif'),
(13, 4, 'Nutella Tiramisu', 28000, 'Nutella Tiramisu.jfif'),
(14, 4, 'Ice Cream', 20000, 'download (25).jfif'),
(15, 4, 'Pudding Caramel', 42000, 'pudding caramel.jfif'),
(16, 2, 'Matcha Latte', 28000, 'Creamy Matcha Latte Recipe.jfif'),
(17, 2, 'Milkshake', 15000, 'Coffee Milkshake - Baking Mischief.jfif'),
(18, 2, 'Strawberry Milkshake', 15000, 'Strawberry Milkshake.jfif'),
(19, 3, 'Nasi Goreng', 38000, 'Nasi Goreng (Indonesian Fried Rice).jfif'),
(20, 3, 'Ayam Bakar', 50000, 'Chic Outfit Ideas for Every Occasion 👗✨.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `id_reservasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `status` enum('menunggu','disetujui','ditolak') DEFAULT 'menunggu',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','pemilik','user') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `nama`, `email`, `password`, `role`) VALUES
(1, 'admin', 'Admin', 'admin@gmail.com', '123', 'admin'),
(2, 'Jaehyun', 'Jaehyun', 'jaehyun@gmail.com', '123', 'pemilik'),
(3, 'ichi', 'cici', 'cici@gmail.com', '123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_reservasi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
