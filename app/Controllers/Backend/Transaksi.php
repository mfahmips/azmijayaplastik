<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\StockInModel;

class Transaksi extends BaseController
{
    protected $trx;
    protected $stockInModel;

    public function __construct()
    {
        $this->trx = new TransactionModel();
        $this->stockInModel = new StockInModel();
    }

    // ================= Dashboard =================
    public function index()
    {
        // Cash In per day
        $cashIn = $this->trx
            ->select("DATE(date) as date, SUM(amount) as total")
            ->where('type', 'in')
            ->groupBy('DATE(date)')
            ->orderBy('date', 'DESC')
            ->findAll();

        // Cash Out (manual entries) per day
        $cashOutManual = $this->trx
            ->select("DATE(date) as date, SUM(amount) as total")
            ->where('type', 'out')
            ->groupBy('DATE(date)')
            ->orderBy('date', 'DESC')
            ->findAll();

        // Stock In (purchases) per day
        $stockIn = $this->stockInModel
            ->select("DATE(stock_in.created_at) as date, SUM(qty * stock_in.cost_price) as total")
            ->join('products', 'products.id = stock_in.product_id')
            ->groupBy('DATE(stock_in.created_at)')
            ->orderBy('date', 'DESC')
            ->findAll();

        // Gabungkan Cash Out Manual + Stock In jadi satu Cash Out
        $cashOut = [];

        // Index by date
        foreach ($cashOutManual as $r) {
            $cashOut[$r['date']] = ($cashOut[$r['date']] ?? 0) + $r['total'];
        }
        foreach ($stockIn as $r) {
            $cashOut[$r['date']] = ($cashOut[$r['date']] ?? 0) + $r['total'];
        }

        // Convert ke array biar bisa dipakai di view
        $cashOutData = [];
        foreach ($cashOut as $date => $total) {
            $cashOutData[] = [
                'date'  => $date,
                'total' => $total
            ];
        }

        // Urutkan dari terbaru
        usort($cashOutData, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        return view('backend/reports/transactions', [
            'cashIn'  => $cashIn,
            'cashOut' => $cashOutData,
        ]);
    }

    // ================= CRUD =================
    public function create()
    {
        return view('backend/reports/transaction_form', [
            'title' => 'Add Transaction'
        ]);
    }

    public function store()
    {
        $data = $this->request->getPost([
            'date', 'description', 'amount', 'type'
        ]);

        $this->trx->insert($data);

        return redirect()->to(base_url('dashboard/transaksi'))
            ->with('success', 'Transaction added successfully.');
    }

    public function edit($id)
    {
        $transaction = $this->trx->find($id);
        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaction not found.');
        }

        return view('backend/reports/transaction_form', [
            'transaction' => $transaction,
            'title'       => 'Edit Transaction'
        ]);
    }

    public function update($id)
    {
        $data = $this->request->getPost([
            'date', 'description', 'amount', 'type'
        ]);

        $this->trx->update($id, $data);

        return redirect()->to(base_url('dashboard/transaksi'))
            ->with('success', 'Transaction updated successfully.');
    }

    public function delete($id)
    {
        $this->trx->delete($id);

        return redirect()->to(base_url('dashboard/transaksi'))
            ->with('success', 'Transaction deleted successfully.');
    }
}
