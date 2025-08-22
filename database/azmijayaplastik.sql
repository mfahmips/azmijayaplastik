-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 22 Agu 2025 pada 14.34
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
  `id` int UNSIGNED NOT NULL,
  `parent_id` int UNSIGNED DEFAULT NULL COMMENT 'FK ke categories.id untuk subkategori',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Plastik', 'plastik', 'Produk plastik seperti kresek, roll, dan lainnya', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(2, NULL, 'Bahan Kue', 'bahan-kue', 'Bahan dasar dan perlengkapan membuat kue', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(3, NULL, 'Packaging', 'packaging', 'Kemasan makanan, minuman, dan kebutuhan usaha', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(4, NULL, 'Alat Pesta', 'alat-pesta', 'Perlengkapan untuk acara dan perayaan', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(5, 1, 'Plastik Kresek', 'plastik-kresek', 'Kantong plastik berbagai ukuran dan warna', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(6, 1, 'Plastik Roll', 'plastik-roll', 'Plastik gulungan untuk packing dan kebutuhan industri', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(7, 1, 'Plastik PP / OPP', 'plastik-pp-opp', 'Plastik bening untuk makanan, kue, dan souvenir', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(8, 1, 'Plastik HD / PE', 'plastik-hd-pe', 'Plastik tahan panas dan makanan berat', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(9, 2, 'Tepung & Gula', 'tepung-gula', 'Aneka tepung dan gula untuk bahan dasar', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(10, 2, 'Coklat & Keju', 'coklat-keju', 'Bahan isian dan topping kue', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(11, 2, 'Pewarna & Perasa', 'pewarna-perasa', 'Pewarna makanan dan perasa sintetis/alami', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(12, 2, 'Peralatan Baking', 'peralatan-baking', 'Spatula, loyang, cetakan', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(13, 3, 'Mika & Cup', 'mika-cup', 'Mika bening, cup plastik, dan penutupnya', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(14, 3, 'Box Kue & Makanan', 'box-kue-makanan', 'Box karton atau kraft untuk makanan & bakery', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(15, 3, 'Standing Pouch', 'standing-pouch', 'Kemasan berdiri untuk snack dan bumbu', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(16, 3, 'Toples & Wadah', 'toples-wadah', 'Toples plastik, toples kue, dan kontainer kecil', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(17, 4, 'Balon & Dekorasi', 'balon-dekorasi', 'Balon latex, foil, pita, dan pompom', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(18, 4, 'Piring & Gelas Plastik', 'piring-gelas-plastik', 'Peralatan makan sekali pakai', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(19, 4, 'Tisu & Serbet', 'tisu-serbet', 'Tisu meja, serbet makanan', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL),
