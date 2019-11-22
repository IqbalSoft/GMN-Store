-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 13, 2019 at 05:10 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gmn`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id_bank` int(11) NOT NULL,
  `bank_name` varchar(60) NOT NULL,
  `no_rekening` varchar(15) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id_bank`, `bank_name`, `no_rekening`, `id_user`) VALUES
(1, 'bca', '876756564509781', 2);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comments_fill` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id_warehouse` int(11) NOT NULL,
  `warehouse_name` varchar(50) NOT NULL,
  `image_gudang` varchar(100) NOT NULL,
  `warehouse_type` enum('ps','cb') NOT NULL,
  `province_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id_warehouse`, `warehouse_name`, `image_gudang`, `warehouse_type`, `province_id`, `city_id`, `address`, `created_at`) VALUES
(1, 'gwc bandung', '5d806042bf67c.jpg', 'ps', 9, 22, 'Tidak diketahui lokasinya silahkan cari sendiri di google bisa searching kan :v', 1570591844);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `fullname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `message` varchar(100) NOT NULL,
  `status_read` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id_message`, `fullname`, `email`, `message`, `status_read`, `created_at`) VALUES
(1, 'muhammad iqbal', 'muhammadiqbal.rpl@gmail.com', 'bagus bro tampilannya tapi mana isi produknya kenapa kosong ? :v', 0, 1570554390);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `file_name` varchar(40) NOT NULL,
  `created_at` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_user`, `file_name`, `created_at`) VALUES
(1, 4, '5d9d55de592b2.pdf', 1570592222);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `price` varchar(30) NOT NULL,
  `weight` int(11) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_vendor` int(11) NOT NULL,
  `id_gudang` int(11) NOT NULL,
  `descriptions` varchar(300) NOT NULL,
  `product_arrive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `image`, `product_name`, `price`, `weight`, `product_stock`, `province_id`, `city_id`, `id_user`, `id_vendor`, `id_gudang`, `descriptions`, `product_arrive`) VALUES
(1, '5d9d56cf9576d.jpg', 'Triplex 10mm', '30000', 1, 10, 6, 154, 7, 1, 1, 'gk ada deskripsinya.', 1570592463),
(2, '5d9d5ddf61adc.jpg', 'Triplex 30mm', '90000', 1, 12, 1, 17, 7, 1, 1, 'tak ada deskripsi.', 1570594271),
(3, '5d9d5e10a2b17.jpg', 'Triplex 20mm', '25000', 1, 4, 1, 17, 7, 1, 1, 'wdwdededwscecew.', 1570594320),
(4, '5d9d5e3332e7a.jpg', 'Triplex 35mm', '33000', 2, 5, 1, 17, 7, 1, 1, 'dasdwefegfergregergergrgh.', 1570594355),
(5, '5d9d5e4f6b817.jpg', 'Triplex 15mm', '14000', 1, 3, 1, 17, 7, 1, 1, 'wdweeeeeedwe.', 1570594383),
(6, '5d9d5e6fde296.jpg', 'Triplex 20mm', '54000', 2, 3, 1, 17, 7, 1, 1, 'sadasdwedwefewfwefwegw.', 1570594415),
(7, '5d9d5e87955db.jpg', 'Triplex 10mm', '34000', 1, 2, 1, 17, 7, 1, 1, 'wadwdwqdwdwwqFFFESF.', 1570594439),
(8, '5d9d5eaa658fb.jpg', 'Triplex 11mm', '12000', 1, 5, 1, 17, 7, 1, 1, 'sadefefewfweafeawferg.', 1570594474);

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `province_id` int(11) NOT NULL,
  `province_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`province_id`, `province_name`) VALUES
(1, 'Bali'),
(2, 'Bangka Belitung'),
(3, 'Banten'),
(4, 'Bengkulu'),
(5, 'DI Yogyakarta'),
(6, 'DKI Jakarta'),
(7, 'Gorontalo'),
(8, 'Jambi'),
(9, 'Jawa Barat'),
(10, 'Jawa Tengah'),
(11, 'Jawa Timur'),
(12, 'Kalimantan Barat'),
(13, 'Kalimantan Selatan'),
(14, 'Kalimantan Tengah'),
(15, 'Kalimantan Timur'),
(16, 'Kalimantan Utara'),
(17, 'Kepulauan Riau'),
(18, 'Lampung'),
(19, 'Maluku'),
(20, 'Maluku Utara'),
(21, 'Nanggroe Aceh Darussalam(NAD)'),
(22, 'Nusa Tenggara Barat(NTB)'),
(23, 'Nusa Tenggara Timur'),
(24, 'Papua'),
(25, 'Papua Barat'),
(26, 'Riau'),
(27, 'Sulawesi Barat'),
(28, 'Sulawesi Selatan'),
(29, 'Sulawesi Tengah'),
(30, 'Sulawesi Tenggara'),
(31, 'Sulawesi Utara'),
(32, 'Sumatera Barat'),
(33, 'Sumatera Selatan'),
(34, 'Sumatera Utara');

-- --------------------------------------------------------

--
-- Table structure for table `remaining_stock`
--

CREATE TABLE `remaining_stock` (
  `id_remaining` int(11) NOT NULL,
  `id_gudang` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(128) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `status`) VALUES
(1, 'Admin Gudang', 1),
(2, 'Admin Pembelian', 1),
(3, 'Admin Penjualanan', 1),
(4, 'Member', 1),
(5, 'HRD', 1),
(6, 'Supervisor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_kasir` int(11) NOT NULL,
  `id_gudang` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_weight` int(11) NOT NULL,
  `courier` int(11) NOT NULL,
  `service` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `status_confirm` int(11) NOT NULL,
  `date_order` int(11) NOT NULL,
  `date_confirm` int(11) NOT NULL,
  `resi` varchar(60) NOT NULL,
  `month_chart` varchar(20) NOT NULL,
  `year_chart` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_barang`, `id_pembeli`, `id_kasir`, `id_gudang`, `qty`, `total_weight`, `courier`, `service`, `payment`, `status_confirm`, `date_order`, `date_confirm`, `resi`, `month_chart`, `year_chart`) VALUES
