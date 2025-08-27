<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\SaleModel;
use App\Models\ProductModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $saleModel = new SaleModel();
        $productModel = new ProductModel();

        $today = date('Y-m-d');

        // Penjualan Hari Ini
        $salesToday = $saleModel->where('DATE(created_at)', $today)->selectSum('paid')->first()['paid'] ?? 0;

        // Jumlah Transaksi Hari Ini
        $ordersToday = $saleModel->where('DATE(created_at)', $today)->countAllResults();

        // Total Transaksi Semua
        $transactions = $saleModel->countAllResults();
        $transactionsAmount = $saleModel->selectSum('paid')->first()['paid'] ?? 0;

        // Produk aktif
        $activeProducts = $productModel->where('is_active', 1)->countAllResults();

        // Produk hampir habis
        $lowStocks = $productModel
            ->where('is_active', 1)
            ->where('stock < min_stock')
            ->findAll();

        // Placeholder growth (implementasikan nanti jika ada histori)
        $summary = [
            'sales_today'         => $salesToday,
            'orders_today'        => $ordersToday,
            'sales_growth'        => 0, // perlu logika tambahan jika ingin menghitung growth
            'transactions'        => $transactions,
            'transactions_amount' => $transactionsAmount,
            'trx_growth'          => 0, // idem
            'active_products'     => $activeProducts,
            'low_stock_count'     => count($lowStocks),
        ];

        // Aktivitas terakhir (dummy)
        $activities = [
            [
                'title' => 'Transaksi Baru',
                'desc'  => 'INV-001 berhasil disimpan',
                'icon'  => 'receipt_long',
                'color' => 'primary',
                'time'  => 'Hari ini',
            ],
        ];

        return view('backend/index', [
            'title'      => 'Dashboard - Azmi Jaya Plastik',
            'summary'    => $summary,
            'lowStocks'  => $lowStocks,
            'activities' => $activities,
        ]);
    }
}
