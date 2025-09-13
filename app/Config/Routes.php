<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('dashboard', static function($routes) {
    // Utama
    $routes->get('/', 'Backend\Dashboard::index');
    
    // =============================
    // Kasir
    // =============================
    $routes->get('kasir', 'Backend\Kasir::index');
    $routes->get('kasir/cariProduk', 'Backend\Kasir::cariProduk');
    $routes->post('kasir/tambahProdukBaru', 'Backend\Kasir::tambahProdukBaru');
    $routes->post('kasir/simpanTransaksi', 'Backend\Kasir::simpanTransaksi');
    $routes->get('kasir/penjualan', 'Backend\Kasir::penjualan');
    $routes->get('kasir/penjualanData', 'Backend\Kasir::penjualanData');
    $routes->get('kasir/cetak/(:segment)', 'Backend\Kasir::cetak/$1');
    $routes->get('kasir/nextInvoice', 'Backend\Kasir::nextInvoice');
    $routes->post('kasir/previewInvoice', 'Backend\Kasir::previewInvoice');

    // Cashflow
    $routes->get('cashflow', 'Backend\Cashflow::index');

    // =============================
    // Transaksi
    // =============================
    $routes->get('transaksi', 'Backend\Transaksi::index');
    $routes->post('transaksi/save', 'Backend\Transaksi::save');
    $routes->get('transaksi/create', 'Backend\Transaksi::create');
    $routes->post('transaksi/store', 'Backend\Transaksi::store');
    $routes->get('transaksi/edit/(:num)', 'Backend\Transaksi::edit/$1');
    $routes->post('transaksi/update/(:num)', 'Backend\Transaksi::update/$1');
    $routes->get('transaksi/delete/(:num)', 'Backend\Transaksi::delete/$1');

    // =============================
    // Produk
    // =============================
    $routes->get('products', 'Backend\Products::index');
    $routes->get('products/create', 'Backend\Products::create');
    $routes->post('products', 'Backend\Products::store');
    $routes->get('products/edit/(:num)', 'Backend\Products::edit/$1');
    $routes->post('products/update/(:num)', 'Backend\Products::update/$1');
    $routes->post('products/delete/(:num)', 'Backend\Products::delete/$1');
    $routes->get('products/export', 'Backend\Products::export');
    $routes->post('products/import', 'Backend\Products::import');

    // Barang Masuk
    $routes->get('products/stock-in', 'Backend\Products::stockIn');
    $routes->post('products/stock-in/save', 'Backend\Products::stockInSave');
    $routes->get('products/stock-in/edit/(:num)', 'Backend\Products::stockInEdit/$1');
    $routes->post('products/stock-in/update/(:num)', 'Backend\Products::stockInUpdate/$1');
    $routes->get('products/stock-in/delete/(:num)', 'Backend\Products::stockInDelete/$1');

    // =============================
    // Stok Opname
    // =============================
    $routes->get('products/stock-opname', 'Backend\Products::stokOpname');
    $routes->post('products/simpanStokOpname', 'Backend\Products::simpanStokOpname');

    // Histori opname
    $routes->get('products/riwayat-opname', 'Backend\Products::riwayatOpname');
    $routes->get('products/edit-opname/(:num)', 'Backend\Products::editOpname/$1');
    $routes->post('products/update-opname/(:num)', 'Backend\Products::updateOpname/$1');
    $routes->get('products/delete-opname/(:num)', 'Backend\Products::deleteOpname/$1');

    // =============================
    // Kategori
    // =============================
    $routes->group('categories', function($routes) {
        $routes->get('/', 'Backend\Categories::index');
        $routes->post('store', 'Backend\Categories::store');
        $routes->post('update/(:num)', 'Backend\Categories::update/$1');
        $routes->delete('delete/(:num)', 'Backend\Categories::delete/$1');

        $routes->get('export', 'Backend\Categories::export');
        $routes->post('import', 'Backend\Categories::import');

        $routes->get('children/(:num)', 'Backend\Categories::children/$1');
    });

    // =============================
    // Supplier
    // =============================
    $routes->get('suppliers', 'Backend\Suppliers::index');
    $routes->get('suppliers/create', 'Backend\Suppliers::create');
    $routes->post('suppliers', 'Backend\Suppliers::store');
    $routes->get('suppliers/(:num)/edit', 'Backend\Suppliers::edit/$1');
    $routes->post('suppliers/(:num)/update', 'Backend\Suppliers::update/$1');
    $routes->post('suppliers/(:num)/delete', 'Backend\Suppliers::delete/$1');
    $routes->get('suppliers/export', 'Backend\Suppliers::export');
    $routes->post('suppliers/import', 'Backend\Suppliers::import');

    // =============================
    // Pelanggan
    // =============================
    $routes->get('customers', 'Backend\Customers::index');
    $routes->get('customers/create', 'Backend\Customers::create');
    $routes->post('customers', 'Backend\Customers::store');
    $routes->get('customers/(:num)/edit', 'Backend\Customers::edit/$1');
    $routes->post('customers/(:num)/update', 'Backend\Customers::update/$1');
    $routes->post('customers/(:num)/delete', 'Backend\Customers::delete/$1');
    $routes->get('customers/export', 'Backend\Customers::export');
    $routes->post('customers/import', 'Backend\Customers::import');

    // =============================
    // Penjualan
    // =============================
    $routes->get('penjualan', 'Backend\Transaksi\Penjualan::index');
    $routes->post('penjualan', 'Backend\Transaksi\Penjualan::create');
    $routes->post('penjualan/update', 'Backend\Transaksi\Penjualan::update');
    $routes->post('penjualan/(:num)/delete', 'Backend\Transaksi\Penjualan::delete/$1');

    // =============================
    // Store Setting
    // =============================
    $routes->get('store-setting', 'Backend\StoreSetting::index');
    $routes->post('store-setting/update', 'Backend\StoreSetting::update');
});
