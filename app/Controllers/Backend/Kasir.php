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
        $this->saleModel    = new SaleModel();
        $this->saleItemModel = new SaleItemModel();
    }

    public function index()
{
    $produk = $this->productModel->where('is_active',1)->findAll();
    return view('backend/kasir/index', compact('produk'));
}


    /**
     * Endpoint untuk generate invoice baru (INV-ddmmyyyy-0001)
     */
    public function nextInvoice()
    {
        $today = date('Y-m-d');
        $tanggal = date('dmY'); // contoh: 06092025

        $db = \Config\Database::connect();
        $count = $db->table('sales')
            ->where('DATE(created_at)', $today)
            ->countAllResults();

        $urut = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        $invoice = "INV-{$tanggal}-{$urut}";

        return $this->response->setJSON([
            'status'  => 'ok',
            'invoice' => $invoice,
        ]);
    }

    /**
     * Cari produk untuk autocomplete (nama, sku, atau barcode)
     */
public function cariProduk()
{
    $keyword = $this->request->getGet('q');

    if (!$keyword) {
        return $this->response->setJSON([]);
    }

    $produk = $this->productModel
        ->select('id, sku, name, sell_price, stock') // ambil field penting
        ->where('is_active', 1)
        ->groupStart()
            ->like('name', $keyword)
            ->orLike('sku', $keyword)
            ->orLike('barcode', $keyword)
        ->groupEnd()
        ->limit(10)
        ->findAll(); // ⚠️ pakai findAll() bukan find()

    return $this->response->setJSON($produk);
}


    /**
     * Tambah produk baru via modal
     */
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

    /**
     * Simpan transaksi kasir
     */
    public function simpanTransaksi()
    {
        $data = $this->request->getJSON(true);

        if (!isset($data['items']) || !is_array($data['items']) || empty($data['items'])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Item kosong']);
        }

        $db = \Config\Database::connect();
        $db->transStart();

        // Gunakan invoice dari client jika ada, jika tidak generate baru
        $invoice = $data['invoice_hint'] ?? null;
        if (!$invoice) {
            $today = date('Y-m-d');
            $tanggal = date('dmY');
            $count = $db->table('sales')
                ->where('DATE(created_at)', $today)
                ->countAllResults();
            $urut = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
            $invoice = "INV-{$tanggal}-{$urut}";
        }

        $saleData = [
            'invoice'      => $invoice,
            'total_price'  => $data['total_price'],
            'total_items'  => count($data['items']),
            'customer_id'  => null,
            'paid'         => $data['payment'],
            'change'       => $data['payment'] - $data['total_price'],
            'created_at'   => date('Y-m-d H:i:s'),
        ];

        if (!empty($data['customer_name'])) {
            $saleData['customer_name'] = $data['customer_name'];
        }

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

            $this->saleItemModel->insert($insertItem);

            // Update stok produk
            $produk = $this->productModel->find($item['id']);
            if ($produk) {
                $newStock = (int)$produk['stock'] - (int)$item['qty'];
                $this->productModel->update($item['id'], ['stock' => $newStock]);
            }
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan transaksi.']);
        }

        return $this->response->setJSON(['status' => 'ok', 'invoice' => $invoice]);
    }

    /**
     * Halaman riwayat penjualan
     */
    public function penjualan()
    {
        return view('backend/transaksi/penjualan/index');
    }

    /**
     * Cetak struk penjualan
     */
    public function cetak($invoice)
{
    $sale = $this->saleModel->getSaleByInvoice($invoice);
    if (!$sale) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Invoice {$invoice} tidak ditemukan");
    }

    return view('backend/kasir/print', [
        'sale' => $sale,
        'items' => $sale['items']
    ]);
}

public function penjualanData()
{
    $sales = $this->saleModel->getAllSalesWithSummary(100); // ambil max 100 transaksi terakhir
    return $this->response->setJSON($sales);
}


}
