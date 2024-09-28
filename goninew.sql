-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2022 at 04:23 PM
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
-- Database: `goninew`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamat_konsumen`
--

CREATE TABLE `alamat_konsumen` (
  `id_alamat` int(11) NOT NULL,
  `id_ksmn` int(11) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `RT` char(5) NOT NULL,
  `RW` char(5) NOT NULL,
  `jalan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alamat_konsumen`
--

INSERT INTO `alamat_konsumen` (`id_alamat`, `id_ksmn`, `kecamatan`, `RT`, `RW`, `jalan`) VALUES
(17, 31, 'karangdami', '1', '4', 'ngingas'),
(18, 33, '123', '12', '1', 'jalan 1');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_brg` int(11) NOT NULL,
  `nama_brg` varchar(50) NOT NULL,
  `harga_brg` int(12) NOT NULL,
  `jenis_brg` varchar(25) NOT NULL,
  `stock` int(11) NOT NULL,
  `status_brg` varchar(25) NOT NULL DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_brg`, `nama_brg`, `harga_brg`, `jenis_brg`, `stock`, `status_brg`) VALUES
(1, 'sabun cuci tangan', 3000, 'alat rumah tangga', 0, 'Aktif'),
(2, 'beras mentik wangi', 6000, 'kebutuhan pokok', 89, 'Aktif'),
(3, 'Boneka Anime', 15000, 'boneka', 3, 'Nonaktif'),
(4, 'Games', 150000, 'online', 93, 'Aktif'),
(5, 'Fortune', 25000, 'Minyak Goreng', 0, 'Aktif'),
(6, 'Bimoli', 35000, 'Minyak Goreng', 29, 'Aktif'),
(7, 'Cumi-Cumi', 40000, 'Makanan', 5, 'Nonaktif');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemb`
--

