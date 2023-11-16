-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Waktu pembuatan: 16 Nov 2023 pada 09.29
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kelompok6_pa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`id`, `judul`, `penulis`, `harga`, `email`) VALUES
(31, 'I Love You, Idiot!', 'XuenSun', 77000, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `checkout`
--

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `checkout`
--

INSERT INTO `checkout` (`id`, `judul`, `email`, `status`) VALUES
(2, 'I Love You, Idiot!', 'ajadinda975@gmail.com', 'Sudah Dibeli'),
(3, 'Your Majesty', 'ajadinda975@gmail.com', 'Sudah Dibeli'),
(4, '[Zoro x Reader]', 'ajadinda975@gmail.com', 'Sudah Dibeli'),
(5, 'The Villains In One Piece, Otome Game World', 'ajadinda975@gmail.com', 'Sudah Dibeli'),
(6, 'The Nightmare', 'ajadinda975@gmail.com', 'Sudah Dibeli'),
(7, 'Your Majesty', 'vista@gmail.com', 'Sudah Dibeli'),
(8, 'I Love You, Idiot!', 'vista@gmail.com', 'Sudah Dibeli'),
(9, 'Your Majesty', 'alif@gmail.com', 'Sudah Dibeli');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ebook`
--

CREATE TABLE `ebook` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `genre` varchar(25) NOT NULL,
  `halaman` int(11) NOT NULL,
  `penjualan` int(11) DEFAULT NULL,
  `cover` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ebook`
--

INSERT INTO `ebook` (`id`, `judul`, `penulis`, `harga`, `genre`, `halaman`, `penjualan`, `cover`, `deskripsi`) VALUES
(1, 'I Love You, Idiot!', 'XuenSun', 77000, 'Romance', 50, 2, 'cover/I Love You, Idiot_.jpg', '&quot;Aku... Aku mencintaimu!&quot; \r\n\r\n(Name) mengatakan itu dengan wajah memerah. Namun sosok bertopi jerami di depannya hanya memberikannya tatapan bingung dan senyum konyol yang sering pria itu tampilkan. \r\n\r\n&quot;Oh? Aku juga mencintaimu (name)! Aku mencintai semua orang di kapal! Shishishi~&quot;\r\n\r\nWajah (name) menggelap, didetik berikutnya Luffy terpental dan jatuh ke laut.'),
(2, 'The Villains In One Piece, Otome Game World', 'XuenSun', 120000, 'Aksi', 230, 2, 'cover/The Villains In One Piece, Otome Game World.jpg', 'Pemerintah Jepang merilis sebuah game berbasis VR dari serial One Piece. Game yang mengguncang dunia para pencinta anime ini memiliki jumlah yang terbatas. \r\n\r\nNamun y/n, seorang gadis biasa menerima paket misterius berisikan game tersebut tapi dengan model yang berbeda dari yang telah diluncurkan.\r\n\r\n&quot;Siapa orang yang mengirim ini? Apa dia tidak salah alamat? Hm? Versi Khusus? Apa maksudnya ini?&quot;'),
(3, '[Zoro x Reader]', 'XuenSun', 100000, 'Komedi', 500, 1, 'cover/_Zoro x Reader_.jpg', 'Zoro si tukang nyasar yang kurang peka vs Y/n si gadis bucin yang suka modus.\r\n\r\nBagaimanakah kira-kira kisah mereka?'),
(5, 'The Nightmare', 'XuenSun', 110000, 'Aksi', 160, 1, 'cover/The Nightmare.jpg', '(Name) tidak mengerti, satu-satunya yang dia pahami adalah... Perasaannya pada pria itu tampak tidak nyata. Apa dia benar-benar jatuh cinta padanya? Atau semua perasaan ini...\r\n\r\n&quot;Palsu? Shishishi, siapa yang mengatakan itu padamu?&quot;\r\n\r\nSosok kurus itu tersenyum padanya, namun bukan nya membawa kecerian, senyum miliknya itu tampak... Sedikit menakutkan.'),
(6, 'Your Majesty', 'XuenSun', 90000, 'Romance', 85, 3, 'cover/Your Majesty.jpg', 'Dari seorang pelayan biasa menjadi seorang putri dalam satu malam? Bukankah itu terdengar ajaib dan mengagumkan? \r\n\r\nSeperti cerita dongeng yang sering kalian dengar, dimana seorang pelayan kecil yang menyedihkan akhirnya menjadi seorang putri dan bertemu pangerannya. \r\n\r\nBukankah itu terdengar luar biasa? '),
(11, 'There Not Love Story For Us', 'XuenSun', 56000, 'Romance', 69, 0, 'cover/There Not Love Story For Us.jpg', 'Kisah kami tak semanis cerita di dalam buku, sejujurnya kami benar-benar tidak akan bisa bersama, tapi tetap aku ingin bersamanya - (Name)'),
(12, 'Never Leave me', 'XuenSun', 234900, 'Romance', 59, 0, 'cover/Never Leave me.jpg', 'Jangan pergi... - (name)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `profile_picture` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact`, `profile_picture`) VALUES
(26, 'kelompok6', 'kelompok6@gmail.com', '$2y$10$ofVVtA5WsNJbHGmEYBagKeM3kIkffIftSd6s.Z.k448O4K5M63v96', '+6282148188760', 'profile/2023-11-14 06-35-43.gif'),
(27, 'Dinda Ayu Aprilia', 'ajadinda975@gmail.com', '$2y$10$rQaG3zPbLlwbvv5YOx5IkuOIDHq0.IFt4hFz6WooMZxZeAnuQ5WR2', '082148188766', 'profile/2023-11-15 22-56-05.jpg'),
(30, 'Vista Mellyna Atsfi', 'vista@gmail.com', '$2y$10$2krj9xeYWyuUzOsn4j8V6OvElgMcAPuLpFIgFdXenSAMPdNmgdMZO', '082148188769', 'profile/2023-11-16 02-34-11.jpg'),
(31, 'Muhammad Rizky Putra Pratama', 'tama@gmail.com', '$2y$10$yViQfnFu0MHm3X5buCZhHOa4.ulr8loiTSWXdiSUlSKAYt0oGfqF2', '082148188761', 'profile/2023-11-16 02-14-21.jpg'),
(32, 'Alif Naufal Fachrian', 'alif@gmail.com', '$2y$10$1wZ9aUC9xLVaAvUjIzEwBe3fel9WPfmeQVYIsZkbfItQX4XnJzR4.', '082148188756', 'profile/2023-11-16 09-16-46.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ebook`
--
ALTER TABLE `ebook`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `ebook`
--
ALTER TABLE `ebook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
