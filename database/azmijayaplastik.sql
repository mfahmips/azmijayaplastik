-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 14 Sep 2025 pada 09.21
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
  `type` enum('category','sub','product') DEFAULT 'category',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `code`, `name`, `type`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'PLK-HD', 'HDPE', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(2, 'PLK-PE', 'PE', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(3, 'PLK-PT', 'PE TIPIS', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(4, 'PLK-PB', 'PE TEBAL', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(5, 'PLK-PP', 'PP', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(6, 'PLK-AT', 'ATP', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(7, 'PLK-OP', 'OPP', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(8, 'PLK-KP', 'KLIP', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(9, 'PLK-ST', 'STANDING POUCH', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(10, 'PLK-HS', 'HD SAMPAH', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(11, 'PKG-BT', 'KOTAK BENTO', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(12, 'PKG-DM', 'DUS MAKAN', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(13, 'PKG-DS', 'DUS SNACK', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(14, 'PKG-PB', 'PAPER BOWL', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(15, 'PKG-LB', 'LUNCH BOX', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(16, 'PKG-CP', 'CUP PLASTIK', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(17, 'PKG-CK', 'CUP KERTAS', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(18, 'PKG-ST', 'SEDOTAN', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(19, 'PKG-MK', 'MIKA', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(20, 'PKG-AK', 'ALAS KUE', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(21, 'PKG-LA', 'LOYANG ALUMUNIUM', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(22, 'PKG-CA', 'CETAKAN AGAR', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(23, 'PKG-TR', 'TALI RAPIA', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(24, 'PKG-IS', 'ISOLASI', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(25, 'PKG-KM', 'KERTAS NASI', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(26, 'PKG-KK', 'KERTAS KADO', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(27, 'PKG-SY', 'STYROFOAM', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(28, 'PKG-BW', 'BUBBLE WRAP', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(29, 'PKG-GB', 'GOODIE BAG', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(30, 'PKG-PG', 'PAPER BAG', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(31, 'BHK-TT', 'TEPUNG TERIGU', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(32, 'BHK-TM', 'TEPUNG MEIZENA', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(33, 'BHK-TP', 'TEPUNG TAPIOKA', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(34, 'BHK-TB', 'TEPUNG BERAS', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(35, 'BHK-TK', 'TEPUNG KETAN', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(36, 'BHK-TR', 'TEPUNG ROTI', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(37, 'BHK-GP', 'GULA PASIR', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(38, 'BHK-GH', 'GULA HALUS', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(39, 'BHK-GL', 'GULA PALM', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(40, 'BHK-GM', 'GULA MERAH', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(41, 'BHK-CB', 'COKELAT BATANG', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(42, 'BHK-CU', 'COKELAT BUBUK', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(43, 'BHK-MT', 'MENTEGA', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(44, 'BHK-SB', 'SUSU BUBUK', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(45, 'BHK-SM', 'SUSU KENTAL MANIS', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(46, 'BHK-SK', 'SUSU KRIMER', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(47, 'BHK-SF', 'SUSU FULL CREAM', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(48, 'BHK-WC', 'WHIPPING CREAM', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(49, 'BHK-BS', 'BAKING POWDER & SODA KUE', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(50, 'BHK-RI', 'RAGI INSTAN', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(51, 'BHK-ST', 'SP, TBM, OVALET', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(52, 'BHK-PP', 'PEWARNA MAKANAN & PASTA', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(53, 'BHK-EM', 'ESSENSE MAKANAN', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(54, 'BHK-SE', 'SELAI', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(55, 'BHK-GD', 'GLAZE DONAT', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(56, 'BHK-KJ', 'KEJU', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(57, 'BHK-MK', 'SPRINGKEL, MESES, KISMIS', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37'),
(58, 'BHK-BJ', 'BIJI JAGUNG', 'category', 1, '2025-09-14 04:01:37', '2025-09-14 04:01:37');

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
  `sku` varchar(50) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
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
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `brand`, `category_id`, `supplier_id`, `barcode`, `unit`, `cost_price`, `sell_price`, `stock`, `min_stock`, `is_active`, `description`, `created_at`, `updated_at`) VALUES
(1, 'PLK-PE001-MICO', 'PE 4 X 23', 'Mico', 2, NULL, NULL, 'Bks', 0.00, 8000.00, 16, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(2, 'PLK-PE002-BAWANG', 'PE 4,5 X 23', 'Bawang', 2, NULL, NULL, 'Bks', 0.00, 8000.00, 0, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(3, 'PLK-PE003-MICO', 'PE 6 X 20', 'Mico', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 8, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(4, 'PLK-PE004-MICO', 'PE 7 X 20', 'Mico', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 9, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(5, 'PLK-PE005-MICO', 'PE 8 X 20', 'Mico', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 5, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(6, 'PLK-PE006-BAWANG', 'PE 9 X 20', 'Bawang', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 1, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(7, 'PLK-PE007-MICO', 'PE 10 X 20', 'Mico', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 25, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(8, 'PLK-PE008-BAWANG', 'PE 10 X 20', 'Bawang', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 8, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(9, 'PLK-PE009-MICO', 'PE 10 X 25', 'Mico', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 21, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(10, 'PLK-PE010-MICO', 'PE 12 X 25', 'Mico', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 7, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(11, 'PLK-PE011-BAWANG', 'PE 12 X 25', 'Bawang', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 10, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(12, 'PLK-PE012-MICO', 'PE 12 X 30', 'Mico', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 15, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(13, 'PLK-PE013-MICO', 'PE 15 X 30', 'Mico', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 25, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(14, 'PLK-PE014-MICO', 'PE 14 X 35', 'Mico', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 35, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(15, 'PLK-PE015-MICO', 'PE 17 X 35', 'Mico', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 22, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(16, 'PLK-PE016-MICO', 'PE 20 X 35', 'Mico', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 5, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(17, 'PLK-PE017-BAWANG', 'PE 20 X 35', 'Bawang', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 10, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(18, 'PLK-PE018-MICO', 'PE 20 X 40', 'Mico', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 11, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(19, 'PLK-PT001-KEMBANG', 'PT 10 X 30', 'Kembang', 3, NULL, NULL, 'Bks', 1600.00, 2500.00, 12, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(20, 'PLK-PT002-KEMBANG', 'PT 12 X 35', 'Kembang', 3, NULL, NULL, 'Bks', 2200.00, 3000.00, 24, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(21, 'PLK-PT003-KEMBANG', 'PT 15 X 35', 'Kembang', 3, NULL, NULL, 'Bks', 2600.00, 3500.00, 20, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(22, 'PLK-PT004-KEMBANG', 'PT 17 X 35', 'Kembang', 3, NULL, NULL, 'Bks', 0.00, 4500.00, 15, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(23, 'PLK-AT001-OBOR', 'ATP 10 X 20', 'Obor', 6, NULL, NULL, 'Bks', 7125.00, 10000.00, 7, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(24, 'PLK-AT002-OBOR', 'ATP 12 X 25', 'Obor', 6, NULL, NULL, 'Bks', 7125.00, 10000.00, 9, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(25, 'PLK-AT003-OBOR', 'ATP 15 X 30', 'Obor', 6, NULL, NULL, 'Bks', 7125.00, 10000.00, 6, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(26, 'PLK-AT004-OBOR', 'ATP 20 X 35', 'Obor', 6, NULL, NULL, 'Bks', 7125.00, 10000.00, 7, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(27, 'PLK-AT005-OBOR', 'ATP 20 X 20', 'Obor', 6, NULL, NULL, 'Bks', 7125.00, 10000.00, 7, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(28, 'PLK-KP001-CETIK', 'Klip 6 X 4', 'Cetik', 8, NULL, NULL, 'Bks', 0.00, 4000.00, 9, 0, 1, NULL, '2025-09-14 07:25:26', '2025-09-14 07:32:26'),
(29, 'PLK-KP002-LIPS', 'Klip 6 X 4', 'Lips', 8, NULL, NULL, 'Bks', 0.00, 4000.00, 3, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(30, 'PLK-KP003-CETAK', 'Klip 5 X 8', 'Cetak', 8, NULL, NULL, 'Bks', 0.00, 5000.00, 10, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(31, 'PLK-KP004-LIPS', 'Klip 5 X 8', 'Lips', 8, NULL, NULL, 'Bks', 0.00, 5000.00, 3, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(32, 'PLK-KP005-CETAK', 'Klip 6 X 10', 'Cetak', 8, NULL, NULL, 'Bks', 0.00, 6000.00, 3, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(33, 'PLK-KP006-IPPM', 'Klip 10 X 7', 'IPPM', 8, NULL, NULL, 'Bks', 0.00, 7000.00, 9, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(34, 'PLK-KP007-IPPM', 'Klip 12 X 8', 'IPPM', 8, NULL, NULL, 'Bks', 0.00, 8000.00, 8, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(35, 'PLK-KP008-IPPM', 'Klip 10 X 15', 'IPPM', 8, NULL, NULL, 'Bks', 0.00, 10000.00, 13, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(36, 'PLK-ST001-BLUTOP', 'STP 9 X 15', 'Blutop', 9, NULL, NULL, 'Bks', 0.00, 10000.00, 1, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(37, 'PLK-ST002-BLUTOP', 'STP 10 X 17', 'Blutop', 9, NULL, NULL, 'Bks', 0.00, 10000.00, 0, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(38, 'PLK-ST003-BLUTOP', 'STP 12 X 20', 'Blutop', 9, NULL, NULL, 'Bks', 0.00, 10000.00, 2, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(39, 'PLK-ST004-BLUTOP', 'STP 14 X 22', 'Blutop', 9, NULL, NULL, 'Bks', 0.00, 10000.00, 5, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(40, 'PLK-ST005-BLUTOP', 'STP 16 X 24', 'Blutop', 9, NULL, NULL, 'Bks', 0.00, 10000.00, 2, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(41, 'PLK-ST006-BLUTOP', 'STP 16 X 32', 'Blutop', 9, NULL, NULL, 'Bks', 0.00, 10000.00, 5, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(42, 'PLK-ST007-BLUTOP', 'STP 20 X 29', 'Blutop', 9, NULL, NULL, 'Bks', 0.00, 10000.00, 5, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(43, 'PLK-HS001-MOCO', 'HD Sampah 60 X 100', 'Moco', 10, NULL, NULL, 'Pak', 4250.00, 20000.00, 20, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(44, 'PLK-HS002-MOCO', 'HD Sampah 90 X 120', 'Moco', 10, NULL, NULL, 'Pak', 4250.00, 20000.00, 19, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(45, 'PLK-HD001-MEGA', 'HD Warna 10', 'Mega', 1, NULL, NULL, 'Pak', 3000.00, 5000.00, 17, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(46, 'PLK-HD002-NULL', 'HD Bening 10', 'Null', 1, NULL, NULL, 'Pak', 0.00, 5000.00, 0, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(47, 'PLK-HD003-PUSAKA', 'HD Bening 15', 'Pusaka', 1, NULL, NULL, 'Pak', 0.00, 7000.00, 146, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(48, 'PLK-HD004-PUSAKA', 'HD Bening 24', 'Pusaka', 1, NULL, NULL, 'Pak', 0.00, 7000.00, 148, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(49, 'PLK-HD005-NULL', 'HD Hitam 24', 'Null', 1, NULL, NULL, 'Pak', 0.00, 0.00, 0, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(50, 'PLK-HD006-JERUK', 'HD Salur 28', 'Jeruk', 1, NULL, NULL, 'Pak', 0.00, 8000.00, 123, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(51, 'PLK-HD007-NULL', 'HD Hitam 28', 'Null', 1, NULL, NULL, 'Pak', 0.00, 0.00, 0, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(52, 'PLK-HD008-MICO', 'HD Merah 28', 'Mico', 1, NULL, NULL, 'Pak', 12000.00, 17000.00, 27, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(53, 'PLK-HD009-TIGER', 'HD Merah 28', 'Tiger', 1, NULL, NULL, 'Pak', 12000.00, 17000.00, 4, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(54, 'PLK-HD010-TIGER', 'HD Putih 28', 'Tiger', 1, NULL, NULL, 'Pak', 14800.00, 17000.00, 5, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(55, 'PLK-HD011-LOCO', 'HD Hitam 35', 'Loco', 1, NULL, NULL, 'Pak', 12800.00, 16000.00, 7, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(56, 'PLK-HD012-TIGER', 'HD Merah 35', 'Tiger', 1, NULL, '', 'Pak', 14800.00, 18000.00, 8, 0, 1, '', '2025-09-14 07:25:27', '2025-09-14 08:54:44'),
(57, 'PLK-HD013-TIGER', 'HD Putih 35', 'Tiger', 1, NULL, NULL, 'Pak', 14800.00, 0.00, 7, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(58, 'PLK-HD014-OTO', 'HD Hitam 40', 'Oto', 1, NULL, NULL, 'Pak', 17200.00, 0.00, 5, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(59, 'PLK-HD015-DELMAN', 'HD Hitam 40', 'Delman', 1, NULL, NULL, 'Pak', 17200.00, 0.00, 10, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(60, 'PLK-HD016-TIGER', 'HD Merah 40', 'Tiger', 1, NULL, NULL, 'Pak', 14800.00, 0.00, 7, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(61, 'PLK-HD017-TIGER', 'HD Putih 40', 'Tiger', 1, NULL, NULL, 'Pak', 14800.00, 0.00, 9, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(62, 'PLK-HD018-MOCO', 'HD Hitam 50', 'Moco', 1, NULL, '', 'Pcs', 17500.00, 3000.00, 4, 0, 1, '', '2025-09-14 07:25:27', '2025-09-14 08:57:58'),
(63, 'PLK-HD019-TIGER', 'HD Merah 50', 'Tiger', 1, NULL, NULL, 'Pcs', 29000.00, 0.00, 2, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(64, 'PLK-HD020-NULL', 'HD Putih 50', 'Null', 1, NULL, NULL, 'Pcs', 0.00, 0.00, 0, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(65, 'PKG-SY001-NULL', 'Foam Besar Polos', 'Null', 27, NULL, '', 'Pcs', 0.00, 500.00, 500, 0, 1, '', '2025-09-14 07:25:27', '2025-09-14 07:40:01'),
(66, 'PKG-SY002-NULL', 'Foam Besar Sekat', 'Null', 27, NULL, '', 'Pcs', 0.00, 500.00, 0, 0, 1, '', '2025-09-14 07:25:27', '2025-09-14 07:40:36'),
(67, 'PKG-SY003-NULL', 'Foam HB Burger', 'Null', 27, NULL, NULL, 'Pcs', 0.00, 0.00, 500, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(68, 'PKG-SY004-NULL', 'Foam Sedang', 'Null', 27, NULL, NULL, 'Pcs', 0.00, 0.00, 0, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(69, 'PKG-SY005-NULL', 'Foam Mangkuk Besar', 'Null', 27, NULL, NULL, 'Pcs', 0.00, 0.00, 0, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(70, 'PKG-SY006-NULL', 'Foam Mangkuk Sedang', 'Null', 27, NULL, NULL, 'Pcs', 0.00, 0.00, 0, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(71, 'PKG-SY007-NULL', 'Foam Mangkuk Kecil', 'Null', 27, NULL, NULL, 'Pcs', 0.00, 0.00, 0, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(72, 'PKG-CP001-ANGGUR', 'Cup Aqua', 'Anggur', 16, NULL, NULL, 'Roll', 4750.00, 7000.00, 40, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(73, 'PKG-CP002-PRIMA', 'Cup 16 OZ', 'Prima', 16, NULL, NULL, 'Roll', 7500.00, 10000.00, 20, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(74, 'PKG-CP003-PRIMA', 'Cup 14 OZ', 'Prima', 16, NULL, NULL, 'Roll', 7500.00, 10000.00, 10, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(75, 'PKG-CP004-PRIMA', 'Cup 12 OZ', 'Prima', 16, NULL, NULL, 'Roll', 7500.00, 10000.00, 10, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(76, 'PKG-CP005-PRIMA', 'Cup 10 OZ', 'Prima', 16, NULL, NULL, 'Roll', 0.00, 10000.00, 0, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(77, 'PKG-MK001-NULL', 'Mika 3A', 'Null', 19, NULL, NULL, 'Ikat', 10000.00, 15000.00, 9, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(78, 'PKG-MK002-NULL', 'Mika 4A', 'Null', 19, NULL, NULL, 'Ikat', 7000.00, 10000.00, 10, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(79, 'PKG-MK003-NULL', 'Mika 7C', 'Null', 19, NULL, NULL, 'Ikat', 2500.00, 5000.00, 10, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(80, 'PKG-MK004-NULL', 'Mika 2A', 'Null', 19, NULL, NULL, 'Pcs', 560.00, 1000.00, 50, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(81, 'PKG-MK005-NULL', 'Mika 1A', 'Null', 19, NULL, NULL, 'Pcs', 950.00, 1500.00, 49, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(82, 'PKG-MK006-NULL', 'Mika 1X', 'Null', 19, NULL, NULL, 'Pcs', 1440.00, 2000.00, 50, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(83, 'PKG-KM001-NULL', 'Kertas Nasi 100', 'Null', 25, NULL, NULL, 'Pak', 8000.00, 10000.00, 5, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(84, 'PKG-KM002-GAJAH', 'Kertas Nasi 250', 'Gajah', 25, NULL, NULL, 'Pak', 22800.00, 28000.00, 4, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(85, 'PKG-KM003-ANGEL', 'Kertas Nasi Bunga 24 - B', 'Angel', 25, NULL, NULL, 'Pak', 16000.00, 20000.00, 5, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26'),
(86, 'PKG-KM004-ANGEL', 'Kertas Nasi Bunga 28 - B', 'Angel', 25, NULL, NULL, 'Pak', 20000.00, 25000.00, 5, 0, 1, NULL, '2025-09-14 07:25:27', '2025-09-14 07:32:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_prices`
--

CREATE TABLE `product_prices` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `unit` varchar(50) NOT NULL,
  `min_qty` int DEFAULT '1',
  `price` decimal(12,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `product_prices`
--

INSERT INTO `product_prices` (`id`, `product_id`, `unit`, `min_qty`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kg', 5, 35000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(2, 2, 'Kg', 5, 35000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(3, 3, 'Kg', 5, 35000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(4, 4, 'Kg', 5, 35000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(5, 5, 'Kg', 5, 35000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(6, 6, 'Kg', 5, 35000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(7, 7, 'Kg', 5, 35000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(8, 8, 'Kg', 5, 35000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(9, 9, 'Kg', 5, 35000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(10, 10, 'Kg', 5, 35000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(11, 11, 'Kg', 5, 35000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(12, 12, 'Kg', 5, 35000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(13, 13, 'Kg', 5, 35000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(14, 14, 'Kg', 5, 35000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(15, 15, 'Kg', 5, 35000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(16, 16, 'Kg', 5, 35000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(17, 17, 'Kg', 5, 35000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(18, 18, 'Kg', 5, 35000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(19, 19, 'Ikat', 5, 8000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(20, 20, 'Ikat', 5, 12000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(21, 21, 'Ikat', 5, 15000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(22, 22, 'Ikat', 5, 18000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(23, 23, 'Ikat', 4, 38000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(24, 24, 'Ikat', 4, 38000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(25, 25, 'Ikat', 4, 38000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(26, 26, 'Ikat', 4, 38000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(27, 27, 'Ikat', 4, 38000.00, '2025-09-14 07:25:26', '2025-09-14 07:25:26'),
(28, 62, 'Pak', 1, 23000.00, '2025-09-14 08:58:43', '2025-09-14 08:58:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `total_price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_items` int NOT NULL DEFAULT '0',
  `paid` decimal(15,2) NOT NULL DEFAULT '0.00',
  `change` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sale_items`
--

CREATE TABLE `sale_items` (
  `id` bigint UNSIGNED NOT NULL,
  `sale_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `qty` int NOT NULL DEFAULT '0',
  `subtotal` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_in`
--

CREATE TABLE `stock_in` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `supplier_id` bigint UNSIGNED DEFAULT NULL,
  `qty` int NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `cost_price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_opnames`
--

CREATE TABLE `stock_opnames` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `stock_system` int NOT NULL,
  `stock_real` int NOT NULL,
  `difference` int NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `store_settings`
--

CREATE TABLE `store_settings` (
  `id` int UNSIGNED NOT NULL,
  `store_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `store_owner` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `store_category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `store_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `store_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `store_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `store_phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `store_facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `store_instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `store_tiktok` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `store_website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `store_settings`
--

INSERT INTO `store_settings` (`id`, `store_name`, `store_owner`, `store_category`, `store_address`, `store_logo`, `store_description`, `store_phone`, `store_facebook`, `store_instagram`, `store_tiktok`, `store_website`, `created_at`, `updated_at`) VALUES
(1, 'Azmi Jaya Plastik', 'Muhamad Fahmi Purnama Sidiq', 'Toko Plastik dan Bahan Kue', 'Jalan Jembatan Hitam No. 1 RT. 03/10 Desa Cijujung Kec. Sukaraja Kab. Bogor', 'uploads/website/logo/1756990951_3eb4812f75684798e218.png', '', '08561331998', '', 'azmijayaplastik', '', 'www.azmijayaplastik.com', '2025-09-04 12:29:43', '2025-09-07 13:41:20');

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
  `payment_method` enum('cash','termin') DEFAULT 'cash',
  `default_terms` int DEFAULT '0',
  `bank_account` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `date`, `description`, `amount`, `type`, `created_at`, `updated_at`) VALUES
(1, '2025-09-06', 'Hutang', 400000.00, 'out', '2025-09-06 18:49:40', '2025-09-06 18:49:40'),
(3, '2025-09-06', 'Penjualan Total', 804000.00, 'in', '2025-09-06 18:52:15', '2025-09-07 01:52:29');

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
-- Indeks untuk tabel `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product` (`product_id`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice` (`invoice`),
  ADD KEY `idx_invoice` (`invoice`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indeks untuk tabel `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_sale_id` (`sale_id`),
  ADD KEY `idx_product_id` (`product_id`);

--
-- Indeks untuk tabel `stock_in`
--
ALTER TABLE `stock_in`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indeks untuk tabel `stock_opnames`
--
ALTER TABLE `stock_opnames`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `store_settings`
--
ALTER TABLE `store_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT untuk tabel `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `stock_in`
--
ALTER TABLE `stock_in`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `stock_opnames`
--
ALTER TABLE `stock_opnames`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `store_settings`
--
ALTER TABLE `store_settings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Ketidakleluasaan untuk tabel `product_prices`
--
ALTER TABLE `product_prices`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sale_items`
--
ALTER TABLE `sale_items`
  ADD CONSTRAINT `fk_sale_items_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_sale_items_sale` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stock_in`
--
ALTER TABLE `stock_in`
  ADD CONSTRAINT `stock_in_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_in_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stock_opnames`
--
ALTER TABLE `stock_opnames`
  ADD CONSTRAINT `stock_opnames_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