CREATE TABLE `detail_pemb` (
  `iddetail_pemb` int(11) NOT NULL,
  `jumlah` int(12) NOT NULL,
  `subtotal` int(12) NOT NULL,
  `id_pemb` int(11) NOT NULL,
  `id_brg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_setor`
--

CREATE TABLE `detail_setor` (
  `id_detail_pickup` int(11) NOT NULL,
  `id_setor` int(11) NOT NULL,
  `id_sampahsetor` int(11) NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'Pending',
  `tgl_jemput` date DEFAULT '2022-06-13',
  `tgl_approve` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gambar_brg`
--

CREATE TABLE `gambar_brg` (
  `idgambar_brg` int(11) NOT NULL,
  `file_brg` varchar(255) NOT NULL,
  `id_brg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gambar_brg`
--

INSERT INTO `gambar_brg` (`idgambar_brg`, `file_brg`, `id_brg`) VALUES
(1, '38338422-fa2d-413c-bbe1-10574457db7b.jpg', 2),
(2, '54570431_bb368a84-fdda-4d04-8228-9f17db4bbaaf_800_800.jpg', 1),
(3, 'Screenshot (13).png', 3),
(4, 'Screenshot (16).png', 4),
(6, 'Hajar Beauty.jpg', 5),
(7, '0d364c98-9ad1-44bd-9843-2a46e939fa31.jpg', 6),
(8, 'Cumi Asam Manis.jpg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `gambar_smph`
--

CREATE TABLE `gambar_smph` (
  `idgambar_smph` int(11) NOT NULL,
  `file_smph` varchar(255) NOT NULL DEFAULT 'no picture',
  `id_smph` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gambar_smph`
--

INSERT INTO `gambar_smph` (`idgambar_smph`, `file_smph`, `id_smph`) VALUES
(2, 'no picture', 1),
(4, 'no picture\r\n', 3),
(5, 'no picture', 4),
(7, 'Screenshot (23).png', 17),
(8, 'no picture', 5),
(9, 'no picture', 18);

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `id_ksmn` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_telp` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `poin` float NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'assets/images/users/avatar-1.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`id_ksmn`, `username`, `email`, `password`, `no_telp`, `nama`, `poin`, `image`) VALUES
(29, 'Wahyud1', 'wahyuy@student.telkomuniversity.ac.id', '$2y$10$UrQRHIyukRL2PbZ3gMe3uuyS8Mx3KCc6jEIyVG.tGbjn.7pJWFLS6', '085325042061', 'WAHYU YULIANTO PRATAMA', 700, 'assets/images/users/avatar-1.jpg'),
(31, 'reza', 'claraadelson@gmaill.com', '$2y$10$3WGEqJ76b9363qwiRAxrwemDlv2BAKDUO4hjsRQRH0wMW3YzKNLXq', '081233905145', 'Reza Hadinoviantari', 8000, 'assets/konsumen/gambarReza Hadinoviantari.jpeg'),
(33, 'Wahyud1', 'wahyuy1@student.telkomuniversity.ac.id', '$2y$10$vS9yqErwTq0ERt0EYXEdNu8r356T18xISRPeBfTYiQEznYruQD21u', '085325042062', 'WAHYU YULIANTO PRATAMA', 90700, 'assets/images/users/avatar-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `metode`
--

CREATE TABLE `metode` (
  `id_pilih` int(11) NOT NULL,
  `nama` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `metode`
--

INSERT INTO `metode` (`id_pilih`, `nama`) VALUES
(1, 'BANK'),
(2, 'E-Wallet'),
(3, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_tabungan`
--

CREATE TABLE `mutasi_tabungan` (
  `id_mutasi` int(11) NOT NULL,
  `tgl_mutasi` date DEFAULT NULL,
  `debit` int(12) DEFAULT 0,
  `kredit` int(12) DEFAULT 0,
  `saldo` int(12) NOT NULL DEFAULT 0,
  `desk_mutasi` text DEFAULT NULL,
  `id_ptgs` int(11) NOT NULL,
  `id_ksmn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pemb` int(11) NOT NULL,
  `tgl_pemb` date NOT NULL,
  `jumlah_brg` int(12) NOT NULL DEFAULT 0,
  `total` int(12) NOT NULL DEFAULT 0,
  `token_pemb` varchar(6) NOT NULL,
  `status_pemb` varchar(25) NOT NULL DEFAULT 'Pending',
  `id_ksmn` int(11) NOT NULL,
  `pimbol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penukaran`
--

CREATE TABLE `penukaran` (
  `id_tukar` int(11) NOT NULL,
  `tgl_tukar` date NOT NULL,
  `nominal` int(12) NOT NULL,
  `token_tukar` varchar(6) NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'Pending',
  `telpon` varchar(100) NOT NULL,
  `id_ksmn` int(11) NOT NULL,
  `id_wallet` int(11) NOT NULL,
  `simbol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_ptgs` int(11) NOT NULL,
  `uname_ptgs` varchar(25) NOT NULL,
  `email_ptgs` varchar(100) NOT NULL,
  `pw_ptgs` varchar(255) NOT NULL,
  `nama_ptgs` varchar(50) NOT NULL,
  `kontak_ptgs` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_ptgs`, `uname_ptgs`, `email_ptgs`, `pw_ptgs`, `nama_ptgs`, `kontak_ptgs`) VALUES
(3, 'AdminOne', 'admin1One@gmail.com', '$2y$10$RB2.UVslnWWEqAQ8dL2LOOQrupuMW4CIf1KCASeMUw8BfKCmSYDjS', 'Admin 1', '085555332241'),
(6, 'AdminTwo', 'AdminTwo@gmail.com', '$2y$10$MhlTsNsGOvYYYdUCDhzlp.geZtiG0Xl1LyKgEoqYoYjRfGnFqQycW', 'Admin 2', '085325004400'),
(7, 'admin3', 'admin@gmail.com', 'reza', 'admin3', '08122209987'),
(8, 'reza', 'rezahadinoviantari@student.telkomuniversity.ac.id', '$2y$10$rYC6/tyIAnSFr9Co2iG3MuMl8V4UdaQhf9zEsP4pOLRd7mCOvCJbe', 'Reza Hadinoviantari', '081233905145');

-- --------------------------------------------------------

--
-- Table structure for table `sampah`
--

CREATE TABLE `sampah` (
  `id_smph` int(11) NOT NULL,
  `kategori_smph` varchar(25) NOT NULL,
  `harga_cash` int(12) NOT NULL,
  `kode_smph` char(6) NOT NULL,
  `status_smph` varchar(25) NOT NULL DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sampah`
--

INSERT INTO `sampah` (`id_smph`, `kategori_smph`, `harga_cash`, `kode_smph`, `status_smph`) VALUES
(1, 'plastik', 600, 'PLAS01', 'Nonaktif'),
(2, 'jelantah', 1500, 'JELA01', 'Nonaktif'),
(3, 'kaca', 500, 'KCA001', 'Aktif'),
(4, 'kertas', 700, 'KTAS01', 'Aktif'),
(5, 'kardus', 1000, 'KDUS01', 'Aktif'),
(17, 'Karung', 900, 'KRG001', 'Nonaktif'),
(18, 'Karung', 1000, 'krg001', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `sampah_setor`
--

CREATE TABLE `sampah_setor` (
  `id_sampahsetor` int(11) NOT NULL,
  `berat` int(12) NOT NULL DEFAULT 0,
  `id_smph` int(11) NOT NULL,
  `id_ksmn` int(11) NOT NULL,
  `harga` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `setor`
--

CREATE TABLE `setor` (
  `id_setor` int(11) NOT NULL,
  `id_ksmn` int(11) NOT NULL,
  `alamat_setor` varchar(250) NOT NULL DEFAULT 'Setor Langsung',
  `total_berat` int(11) NOT NULL DEFAULT 0,
  `total_harga` int(11) DEFAULT 0,
  `tgl_setor` date DEFAULT NULL,
  `cara_setor` varchar(25) NOT NULL DEFAULT 'Jemput',
  `jenis_setor` varchar(25) NOT NULL DEFAULT 'Tabung'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id_wallet` int(11) NOT NULL,
  `id_pilih` int(11) NOT NULL,
  `wallet` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id_wallet`, `id_pilih`, `wallet`) VALUES
(1, 1, 'BRI'),
(2, 1, 'BNI'),
(3, 1, 'MANDIRI'),
(4, 1, 'BCA'),
(5, 2, 'OVO'),
(6, 2, 'DANA'),
(7, 2, 'ShopeePay'),
(8, 2, 'LinkAJA'),
(9, 2, 'Gopay'),
(12, 1, 'BSI'),
(13, 2, 'i.saku'),
(14, 3, 'Cash');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamat_konsumen`
--
ALTER TABLE `alamat_konsumen`
  ADD PRIMARY KEY (`id_alamat`),
  ADD KEY `id_ksmn` (`id_ksmn`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_brg`);

--
-- Indexes for table `detail_pemb`
--
ALTER TABLE `detail_pemb`
  ADD PRIMARY KEY (`iddetail_pemb`),
  ADD KEY `transaksi` (`id_pemb`),
  ADD KEY `barangterjual` (`id_brg`);

--
-- Indexes for table `detail_setor`
--
ALTER TABLE `detail_setor`
  ADD PRIMARY KEY (`id_detail_pickup`),
  ADD KEY `id_setor` (`id_setor`),
  ADD KEY `id_sampahsetor` (`id_sampahsetor`);

--
-- Indexes for table `gambar_brg`
--
ALTER TABLE `gambar_brg`
  ADD PRIMARY KEY (`idgambar_brg`),
  ADD KEY `gambarbarang` (`id_brg`);

--
-- Indexes for table `gambar_smph`
--
ALTER TABLE `gambar_smph`
  ADD PRIMARY KEY (`idgambar_smph`),
  ADD KEY `iconsampah` (`id_smph`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_ksmn`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `no_telp` (`no_telp`);

--
-- Indexes for table `metode`
--
ALTER TABLE `metode`
  ADD PRIMARY KEY (`id_pilih`);

--
-- Indexes for table `mutasi_tabungan`
--
ALTER TABLE `mutasi_tabungan`
  ADD PRIMARY KEY (`id_mutasi`),
  ADD KEY `id_ksmn` (`id_ksmn`),
  ADD KEY `id_ptgs` (`id_ptgs`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pemb`),
  ADD KEY `pembeli` (`id_ksmn`);

--
-- Indexes for table `penukaran`
--
ALTER TABLE `penukaran`
  ADD PRIMARY KEY (`id_tukar`),
  ADD KEY `perequestcashout` (`id_ksmn`),
  ADD KEY `id_wallet` (`id_wallet`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_ptgs`),
  ADD UNIQUE KEY `email_ptgs` (`email_ptgs`);

--
-- Indexes for table `sampah`
--
ALTER TABLE `sampah`
  ADD PRIMARY KEY (`id_smph`);

--
-- Indexes for table `sampah_setor`
--
ALTER TABLE `sampah_setor`
  ADD PRIMARY KEY (`id_sampahsetor`),
  ADD KEY `kategorisampah` (`id_smph`),
  ADD KEY `penyetor` (`id_ksmn`);

--
-- Indexes for table `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id_setor`),
  ADD KEY `id_ksmn` (`id_ksmn`),
  ADD KEY `id_alamat` (`alamat_setor`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id_wallet`),
  ADD KEY `id_pilih` (`id_pilih`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alamat_konsumen`
--
ALTER TABLE `alamat_konsumen`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_brg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detail_pemb`
--
ALTER TABLE `detail_pemb`
  MODIFY `iddetail_pemb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `detail_setor`
--
ALTER TABLE `detail_setor`
  MODIFY `id_detail_pickup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT for table `gambar_brg`
--
ALTER TABLE `gambar_brg`
  MODIFY `idgambar_brg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gambar_smph`
--
ALTER TABLE `gambar_smph`
  MODIFY `idgambar_smph` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `id_ksmn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `metode`
--
ALTER TABLE `metode`
  MODIFY `id_pilih` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mutasi_tabungan`
--
ALTER TABLE `mutasi_tabungan`
  MODIFY `id_mutasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pemb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `penukaran`
--
ALTER TABLE `penukaran`
  MODIFY `id_tukar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_ptgs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sampah`
--
ALTER TABLE `sampah`
  MODIFY `id_smph` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sampah_setor`
--
ALTER TABLE `sampah_setor`
  MODIFY `id_sampahsetor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;

--
-- AUTO_INCREMENT for table `setor`
--
ALTER TABLE `setor`
  MODIFY `id_setor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id_wallet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamat_konsumen`
--
ALTER TABLE `alamat_konsumen`
  ADD CONSTRAINT `alamat_konsumen_ibfk_1` FOREIGN KEY (`id_ksmn`) REFERENCES `konsumen` (`id_ksmn`);

--
-- Constraints for table `detail_pemb`
--
ALTER TABLE `detail_pemb`
  ADD CONSTRAINT `detail_pemb_ibfk_1` FOREIGN KEY (`id_brg`) REFERENCES `barang` (`id_brg`),
  ADD CONSTRAINT `detail_pemb_ibfk_2` FOREIGN KEY (`id_pemb`) REFERENCES `pembelian` (`id_pemb`);

--
-- Constraints for table `detail_setor`
--
ALTER TABLE `detail_setor`
  ADD CONSTRAINT `detail_setor_ibfk_1` FOREIGN KEY (`id_setor`) REFERENCES `setor` (`id_setor`),
  ADD CONSTRAINT `detail_setor_ibfk_2` FOREIGN KEY (`id_sampahsetor`) REFERENCES `sampah_setor` (`id_sampahsetor`);

--
-- Constraints for table `gambar_brg`
--
ALTER TABLE `gambar_brg`
  ADD CONSTRAINT `gambar_brg_ibfk_1` FOREIGN KEY (`id_brg`) REFERENCES `barang` (`id_brg`);

--
-- Constraints for table `gambar_smph`
--
ALTER TABLE `gambar_smph`
  ADD CONSTRAINT `gambar_smph_ibfk_1` FOREIGN KEY (`id_smph`) REFERENCES `sampah` (`id_smph`);

--
-- Constraints for table `mutasi_tabungan`
--
ALTER TABLE `mutasi_tabungan`
  ADD CONSTRAINT `mutasi_tabungan_ibfk_3` FOREIGN KEY (`id_ksmn`) REFERENCES `konsumen` (`id_ksmn`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`id_ksmn`) REFERENCES `konsumen` (`id_ksmn`);

--
-- Constraints for table `penukaran`
--
ALTER TABLE `penukaran`
  ADD CONSTRAINT `penukaran_ibfk_2` FOREIGN KEY (`id_ksmn`) REFERENCES `konsumen` (`id_ksmn`),
  ADD CONSTRAINT `penukaran_ibfk_3` FOREIGN KEY (`id_wallet`) REFERENCES `wallet` (`id_wallet`);

--
-- Constraints for table `sampah_setor`
--
ALTER TABLE `sampah_setor`
  ADD CONSTRAINT `sampah_setor_ibfk_1` FOREIGN KEY (`id_ksmn`) REFERENCES `konsumen` (`id_ksmn`),
  ADD CONSTRAINT `sampah_setor_ibfk_3` FOREIGN KEY (`id_smph`) REFERENCES `sampah` (`id_smph`);

--
-- Constraints for table `setor`
--
ALTER TABLE `setor`
  ADD CONSTRAINT `setor_ibfk_1` FOREIGN KEY (`id_ksmn`) REFERENCES `konsumen` (`id_ksmn`);

--
-- Constraints for table `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `wallet_ibfk_1` FOREIGN KEY (`id_pilih`) REFERENCES `metode` (`id_pilih`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
