<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\SaleModel;
use App\Models\SaleItemModel;

class Kasir extends BaseController
{
    protected $productModel;
    protected $saleModel;
    protected $saleItemModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->saleModel = new SaleModel();
        $this->saleItemModel = new SaleItemModel();
    }

    public function index()
    {
        return view('backend/kasir/index');
    }

public function cariProduk()
{
    $keyword = $this->request->getGet('q');

    $produk = $this->productModel
        ->select('id, name, sell_price')
        ->groupStart()
            ->like('name', $keyword)
            ->orLike('sku', $keyword)
            ->orLike('barcode', $keyword)
        ->groupEnd()
        ->limit(10)
        ->find();

    return $this->response->setJSON($produk);
}



    public function tambahProdukBaru()
    {
        $name = $this->request->getPost('name');
        $sellPrice = (int) ($this->request->getPost('sell_price') ?? 0);

        if (empty($name)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Nama produk wajib diisi.']);
        }

        $data = [
            'sku'        => 'SKU-' . date('Ymd-His'),
            'name'       => $name,
            'sell_price' => $sellPrice,
            'stock'      => 0,
            'unit'       => 'pcs',
            'is_active'  => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $id = $this->productModel->insert($data);
        $produk = $this->productModel->find($id);

        return $this->response->setJSON(['status' => 'ok', 'produk' => $produk]);
    }

    public function simpanTransaksi()
{
    $data = $this->request->getJSON(true);

    if (!isset($data['items']) || !is_array($data['items']) || empty($data['items'])) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Item kosong']);
    }

    $db = \Config\Database::connect();
    $db->transStart();

    // Generate invoice: INV-YYYYMMDD-XXXX
    $tanggal = date('Ymd');
    $jumlahHariIni = $db->table('sales')
        ->where('DATE(created_at)', date('Y-m-d'))
        ->countAllResults();
    $invoice = 'INV-' . $tanggal . '-' . str_pad($jumlahHariIni + 1, 4, '0', STR_PAD_LEFT);

    $saleData = [
        'invoice'      => $invoice,
        'total_price'  => $data['total_price'],
        'total_items'  => count($data['items']),
        'customer_id'  => null,
        'paid'         => $data['payment'], // FIXED: sebelumnya tidak tersimpan
        'change'       => $data['payment'] - $data['total_price'],
        'created_at'   => date('Y-m-d H:i:s'),
    ];

    $this->saleModel->insert($saleData);
    $saleId = $this->saleModel->getInsertID();

    foreach ($data['items'] as $item) {
        $insertItem = [
            'sale_id'    => $saleId,
            'product_id' => $item['id'],
            'price'      => $item['price'],
            'qty'        => $item['qty'],
            'subtotal'   => $item['subtotal'],
        ];

        if (!$this->saleItemModel->insert($insertItem)) {
            log_message('error', 'Gagal insert sale item: ' . json_encode($this->saleItemModel->errors()));
        }

        // Update stok produk
        $produk = $this->productModel->find($item['id']);
        if ($produk) {
            $newStock = (int)$produk['stock'] - (int)$item['qty'];
            $this->productModel->update($item['id'], ['stock' => $newStock]);
        }
    }

    $db->transComplete();

    if ($db->transStatus() === false) {
        log_message('error', 'Transaksi gagal, rollback.');
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan transaksi.']);
    }

    return $this->response->setJSON(['status' => 'ok', 'invoice' => $invoice]);
}


public function penjualan()
{
    return view('backend/transaksi/penjualan/index');
}

public function penjualanData()
{
    $model = new \App\Models\SaleModel();
    $sales = $model->orderBy('created_at', 'DESC')->findAll();

    return $this->response->setJSON($sales);
}

public function cetak($invoice)
{
    $sale = $this->saleModel->where('invoice', $invoice)->first();
    $items = $this->saleItemModel->where('sale_id', $sale['id'])->findAll();
    return view('backend/kasir/print', compact('sale', 'items'));
}



}
