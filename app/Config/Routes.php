<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->group('dashboard', static function($routes) {
    // Utama
    $routes->get('/', 'Backend\Dashboard::index');
    $routes->get('kasir', 'Backend\Kasir::index');
    $routes->post('kasir/tambahProdukBaru', 'Backend\Kasir::tambahProdukBaru');
    $routes->get('kasir/cariProduk', 'Backend\Kasir::cariProduk');
    $routes->post('kasir/simpanTransaksi', 'Backend\Kasir::simpanTransaksi');
    $routes->get('penjualan', 'Backend\Kasir::penjualan');
    $routes->get('penjualan/data', 'Backend\Kasir::penjualanData');




    // Produk
    $routes->get('products', 'Backend\Products::index');
    $routes->get('products/create', 'Backend\Products::create');
    $routes->post('products', 'Backend\Products::store');
    $routes->get('products/(:num)/edit', 'Backend\Products::edit/$1');
    $routes->post('products/(:num)/update', 'Backend\Products::update/$1');
    $routes->post('products/(:num)/delete', 'Backend\Products::delete/$1');
    $routes->get ('products/export', 'Backend\Products::export');
    $routes->post('products/import', 'Backend\Products::import');

    // Kategori
    $routes->get('categories', 'Backend\Categories::index');
    $routes->get('categories/create', 'Backend\Categories::create');
    $routes->post('categories', 'Backend\Categories::store');
    $routes->get('categories/(:num)/edit', 'Backend\Categories::edit/$1');
    $routes->post('categories/(:num)/update', 'Backend\Categories::update/$1');
    $routes->post('categories/(:num)/delete', 'Backend\Categories::delete/$1');
    $routes->get ('categories/export', 'Backend\Categories::export');
    $routes->post('categories/import', 'Backend\Categories::import');
    $routes->get('categories/children/(:num)', 'Backend\Categories::children/$1');

    // Supplier
    $routes->get('suppliers', 'Backend\Suppliers::index');
    $routes->get('suppliers/create', 'Backend\Suppliers::create');
    $routes->post('suppliers', 'Backend\Suppliers::store');
    $routes->get('suppliers/(:num)/edit', 'Backend\Suppliers::edit/$1');
    $routes->post('suppliers/(:num)/update', 'Backend\Suppliers::update/$1');
    $routes->post('suppliers/(:num)/delete', 'Backend\Suppliers::delete/$1');
    $routes->get ('suppliers/export', 'Backend\Suppliers::export');
    $routes->post('suppliers/import', 'Backend\Suppliers::import');

    // Pelanggan
    $routes->get('customers', 'Backend\Customers::index');
    $routes->get('customers/create', 'Backend\Customers::create');
    $routes->post('customers', 'Backend\Customers::store');
    $routes->get('customers/(:num)/edit', 'Backend\Customers::edit/$1');
    $routes->post('customers/(:num)/update', 'Backend\Customers::update/$1');
    $routes->post('customers/(:num)/delete', 'Backend\Customers::delete/$1');
    $routes->get ('customers/export', 'Backend\Customers::export');
    $routes->post('customers/import', 'Backend\Customers::import');


    $routes->get('penjualan', 'Backend\Transaksi\Penjualan::index');
    $routes->post('penjualan', 'Backend\Transaksi\Penjualan::create');
    $routes->post('penjualan/update', 'Backend\Transaksi\Penjualan::update');
    $routes->post('penjualan/(:num)/delete', 'Backend\Transaksi\Penjualan::delete/$1');


    $routes->get('store-setting', 'Backend\StoreSetting::index');
    $routes->post('store-setting/update', 'Backend\StoreSetting::update');


});
