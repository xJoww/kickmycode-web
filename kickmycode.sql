-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jan 2024 pada 21.23
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kickmycode`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `email` varchar(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `password` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '$2y$10$0dEE24kRCypWRAdBqf63o.jXHI5vNjOoX7HjfZCBHGnUv8KU58uT.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel`
--

CREATE TABLE `tabel` (
  `id` int(11) NOT NULL,
  `user` varchar(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `tanggal` varchar(24) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `expire` varchar(24) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `expire_6hr` varchar(24) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `expire_16hr` varchar(24) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email` varchar(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email_pw` varchar(24) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `stake_pw` varchar(24) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tabel`
--

INSERT INTO `tabel` (`id`, `user`, `tanggal`, `expire`, `expire_6hr`, `expire_16hr`, `email`, `email_pw`, `stake_pw`) VALUES
(1, 'admin@gmail.com', '06/01/2024, 03:11', '12/01/2024, 03:11', '12/01/2024, 09:11', '12/01/2024, 19:11', 'dclr2337@zulmel.com', 'kamuhoki09', 'Kembalikan1'),
(2, 'admin@gmail.com', '06/01/2024, 03:14', '12/01/2024, 03:14', '12/01/2024, 09:14', '12/01/2024, 19:14', 'dclr2856@zulmel.com', 'kamuhoki09', 'Penyihir2'),
(3, 'admin@gmail.com', '06/01/2024, 03:16', '12/01/2024, 03:16', '12/01/2024, 09:16', '12/01/2024, 19:16', 'dclr2420@zulmel.com', 'kamuhoki09', 'Teneterika3'),
(4, 'admin@gmail.com', '06/01/2024, 03:16', '12/01/2024, 03:16', '12/01/2024, 09:16', '12/01/2024, 19:16', 'dclr2267@zulmel.com', 'kamuhoki09', 'Palaron4'),
(5, 'admin@gmail.com', '06/01/2024, 03:17', '12/01/2024, 03:17', '12/01/2024, 09:17', '12/01/2024, 19:17', 'dclr2005@zulmel.com', 'kamuhoki09', 'Tepongan5'),
(6, 'admin@gmail.com', '06/01/2024, 03:17', '12/01/2024, 03:17', '12/01/2024, 09:17', '12/01/2024, 19:17', 'dclr2680@zulmel.com', 'kamuhoki09', 'Pancider6'),
(7, 'admin@gmail.com', '06/01/2024, 03:17', '12/01/2024, 03:17', '12/01/2024, 09:17', '12/01/2024, 19:17', 'dclr2901@zulmel.com', 'kamuhoki09', 'Pedasin7'),
(8, 'admin@gmail.com', '06/01/2024, 03:18', '12/01/2024, 03:18', '12/01/2024, 09:18', '12/01/2024, 19:18', 'dclr2805@zulmel.com', 'kamuhoki09', 'Notifiks8'),
(9, 'admin@gmail.com', '06/01/2024, 03:18', '12/01/2024, 03:18', '12/01/2024, 09:18', '12/01/2024, 19:18', 'dclr2827@zulmel.com', 'kamuhoki09', 'Tentang9'),
(10, 'admin@gmail.com', '06/01/2024, 03:18', '12/01/2024, 03:18', '12/01/2024, 09:18', '12/01/2024, 19:18', 'dclr2017@zulmel.com', 'kamuhoki09', 'Ungkapan10'),
(11, 'admin@gmail.com', '06/01/2024, 03:19', '12/01/2024, 03:19', '12/01/2024, 09:19', '12/01/2024, 19:19', 'laroroma4@gmail.com', 'laro123$', 'Koamrisa1'),
(12, 'admin@gmail.com', '06/01/2024, 03:20', '12/01/2024, 03:20', '12/01/2024, 09:20', '12/01/2024, 19:20', 'mopiguga@gmail.com', 'mopi123$', 'Peraslanag2'),
(13, 'admin@gmail.com', '06/01/2024, 03:20', '12/01/2024, 03:20', '12/01/2024, 09:20', '12/01/2024, 19:20', 'raliboyo6@gmail.com', 'rali123$', 'Akuberhon3'),
(14, 'admin@gmail.com', '06/01/2024, 03:20', '12/01/2024, 03:20', '12/01/2024, 09:20', '12/01/2024, 19:20', 'sukiponi9@gmail.com', 'suki123$', 'Homanisa4');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tabel`
--
ALTER TABLE `tabel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tabel`
--
ALTER TABLE `tabel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
