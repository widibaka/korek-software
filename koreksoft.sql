-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Agu 2020 pada 02.26
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koreksoft`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `link_previewer`
--

CREATE TABLE `link_previewer` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `request_remains` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `link_previewer`
--

INSERT INTO `link_previewer` (`id`, `email`, `request_remains`) VALUES
(1, 'widibaka55@gmail.com', 1000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `product_plan_id` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(10) NOT NULL,
  `timestamp` datetime NOT NULL,
  `image` varchar(20) NOT NULL,
  `is_active` int(1) NOT NULL,
  `expire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`id`, `product_plan_id`, `user_id`, `amount`, `timestamp`, `image`, `is_active`, `expire`) VALUES
(5, 3, 1, 1, '2020-08-14 01:05:07', '', 0, '2021-02-14 01:05:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(56) NOT NULL,
  `ribbon_caption` varchar(20) NOT NULL,
  `link_download` varchar(255) NOT NULL,
  `user_docs` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `title`, `description`, `image`, `ribbon_caption`, `link_download`, `user_docs`) VALUES
(2, 'KorekSubs Makina', 'CMS khusus konten anime dibuat menggunakan Codeigniter 3.1', '2-1.jpg', '', '#', '#'),
(3, 'Koreksoft Link Previewer', 'Untuk menanpilkan pratinjau dari link', '1-1.jpg; 1-2.jpg; 1-3.jpg', 'NEW', 'https://github.com/widibaka/', '#');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_plan`
--

CREATE TABLE `product_plan` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `plan_title` varchar(50) NOT NULL,
  `feature` text NOT NULL,
  `price` varchar(110) NOT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product_plan`
--

INSERT INTO `product_plan` (`id`, `product_id`, `plan_title`, `feature`, `price`, `color`) VALUES
(1, 3, 'Free', 'No-ads: NO; Request limit: 1000 / day (collective); Could Use The Data: NO', '0', 'danger'),
(2, 3, 'Registered User', 'No-ads: NO; Request limit: 1000 / day (for each user); Could Use The Data: YES', '0', 'gray'),
(3, 3, 'Premium', 'No-ads: YES; Request limit: Unlimited; Could Use The Data: YES', 'Rp10.000 / 6 bln ($1 / 6 mo)', 'warning');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sidebar`
--

CREATE TABLE `sidebar` (
  `id` int(11) NOT NULL,
  `item` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sidebar`
--

INSERT INTO `sidebar` (`id`, `item`, `url`) VALUES
(1, 'Home', 'home'),
(2, 'Product', 'product'),
(3, 'Chat', 'chat'),
(4, 'Orders', 'order');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT '''''',
  `username` varchar(100) NOT NULL DEFAULT '''''',
  `password` varchar(255) NOT NULL DEFAULT '''''',
  `register_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `email`, `username`, `password`, `register_time`) VALUES
(1, 'widibaka55@gmail.com', 'Widi Baka', '123', '2020-07-31 14:09:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `website`
--

CREATE TABLE `website` (
  `id` int(11) NOT NULL,
  `website_name` varchar(20) NOT NULL,
  `website_title` varchar(100) NOT NULL,
  `website_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `website`
--

INSERT INTO `website` (`id`, `website_name`, `website_title`, `website_description`) VALUES
(1, 'Korek Software', 'Korek Software - Snippet, Plugin, & Source-code', 'Korek Software menyediakan produk-produk snippet, plugin, dan source-code.');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `link_previewer`
--
ALTER TABLE `link_previewer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`email`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_plan`
--
ALTER TABLE `product_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sidebar`
--
ALTER TABLE `sidebar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `website`
--
ALTER TABLE `website`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `link_previewer`
--
ALTER TABLE `link_previewer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `product_plan`
--
ALTER TABLE `product_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sidebar`
--
ALTER TABLE `sidebar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `website`
--
ALTER TABLE `website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
