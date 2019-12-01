-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2019 at 09:48 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `konveksiap`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_admin`
--

CREATE TABLE `t_admin` (
  `id_admin` tinyint(2) NOT NULL,
  `username` varchar(35) NOT NULL,
  `fullname` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `reset` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_admin`
--

INSERT INTO `t_admin` (`id_admin`, `username`, `fullname`, `password`, `level`, `email`, `reset`) VALUES
(1, 'admin', 'Administrator', '$2y$10$h.2rmSj059VCc3hNjvnbzOgTVprnmjgP1I9M570.RERGRkU1KbFBq', 1, 'email@example', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_detail_order`
--

CREATE TABLE `t_detail_order` (
  `id_order` varchar(10) NOT NULL,
  `id_item` int(7) NOT NULL,
  `qty` smallint(4) NOT NULL,
  `biaya` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_detail_order`
--

INSERT INTO `t_detail_order` (`id_order`, `id_item`, `qty`, `biaya`) VALUES
('1492901950', 1, 1, 9000),
('1492901950', 2, 1, 80000);

-- --------------------------------------------------------

--
-- Table structure for table `t_items`
--

CREATE TABLE `t_items` (
  `id_item` int(7) NOT NULL,
  `nama_item` varchar(255) NOT NULL,
  `harga` int(10) NOT NULL,
  `berat` int(5) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_items`
--

INSERT INTO `t_items` (`id_item`, `nama_item`, `harga`, `berat`, `status`, `gambar`, `deskripsi`) VALUES
(1, 'Item 1', 9000, 500, 2, 'gambar1488358808.png', 'Ini Item pertama'),
(2, 'Test 2', 900000, 500, 2, 'gambar1493949615.png', 'Bahan dari kulit'),
(7, 'Kemeja Kerja', 120000, 400, 1, 'gambar1574668610.jpg', 'Bordir Kemeja Seragam\r\n\r\nDesain di atas adalah contoh Kemeja yang dapat Anda gunakan. Anda dapat mengganti kombinasi warna dan model serta dapat menambahkan logo dan tulisan sesuai dengan keinginan dan kebutuhan.\r\n\r\nBahan yang biasa kami gunakan :\r\n\r\nDrill (American Drill, Tropical Drill, Japan Drill, Plat, Ribstok, dll)\r\nPoplin, Canvas, Baby Canvas.\r\nOxford\r\nBatik\r\ndll. (silahkan sampaikan bahan yang ingin Anda gunakan)\r\nPilihan warna bahan cukup lengkap. Anda perlu menghubungi kami terlebih dahulu untuk mengetahui warna yang tersedia karena setiap bahan memliki karakteristik warna yang berbeda.\r\n\r\nStandard ukuran yang kami gunakan adalah ukuran orang Indonesia pada umumnya. Namun jika Anda menginginkan produk dengan ukuran luar (Eropa) tetap dapat kami sediakan. Acuan standard ukuran kami adalah sebagai berikut.'),
(8, 'Kemeja Lapangan', 130000, 400, 1, 'gambar1574668768.jpg', 'Baju Kemeja Taktikal, Konveksi Baju Taktikal\r\n\r\nIni adalah contoh Gambar Desain Kemeja Taktikal. Anda dapat mengganti kombinasi warna dan dapat menambahkan Bordir Logo Perusahaan atau Bordir Tulisan sesuai dengan keinginan dan kebutuhan\r\n\r\nBahan Baju Seragam Taktikal yang biasa kami gunakan adalah : Taipan Drill, Taipan Tropical, Verlando American Drill, Verlando Tropical, Maryland American Drill, Maryland Tropical, Nagata Drill, Namura Drill, Ventura, Obor Japan Drill, Poplin Plat, Poplin Stretch, Katun Oxford, Katun Jepang, dll.\r\n\r\nPilihan warna bahan kemeja Taktikal cukup lengkap. Anda perlu menghubungi kami terlebih dahulu untuk mengetahui warna yang tersedia karena setiap bahan memliki karakteristik warna yang berbeda.\r\n\r\nStandard ukuran yang kami gunakan adalah ukuran lokal (ukuran orang Indonesia pada umumnya). Namun jika Anda menginginkan produk dengan ukuran luar (Eropa) tetap dapat kami sediakan. Acuan standard ukuran kami adalah sebagai berikut.'),
(9, 'Kemeja Kantor', 125000, 300, 1, 'gambar1574668834.jpg', 'Kemeja Kantor\r\n\r\nIni adalah contoh Gambar Desain Kemeja. Anda dapat mengganti kombinasi warna dan dapat menambahkan Bordir Logo Perusahaan atau Bordir Tulisan sesuai dengan keinginan dan kebutuhan\r\n\r\nBahan Kemeja Seragam yang biasa kami gunakan adalah : Taipan Drill, Taipan Tropical, Verlando American Drill, Verlando Tropical, Maryland American Drill, Maryland Tropical, Nagata Drill, Namura Drill, Ventura, Obor Japan Drill, Poplin Plat, Poplin Stretch, Katun Oxford, Katun Jepang, dll.'),
(10, 'Baju Polo', 75000, 200, 1, 'gambar1574669796.jpg', 'Konveksi Baju Polo\r\n\r\nDesain di atas adalah contoh Polo Shirt yang dapat Anda gunakan. Anda dapat mengganti kombinasi warna dan model serta dapat menambahkan logo dan tulisan sesuai dengan keinginan dan kebutuhan.\r\n\r\nBahan yang biasa kami gunakan :\r\n\r\nLacoste (Cotton, CVC, Polyester)\r\nKatun\r\nDrifit/Serena\r\ndll. (silahkan sampaikan bahan yang ingin Anda gunakan)\r\nPilihan warna bahan cukup lengkap. Anda perlu menghubungi kami terlebih dahulu untuk mengetahui warna yang tersedia karena setiap bahan memliki karakteristik warna yang berbeda.'),
(11, 'Polo Golf', 75000, 200, 1, 'gambar1574670025.jpg', 'Desain di atas adalah contoh Polo Shirt yang dapat Anda gunakan. Anda dapat mengganti kombinasi warna dan model serta dapat menambahkan logo dan tulisan sesuai dengan keinginan dan kebutuhan Anda.\r\n\r\nBahan yang tersedia antara lain :\r\n\r\nLacoste (Cotton / Pique, CVC, Polyester)\r\nKatun\r\nDrifit\r\nSerena\r\nWaffle\r\ndll\r\n\r\nPilihan warna cukup lengkap. Anda perlu menghubungi kami terlebih dahulu untuk mengetahui warna yang tersedia karena setiap bahan memliki karakteristik warna yang berbeda.'),
(12, 'Baju Polo Bordir', 80000, 200, 1, 'gambar1574670421.jpg', 'Seragam Polo Shirt\r\n\r\nDesain di atas adalah contoh Polo Shirt yang dapat Anda gunakan. Anda dapat mengganti kombinasi warna dan model serta dapat menambahkan logo dan tulisan sesuai dengan keinginan dan kebutuhan.\r\n\r\nBahan yang biasa kami gunakan :\r\n\r\nLacoste (Cotton, CVC, Polyester)\r\nKatun\r\nDrifit/Serena\r\ndll. (silahkan sampaikan bahan yang ingin Anda gunakan)\r\nPilihan warna bahan cukup lengkap. Anda perlu menghubungi kami terlebih dahulu untuk mengetahui warna yang tersedia karena setiap bahan memliki karakteristik warna yang berbeda.'),
(13, 'Patch Emblem Nasa', 10000, 100, 1, 'gambar1574670792.jpg', 'Patch / Emblem\r\nProduk di atas adalah contoh desain Patch atau Emblem yang dapat Anda gunakan. Desain atau gambar dapat diganti sesuai dengan kebutuhan dan keinginan Anda.\r\n\r\nSyarat dan ketentuan order yang biasa kami gunakan :\r\n\r\nMinimum pemesanan 12 pcs per desain atau gambar.\r\nWaktu pengerjaan 4 - 7 hari. Terdapat penambahan waktu 2 - 3 hari untuk jenis Iron On Patch (bisa menempel ketika disetrika)\r\nTidak ada batasan jumlah warna\r\nKirimkan file gambar berukuran besar (gambar berupa file vector lebih baik).\r\nTerdapat 2 pilihan cutting : Cutting Laser dan Cutting Manual.\r\nUkuran maksimum Patch adalah 18 x 18 cm dan ukuran minimumnya adalah 2 x 2 cm.'),
(14, 'Bordir Emblem Iron on', 10000, 100, 1, 'gambar1574671019.jpg', 'Patch / Emblem\r\nProduk di atas adalah contoh desain Patch atau Emblem yang dapat Anda gunakan. Desain atau gambar dapat diganti sesuai dengan kebutuhan dan keinginan Anda.\r\n\r\nSyarat dan ketentuan order yang biasa kami gunakan :\r\n\r\nMinimum pemesanan 12 pcs per desain atau gambar.\r\nWaktu pengerjaan 4 - 7 hari. Terdapat penambahan waktu 2 - 3 hari untuk jenis Iron On Patch (bisa menempel ketika disetrika)\r\nTidak ada batasan jumlah warna\r\nKirimkan file gambar berukuran besar (gambar berupa file vector lebih baik).\r\nTerdapat 2 pilihan cutting : Cutting Laser dan Cutting Manual.\r\nUkuran maksimum Patch adalah 18 x 18 cm dan ukuran minimumnya adalah 2 x 2 cm.'),
(15, 'Patch Emblem Goku', 10000, 100, 1, 'gambar1574671135.jpg', 'Patch / Emblem\r\nProduk di atas adalah contoh desain Patch atau Emblem yang dapat Anda gunakan. Desain atau gambar dapat diganti sesuai dengan kebutuhan dan keinginan Anda.\r\n\r\nSyarat dan ketentuan order yang biasa kami gunakan :\r\n\r\nMinimum pemesanan 12 pcs per desain atau gambar.\r\nWaktu pengerjaan 4 - 7 hari. Terdapat penambahan waktu 2 - 3 hari untuk jenis Iron On Patch (bisa menempel ketika disetrika)\r\nTidak ada batasan jumlah warna\r\nKirimkan file gambar berukuran besar (gambar berupa file vector lebih baik).\r\nTerdapat 2 pilihan cutting : Cutting Laser dan Cutting Manual.\r\nUkuran maksimum Patch adalah 18 x 18 cm dan ukuran minimumnya adalah 2 x 2 cm.');

-- --------------------------------------------------------

--
-- Table structure for table `t_kategori`
--

CREATE TABLE `t_kategori` (
  `id_kategori` smallint(6) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `url` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_kategori`
--

INSERT INTO `t_kategori` (`id_kategori`, `kategori`, `url`) VALUES
(14, 'Kemeja', 'kemeja'),
(15, 'Polo', 'polo'),
(17, 'Patch Emblem', 'patch-emblem');

-- --------------------------------------------------------

--
-- Table structure for table `t_order`
--

CREATE TABLE `t_order` (
  `id_order` varchar(10) NOT NULL,
  `id_user` int(7) NOT NULL,
  `total` double NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `pos` int(5) NOT NULL,
  `kota` varchar(25) NOT NULL,
  `kurir` varchar(5) NOT NULL,
  `service` varchar(50) NOT NULL,
  `tgl_pesan` date NOT NULL,
  `bts_bayar` date NOT NULL,
  `status` enum('belum','proses') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_order`
--

INSERT INTO `t_order` (`id_order`, `id_user`, `total`, `tujuan`, `pos`, `kota`, `kurir`, `service`, `tgl_pesan`, `bts_bayar`, `status`) VALUES
('1492901950', 1, 103000, 'Mojoroto', 64112, 'Kediri', 'pos', 'Surat Kilat Khusus(Surat Kilat Khusus)', '2017-04-23', '2017-04-26', 'proses');

-- --------------------------------------------------------

--
-- Table structure for table `t_rkategori`
--

CREATE TABLE `t_rkategori` (
  `id_item` int(7) NOT NULL,
  `id_kategori` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_rkategori`
--

INSERT INTO `t_rkategori` (`id_item`, `id_kategori`) VALUES
(4, 14),
(5, 14),
(3, 14),
(6, 14),
(1, 14),
(2, 14),
(7, 14),
(8, 14),
(9, 14),
(10, 15),
(11, 15),
(12, 15),
(13, 17),
(14, 17),
(15, 17);

-- --------------------------------------------------------

--
-- Table structure for table `t_users`
--

CREATE TABLE `t_users` (
  `id_user` int(7) NOT NULL,
  `username` varchar(35) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `telp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `reset` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_users`
--

INSERT INTO `t_users` (`id_user`, `username`, `fullname`, `email`, `password`, `jk`, `telp`, `alamat`, `status`, `reset`) VALUES
(1, 'olshoop', 'jazuli utsman', 'email@example', '$2y$10$8mR1Z5YB.ivh7CwcG7t3n.fCR4Sy/sncukzoPBImEC8m22IKVKY6u', 'L', '08983895092', 'askjhasdlasdas', 1, ''),
(2, 'olshop99', 'jazuliu utsman', 'olshopku77@gmail.com', '$2y$10$QZk4MfX9.gHP07hpk38wAu29KnuVMvqKCTXvFYL1Wi5uhJbbuJ.ny', 'P', '08983895092', 'askjhasdlasdas', 2, ''),
(3, 'rizky', 'rizky mblog', 'rizkymblog@gmail.com', '$2y$10$.vFz46e5uRvu0Y7aaZ1B3eb.mDJsOPDKcLlpwY7DQlHzH6KmLbo0O', 'L', '085857719643', 'Jalan sukarame 1, Cicaheum, kec. Kiaracondong, Bandung.', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_admin`
--
ALTER TABLE `t_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `t_items`
--
ALTER TABLE `t_items`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `t_kategori`
--
ALTER TABLE `t_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `t_order`
--
ALTER TABLE `t_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_admin`
--
ALTER TABLE `t_admin`
  MODIFY `id_admin` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_items`
--
ALTER TABLE `t_items`
  MODIFY `id_item` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_kategori`
--
ALTER TABLE `t_kategori`
  MODIFY `id_kategori` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `id_user` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
