<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\SaleModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SupplierModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $saleModel      = new SaleModel();
        $productModel   = new ProductModel();
        $categoryModel  = new CategoryModel();
        $supplierModel  = new SupplierModel();

        $today = date('Y-m-d');

        // Penjualan Hari Ini
        $salesToday = $saleModel->where('DATE(created_at)', $today)->selectSum('paid')->first()['paid'] ?? 0;

        // Jumlah Transaksi Hari Ini
        $ordersToday = $saleModel->where('DATE(created_at)', $today)->countAllResults();

        // Total Transaksi Keseluruhan
        $transactions       = $saleModel->countAllResults();
        $transactionsAmount = $saleModel->selectSum('paid')->first()['paid'] ?? 0;

        // Produk aktif
        $activeProducts = $productModel->where('is_active', 1)->countAllResults();

        // Total kategori & supplier
        $totalKategori = $categoryModel->countAllResults();
        $totalSupplier = $supplierModel->countAllResults();

        // Produk hampir habis
        $lowStocks = $productModel
            ->where('is_active', 1)
            ->where('stock < min_stock')
            ->findAll();

        // Ringkasan statistik untuk dashboard
        $summary = [
            'sales_today'         => $salesToday,
            'orders_today'        => $ordersToday,
            'sales_growth'        => 0, // Placeholder
            'transactions'        => $transactions,
            'transactions_amount' => $transactionsAmount,
            'trx_growth'          => 0,
            'active_products'     => $activeProducts,
            'total_kategori'      => $totalKategori,
            'total_supplier'      => $totalSupplier,
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

        // Chart Penjualan 7 Hari Terakhir
        $days = [];
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $label = date('D', strtotime($date));
            $days[] = $label;

            $daySales = $saleModel->where('DATE(created_at)', $date)->selectSum('paid')->first()['paid'] ?? 0;
            $data[] = (float)$daySales;
        }
        $chart_sales = [
            'labels' => $days,
            'data'   => $data
        ];

        // Chart Kategori (dummy data)
        $chart_categories = [
            'data' => [
                'Plastik'   => 120,
                'Kue'       => 80,
                'Minuman'   => 40,
                'Lainnya'   => 20,
            ]
        ];

        // Sparkline dummy data untuk statistik mini
        $chart_spark1 = [10, 15, 8, 12, 16];
        $chart_spark2 = [20, 22, 18, 25, 30];
        $chart_spark3 = [5, 7, 6, 8, 10];
        $chart_spark4 = [3, 5, 4, 6, 7];


        return view('backend/index', [
            'title'            => 'Dashboard - Azmi Jaya Plastik',
            'summary'          => $summary,
            'lowStocks'        => $lowStocks,
            'activities'       => $activities,
            'chart_sales'      => $chart_sales,
            'chart_categories' => $chart_categories,

            // Sparkline data
            'chart_spark1' => $chart_spark1,
            'chart_spark2' => $chart_spark2,
            'chart_spark3' => $chart_spark3,
            'chart_spark4' => $chart_spark4,
        ]);

    }
}
