<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\SaleModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $saleModel     = new SaleModel();
        $productModel  = new ProductModel();
        $categoryModel = new CategoryModel();

        $today = date('Y-m-d');

        // Penjualan Hari Ini
        $salesToday = $saleModel->where('DATE(created_at)', $today)->selectSum('paid')->first()['paid'] ?? 0;

        // Jumlah Transaksi Hari Ini
        $ordersToday = $saleModel->where('DATE(created_at)', $today)->countAllResults();

        // Total Transaksi Semua
        $transactions       = $saleModel->countAllResults();
        $transactionsAmount = $saleModel->selectSum('paid')->first()['paid'] ?? 0;

        // Produk aktif
        $activeProducts = $productModel->where('is_active', 1)->countAllResults();

        // Produk hampir habis
        $lowStocks = $productModel
            ->where('is_active', 1)
            ->where('stock < min_stock')
            ->findAll();

        // Ringkasan
        $summary = [
            'sales_today'         => $salesToday,
            'orders_today'        => $ordersToday,
            'sales_growth'        => 0, // opsional, bisa ditambahkan nanti
            'transactions'        => $transactions,
            'transactions_amount' => $transactionsAmount,
            'trx_growth'          => 0,
            'active_products'     => $activeProducts,
            'low_stock_count'     => count($lowStocks),
        ];

        // Aktivitas dummy
        $activities = [
            [
                'title' => 'Transaksi Baru',
                'desc'  => 'INV-001 berhasil disimpan',
                'icon'  => 'solar:receipt-outline',
                'color' => 'primary',
                'time'  => 'Hari ini',
            ],
        ];

        // Chart: Penjualan 7 Hari Terakhir
        $days = [];
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $label = date('D', strtotime($date)); // Sen, Sel, ...
            $days[] = $label;

            $daySales = $saleModel->where('DATE(created_at)', $date)->selectSum('paid')->first()['paid'] ?? 0;
            $data[] = (float)$daySales;
        }
        $chart_sales = [
            'labels' => $days,
            'data'   => $data
        ];

        // Chart: Transaksi per Kategori (Dummy jika belum ada relasi di DB)
        $chart_categories = [
            'data' => [
                'Makanan'   => 120,
                'Minuman'   => 80,
                'Aksesoris' => 40,
            ]
        ];

        return view('backend/index', [
            'title'            => 'Dashboard - Azmi Jaya Plastik',
            'summary'          => $summary,
            'lowStocks'        => $lowStocks,
            'activities'       => $activities,
            'chart_sales'      => $chart_sales,
            'chart_categories' => $chart_categories,
        ]);
    }
}
