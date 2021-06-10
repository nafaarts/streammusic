-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2021 at 04:09 PM
-- Server version: 5.7.32
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db_streammusic`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_favorit`
--

CREATE TABLE `tb_favorit` (
  `id_favorit` int(11) NOT NULL,
  `id_musik` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `kategori`) VALUES
(1, 'rock'),
(2, 'reggae'),
(3, 'dangdut'),
(4, 'pop');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_musik`
--

CREATE TABLE `tb_kategori_musik` (
  `id_katmus` int(11) NOT NULL,
  `id_musik` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_kategori_musik`
--

INSERT INTO `tb_kategori_musik` (`id_katmus`, `id_musik`, `id_kategori`) VALUES
(3, 2, 1),
(4, 2, 4),
(5, 3, 1),
(6, 3, 3),
(7, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_last_stream`
--

CREATE TABLE `tb_last_stream` (
  `id_last_stream` int(11) NOT NULL,
  `id_musik` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `last_stream_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_musik`
--

CREATE TABLE `tb_musik` (
  `id_musik` int(11) NOT NULL,
  `file` varchar(128) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `artist` varchar(50) NOT NULL,
  `durasi` varchar(10) NOT NULL,
  `stream` bigint(20) NOT NULL,
  `date_upload` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_musik`
--

INSERT INTO `tb_musik` (`id_musik`, `file`, `judul`, `artist`, `durasi`, `stream`, `date_upload`) VALUES
(2, '1623334422(Budi Doremi).mp3', 'Melukis Senja', 'Budi Doremi', '4:36', 13, 1623334422),
(3, '1623335564(Ismail Marzuki).mp3', 'Selamat hari lebaran (Piano)', 'Ismail Marzuki', '1:09', 5, 1623335564);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL,
  `hak_akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `email`, `password`, `date_created`, `hak_akses`) VALUES
(1, 'jokowi', 'jokowi@gmail.com', '$2y$10$egQe2LusF0C1zv3TsXJwjOgpnTAMZxyh6w1AS7A34YjBVW1C6FXRq', 1623322040, 1),
(2, 'prabowo', 'prabowo@gmail.com', '$2y$10$LHvO1WLTS.85X5WU3p0OFe31asEoT91DHWs9CkuqNLtaGehsCsg/i', 1623321994, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_favorit`
--
ALTER TABLE `tb_favorit`
  ADD PRIMARY KEY (`id_favorit`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_kategori_musik`
--
ALTER TABLE `tb_kategori_musik`
  ADD PRIMARY KEY (`id_katmus`);

--
-- Indexes for table `tb_last_stream`
--
ALTER TABLE `tb_last_stream`
  ADD PRIMARY KEY (`id_last_stream`);

--
-- Indexes for table `tb_musik`
--
ALTER TABLE `tb_musik`
  ADD PRIMARY KEY (`id_musik`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_favorit`
--
ALTER TABLE `tb_favorit`
  MODIFY `id_favorit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_kategori_musik`
--
ALTER TABLE `tb_kategori_musik`
  MODIFY `id_katmus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_last_stream`
--
ALTER TABLE `tb_last_stream`
  MODIFY `id_last_stream` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_musik`
--
ALTER TABLE `tb_musik`
  MODIFY `id_musik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
