-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2023 at 11:11 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web-p0a69`
--

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `foto` text NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`id`, `nama`, `foto`, `deskripsi`) VALUES
(5, 'Cabang 6', 'assets/images/cabang-1693181947-210.jpg', '<p>Cabang 6 ini berlokasi di Ciwidey.&nbsp;</p><p>Kecamatan Ciwidey, Jawa Barat, Indonesia</p><p>Jl. Otong Kardana Depan lapang No.3, dana laga, Kec. Ciwidey, Bandung, Jawa Barat 40973, Indonesia</p>'),
(6, 'Cabang 5', 'assets/images/cabang-1693183998-751.jpeg', '<p>Cabang 5 ini berlokasi di Pangalengan.</p><p>Jl. Raya Pangalengan No. 10, Pangalengan, Kec. Pangalengan, Kabupaten Bandung, Jawa Barat 40378</p><p>Chika Cemerlang Snack kini telah hadir di bandung selatan yaitu di pangalengan, dekat dengan objek wisata bukit bintang. Objek wisata situ cikenca.</p>'),
(8, 'Cabang 4', 'assets/images/cabang-1693184811-512.jpg', '<p>Cabang 4 berlokasi di Dayeuhkolot.</p><p>Jl. Raya Dayeuh Kolot (OLEH-OLEH CHIKA CEMERLANG), Wates, Kec. Dayeuh Kolot, Bandung 40258</p>'),
(9, 'Cabang 3 ', 'assets/images/cabang-1693186125-650.png', '<p>Cabang 3 berlokasi di Dago.</p><p>Jl. Ir. H. Juanda No. 431, Dago, Kecamatan Coblong, Kota Bandung, Jawa Barat 40135</p>'),
(10, 'Cabang 2', 'assets/images/cabang-1693187612-540.jpeg', '<p>Cabang 2 berlokasi di Dago.</p><p>Jl. Ir. H. Juanda No.216, Lebakgede, Kecamatan Coblong, Kota Bandung, Jawa Barat 40135</p>'),
(11, 'Cabang 1', 'assets/images/cabang-1693193645-330.png', '<p>Cabang 1 berlokasi di Bojongsoang.</p><p>Jl. Raya Bojongsoang No.331, Cipagalo, Kec. Bojongsoang, Kabupaten Bandung, Jawa Barat 40287</p>');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `kode_invoice` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ongkir_id` int(11) DEFAULT NULL,
  `metode_pembayaran` varchar(100) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status` enum('0','1','2','3','4') NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `kode_invoice`, `user_id`, `ongkir_id`, `metode_pembayaran`, `total`, `status`, `tanggal`) VALUES
(16, 'INV31082023001', 10, 1, 'COD', 72000, '1', '2023-08-31'),
(17, 'INV31082023002', 10, 1, 'COD', 162000, '1', '2023-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id` int(11) NOT NULL,
  `kurir` varchar(250) NOT NULL,
  `layanan` varchar(250) NOT NULL,
  `ongkos` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id`, `kurir`, `layanan`, `ongkos`) VALUES
(1, 'JNE', 'Oke', '12000');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `bukti_pembayaran` varchar(250) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `cabang_id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(250) NOT NULL,
  `harga` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `cabang_id`, `nama`, `deskripsi`, `foto`, `harga`) VALUES
