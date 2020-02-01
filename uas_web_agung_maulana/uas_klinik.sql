-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 01 Feb 2020 pada 08.41
-- Versi Server: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas_klinik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `nip` varchar(10) NOT NULL,
  `namaadmin` varchar(100) DEFAULT NULL,
  `kontak` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `password_user` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`nip`, `namaadmin`, `kontak`, `alamat`, `password_user`) VALUES
('001', 'administrator', '088704145010', 'indonesia', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE IF NOT EXISTS `pasien` (
  `idpasien` varchar(20) NOT NULL,
  `namapasien` varchar(100) DEFAULT NULL,
  `kontak` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`idpasien`, `namapasien`, `kontak`, `alamat`, `foto`) VALUES
('P20200201082907', 'agung maulana', '0887', 'jl bogor', 'img_20200201_082927.jpg'),
('P20200201082933', 'aaa', '21212', 'aa', 'img_20200201_082943.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE IF NOT EXISTS `pendaftaran` (
  `iddaftar` varchar(20) NOT NULL,
  `idpasien` varchar(20) DEFAULT NULL,
  `tgldaftar` date DEFAULT NULL,
  `idadmin` varchar(10) DEFAULT NULL,
  `biaya` double DEFAULT NULL,
  `jenisdaftar` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`iddaftar`, `idpasien`, `tgldaftar`, `idadmin`, `biaya`, `jenisdaftar`) VALUES
('DF20200201051421', 'P20200201051421', '2020-02-20', '001', 20000, 'belum'),
('DF20200201051430', 'P20200201051430', '2020-02-01', '001', 2000, 'belum'),
('DF20200201051457', 'P20200201051457', '2020-02-01', '001', 20002121, 'belum'),
('DF20200201081949', 'P20200201081949', '2020-02-01', '001', 212121, 'belum'),
('DF20200201082907', 'P20200201082907', '2020-02-01', '001', 200, 'belum'),
('DF20200201082933', 'P20200201082933', '2020-02-01', '001', 2121, 'belum'),
('DF20200201083925', 'P20200201083925', '2020-02-01', '001', 121212, 'belum');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`idpasien`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`iddaftar`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
