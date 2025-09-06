<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SupplierModel;
use App\Models\StockInModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Products extends BaseController
{
    protected $product, $category, $supplier, $stockIn;

    public function __construct()
    {
        $this->product  = new ProductModel();
        $this->category = new CategoryModel();
        $this->supplier = new SupplierModel();
        $this->stockIn  = new StockInModel();
    }

    public function index()
    {
        $q           = trim($this->request->getGet('q') ?? '');
        $perPage     = 8;
        $category_id = $this->request->getGet('category_id');
        $builder     = $this->product->getJoined(); // method with join to category

        if ($q !== '') {
            $builder->groupStart()
                ->like('products.name', $q)
                ->orLike('products.sku', $q)
                ->orLike('products.barcode', $q)
                ->groupEnd();
        }

        if ($category_id) {
            $builder->where('products.category_id', $category_id);
        }

        $products = $builder->orderBy('products.id', 'DESC')->paginate($perPage, 'prod');
        $pager    = $this->product->pager;
        $no       = 1 + ($pager->getCurrentPage('prod') - 1) * $perPage;

        $data = [
            'title'       => 'Data Produk',
            'products'    => $products,
            'categories'  => $this->category->findAll(),
            'pager'       => $pager,
            'q'           => $q,
            'category_id' => $category_id,
            'per_page'    => $perPage,
            'no'          => $no
        ];

        return view('backend/master/products/index', $data);
    }

    public function create()
    {
        $data = [
            'categories' => $this->category->findAll(),
            'suppliers'  => $this->supplier->findAll()
        ];
        return view('backend/master/products/create', $data);
    }

    public function store()
    {
        $this->product->save($this->request->getPost());
        return redirect()->to(base_url('dashboard/products'))->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'product'    => $this->product->find($id),
            'categories' => $this->category->findAll(),
            'suppliers'  => $this->supplier->findAll()
        ];
        return view('backend/master/products/edit', $data);
    }

    public function update($id)
    {
        $this->product->update($id, $this->request->getPost());
        return redirect()->to(base_url('dashboard/products'))->with('success', 'Produk berhasil diupdate.');
    }

    public function delete($id)
    {
        $this->product->delete($id);
        return redirect()->to(base_url('dashboard/products'))->with('success', 'Produk berhasil dihapus.');
    }

    public function export()
    {
        $products = $this->product->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'SKU');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Kategori ID');
        $sheet->setCellValue('D1', 'Supplier ID');
        $sheet->setCellValue('E1', 'Harga Beli');
        $sheet->setCellValue('F1', 'Harga Jual');
        $sheet->setCellValue('G1', 'Stok');
        $sheet->setCellValue('H1', 'Keterangan');

        $row = 2;
        foreach ($products as $p) {
            $sheet->fromArray([
                $p['sku'], $p['name'], $p['category_id'], $p['supplier_id'],
                $p['cost_price'], $p['sell_price'], $p['stock'], $p['description']
            ], null, 'A' . $row);
            $row++;
        }

        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'Produk_' . date('Ymd_His') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        (new Xlsx($spreadsheet))->save('php://output');
        exit;
    }

public function import()
{
    $file = $this->request->getFile('file_excel');
    if ($file && $file->isValid()) {
        $sheet = IOFactory::load($file->getTempName())->getActiveSheet()->toArray();

        for ($i = 1; $i < count($sheet); $i++) {
            $row = $sheet[$i];
            $sku = trim($row[0]);

            // ✅ Cek apakah SKU sudah ada
            $existing = $this->product->where('sku', $sku)->first();

            if ($existing) {
                // 👉 Kalau SKU sudah ada, update data
                $this->product->update($existing['id'], [
                    'name'        => $row[1],
                    'category_id' => $row[2],
                    'supplier_id' => $row[3],
                    'cost_price'  => $row[4],
                    'sell_price'  => $row[5],
                    'stock'       => $row[6],
                    'description' => $row[7],
                ]);
            } else {
                // 👉 Kalau SKU belum ada, insert baru
                $this->product->insert([
                    'sku'         => $sku ?: 'SKU' . time(),
                    'name'        => $row[1],
                    'category_id' => $row[2],
                    'supplier_id' => $row[3],
                    'cost_price'  => $row[4],
                    'sell_price'  => $row[5],
                    'stock'       => $row[6],
                    'description' => $row[7],
                ]);
            }
        }

        return redirect()->to(base_url('dashboard/products'))->with('success', 'Import berhasil!');
    }

    return redirect()->back()->with('error', 'File tidak valid.');
}


    // ================= Barang Masuk =================
    public function stockIn()
{
    $data = [
        'title'      => 'Barang Masuk',
        'products'   => $this->product->where('is_active', 1)->findAll(),
        'suppliers'  => $this->supplier->findAll(),
        'categories' => $this->category->findAll(), // ✅ tambahkan ini
        'stock_in'   => $this->stockIn
            ->select('stock_in.*, products.name as product_name, suppliers.name as supplier_name')
            ->join('products', 'products.id = stock_in.product_id')
            ->join('suppliers', 'suppliers.id = stock_in.supplier_id', 'left')
            ->orderBy('stock_in.created_at', 'DESC')
            ->findAll()
    ];

    return view('backend/master/products/stock-in', $data);
}


   public function stockInSave()
{
    $productId   = $this->request->getPost('product_id');
    $newProduct  = $this->request->getPost('new_product');
    $supplierId  = $this->request->getPost('supplier_id') ?: null;
    $qty         = (int)$this->request->getPost('qty');
    $costPrice   = (float)$this->request->getPost('cost_price');
    $note        = $this->request->getPost('note');

    if ($qty <= 0) {
        return redirect()->back()->with('error', 'Qty wajib diisi.');
    }

    // ✅ Jika ada produk baru, buat dulu di tabel products
    if ($newProduct) {
        $this->product->insert([
            'name'        => $newProduct,
            'sku'         => 'SKU' . time(),
            'category_id' => null,
            'supplier_id' => $supplierId,
            'stock'       => 0,
            'cost_price'  => $costPrice, // langsung simpan harga beli awal
            'sell_price'  => 0,
        ]);
        $productId = $this->product->getInsertID();
    }

    if (!$productId) {
        return redirect()->back()->with('error', 'Pilih produk atau isi produk baru.');
    }

    // ✅ Insert ke tabel stock_in
    $this->stockIn->insert([
        'product_id'  => $productId,
        'supplier_id' => $supplierId,
        'qty'         => $qty,
        'cost_price'  => $costPrice,
        'note'        => $note,
        'created_at'  => date('Y-m-d H:i:s')
    ]);

    // ✅ Update stok + update harga beli produk
    $product   = $this->product->find($productId);
    $newStock  = $product['stock'] + $qty;
    $this->product->update($productId, [
        'stock'      => $newStock,
        'cost_price' => $costPrice // harga beli terakhir dari stock in
    ]);

    return redirect()->to(base_url('dashboard/products/stock-in'))->with('success', 'Barang masuk berhasil ditambahkan.');
}

private function generateSku()
{
    return 'SKU' . date('YmdHis') . rand(100, 999);
}




}