(20, 4, 'Lilin Ulang Tahun', 'lilin-ulang-tahun', 'Aneka lilin karakter dan angka untuk ulang tahun', '2025-08-18 15:55:27', '2025-08-18 15:55:27', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id` int NOT NULL,
  `pembelian_id` int DEFAULT NULL,
  `produk_id` int DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `harga_satuan` bigint DEFAULT NULL,
  `subtotal` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int NOT NULL,
  `penjualan_id` int DEFAULT NULL,
  `produk_id` int DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `harga_satuan` bigint DEFAULT NULL,
  `subtotal` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int UNSIGNED NOT NULL,
  `category_id` int UNSIGNED NOT NULL COMMENT 'boleh menunjuk ke kategori utama atau subkategori',
  `supplier_id` int UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pcs',
  `stock` int NOT NULL DEFAULT '0',
  `min_stock` int NOT NULL DEFAULT '0',
  `purchase_price` int DEFAULT NULL COMMENT 'harga beli (Rp)',
  `sell_price` int DEFAULT NULL COMMENT 'harga jual (Rp)',
  `price_tier` json DEFAULT NULL COMMENT 'opsional: harga grosir/level',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `category_id`, `supplier_id`, `name`, `slug`, `sku`, `barcode`, `unit`, `stock`, `min_stock`, `purchase_price`, `sell_price`, `price_tier`, `image`, `is_active`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, NULL, 'Plastik Kresek Ukuran Sedang', 'plastik-kresek-sedang', 'PKS-001', NULL, 'pcs', 200, 0, 200, 400, NULL, NULL, 1, NULL, '2025-08-18 16:19:14', '2025-08-18 16:19:14', NULL),
(2, 5, NULL, 'Plastik Kresek Warna Hitam', 'plastik-kresek-hitam', 'PKH-002', NULL, 'pcs', 150, 0, 180, 350, NULL, NULL, 1, NULL, '2025-08-18 16:19:14', '2025-08-18 16:19:14', NULL),
(3, 6, NULL, 'Plastik Roll 1 Meter', 'plastik-roll-1m', 'PR1M-001', NULL, 'm', 100, 0, 500, 1000, NULL, NULL, 1, NULL, '2025-08-18 16:19:14', '2025-08-18 16:19:14', NULL),
(4, 6, NULL, 'Plastik Roll Transparan', 'plastik-roll-transparan', 'PRT-002', NULL, 'm', 80, 0, 450, 950, NULL, NULL, 1, NULL, '2025-08-18 16:19:14', '2025-08-18 16:19:14', NULL),
(5, 7, NULL, 'Plastik OPP 10x15', 'plastik-opp-10x15', 'OPP1015', NULL, 'pcs', 300, 0, 100, 250, NULL, NULL, 1, NULL, '2025-08-18 16:19:14', '2025-08-18 16:19:14', NULL),
(6, 7, NULL, 'Plastik PP 20x30', 'plastik-pp-20x30', 'PP2030', NULL, 'pcs', 250, 0, 150, 300, NULL, NULL, 1, NULL, '2025-08-18 16:19:14', '2025-08-18 16:19:14', NULL),
(7, 13, NULL, 'Mika Kue 10x10', 'mika-kue-10x10', 'MK1010', NULL, 'pcs', 500, 0, 200, 500, NULL, NULL, 1, NULL, '2025-08-18 16:19:14', '2025-08-18 16:19:14', NULL),
(8, 13, NULL, 'Cup Plastik 250ml', 'cup-plastik-250ml', 'CP250', NULL, 'pcs', 400, 0, 250, 550, NULL, NULL, 1, NULL, '2025-08-18 16:19:14', '2025-08-18 16:19:14', NULL),
(9, 14, NULL, 'Box Makanan Putih 500ml', 'box-putih-500ml', 'BX500', NULL, 'pcs', 200, 0, 600, 1200, NULL, NULL, 1, NULL, '2025-08-18 16:19:14', '2025-08-18 16:19:14', NULL),
(10, 14, NULL, 'Box Kue Coklat 2 Layer', 'box-kue-coklat', 'BX2L', NULL, 'pcs', 150, 0, 800, 1600, NULL, NULL, 1, NULL, '2025-08-18 16:19:14', '2025-08-18 16:19:14', NULL),
(11, 16, NULL, 'Toples Plastik Bulat 250ml', 'toples-bulat-250ml', 'TPL250', NULL, 'pcs', 300, 0, 500, 1000, NULL, NULL, 1, NULL, '2025-08-18 16:19:14', '2025-08-18 16:19:14', NULL),
(12, 16, NULL, 'Wadah Makanan Segi 500ml', 'wadah-segi-500ml', 'WDH500', NULL, 'pcs', 280, 0, 700, 1350, NULL, NULL, 1, NULL, '2025-08-18 16:19:14', '2025-08-18 16:19:14', NULL),
(13, 18, NULL, 'Piring Plastik Warna', 'piring-plastik-warna', 'PRGP-001', NULL, 'pcs', 300, 0, 300, 700, NULL, NULL, 1, NULL, '2025-08-18 16:19:14', '2025-08-18 16:19:14', NULL),
(14, 18, NULL, 'Gelas Plastik Bening 200ml', 'gelas-plastik-200ml', 'GLS200', NULL, 'pcs', 350, 0, 400, 800, NULL, NULL, 1, NULL, '2025-08-18 16:19:14', '2025-08-18 16:19:14', NULL),
(15, 19, NULL, 'Tisu Meja Putih', 'tisu-meja-putih', 'TSM001', NULL, 'pcs', 400, 0, 600, 1300, NULL, NULL, 1, NULL, '2025-08-18 16:19:14', '2025-08-18 16:19:14', NULL),
(16, 19, NULL, 'Serbet Makan 2 Ply', 'serbet-2ply', 'SB2P', NULL, 'pcs', 350, 0, 550, 1150, NULL, NULL, 1, NULL, '2025-08-18 16:19:14', '2025-08-18 16:19:14', NULL),
(17, 20, NULL, 'Lilin Angka Warna', 'lilin-angka-warna', 'LAW001', NULL, 'pcs', 200, 0, 500, 1000, NULL, NULL, 1, NULL, '2025-08-18 16:19:14', '2025-08-18 16:19:14', NULL),
(18, 20, NULL, 'Lilin Karakter Ulang Tahun', 'lilin-karakter', 'LKT002', NULL, 'pcs', 150, 0, 700, 1400, NULL, NULL, 1, NULL, '2025-08-18 16:19:14', '2025-08-18 16:19:14', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `harga_jual` bigint DEFAULT NULL,
  `harga_beli` bigint DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `stok` int DEFAULT '0',
  `deskripsi` text,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `address`, `note`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PT Plastik Jaya', NULL, '0215550001', 'Jakarta', NULL, '2025-08-09 14:52:04', '2025-08-09 14:52:04', NULL),
(2, 'CV Sumber Makmur', NULL, '0227770022', 'Bandung', NULL, '2025-08-09 14:52:04', '2025-08-09 14:52:04', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_pembelian`
--

CREATE TABLE `transaksi_pembelian` (
  `id` int NOT NULL,
  `faktur` varchar(100) DEFAULT NULL,
  `nama_supplier` varchar(100) DEFAULT NULL,
  `tanggal_transaksi` datetime DEFAULT NULL,
  `total_harga` bigint DEFAULT NULL,
  `keterangan` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_penjualan`
--

CREATE TABLE `transaksi_penjualan` (
  `id` int NOT NULL,
  `faktur` varchar(100) DEFAULT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `tanggal_transaksi` datetime DEFAULT NULL,
  `total_harga` bigint DEFAULT NULL,
  `keterangan` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_categories_slug` (`slug`),
  ADD KEY `idx_categories_name` (`name`),
  ADD KEY `idx_categories_parent` (`parent_id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_customers_name` (`name`),
  ADD KEY `idx_customers_phone` (`phone`),
  ADD KEY `idx_customers_email` (`email`);

--
-- Indeks untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembelian_id` (`pembelian_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_id` (`penjualan_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_products_slug` (`slug`),
  ADD KEY `idx_products_name` (`name`),
  ADD KEY `idx_products_sku` (`sku`),
  ADD KEY `idx_products_category` (`category_id`),
  ADD KEY `idx_products_supplier` (`supplier_id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_suppliers_name` (`name`),
  ADD KEY `idx_suppliers_phone` (`phone`),
  ADD KEY `idx_suppliers_email` (`email`);

--
-- Indeks untuk tabel `transaksi_pembelian`
--
ALTER TABLE `transaksi_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faktur` (`faktur`);

--
-- Indeks untuk tabel `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faktur` (`faktur`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi_pembelian`
--
ALTER TABLE `transaksi_pembelian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_categories_parent` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_ibfk_1` FOREIGN KEY (`pembelian_id`) REFERENCES `transaksi_pembelian` (`id`),
  ADD CONSTRAINT `detail_pembelian_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);

--
-- Ketidakleluasaan untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`penjualan_id`) REFERENCES `transaksi_penjualan` (`id`),
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_products_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