(1, 5, 5, 7, 1, 3, 3, 0, 12000, 1, 2, 1570597357, 1570597671, '5d9d6b4e707fd.png', '10', '2019');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `province_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `picture` varchar(60) NOT NULL,
  `postal_code` int(6) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone_number` varchar(13) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(65) NOT NULL,
  `role_id` int(11) NOT NULL,
  `id_gudang` int(11) NOT NULL,
  `active_staff` int(2) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `fullname`, `province_id`, `city_id`, `picture`, `postal_code`, `address`, `phone_number`, `email`, `password`, `role_id`, `id_gudang`, `active_staff`, `date_created`) VALUES
(2, 'muhammad iqbal', 9, 22, '5d9d50ddaea5c.png', 40295, 'jalan merkuri indah timur nomor 14.', '089697704167', 'muhammadiqbal.rpl@gmail.com', '$2y$10$g1QorBlME8jKh6Htix3oJe7MDv/0G0jJfAV05h7o4YECY1/gxX4wu', 3, 0, 1, 1570590521),
(3, 'eva statham', 6, 151, 'no-photo.jpg', NULL, NULL, NULL, 'eva@gmail.com', '$2y$10$CUd3qg.6.J4u8Dd03MA6U.kYc2FwO4rA6ZVmghMimzr278Ca782VG', 5, 0, 1, 1570590551),
(4, 'Stephen statham', 3, 106, 'no-photo.jpg', NULL, NULL, NULL, 'stepen@gmail.com', '$2y$10$rWqx4t2xHUKMHPPNNaMfl.rtTcK80wMuPpHt2Ru6V8JVJ3Vdt0pRe', 2, 0, 1, 1570590652),
(5, 'yusuf ganteng', 9, 22, '5d9d5f6f3f388.png', 1221, 'jalan merkuri indah timur nomor 10.', '08998877884', 'yusuf@gmail.com', '$2y$10$Ho0W3XKsPVNoEJwDkh9qnOfTUn4QeNoGTHSoqI6fCnm/wTc8ROr4i', 4, 0, 1, 1570590703),
(6, 'asep warior', 9, 376, 'no-photo.jpg', NULL, NULL, NULL, 'asep@yahoo.com', '$2y$10$eykBbN2YnLpAJXCjHxQs7O7lhmacylloADYF3Q1tnO3mNTlYcFIDW', 6, 0, 1, 1570590855),
(7, 'ucok derpina', 1, 17, '5d9d5949869d3.png', 10234, 'jalan merkuri indah tengah nomor 14.', '08998877887', 'ucok@gmail.com', '$2y$10$/PtNs6qIm07UIGNfpCI8m.kwZiV6quixMp6DGnw2JdrNpUDgQ1kv2', 1, 1, 1, 1570592317);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id_vendor` int(11) NOT NULL,
  `vendor_name` varchar(40) NOT NULL,
  `product_type` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `address` varchar(100) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id_vendor`, `vendor_name`, `product_type`, `email`, `phone_number`, `address`, `created_at`) VALUES
(1, 'lotte', 'Wood', 'lotte@gmail.com', '0998798898', 'gk tau alamatnya dimana cari sendiri di google :v', 1570592155);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id_bank`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_warehouse`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_gudang` (`id_gudang`),
  ADD KEY `id_vendor` (`id_vendor`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`province_id`);

--
-- Indexes for table `remaining_stock`
--
ALTER TABLE `remaining_stock`
  ADD PRIMARY KEY (`id_remaining`),
  ADD KEY `id_gudang` (`id_gudang`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_gudang` (`id_gudang`),
  ADD KEY `id_pembeli` (`id_pembeli`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id_vendor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id_warehouse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `province_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `remaining_stock`
--
ALTER TABLE `remaining_stock`
  MODIFY `id_remaining` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id_vendor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `banks`
--
ALTER TABLE `banks`
  ADD CONSTRAINT `banks_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_vendor`) REFERENCES `vendor` (`id_vendor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id_warehouse`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `remaining_stock`
--
ALTER TABLE `remaining_stock`
  ADD CONSTRAINT `remaining_stock_ibfk_1` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id_warehouse`),
  ADD CONSTRAINT `remaining_stock_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `product` (`id_product`),
  ADD CONSTRAINT `remaining_stock_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_pembeli`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id_warehouse`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
