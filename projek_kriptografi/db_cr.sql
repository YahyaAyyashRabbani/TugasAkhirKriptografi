-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Nov 2024 pada 00.46
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cr`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `deck`
--

CREATE TABLE `deck` (
  `deck_id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `konten` text NOT NULL,
  `owner` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `deck`
--

INSERT INTO `deck` (`deck_id`, `judul`, `konten`, `owner`) VALUES
(1, 'Deck Hog Rider 2.6', '4CG\0\Z', 'NOTE'),
(2, 'Pekka Bridge spam', '4@G\0\Z', 'Z');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `komen_id` int(11) NOT NULL,
  `komen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`komen_id`, `komen`) VALUES
(18, 'N2lVUWFQd3ZyRDdWamtGdzlGR2VCQm1wNFpKVFlNVkgxN1pJVDVRMU81djhVSFErbjJORUZ3eU40RjVBeWM0Vjo6LOjd6FwFAYsR/jWjg4z3fw=='),
(19, 'VG1mekpLUTY1ZXljOUJKYVVQbnNRamI1YThWcTk4K3c0cWFPUTdvZnJrTVk3cU9BQTBkZ0RHTHhFU1FFbTgxMjo6yYOWsJKf0pcHKQyCHPfdYA==');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(3, 'yas', 'yas@gmail.com', '$2y$10$BGHuv.MU7W5iqc3H/p9PIOzqufbxi/iBpk9wIW4Gx56qAfgkdumLS'),
(5, 'l', 'l@gmail.com', '$2y$10$AVd.UJKL47gGfpJ7oy3dYeeNXTSjGwDXV.SH.4isCNgO.IgO8C.le'),
(6, 'ayas', 'ayas@gmail.com', '$2y$10$1JiOTFp2YZJDsTjJ5Tum5.mPJO9LF2dJEnNBCY93F6DL4.LeHvnAy');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `deck`
--
ALTER TABLE `deck`
  ADD PRIMARY KEY (`deck_id`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`komen_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `deck`
--
ALTER TABLE `deck`
  MODIFY `deck_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `komen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
