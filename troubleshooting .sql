-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 09 Jan 2020 pada 05.45
-- Versi Server: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `troubleshooting`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `active_user`
--
CREATE TABLE IF NOT EXISTS `active_user` (
`u_id` int(11)
,`username` varchar(25)
,`password` varchar(20)
,`level` varchar(25)
,`u_status` tinyint(1)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laboratory`
--

CREATE TABLE IF NOT EXISTS `laboratory` (
  `lab_id` int(8) NOT NULL,
  `lab_name` varchar(40) DEFAULT NULL,
  `lab_status` tinyint(1) DEFAULT '1',
  `capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laboratory`
--

INSERT INTO `laboratory` (`lab_id`, `lab_name`, `lab_status`, `capacity`) VALUES
(1, 'Laboratoraium Multimedia', 1, 28),
(2, 'Laboratorium Basis Data', 0, 40),
(3, 'Laboratorium Pemrograman', 1, 34);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laboratory_things`
--

CREATE TABLE IF NOT EXISTS `laboratory_things` (
  `things_id` int(11) NOT NULL,
  `lab_id` int(8) DEFAULT '0',
  `wares_name` varchar(50) DEFAULT '0',
  `description` text,
  `pc` int(4) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laboratory_things`
--

INSERT INTO `laboratory_things` (`things_id`, `lab_id`, `wares_name`, `description`, `pc`) VALUES
(1, 1, 'Netbeans', 'hanya ada', 22);

-- --------------------------------------------------------

--
-- Stand-in structure for view `show_user`
--
CREATE TABLE IF NOT EXISTS `show_user` (
`name` char(70)
,`lab_name` varchar(40)
,`lab_id` int(8)
,`email` varchar(50)
,`cp` varchar(14)
,`username` varchar(25)
,`password` varchar(20)
,`level` varchar(25)
,`u_id` int(11)
,`u_status` tinyint(1)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` varchar(25) NOT NULL,
  `u_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`u_id`, `username`, `password`, `level`, `u_status`) VALUES
(1, 'admin', 'admin', 'admin', 1),
(4, '16013013', '16013013', 'Asisten Laboratorium', 1),
(5, 'jsanger', 'jsanger', 'Koordinator Laboratorium', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_detail`
--

CREATE TABLE IF NOT EXISTS `user_detail` (
  `u_id` int(11) NOT NULL,
  `lab_id` int(8) DEFAULT NULL,
  `name` char(70) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cp` varchar(14) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_detail`
--

INSERT INTO `user_detail` (`u_id`, `lab_id`, `name`, `email`, `cp`) VALUES
(1, NULL, 'admin', NULL, NULL),
(4, 1, 'Elizabeth Yolasb', '16013013@unika.ac.id', '09090912233'),
(5, 1, 'Junaidy B Sanger, S.Kom, M.Kom', 'jsanger@unikadelasalle.ac.id', '081355689038');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wares`
--

CREATE TABLE IF NOT EXISTS `wares` (
  `w_id` int(8) NOT NULL,
  `w_name` varchar(50) NOT NULL DEFAULT '',
  `w_kind` varchar(25) NOT NULL DEFAULT '',
  `w_icon` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `wares`
--

INSERT INTO `wares` (`w_id`, `w_name`, `w_kind`, `w_icon`) VALUES
(1, 'RAM', 'Hardware', 'icons8-memory-slot-96.png'),
(2, 'Dreamweaver', 'Software', 'icons8-adobe-dreamweaver-144.png'),
(3, 'MATLAB', 'Software', 'Matlab_Logo_(1).png'),
(4, 'Microsoft Power Point', 'Software', 'icons8-microsoft-powerpoint-144.png'),
(5, 'Microsoft Visio', 'Software', 'icons8-microsoft-visio-144.png'),
(6, 'Microsoft Word 2019', 'Software', 'icons8-microsoft-word-144.png'),
(7, 'Netbeans', 'Software', '800px-Apache_NetBeans_Logo_svg.png'),
(8, 'Photoshop', 'Software', 'icons8-adobe-photoshop-144.png'),
(9, 'Animate', 'Software', 'Animate-512.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wares_ts`
--

CREATE TABLE IF NOT EXISTS `wares_ts` (
  `ts_id` int(8) NOT NULL,
  `w_id` int(8) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `detail` text NOT NULL,
  `solving` text,
  `video` varchar(100) DEFAULT '0',
  `upd_by` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = approved | 0 = unapprove',
  `upd_date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `wares_ts`
--

INSERT INTO `wares_ts` (`ts_id`, `w_id`, `title`, `detail`, `solving`, `video`, `upd_by`, `status`, `upd_date`) VALUES
(1, 1, 'tambah perangkat tes', 'tes tambah perangkat', 'tes solusi', '', 1, 1, '2019-12-05'),
(4, 1, 'Bunyi [b]Beep[/b] pendek sebanyak 1 kali saat komputer dihidupkan', 'Bunyi beep pendek sebanyak 1 kali menandakan bahwa terjadi permasalahan pada DRAM komputer yaitu gagalnya refresh pada DRAM komputer. Oleh karena itu disarankan untuk mengecek apabila terjadi kerusakan pada RAM ataupun mengganti RAM dengan komponen yang baru. Berikut adalah video cara melepas RAM dari komputer.', '[b]Langkah 1:[/b][br]\r\nBuka case pada komputer dengan melepaskan sekrupnya.[br]\r\n[b]Langkah 2:[/b][br]\r\nCabut RAM dengan cara melepaskan kunci soket, lalu tarik RAM secara perlahan dari soket.[br]\r\n[b]Langkah 3:[/b][br]\r\nPeriksalah RAM tersebut apabila terdapat kerusakan seperti beberapa bagian yang mengalami kecacatan.\r\n', 'https://www.youtube.com/embed/zZhWAl9PFcw', 1, 1, '2019-12-19');

-- --------------------------------------------------------

--
-- Struktur untuk view `active_user`
--
DROP TABLE IF EXISTS `active_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `active_user` AS select `user`.`u_id` AS `u_id`,`user`.`username` AS `username`,`user`.`password` AS `password`,`user`.`level` AS `level`,`user`.`u_status` AS `u_status` from `user` where (`user`.`u_status` = '1');

-- --------------------------------------------------------

--
-- Struktur untuk view `show_user`
--
DROP TABLE IF EXISTS `show_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `show_user` AS select `b`.`name` AS `name`,`a`.`lab_name` AS `lab_name`,`a`.`lab_id` AS `lab_id`,`b`.`email` AS `email`,`b`.`cp` AS `cp`,`c`.`username` AS `username`,`c`.`password` AS `password`,`c`.`level` AS `level`,`c`.`u_id` AS `u_id`,`c`.`u_status` AS `u_status` from ((`laboratory` `a` join `user_detail` `b` on((`a`.`lab_id` = `b`.`lab_id`))) join `user` `c` on((`b`.`u_id` = `c`.`u_id`))) order by `c`.`level` desc;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laboratory`
--
ALTER TABLE `laboratory`
  ADD PRIMARY KEY (`lab_id`);

--
-- Indexes for table `laboratory_things`
--
ALTER TABLE `laboratory_things`
  ADD PRIMARY KEY (`things_id`),
  ADD KEY `lab_id` (`lab_id`),
  ADD KEY `lab_id_2` (`lab_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `lab_id` (`lab_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `wares`
--
ALTER TABLE `wares`
  ADD PRIMARY KEY (`w_id`);

--
-- Indexes for table `wares_ts`
--
ALTER TABLE `wares_ts`
  ADD PRIMARY KEY (`ts_id`),
  ADD KEY `upd_by` (`upd_by`),
  ADD KEY `w_id` (`w_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laboratory`
--
ALTER TABLE `laboratory`
  MODIFY `lab_id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `laboratory_things`
--
ALTER TABLE `laboratory_things`
  MODIFY `things_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_detail`
--
ALTER TABLE `user_detail`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `wares`
--
ALTER TABLE `wares`
  MODIFY `w_id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `wares_ts`
--
ALTER TABLE `wares_ts`
  MODIFY `ts_id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `laboratory_things`
--
ALTER TABLE `laboratory_things`
  ADD CONSTRAINT `laboratory_things_ibfk_1` FOREIGN KEY (`lab_id`) REFERENCES `laboratory` (`lab_id`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user_detail` (`u_id`);

--
-- Ketidakleluasaan untuk tabel `user_detail`
--
ALTER TABLE `user_detail`
  ADD CONSTRAINT `user_detail_ibfk_1` FOREIGN KEY (`lab_id`) REFERENCES `laboratory` (`lab_id`),
  ADD CONSTRAINT `user_detail_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`);

--
-- Ketidakleluasaan untuk tabel `wares_ts`
--
ALTER TABLE `wares_ts`
  ADD CONSTRAINT `wares_ts_ibfk_1` FOREIGN KEY (`upd_by`) REFERENCES `user_detail` (`u_id`),
  ADD CONSTRAINT `wares_ts_ibfk_2` FOREIGN KEY (`w_id`) REFERENCES `wares` (`w_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
