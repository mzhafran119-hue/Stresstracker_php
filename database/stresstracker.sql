-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2024 at 09:35 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stresstracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `nohp` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(25) NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `nama`, `email`, `password`, `nohp`, `alamat`, `username`, `level`) VALUES
(2, 'Administrator', 'admin@gmail.com', 'admin', '0812345678', '<p>Jl. Sudirman, Jakarta</p>\r\n', 'admin', 'Admin'),
(3, 'Fahrul Adib', 'fahruladib9@gmail.com', '123', '082282076702', 'Banyuasin', 'sudendev', 'User'),
(4, 'Ridwan', 'ridwan@gmail.com', '123', '087384739292', 'Pangkalan Balai', 'ridwan', 'User'),
(5, 'Feby Saputra', 'feby@gmail.com', '123', '08738479894', 'Kenten Laut', 'fbys', 'User'),
(6, 'Alex', 'akuskibidi@gamer.com', 'toilet', '088888888888', 'Jl. Kebenaran', 'skibidi', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `idjawaban` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jekel` varchar(255) NOT NULL,
  `usia` varchar(5) NOT NULL,
  `pendidikan` varchar(30) NOT NULL,
  `jenislayanan` varchar(255) NOT NULL,
  `idsurvey` int(11) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp(),
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`idjawaban`, `nama`, `jekel`, `usia`, `pendidikan`, `jenislayanan`, `idsurvey`, `waktu`, `iduser`) VALUES
(1, 'sugeng pratama', 'Laki - Laki', '23', 'SMA', 'IKM', 3, '2024-08-08 11:54:13', 0),
(2, 'riki rivaldo', 'Laki - Laki', '25', 'SMA', 'PSS', 3, '2024-08-08 12:18:16', 0),
(5, 'Fahrul Adib', 'Laki - Laki', '24', 'SMA', 'Test', 3, '2024-08-15 09:48:26', 3),
(6, 'Budiono Siregar', 'Laki - Laki', '20', 'SMP', 'Kena bully', 3, '2024-08-15 10:23:23', 6),
(7, 'Fahrul Adib', 'Laki - Laki', '24', 'SMA', 'Test', 3, '2024-08-15 10:30:59', 3),
(8, 'Fahrul Adib', 'Laki - Laki', '24', 'SMA', 'Test', 3, '2024-08-15 10:33:08', 3);

-- --------------------------------------------------------

--
-- Table structure for table `listjawaban`
--

CREATE TABLE `listjawaban` (
  `idlistjawaban` int(11) NOT NULL,
  `idjawaban` int(11) NOT NULL,
  `idpertanyaan` int(11) NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `listjawaban`
--

INSERT INTO `listjawaban` (`idlistjawaban`, `idjawaban`, `idpertanyaan`, `jawaban`) VALUES
(1, 1, 7, 'B'),
(2, 1, 8, 'C'),
(3, 1, 9, 'D'),
(4, 1, 10, 'B'),
(5, 1, 11, 'B'),
(6, 1, 12, 'B'),
(7, 1, 13, 'B'),
(8, 1, 14, 'B'),
(9, 1, 15, 'C'),
(10, 1, 16, 'C'),
(11, 2, 7, 'D'),
(12, 2, 8, 'D'),
(13, 2, 9, 'D'),
(14, 2, 10, 'D'),
(15, 2, 11, 'D'),
(16, 2, 12, 'D'),
(17, 2, 13, 'D'),
(18, 2, 14, 'D'),
(19, 2, 15, 'D'),
(20, 2, 16, 'D'),
(21, 3, 7, 'B'),
(22, 3, 8, 'A'),
(23, 3, 9, 'C'),
(24, 3, 10, 'B'),
(25, 3, 11, 'C'),
(26, 3, 12, 'C'),
(27, 3, 13, 'C'),
(28, 3, 14, 'B'),
(29, 3, 15, 'D'),
(30, 3, 16, 'C'),
(31, 4, 7, 'D'),
(32, 4, 8, 'C'),
(33, 4, 9, 'C'),
(34, 4, 10, 'C'),
(35, 4, 11, 'B'),
(36, 4, 12, 'C'),
(37, 4, 13, 'B'),
(38, 4, 14, 'A'),
(39, 4, 15, 'C'),
(40, 4, 16, 'C'),
(41, 5, 7, 'B'),
(42, 5, 8, 'B'),
(43, 5, 9, 'B'),
(44, 5, 10, 'C'),
(45, 5, 11, 'B'),
(46, 5, 12, 'C'),
(47, 5, 13, 'B'),
(48, 5, 14, 'D'),
(49, 5, 15, 'C'),
(50, 5, 16, 'D'),
(51, 6, 7, 'C'),
(52, 6, 8, 'B'),
(53, 6, 9, 'B'),
(54, 6, 10, 'C'),
(55, 6, 11, 'C'),
(56, 6, 12, 'B'),
(57, 6, 13, 'D'),
(58, 6, 14, 'C'),
(59, 6, 15, 'A'),
(60, 6, 16, 'A'),
(61, 7, 7, 'D'),
(62, 7, 8, 'D'),
(63, 7, 9, 'D'),
(64, 7, 10, 'D'),
(65, 7, 11, 'D'),
(66, 7, 12, 'D'),
(67, 7, 13, 'D'),
(68, 7, 14, 'D'),
(69, 7, 15, 'D'),
(70, 7, 16, 'D'),
(71, 8, 7, 'A'),
(72, 8, 8, 'A'),
(73, 8, 9, 'A'),
(74, 8, 10, 'B'),
(75, 8, 11, 'B'),
(76, 8, 12, 'A'),
(77, 8, 13, 'A'),
(78, 8, 14, 'B'),
(79, 8, 15, 'B'),
(80, 8, 16, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `idpertanyaan` int(11) NOT NULL,
  `idsurvey` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `e` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`idpertanyaan`, `idsurvey`, `pertanyaan`, `a`, `b`, `c`, `d`, `e`) VALUES
(7, 3, 'Selama sebulan terakhir, seberapa sering anda marah karena sesuatu yang tidak terduga', 'Tidak pernah.', 'Hampir tidak pernah (1-2 kali).', 'Kadang-kadang (3-4 kali).', 'Hampir sering (5-6 kali) ', 'Sangat sering (lebih dari 6 kali).'),
(8, 3, 'Selama sebulan terakhir, seberapa sering anda merasa tidakmampu mengontrol hal-hal yang penting dalam kehidupan anda', 'Tidak pernah', 'Hampir tidak pernah (1-2 kali).', 'Kadang-kadang (3-4 kali).', 'Hampir sering (5-6 kali) ', 'Sangat sering (lebih dari 6 kali).'),
(9, 3, 'Selama sebulan terakhir, seberapa sering anda merasa gelisah dan tertekan', 'Tidak pernah.', 'Hampir tidak pernah (1-2 kali).', 'Kadang-kadang (3-4 kali).', 'Hampir sering (5-6 kali) ', 'Sangat sering (lebih dari 6 kali).'),
(10, 3, 'Selama sebulan terakhir, seberapa sering anda merasa yakin terhadap kemampuan diri untuk mengatasi masalah pribadi', 'Tidak pernah.', 'Hampir tidak pernah (1-2 kali).', 'Kadang-kadang (3-4 kali).', 'Hampir sering (5-6 kali) ', 'Sangat sering (lebih dari 6 kali).'),
(11, 3, 'Selama sebulan terakhir, seberapa sering anda merasa segala sesuatu yang terjadi sesuai dengan harapan anda', 'Tidak pernah.', 'Hampir tidak pernah (1-2 kali).', 'Kadang-kadang (3-4 kali).', 'Hampir sering (5-6 kali) ', 'Sangat sering (lebih dari 6 kali).'),
(12, 3, 'Selama sebulan terakhir, seberapa sering anda merasa tidak mampu menyelesaikan hal-hal yang harus dikerjakan', 'Tidak pernah.', 'Hampir tidak pernah (1-2 kali).', 'Kadang-kadang (3-4 kali).', 'Hampir sering (5-6 kali) ', 'Sangat sering (lebih dari 6 kali).'),
(13, 3, 'Selama sebulan terakhir, seberapa sering anda mampu mengontrol rasa mudah tersinggung dalam kehidupan anda', 'Tidak pernah.', 'Hampir tidak pernah (1-2 kali).', 'Kadang-kadang (3-4 kali).', 'Hampir sering (5-6 kali) ', 'Sangat sering (lebih dari 6 kali).'),
(14, 3, 'Selama sebulan terakhir, seberapa sering anda merasa lebih mampu mengatasi masalah jika dibandingkan dengan orang lain', 'Tidak pernah.', 'Hampir tidak pernah (1-2 kali).', 'Kadang-kadang (3-4 kali).', 'Hampir sering (5-6 kali) ', 'Sangat sering (lebih dari 6 kali).'),
(15, 3, 'Selama sebulan terakhir, seberapa sering anda marah karena adanya masalah yang tidak dapat anda kendalikan', 'Tidak pernah.', 'Hampir tidak pernah (1-2 kali).', 'Kadang-kadang (3-4 kali).', 'Hampir sering (5-6 kali) ', 'Sangat sering (lebih dari 6 kali).'),
(16, 3, 'Selama sebulan terakhir, seberapa sering anda merasakan kesulitan yang menumpuk sehingga anda tidak mampu untuk mengatasinya', 'Tidak pernah.', 'Hampir tidak pernah (1-2 kali).', 'Kadang-kadang (3-4 kali).', 'Hampir sering (5-6 kali) ', 'Sangat sering (lebih dari 6 kali).');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `idsurvey` int(11) NOT NULL,
  `namasurvey` text NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`idsurvey`, `namasurvey`, `isi`) VALUES
(3, 'PSS', '<p>KUESIONER PERCEIVED STRESS SCALE</p>\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`idjawaban`);

--
-- Indexes for table `listjawaban`
--
ALTER TABLE `listjawaban`
  ADD PRIMARY KEY (`idlistjawaban`);

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`idpertanyaan`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`idsurvey`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `idjawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `listjawaban`
--
ALTER TABLE `listjawaban`
  MODIFY `idlistjawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `idpertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `idsurvey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