(9, 11, 'Keripik Kaca 250g', '<p>Keripik Kaca yang pedas, gurih, dan renyah.</p>', 'assets/images/Produk-1693193879-901.jpg', '15000'),
(10, 9, 'Keripik Kaca 250g', '<p>Keripik Kaca yang pedas, gurih, dan renyah</p>', 'assets/images/Produk-1693193926-551.jpg', '15000'),
(11, 6, 'Keripik Kaca 250g', '<p>Keripik Kaca yang pedas, gurih, dan renyah</p>', 'assets/images/Produk-1693193955-588.jpg', '15000'),
(12, 10, 'Keripik pisang 500g', '<p>Keripik Pisang renyah dan gurih</p>', 'assets/images/Produk-1693194015-863.jpg', '35000'),
(13, 8, 'Keripik pisang 500g', '<p>Keripik Pisang gurih dan renyah</p>', 'assets/images/Produk-1693194047-223.jpg', '35000'),
(14, 5, 'Keripik pisang 500g', '<p>Keripik Pisang renyah dan gurih</p>', 'assets/images/Produk-1693194076-714.jpg', '35000');

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `id` int(11) NOT NULL,
  `nama_rekening` varchar(250) NOT NULL,
  `no_rekening` varchar(250) NOT NULL,
  `bank` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id`, `nama_rekening`, `no_rekening`, `bank`) VALUES
(2, 'Putri Adillah', '519001013346530', 'BRI');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `nama_website` varchar(250) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `favicon` varchar(250) NOT NULL,
  `bg_login` varchar(100) DEFAULT NULL,
  `bg_register` varchar(100) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `no_telp` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `google_map` text NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `youtube` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `nama_website`, `logo`, `favicon`, `bg_login`, `bg_register`, `email`, `no_telp`, `alamat`, `google_map`, `facebook`, `twitter`, `instagram`, `youtube`) VALUES
(1, 'Chika Cemerlang', 'assets/images/Logo-1693161072-620.png', 'assets/images/Favicon-1693161072-600.png', 'assets/images/BG-Login-1692264897-128.jpg', 'assets/images/BG-Register-1692264897-155.jpg', 'puteadil07@gmail.com', '082296548752', '<p>Jalan Raya, Wates, Dayeuhkolot, Bandung Regency, West Java 40258</p>', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63374.292703123465!2d107.60195795489032!3d-6.9033624722535505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Kota%20Bandung%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1692540976930!5m2!1sid!2sid', 'https://www.facebook.com/profile.php?id=100076227735104', 'https://www.twitter.com', 'https://www.instagram.com/cemerlangsnack', 'https://www.youtube.com/@chikacemerlangchannel876');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `invoice_id`, `produk_id`, `jumlah`, `total`, `tanggal`) VALUES
(20, 16, 9, 4, 60000, '2023-08-31'),
(21, 17, 10, 3, 45000, '2023-08-31'),
(22, 17, 13, 3, 105000, '2023-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama_user` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `jns_kelamin` varchar(20) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` enum('Admin','Pelanggan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama_user`, `email`, `no_telp`, `jns_kelamin`, `foto`, `alamat`, `username`, `password`, `role`) VALUES
(3, 'Admin', NULL, NULL, NULL, 'assets/images/User-1692263398-354.jpg', NULL, 'admin', '25d55ad283aa400af464c76d713c07ad', 'Admin'),
(9, 'Putri A', 'putdil@gmail.com', '085756112375', 'Perempuan', 'assets/images/Pelanggan-1693229663-709.JPG', 'Gg. Demang Jl. Sukabirus No.I No.148, RT.05/RW.15, Citeureup, Kec. Dayeuhkolot, Kabupaten Bandung, Jawa Barat 40257', 'Putri6', '07ba3bcb46bc235b3fede70b7c551523', 'Pelanggan'),
(10, 'Randy', 'randy@gmail.com', '0898291828', 'Laki-Laki', 'assets/images/Pelanggan-1693429627-904.jpg', 'Kp. Jauh', 'randy', '91c9e3822f2e01a7259fc7d8bd31c51e', 'Pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `rekening` (`metode_pembayaran`),
  ADD KEY `ongkir_id` (`ongkir_id`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cabang_id` (`cabang_id`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_id` (`produk_id`),
  ADD KEY `invoice` (`invoice_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `ongkir_id` FOREIGN KEY (`ongkir_id`) REFERENCES `ongkir` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `invoice_id` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `cabang_id` FOREIGN KEY (`cabang_id`) REFERENCES `cabang` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `invoice` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produk_id` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
