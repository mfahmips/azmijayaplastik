<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\SaleModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\StockInModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $saleModel     = new SaleModel();
        $productModel  = new ProductModel();
        $categoryModel = new CategoryModel();
        $stockInModel  = new StockInModel();

        $today = date('Y-m-d');

        // Penjualan Hari Ini
        $salesToday = $saleModel
            ->where('DATE(created_at)', $today)
            ->selectSum('paid')
            ->first()['paid'] ?? 0;

        // Jumlah Transaksi Hari Ini
        $ordersToday = $saleModel->where('DATE(created_at)', $today)->countAllResults();

        // Total Transaksi Keseluruhan
        $transactions       = $saleModel->countAllResults();
        $transactionsAmount = $saleModel->selectSum('paid')->first()['paid'] ?? 0;

        // Produk aktif
        $activeProducts = $productModel->where('is_active', 1)->countAllResults();

        // Produk hampir habis (stok kurang dari atau sama dengan 5)
        $lowStocks = $productModel
            ->where('is_active', 1)
            ->where('stock <=', 5)
            ->findAll();


        // 🔹 Total Pengeluaran Bulan Ini (transaksi keluar)
        $expensesAmount = $stockInModel
            ->selectSum('(qty * cost_price)', 'total')
            ->where('MONTH(created_at)', date('m'))
            ->where('YEAR(created_at)', date('Y'))
            ->first()['total'] ?? 0;

        // 🔹 Chart Pengeluaran 12 bulan (periode tahun berjalan)
        $chart_spark5 = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthExpense = $stockInModel
                ->selectSum('(qty * cost_price)', 'total')
                ->where('MONTH(created_at)', $m)
                ->where('YEAR(created_at)', date('Y'))
                ->first()['total'] ?? 0;
            $chart_spark5[] = (float)$monthExpense;
        }

        // Ringkasan statistik untuk dashboard
        $summary = [
            'sales_today'         => $salesToday,
            'orders_today'        => $ordersToday,
            'sales_growth'        => 0, // Placeholder
            'transactions'        => $transactions,
            'transactions_amount' => $transactionsAmount,
            'trx_growth'          => 0,
            'active_products'     => $activeProducts,
            'low_stock_count'     => count($lowStocks), // ✅ ganti kategori → stok hampir habis
            'expenses_amount'     => $expensesAmount,   // ✅ transaksi keluar
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

            $daySales = $saleModel
                ->where('DATE(created_at)', $date)
                ->selectSum('paid')
                ->first()['paid'] ?? 0;
            $data[] = (float)$daySales;
        }
        $chart_sales = [
            'labels' => $days,
            'data'   => $data
        ];

        // Chart Kategori (dummy data sementara, bisa diganti real)
        $chart_categories = [
            'data' => [
                'Plastik'   => 120,
                'Kue'       => 80,
                'Minuman'   => 40,
                'Lainnya'   => 20,
            ]
        ];

        // Sparkline dummy data (produk aktif, stok habis, penjualan, dll)
        $chart_spark1 = [10, 15, 8, 12, 16];
        $chart_spark2 = [5, 3, 6, 4, 7];   // stok akan habis
        $chart_spark3 = [3, 5, 4, 6, 7];   // penjualan
        $chart_spark4 = [7, 8, 6, 9, 10];  // transaksi
        // $chart_spark5 diisi pengeluaran per bulan

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
            'chart_spark5' => $chart_spark5,
        ]);
    }
}
