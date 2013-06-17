-- phpMyAdmin SQL Dump
-- version 4.0.3
-- http://www.phpmyadmin.net
--
-- Inang: localhost
-- Waktu pembuatan: 17 Jun 2013 pada 14.20
-- Versi Server: 5.5.24-log
-- Versi PHP: 5.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `db_sires`
--
CREATE DATABASE IF NOT EXISTS `db_sires` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_sires`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_group_user`
--

CREATE TABLE IF NOT EXISTS `tbl_group_user` (
  `id_group_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_group_user` varchar(100) NOT NULL,
  `status_group_user` int(1) NOT NULL,
  PRIMARY KEY (`id_group_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `tbl_group_user`
--

INSERT INTO `tbl_group_user` (`id_group_user`, `nama_group_user`, `status_group_user`) VALUES
(1, 'Administrator', 1),
(2, 'Pelayan', 1),
(3, 'Kitchen', 1),
(4, 'Kasir', 1),
(5, 'Manager', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_makanan`
--

CREATE TABLE IF NOT EXISTS `tbl_makanan` (
  `id_makanan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_makanan` varchar(100) NOT NULL,
  `foto_makanan` varchar(100) NOT NULL,
  `keterangan_makanan` text NOT NULL,
  `status_makanan` int(1) NOT NULL,
  PRIMARY KEY (`id_makanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_meja`
--

CREATE TABLE IF NOT EXISTS `tbl_meja` (
  `id_meja` int(11) NOT NULL AUTO_INCREMENT,
  `nama_meja` varchar(100) NOT NULL,
  `keterangan_meja` varchar(100) NOT NULL,
  `status_meja` int(1) NOT NULL,
  PRIMARY KEY (`id_meja`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_minuman`
--

CREATE TABLE IF NOT EXISTS `tbl_minuman` (
  `id_minuman` int(11) NOT NULL AUTO_INCREMENT,
  `nama_minuman` varchar(100) NOT NULL,
  `foto_minuman` varchar(100) NOT NULL,
  `keterangan_minuman` text NOT NULL,
  `status_minuman` int(1) NOT NULL,
  PRIMARY KEY (`id_minuman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `id_meja` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `array_id_makanan` text NOT NULL,
  `array_id_minuman` text NOT NULL,
  `waktu_masuk` datetime NOT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `id_group_user` int(11) NOT NULL,
  `status_user` int(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
