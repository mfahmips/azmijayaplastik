-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 13 Sep 2025 pada 16.28
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
(1, 'PLK-HDPE', 'HDPE', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(2, 'PLK-PE', 'PE', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(3, 'PLK-PT', 'PE TIPIS', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(4, 'PLK-PTB', 'PE TEBAL', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(5, 'PLK-PP', 'PP', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(6, 'PLK-ATP', 'ATP', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(7, 'PLK-OPP', 'OPP', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(8, 'PLK-KLIP', 'KLIP', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(9, 'PLK-STP', 'STANDING POUCH', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(10, 'PLK-HDS', 'HD SAMPAH', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(11, 'PKG-BNT', 'KOTAK BENTO', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(12, 'PKG-DMS', 'DUS MAKAN & SNACK', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(13, 'PKG-PBLB', 'PAPER BOWL & LUNCH BOX', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(14, 'PKG-CPK', 'CUP PLASTIK & KERTAS', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(15, 'PKG-SDT', 'SEDOTAN', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(16, 'PKG-MK', 'MIKA', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(17, 'PKG-AKU', 'ALAS KUE', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(18, 'PKG-LAL', 'LOYANG ALUMUNIUM', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(19, 'PKG-CAG', 'CETAKAN AGAR', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(20, 'PKG-TLR', 'TALI RAPIA', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(21, 'PKG-ISO', 'ISOLASI', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(22, 'PKG-KRM', 'KERTAS MINYAK', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(23, 'PKG-KRK', 'KERTAS KADO', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(24, 'PKG-STY', 'STYROFOAM', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(25, 'PKG-BBW', 'BUBBLE WRAP', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(26, 'PKG-GBPB', 'GOODIE BAG & PAPER BAG', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(27, 'BHK-TGU', 'TEPUNG TERIGU', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(28, 'BHK-TMZ', 'TEPUNG MEIZENA', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(29, 'BHK-TPK', 'TEPUNG TAPIOKA', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(30, 'BHK-TBS', 'TEPUNG BERAS', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(31, 'BHK-TKT', 'TEPUNG KETAN', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(32, 'BHK-TRI', 'TEPUNG ROTI', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(33, 'BHK-GPR', 'GULA PASIR', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(34, 'BHK-GHS', 'GULA HALUS', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(35, 'BHK-GPM', 'GULA PALM', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(36, 'BHK-GMH', 'GULA MERAH', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(37, 'BHK-CBT', 'COKELAT BATANG', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(38, 'BHK-CBK', 'COKELAT BUBUK', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(39, 'BHK-MTG', 'MENTEGA', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(40, 'BHK-SBK', 'SUSU BUBUK', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(41, 'BHK-SKMK', 'SUSU KENTAL MANIS & KRIMER', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(42, 'BHK-SFC', 'SUSU FULL CREAM', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(43, 'BHK-WCR', 'WHIPPING CREAM', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(44, 'BHK-BPSK', 'BAKING POWDER & SODA KUE', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(45, 'BHK-RIN', 'RAGI INSTAN', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(46, 'BHK-STO', 'SP, TBM, OVALET', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(47, 'BHK-PMP', 'PEWARNA MAKANAN & PASTA', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(48, 'BHK-ESM', 'ESSENSE MAKANAN', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(49, 'BHK-SEL', 'SELAI', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(50, 'BHK-GZD', 'GLAZE DONAT', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(51, 'BHK-KEJ', 'KEJU', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(52, 'BHK-SMKC', 'SPRINGKEL, MESES, KISMIS, & CHOCO', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43'),
(53, 'BHK-BJG', 'BIJI JAGUNG', 'category', 1, '2025-09-13 11:20:43', '2025-09-13 11:20:43');

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
(1, 'PE-PE4X-001-MIC', 'PE 4 X 23', 'Mico', 2, NULL, NULL, 'Bks', 0.00, 8000.00, 7, 0, 1, NULL, '2025-09-13 16:25:47', '2025-09-13 16:25:47'),
(2, 'PE-PE4,-001-BAW', 'PE 4,5 X 23', 'Bawang', 2, NULL, NULL, 'Bks', 0.00, 8000.00, 0, 0, 1, NULL, '2025-09-13 16:25:47', '2025-09-13 16:25:47'),
(3, 'PE-PE6X-001-MIC', 'PE 6 X 20', 'Mico', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 8, 0, 1, NULL, '2025-09-13 16:25:47', '2025-09-13 16:25:47'),
(4, 'PE-PE7X-001-MIC', 'PE 7 X 20', 'Mico', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 10, 0, 1, NULL, '2025-09-13 16:25:48', '2025-09-13 16:25:48'),
(5, 'PE-PE8X-001-MIC', 'PE 8 X 20', 'Mico', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 6, 0, 1, NULL, '2025-09-13 16:25:48', '2025-09-13 16:25:48'),
(6, 'PE-PE9X-001-BAW', 'PE 9 X 20', 'Bawang', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 1, 0, 1, NULL, '2025-09-13 16:25:48', '2025-09-13 16:25:48'),
(7, 'PE-PE10-001-BAW', 'PE 10 X 20', 'Bawang', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 9, 0, 1, NULL, '2025-09-13 16:25:48', '2025-09-13 16:25:48'),
(8, 'PE-PE10-001-MIC', 'PE 10 X 25', 'Mico', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 23, 0, 1, NULL, '2025-09-13 16:25:48', '2025-09-13 16:25:48'),
(9, 'PE-PE12-001-BAW', 'PE 12 X 25', 'Bawang', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 10, 0, 1, NULL, '2025-09-13 16:25:48', '2025-09-13 16:25:48'),
(10, 'PE-PE12-001-MIC', 'PE 12 X 25', 'Mico', 2, NULL, NULL, 'Bks', 6000.00, 8000.00, 6, 0, 1, NULL, '2025-09-13 16:25:48', '2025-09-13 16:25:48');

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
(359, 1, 'Kg', 5, 35000.00, '2025-09-13 16:25:47', '2025-09-13 16:25:47'),
(360, 2, 'Kg', 5, 35000.00, '2025-09-13 16:25:47', '2025-09-13 16:25:47'),
(361, 3, 'Kg', 5, 35000.00, '2025-09-13 16:25:48', '2025-09-13 16:25:48'),
(362, 4, 'Kg', 5, 35000.00, '2025-09-13 16:25:48', '2025-09-13 16:25:48'),
(363, 5, 'Kg', 5, 35000.00, '2025-09-13 16:25:48', '2025-09-13 16:25:48'),
(364, 6, 'Kg', 5, 35000.00, '2025-09-13 16:25:48', '2025-09-13 16:25:48'),
(365, 7, 'Kg', 5, 35000.00, '2025-09-13 16:25:48', '2025-09-13 16:25:48'),
(366, 8, 'Kg', 5, 35000.00, '2025-09-13 16:25:48', '2025-09-13 16:25:48'),
(367, 9, 'Kg', 5, 35000.00, '2025-09-13 16:25:48', '2025-09-13 16:25:48'),
(368, 10, 'Kg', 5, 35000.00, '2025-09-13 16:25:48', '2025-09-13 16:25:48');

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

--
-- Dumping data untuk tabel `sales`
--

INSERT INTO `sales` (`id`, `invoice`, `customer_id`, `customer_name`, `total_price`, `total_items`, `paid`, `change`, `created_at`, `updated_at`) VALUES
(3, 'INV-07092025-0001', NULL, NULL, 15000.00, 1, 20000.00, 5000.00, '2025-09-07 06:16:06', '2025-09-07 06:16:06'),
(4, 'INV-09092025-0001', NULL, NULL, 1500.00, 1, 2000.00, 500.00, '2025-09-09 02:48:56', '2025-09-09 02:48:56');

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;

--
-- AUTO_INCREMENT untuk tabel `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
