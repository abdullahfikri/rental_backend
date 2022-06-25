-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220531.aadb8cc914
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 25, 2022 at 08:33 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_mobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_mobil`
--

CREATE TABLE `jenis_mobil` (
  `id` int(11) NOT NULL,
  `nama_mobil` varchar(30) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_mobil`
--

INSERT INTO `jenis_mobil` (`id`, `nama_mobil`, `jumlah`) VALUES
(1, 'Avanza', 2),
(2, 'Xenia', 2),
(3, 'APV', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id` int(11) NOT NULL,
  `id_jenismobil` int(11) NOT NULL,
  `warna` varchar(20) NOT NULL,
  `plat` varchar(10) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `harga` int(20) NOT NULL,
  `url_image` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id`, `id_jenismobil`, `warna`, `plat`, `tahun`, `harga`, `url_image`, `status`) VALUES
(5, 1, 'Abu-abu', 'BM3131AA', '2020', 300000, 'http://localhost/rentalmobil/images/mobil/avanzabronze.png', 1),
(6, 1, 'Hitam', 'BM1231AB', '2018', 250000, 'http://localhost/rentalmobil/images/mobil/avanzablack.png', 1),
(7, 2, 'Putih', 'BM1234AC', '2019', 280000, 'http://localhost/rentalmobil/images/mobil/xeniawhite.png', 1),
(8, 2, 'Hitam', 'BM1421AB', '2020', 300000, 'http://localhost/rentalmobil/images/mobil/xeniahitam.jpg', 0),
(10, 2, 'Putih', 'BM1233AB', '2019', 280000, 'http://localhost/rentalmobil/images/mobil/xeniaputih.jpg', 0),
(11, 3, 'Putih', 'BM123AJ', '2017', 200000, 'http://localhost/rentalmobil/images/mobil/apvhitam.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kelamin` varchar(50) NOT NULL,
  `nik` varchar(30) NOT NULL,
  `nomor_telp` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `url_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `kelamin`, `nik`, `nomor_telp`, `alamat`, `url_image`) VALUES
(1, 'Ismawan', 'Laki-laki', '123213213', '0812312312', 'Jl manunggal', 'http://localhost/rentalmobil/images/siluetman.png'),
(2, 'Indah', 'Perempuan', '1312321', '09822131', 'Jl Buluh Cina', 'http://localhost/rentalmobil/images/siluetmanwoman.png'),
(3, '31231', 'Laki-laki', '321312', '1231', '1231', 'http://localhost/rentalmobil/images/siluetman.png'),
(6, 'gagah', 'Laki-laki', '123123', '1231231', 'jknda', 'http://localhost/rentalmobil/images/siluetman.png'),
(8, 'tester', 'Laki-laki', '123213', '4432', '123123', 'http://127.0.0.1/rentalmobil/images/8654baju2.jpg'),
(9, 'adi', 'Laki-laki', '122222231', '522211', 'hsdfas', 'http://127.0.0.1/rentalmobil/images/1462sarung.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(5) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `total_harga` int(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_pelanggan`, `id_mobil`, `tanggal_pinjam`, `tanggal_kembali`, `total_harga`, `status`) VALUES
(3, 1, 5, '2022-06-24', '2022-06-26', 600000, 0),
(4, 2, 6, '2022-06-24', '2022-06-27', 750000, 0),
(6, 8, 7, '2022-06-24', '2022-06-29', 1400000, 1),
(7, 9, 11, '2022-06-25', '2022-07-01', 1200000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_mobil`
--
ALTER TABLE `jenis_mobil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mobil_jenismobil` (`id_jenismobil`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_pelanggan` (`id_pelanggan`),
  ADD KEY `transaksi_mobil` (`id_mobil`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_mobil`
--
ALTER TABLE `jenis_mobil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mobil`
--
ALTER TABLE `mobil`
  ADD CONSTRAINT `mobil_jenismobil` FOREIGN KEY (`id_jenismobil`) REFERENCES `jenis_mobil` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_mobil` FOREIGN KEY (`id_mobil`) REFERENCES `mobil` (`id`),
  ADD CONSTRAINT `transaksi_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



