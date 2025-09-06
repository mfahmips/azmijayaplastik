-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 06 Sep 2025 pada 19.02
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
(53, 'BHK-BJG', 'BIJI JAGUNG', NULL, 1, '2025-08-24 02:38:17', '2025-08-24 02:38:17', NULL),
(54, 'SKU1757168944', 'ATP 12 X 25', '7', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(55, 'SKU1757169042', 'ATP 15 X 30', '7', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(56, 'SKU1757169151', 'ATP 20 X 35', '7', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(57, 'SKU1757169173', 'ATP 20 X 20', '7', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(58, 'SKU1757169535', 'PT 10', '4', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(59, 'SKU1757169564', 'PT 12', '4', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(60, 'SKU1757169592', 'PT 15', '4', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(61, 'SKU1757169750', 'KLIP 4 X 6', '9', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(62, 'SKU1757169793', 'KLIP 5 X 8', '9', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(63, 'SKU1757169837', 'KLIP 10 X 15', '9', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(64, 'SKU1757170179', 'HD SAMPAH 60 X 100', '10', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(65, 'SKU1757170199', 'HD SAMPAH 90 X 120', '10', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(66, 'SKU1757170287', 'HD 1 CUP WARNA', '2', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(67, 'SKU1757170377', 'HD HITAM 35', '2', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(68, 'SKU1757170413', 'HD HITAM 40', '2', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(69, 'SKU1757170453', 'HD HITAM 50', '2', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(70, 'SKU1757170492', 'HD MERAH 28', '2', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(71, 'SKU1757170514', 'HD MERAH 35', '2', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(72, 'SKU1757170543', 'HD MERAH 40', '2', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(73, 'SKU1757170648', 'HD MERAH 50', '2', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(74, 'SKU1757170821', 'HD PUTIH 28', '2', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(75, 'SKU1757170839', 'HD PUTIH 35', '2', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(76, 'SKU1757170852', 'HD PUTIH 40', '2', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(77, 'SKU1757171010', 'PE 10 X 20', '3', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(78, 'SKU1757171039', 'PE 12 X 25', '3', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(79, 'SKU1757171055', 'PE 15 X 30', '3', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(80, 'SKU1757171372', 'FOAM BESAR POLOS', '24', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(81, 'SKU1757171534', 'FOAM HB BURGER', '24', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(82, 'SKU1757171705', 'CUP AQUA', '14', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(83, 'SKU1757171831', 'CUP 16 OZ', '14', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(84, 'SKU1757171852', 'CUP 14 OZ', '14', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(85, 'SKU1757171872', 'CUP 12 OZ', '14', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(86, 'SKU1757171948', 'MIKA 3A', '16', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(87, 'SKU1757171986', 'MIKA 4A', '16', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(88, 'SKU1757172026', 'MIKA 7C', '16', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(89, 'SKU1757172095', 'MIKA 2A', '16', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(90, 'SKU1757172124', 'MIKA 1A', '16', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(91, 'SKU1757172176', 'MIKA JUMBO', '16', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(92, 'SKU1757172270', 'KN 100', '22', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(93, 'SKU1757172450', 'KN 250', '22', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(94, 'SKU1757172585', 'KN BUNGA 24 - B', '22', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL),
(95, 'SKU1757172641', 'KN BUNGA 28 - B', '22', 1, '2025-09-06 17:46:30', '2025-09-06 17:46:30', NULL);

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
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `category_id`, `supplier_id`, `barcode`, `unit`, `cost_price`, `sell_price`, `stock`, `min_stock`, `is_active`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'SKU1757168944', 'ATP 12 X 25', 7, NULL, NULL, 'pcs', 0.00, 0.00, 8, 0, 1, NULL, NULL, NULL, NULL),
(7, 'SKU1757169042', 'ATP 15 X 30', 7, NULL, NULL, 'pcs', 0.00, 0.00, 8, 0, 1, NULL, NULL, NULL, NULL),
(8, 'SKU1757169151', 'ATP 20 X 35', 7, NULL, NULL, 'pcs', 0.00, 0.00, 8, 0, 1, NULL, NULL, NULL, NULL),
(9, 'SKU1757169173', 'ATP 20 X 20', 7, NULL, NULL, 'pcs', 0.00, 0.00, 8, 0, 1, NULL, NULL, NULL, NULL),
(10, 'SKU1757169535', 'PT 10', 4, NULL, NULL, 'pcs', 0.00, 0.00, 25, 0, 1, NULL, NULL, NULL, NULL),
(11, 'SKU1757169564', 'PT 12', 4, NULL, NULL, 'pcs', 0.00, 0.00, 25, 0, 1, NULL, NULL, NULL, NULL),
(12, 'SKU1757169592', 'PT 15', 4, NULL, NULL, 'pcs', 0.00, 0.00, 25, 0, 1, NULL, NULL, NULL, NULL),
(13, 'SKU1757169750', 'KLIP 4 X 6', 9, NULL, NULL, 'pcs', 0.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(14, 'SKU1757169793', 'KLIP 5 X 8', 9, NULL, NULL, 'pcs', 0.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(15, 'SKU1757169837', 'KLIP 10 X 15', 9, NULL, NULL, 'pcs', 0.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(16, 'SKU1757170179', 'HD SAMPAH 60 X 100', 10, NULL, NULL, 'pcs', 4250.00, 0.00, 50, 0, 1, NULL, NULL, NULL, NULL),
(17, 'SKU1757170199', 'HD SAMPAH 90 X 120', 10, NULL, NULL, 'pcs', 4250.00, 0.00, 50, 0, 1, NULL, NULL, NULL, NULL),
(18, 'SKU1757170287', 'HD 1 CUP WARNA', 2, NULL, NULL, 'pcs', 3000.00, 0.00, 25, 0, 1, NULL, NULL, NULL, NULL),
(19, 'SKU1757170377', 'HD HITAM 35', 2, NULL, NULL, 'pcs', 12800.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(20, 'SKU1757170413', 'HD HITAM 40', 2, NULL, NULL, 'pcs', 17200.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(21, 'SKU1757170453', 'HD HITAM 50', 2, NULL, NULL, 'pcs', 17500.00, 0.00, 4, 0, 1, NULL, NULL, NULL, NULL),
(22, 'SKU1757170492', 'HD MERAH 28', 2, NULL, NULL, 'pcs', 12000.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(23, 'SKU1757170514', 'HD MERAH 35', 2, NULL, NULL, 'pcs', 14800.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(24, 'SKU1757170543', 'HD MERAH 40', 2, NULL, NULL, 'pcs', 14800.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(25, 'SKU1757170648', 'HD MERAH 50', 2, NULL, NULL, 'pcs', 29000.00, 0.00, 3, 0, 1, NULL, NULL, NULL, NULL),
(26, 'SKU1757170821', 'HD PUTIH 28', 2, NULL, NULL, 'pcs', 14800.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(27, 'SKU1757170839', 'HD PUTIH 35', 2, NULL, NULL, 'pcs', 14800.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(28, 'SKU1757170852', 'HD PUTIH 40', 2, NULL, NULL, 'pcs', 14800.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(29, 'SKU1757171010', 'PE 10 X 20', 3, NULL, NULL, 'pcs', 6000.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(30, 'SKU1757171039', 'PE 12 X 25', 3, NULL, NULL, 'pcs', 6000.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(31, 'SKU1757171055', 'PE 15 X 30', 3, NULL, NULL, 'pcs', 6000.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(32, 'SKU1757171372', 'FOAM BESAR POLOS', 24, NULL, NULL, 'pcs', 335.00, 0.00, 500, 0, 1, NULL, NULL, NULL, NULL),
(33, 'SKU1757171534', 'FOAM HB BURGER', 24, NULL, NULL, 'pcs', 148.00, 0.00, 500, 0, 1, NULL, NULL, NULL, NULL),
(34, 'SKU1757171705', 'CUP AQUA', 14, NULL, NULL, 'pcs', 4750.00, 0.00, 40, 0, 1, NULL, NULL, NULL, NULL),
(35, 'SKU1757171831', 'CUP 16 OZ', 14, NULL, NULL, 'pcs', 7500.00, 0.00, 20, 0, 1, NULL, NULL, NULL, NULL),
(36, 'SKU1757171852', 'CUP 14 OZ', 14, NULL, NULL, 'pcs', 7500.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(37, 'SKU1757171872', 'CUP 12 OZ', 14, NULL, NULL, 'pcs', 7500.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(38, 'SKU1757171948', 'MIKA 3A', 16, NULL, NULL, 'pcs', 10000.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(39, 'SKU1757171986', 'MIKA 4A', 16, NULL, NULL, 'pcs', 7000.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(40, 'SKU1757172026', 'MIKA 7C', 16, NULL, NULL, 'pcs', 2500.00, 0.00, 10, 0, 1, NULL, NULL, NULL, NULL),
(41, 'SKU1757172095', 'MIKA 2A', 16, NULL, NULL, 'pcs', 560.00, 0.00, 50, 0, 1, NULL, NULL, NULL, NULL),
(42, 'SKU1757172124', 'MIKA 1A', 16, NULL, NULL, 'pcs', 950.00, 0.00, 50, 0, 1, NULL, NULL, NULL, NULL),
(43, 'SKU1757172176', 'MIKA JUMBO', 16, NULL, NULL, 'pcs', 1440.00, 0.00, 50, 0, 1, NULL, NULL, NULL, NULL),
(44, 'SKU1757172270', 'KN 100', 22, NULL, NULL, 'pcs', 14000.00, 0.00, 5, 0, 1, NULL, NULL, NULL, NULL),
(45, 'SKU1757172450', 'KN 250', 22, NULL, NULL, 'pcs', 22800.00, 0.00, 5, 0, 1, NULL, NULL, NULL, NULL),
(46, 'SKU1757172585', 'KN BUNGA 24 - B', 22, NULL, '', 'PAK', 16000.00, 0.00, 5, 0, 1, NULL, NULL, NULL, NULL),
(47, 'SKU1757172641', 'KN BUNGA 28 - B', 22, NULL, '', 'PAK', 20000.00, 0.00, 5, 0, 1, NULL, NULL, NULL, NULL);

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
  `cost_price` decimal(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `stock_in`
--

INSERT INTO `stock_in` (`id`, `product_id`, `supplier_id`, `qty`, `note`, `created_at`, `cost_price`) VALUES
(1, 6, NULL, 8, '', '2025-09-06 14:29:04', 7125.00),
(2, 7, NULL, 8, '', '2025-09-06 14:30:42', 7125.00),
(3, 8, NULL, 8, '', '2025-09-06 14:32:31', 7125.00),
(4, 9, NULL, 8, '', '2025-09-06 14:32:53', 7125.00),
(5, 10, NULL, 25, '', '2025-09-06 14:38:55', 1600.00),
(6, 11, NULL, 25, '', '2025-09-06 14:39:24', 2200.00),
(7, 12, NULL, 25, '', '2025-09-06 14:39:52', 2600.00),
(8, 13, NULL, 10, '', '2025-09-06 14:42:30', 1500.00),
(9, 14, NULL, 10, '', '2025-09-06 14:43:13', 2200.00),
(10, 15, NULL, 10, '', '2025-09-06 14:43:57', 7400.00),
(11, 16, NULL, 50, '', '2025-09-06 14:49:39', 4250.00),
(12, 17, NULL, 50, '', '2025-09-06 14:49:59', 4250.00),
(13, 18, NULL, 25, '', '2025-09-06 14:51:27', 3000.00),
(14, 19, NULL, 10, '', '2025-09-06 14:52:57', 12800.00),
(15, 20, NULL, 10, '', '2025-09-06 14:53:33', 17200.00),
(16, 21, NULL, 4, '', '2025-09-06 14:54:13', 17500.00),
(17, 22, NULL, 10, '', '2025-09-06 14:54:52', 12000.00),
(18, 23, NULL, 10, '', '2025-09-06 14:55:14', 14800.00),
(19, 24, NULL, 10, '', '2025-09-06 14:55:43', 14800.00),
(20, 25, NULL, 3, '', '2025-09-06 14:57:28', 29000.00),
(21, 26, NULL, 10, '', '2025-09-06 15:00:21', 14800.00),
(22, 27, NULL, 10, '', '2025-09-06 15:00:39', 14800.00),
(23, 28, NULL, 10, '', '2025-09-06 15:00:52', 14800.00),
(24, 29, NULL, 10, '', '2025-09-06 15:03:30', 6000.00),
(25, 30, NULL, 10, '', '2025-09-06 15:03:59', 6000.00),
(26, 31, NULL, 10, '', '2025-09-06 15:04:15', 6000.00),
(27, 32, NULL, 500, '', '2025-09-06 15:09:32', 335.00),
(28, 33, NULL, 500, '', '2025-09-06 15:12:14', 148.00),
(29, 34, NULL, 40, '', '2025-09-06 15:15:05', 4750.00),
(30, 35, NULL, 20, '', '2025-09-06 15:17:11', 7500.00),
(31, 36, NULL, 10, '', '2025-09-06 15:17:32', 7500.00),
(32, 37, NULL, 10, '', '2025-09-06 15:17:52', 7500.00),
(33, 38, NULL, 10, '', '2025-09-06 15:19:08', 10000.00),
(34, 39, NULL, 10, '', '2025-09-06 15:19:46', 7000.00),
(35, 40, NULL, 10, '', '2025-09-06 15:20:26', 2500.00),
(36, 41, NULL, 50, '', '2025-09-06 15:21:35', 560.00),
(37, 42, NULL, 50, '', '2025-09-06 15:22:04', 950.00),
(38, 43, NULL, 50, '', '2025-09-06 15:22:56', 1440.00),
(39, 44, NULL, 10, '', '2025-09-06 15:24:30', 7000.00),
(40, 45, NULL, 5, '', '2025-09-06 15:27:30', 22800.00),
(41, 46, NULL, 5, '', '2025-09-06 15:29:45', 16000.00),
(42, 47, NULL, 5, '', '2025-09-06 15:30:41', 20000.00);

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
(1, 'Azmi Jaya Plastik', 'Muhamad Fahmi Purnama Sidiq', 'Toko Plastik dan Bahan Kue', 'Jalan Jembatan Hitam No. 1 RT. 03/10 Desa Cijujung Kec. Sukaraja Kab. Bogor', 'uploads/website/logo/1756990951_3eb4812f75684798e218.png', '', '08561331998', '', '', '', '', '2025-09-04 12:29:43', '2025-09-06 17:01:22');

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `stock_in`
--
ALTER TABLE `stock_in`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

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
  ADD CONSTRAINT `stock_in_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
