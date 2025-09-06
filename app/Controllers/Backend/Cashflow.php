<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\SaleModel;
use App\Models\StockInModel;

class Cashflow extends BaseController
{
    protected $trx, $sale, $stockIn;

    public function __construct()
    {
        $this->trx     = new TransactionModel();
        $this->sale    = new SaleModel();
        $this->stockIn = new StockInModel();
    }

    public function index()
    {
        $start = $this->request->getGet('start') ?? date('Y-m-01');
        $end   = $this->request->getGet('end') ?? date('Y-m-t');

        // ================== Cash In ==================
        // Dari tabel transaksi (type=in)
        $trxIncome = $this->trx
            ->select("DATE(date) as tgl, SUM(amount) as total")
            ->where('type', 'in')
            ->where("DATE(date) >=", $start)
            ->where("DATE(date) <=", $end)
            ->groupBy('DATE(date)')
            ->orderBy('tgl', 'ASC')
            ->findAll();

        // Dari tabel penjualan (sales.paid)
        $salesIncome = $this->sale
            ->select("DATE(created_at) as tgl, SUM(paid) as total")
            ->where("DATE(created_at) >=", $start)
            ->where("DATE(created_at) <=", $end)
            ->groupBy('DATE(created_at)')
            ->orderBy('tgl', 'ASC')
            ->findAll();

        // Gabungkan Cash In
        $income = $this->mergeByDate($trxIncome, $salesIncome);

        // ================== Cash Out ==================
        // Dari tabel transaksi (type=out)
        $trxExpense = $this->trx
            ->select("DATE(date) as tgl, SUM(amount) as total")
            ->where('type', 'out')
            ->where("DATE(date) >=", $start)
            ->where("DATE(date) <=", $end)
            ->groupBy('DATE(date)')
            ->orderBy('tgl', 'ASC')
            ->findAll();

        // Dari tabel stok masuk (qty * cost_price)
        $stockExpense = $this->stockIn
            ->select("DATE(created_at) as tgl, SUM(qty * cost_price) as total")
            ->where("DATE(created_at) >=", $start)
            ->where("DATE(created_at) <=", $end)
            ->groupBy('DATE(created_at)')
            ->orderBy('tgl', 'ASC')
            ->findAll();

        // Gabungkan Cash Out
        $expense = $this->mergeByDate($trxExpense, $stockExpense);

        // ================== Total ==================
        $total_income  = array_sum(array_column($income, 'total'));
        $total_expense = array_sum(array_column($expense, 'total'));
        $balance       = $total_income - $total_expense;

        return view('backend/reports/cashflow', [
            'title'         => 'Cashflow',
            'income'        => $income,
            'expense'       => $expense,
            'total_income'  => $total_income,
            'total_expense' => $total_expense,
            'balance'       => $balance,
            'start'         => $start,
            'end'           => $end,
        ]);
    }

    // 🔧 Utility untuk gabungkan data by date
    private function mergeByDate(array $a, array $b)
    {
        $result = [];

        foreach (array_merge($a, $b) as $row) {
            $tgl = $row['tgl'];
            if (!isset($result[$tgl])) {
                $result[$tgl] = ['tgl' => $tgl, 'total' => 0];
            }
            $result[$tgl]['total'] += (float)$row['total'];
        }

        // urutkan tanggal
        usort($result, fn($x, $y) => strcmp($x['tgl'], $y['tgl']));
        return $result;
    }
}
