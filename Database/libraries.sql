-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jul 2022 pada 19.42
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libraries`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `book`
--

CREATE TABLE `book` (
  `book_id` varchar(15) NOT NULL,
  `publisher_id` varchar(15) NOT NULL,
  `book_type_id` varchar(15) NOT NULL,
  `rack_id` varchar(15) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `page` int(4) NOT NULL,
  `publication_year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `book`
--

INSERT INTO `book` (`book_id`, `publisher_id`, `book_type_id`, `rack_id`, `book_name`, `page`, `publication_year`) VALUES
('book_001', 'pub_001', 'type_001', 'rack_001', 'Kisah Pencari Tahta', 89, 2017);

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_type`
--

CREATE TABLE `book_type` (
  `book_type_id` varchar(15) NOT NULL,
  `book_type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `book_type`
--

INSERT INTO `book_type` (`book_type_id`, `book_type_name`) VALUES
('type_001', 'Sejarah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `borrower`
--

CREATE TABLE `borrower` (
  `borrower_id` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `study_program` varchar(100) NOT NULL,
  `class` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `borrower`
--

INSERT INTO `borrower` (`borrower_id`, `name`, `gender`, `phone`, `address`, `study_program`, `class`) VALUES
('bor_001', 'Muhammad Ilman Aqilaa', 'Laki - laki', '08811234567', 'Bandung', 'Teknik Informatika', '2b');

-- --------------------------------------------------------

--
-- Struktur dari tabel `officer`
--

CREATE TABLE `officer` (
  `officer_id` varchar(15) NOT NULL,
  `officer_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `officer`
--

INSERT INTO `officer` (`officer_id`, `officer_name`, `phone`, `gender`) VALUES
('admin_001', 'Surya', '088174653857', 'Laki - laki');

-- --------------------------------------------------------

--
-- Struktur dari tabel `publisher`
--

CREATE TABLE `publisher` (
  `publisher_id` varchar(15) NOT NULL,
  `publisher_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `publisher`
--

INSERT INTO `publisher` (`publisher_id`, `publisher_name`) VALUES
('pub_001', 'Andrea Hirata');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rack`
--

CREATE TABLE `rack` (
  `rack_id` varchar(15) NOT NULL,
  `rack_name` varchar(50) NOT NULL,
  `column` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rack`
--

INSERT INTO `rack` (`rack_id`, `rack_name`, `column`) VALUES
('rack_001', 'Sejarah', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` varchar(15) NOT NULL,
  `book_id` varchar(15) NOT NULL,
  `officer_id` varchar(15) NOT NULL,
  `borrower_id` varchar(15) NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `book_id`, `officer_id`, `borrower_id`, `borrow_date`, `return_date`, `status`) VALUES
('trans_001', 'book_001', 'admin_001', 'bor_001', '2022-07-12', '2022-07-21', 'Dipinjam');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indeks untuk tabel `book_type`
--
ALTER TABLE `book_type`
  ADD PRIMARY KEY (`book_type_id`);

--
-- Indeks untuk tabel `borrower`
--
ALTER TABLE `borrower`
  ADD PRIMARY KEY (`borrower_id`);

--
-- Indeks untuk tabel `officer`
--
ALTER TABLE `officer`
  ADD PRIMARY KEY (`officer_id`);

--
-- Indeks untuk tabel `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`publisher_id`);

--
-- Indeks untuk tabel `rack`
--
ALTER TABLE `rack`
  ADD PRIMARY KEY (`rack_id`);

--
-- Indeks untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
