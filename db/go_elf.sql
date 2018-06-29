-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 29, 2018 at 09:54 AM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 5.6.36-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `go_elf`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `path` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`path`) VALUES
('http://localhost/Go-Elf');

-- --------------------------------------------------------

--
-- Table structure for table `elf`
--

CREATE TABLE `elf` (
  `id` int(100) NOT NULL,
  `name_elf` varchar(50) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `tahun_pembuatan` varchar(20) NOT NULL,
  `nomor_mesin` varchar(50) NOT NULL,
  `plat_nomor` varchar(50) NOT NULL,
  `tahun_registrasi` varchar(20) NOT NULL,
  `expire_stnk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `elf`
--

INSERT INTO `elf` (`id`, `name_elf`, `merk`, `type`, `jenis`, `tahun_pembuatan`, `nomor_mesin`, `plat_nomor`, `tahun_registrasi`, `expire_stnk`) VALUES
(1, 'Elf 1', 'Honda', 'Mobil/Elf', 'Elf', '2005', 'H123NFASD1', 'B 1920 DT', '2010', '2019-07-28');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `no_seat` varchar(255) DEFAULT NULL,
  `no_elf` int(11) DEFAULT NULL,
  `keberangkatan` varchar(50) DEFAULT NULL,
  `tujuan` varchar(255) DEFAULT NULL,
  `date_booking` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `username`, `no_seat`, `no_elf`, `keberangkatan`, `tujuan`, `date_booking`, `status`) VALUES
(73, 'ahmad', '1_1', 1, 'Tekno', 'Intercon', '2018-06-05 14:29:35', 0),
(74, 'Firdauz Fanani', '1_1', 1, 'Intercon', 'Tekno', '2018-06-06 07:26:47', 0),
(75, 'Firdauz Fanani', '1_1', 1, 'Tekno', 'Intercon', '2018-06-06 13:04:24', 0),
(78, 'Firdauz Fanani', '1_1', 1, 'Intercon', 'Tekno', '2018-06-07 08:49:18', 0),
(89, 'Firdauz Fanani', '1_1', 1, 'Tekno', 'Intercon', '2018-06-07 13:55:41', 0),
(92, 'Firdauz Fanani', '1_1', 1, 'Tekno', 'Intercon', '2018-06-08 09:45:42', 0),
(95, 'jourdan', '2_2', 1, 'Tekno', 'Intercon', '2018-06-08 09:50:07', 0),
(98, 'Firdauz Fanani', '1_1', 1, 'Intercon', 'Intercon', '2018-06-11 15:37:32', 0),
(99, 'Firdauz', '1_1', 1, 'Intercon', 'Intercon', '2018-06-20 14:27:54', 0),
(100, 'Firdauz Fanani', '1_1', 1, 'Intercon', 'Tekno', '2018-06-21 09:10:03', 1),
(101, 'jourdan', '2_2', 1, 'Intercon', 'Tekno', '2018-06-21 09:57:03', 1),
(108, 'Firdauz Fanani', '1_1', 2, 'Tekno', 'Intercon', '2018-06-25 20:43:04', 0),
(110, 'Firdauz Fanani', '1_1', 1, 'Intercon', 'Tekno', '2018-06-26 16:31:28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rsvpDriver`
--

CREATE TABLE `rsvpDriver` (
  `id` int(20) NOT NULL,
  `ID_Pegawai` int(10) NOT NULL,
  `Nama_Supir` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `elf_ke` int(5) NOT NULL,
  `tgl_booking` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rsvpDriver`
--

INSERT INTO `rsvpDriver` (`id`, `ID_Pegawai`, `Nama_Supir`, `no_hp`, `email`, `elf_ke`, `tgl_booking`) VALUES
(13, 123456, 'ahmad', '081567920578', 'ahmad@gmail.com', 1, '2018-06-20'),
(15, 123456, 'ahmad', '081567920578', 'ahmad@gmail.com', 1, '2018-06-23'),
(16, 123456, 'ahmad', '081567920578', 'ahmad@gmail.com', 1, '2018-06-21'),
(17, 1234567, 'Jourdan', '081567920578', 'jourdan@gmail.com', 2, '2018-06-21'),
(18, 123456, 'ahmad', '081567920578', 'ahmad@gmail.com', 2, '2018-06-22'),
(19, 123456, 'ahmad', '081567920578', 'ahmad@gmail.com', 1, '2018-06-25'),
(20, 123456, 'ahmad', '081567920578', 'ahmad@gmail.com', 1, '2018-06-26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `department` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `id_pegawai`, `username`, `department`, `jabatan`, `email`, `no_hp`, `password`, `photo`, `role`, `created_at`) VALUES
(1, 0, 'admin', '', '', 'admin@gmail.com', '0', 'admin', '', '', '2018-03-01 09:28:56'),
(2, 123, 'jourdan', '', '', 'jourdan@gmail.com', '0', 'jourdan', '', 'user', '2018-06-05 03:07:22'),
(3, 123456, 'ahmad', 'IT Dept', 'Staff', 'ahmad@gmail.com', '081567920578', 'ahmad', 'poto/ahmad_123456_180607115038_rack.jpg', 'supir', '2018-06-04 08:16:19'),
(5, 12345, 'Firdauz Fanani', 'IT Dept', 'Staff', 'firdauzfanani@gmail.comc', '081567920578', '12345', 'poto/FirdauzFanani_12345_180607101045_rack.jpg', 'user', '2018-06-05 15:35:03'),
(6, 1234567, 'Jourdan', '', '', 'jourdan@gmail.com', '081567920578', 'jourdan', '', 'supir', '2018-06-20 13:37:18'),
(7, 1234, 'Firdauz', 'IT', 'Staff', 'firdauzfanani@gmail.com', '081567920578', '12345', '', 'user', '2018-06-20 14:27:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `elf`
--
ALTER TABLE `elf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rsvpDriver`
--
ALTER TABLE `rsvpDriver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `elf`
--
ALTER TABLE `elf`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `rsvpDriver`
--
ALTER TABLE `rsvpDriver`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
