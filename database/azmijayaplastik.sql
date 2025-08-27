-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 27 Agu 2025 pada 15.50
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `azmijayaplastik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `code`, `name`, `description`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'PLK-HDPE', 'HDPE', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(3, 'PLK-PE', 'PE', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(4, 'PLK-PETP', 'PE TIPIS', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(5, 'PLK-PETB', 'PE TEBAL', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(6, 'PLK-PP', 'PP', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(7, 'PLK-ATP', 'ATP', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(8, 'PLK-OPP', 'OPP', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(9, 'PLK-KLIP', 'STP & KLIP', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(10, 'PLK-SAMPAH', 'HD SAMPAH', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(11, 'PKG-BNT', 'KOTAK BENTO', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(12, 'PKG-DMS', 'DUS MAKAN & SNACK', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(13, 'PKG-PBLB', 'PAPER BOWL & LUNCH BOX', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(14, 'PKG-CPK', 'CUP PLASTIK & KERTAS', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(15, 'PKG-SDT', 'SEDOTAN', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(16, 'PKG-MK', 'MIKA', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(17, 'PKG-AKU', 'ALAS KUE', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(18, 'PKG-LAL', 'LOYANG ALUMUNIUM', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(19, 'PKG-CAG', 'CETAKAN AGAR', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(20, 'PKG-TLR', 'TALI RAPIA', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(21, 'PKG-ISO', 'ISOLASI', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(22, 'PKG-KRM', 'KERTAS MINYAK', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(23, 'PKG-KRK', 'KERTAS KADO', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(24, 'PKG-STY', 'STYROFOAM', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(25, 'PKG-BBW', 'BUBBLE WRAP', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(26, 'PKG-GBPB', 'GOODIE BAG & PAPER BAG', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(27, 'BHK-TGU', 'TEPUNG TERIGU', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(28, 'BHK-TMZ', 'TEPUNG MEIZENA', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(29, 'BHK-TPK', 'TEPUNG TAPIOKA', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(30, 'BHK-TBS', 'TEPUNG BERAS', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(31, 'BHK-TKT', 'TEPUNG KETAN', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(32, 'BHK-TRI', 'TEPUNG ROTI', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(33, 'BHK-GPR', 'GULA PASIR', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(34, 'BHK-GHS', 'GULA HALUS', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(35, 'BHK-GPM', 'GULA PALM', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(36, 'BHK-GMH', 'GULA MERAH', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(37, 'BHK-CBT', 'COKELAT BATANG', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(38, 'BHK-CBK', 'COKELAT BUBUK', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(39, 'BHK-MTG', 'MENTEGA', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(40, 'BHK-SBK', 'SUSU BUBUK', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(41, 'BHK-SKMK', 'SUSU KENTAL MANIS & KRIMER', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(42, 'BHK-SFC', 'SUSU FULL CREAM', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(43, 'BHK-WCR', 'WHIPPING CREAM', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(44, 'BHK-BPSK', 'BAKING POWDER & SODA KUE', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(45, 'BHK-RIN', 'RAGI INSTAN', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(46, 'BHK-STO', 'SP, TBM, OVALET', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(47, 'BHK-PMP', 'PEWARNA MAKANAN & PASTA', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(48, 'BHK-ESM', 'ESSENSE MAKANAN', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(49, 'BHK-SEL', 'SELAI', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(50, 'BHK-GZD', 'GLAZE DONAT', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(51, 'BHK-KEJ', 'KEJU', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(52, 'BHK-SMKC', 'SPRINGKEL, MESES, KISMIS, & CHOCO', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(53, 'BHK-BJG', 'BIJI JAGUNG', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `sku` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `supplier_id` bigint UNSIGNED DEFAULT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `unit` varchar(20) DEFAULT 'pcs',
  `cost_price` decimal(12,2) DEFAULT '0.00',
  `sell_price` decimal(12,2) DEFAULT '0.00',
  `stock` int DEFAULT '0',
  `min_stock` int DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
