<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SupplierModel;
use App\Models\StockInModel;
use App\Models\StockOpnameModel;
use App\Models\ProductPriceModel; // ✅ tambahkan model harga grosir
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Products extends BaseController
{
    protected $product, $category, $supplier, $stockIn, $opname, $price;

    public function __construct()
    {
        setlocale(LC_TIME, 'id_ID.UTF-8', 'Indonesian_indonesia.1252');
        $this->product  = new ProductModel();
        $this->category = new CategoryModel();
        $this->supplier = new SupplierModel();
        $this->stockIn  = new StockInModel();
        $this->opname   = new StockOpnameModel();
        $this->price    = new ProductPriceModel(); // ✅ inisialisasi model grosir
    }

    // ================= Produk =================
    public function index()
{
    $q           = trim($this->request->getGet('q') ?? '');
    $perPage     = 12;
    $category_id = $this->request->getGet('category_id');
    $builder     = $this->product->getJoined();

    // filter pencarian
    if ($q !== '') {
        $builder->groupStart()
            ->like('products.name', $q)
            ->orLike('products.sku', $q)
            ->orLike('products.barcode', $q)
            ->groupEnd();
    }

    // filter kategori
    if ($category_id) {
        $builder->where('products.category_id', $category_id);
    }

    // urutkan berdasar kategori code + sku
    $products = $builder
        ->orderBy('category_code', 'ASC')
        ->orderBy('products.sku', 'ASC')
        ->paginate($perPage, 'prod');

    $pager = $this->product->pager;
    $no    = 1 + ($pager->getCurrentPage('prod') - 1) * $perPage;

    // kategori hanya yang punya produk
    $categories = $this->category
        ->select('c.id, c.name, c.code')
        ->from('categories c')
        ->join('products p', 'p.category_id = c.id', 'inner')
        ->groupBy('c.id, c.name, c.code')
        ->orderBy('c.name', 'ASC')
        ->findAll();

    // Ambil harga grosir untuk semua produk
    $priceModel = $this->price;
    $pricesMap = [];

        foreach ($products as &$p) {
        $hargaGrosir = $priceModel->where('product_id', $p['id'])->orderBy('min_qty', 'ASC')->first();

        if ($hargaGrosir) {
            $p['grosir_unit']    = $hargaGrosir['unit'];
            $p['grosir_min_qty'] = $hargaGrosir['min_qty'];
            $p['grosir_price']   = $hargaGrosir['price'];
            $pricesMap[$p['id']] = "≥ {$hargaGrosir['min_qty']} : Rp. " . number_format($hargaGrosir['price'], 0, ',', '.');
        } else {
            $p['grosir_unit']    = '';
            $p['grosir_min_qty'] = '';
            $p['grosir_price']   = '';
            $pricesMap[$p['id']] = '-';
        }
    }


    return view('backend/master/products/index', [
        'title'       => 'Data Produk',
        'products'    => $products,
        'categories'  => $categories,
        'pager'       => $pager,
        'q'           => $q,
        'category_id' => $category_id,
        'per_page'    => $perPage,
        'no'          => $no,
        'pricesMap'   => $pricesMap, // ✅ dikirim ke view
    ]);
}


    public function create()
    {
        return view('backend/master/products/create', [
            'categories' => $this->category->findAll(),
            'suppliers'  => $this->supplier->findAll()
        ]);
    }

   public function store()
{
    $data = $this->request->getPost([
    'name','brand','barcode','cost_price',
    'sell_price','stock','min_stock','unit',
    'category_id','supplier_id','is_active'
    ]);

    // Auto-generate SKU
    $data['sku'] = $this->generateSkuByCategory($data['category_id'], $data['brand']);

    $this->product->insert($data);
    $productId = $this->product->getInsertID();


    // harga grosir opsional
    $prices = $this->request->getPost('prices');
    if ($prices) {
        foreach ($prices as $price) {
            model('ProductPriceModel')->insert([
                'product_id' => $productId,
                'unit'       => $price['unit'],
                'min_qty'    => $price['min_qty'],
                'price'      => $price['price'],
            ]);
        }
    }

    return redirect()->to(base_url('dashboard/products'))
                     ->with('success', 'Produk berhasil ditambahkan.');
}



    public function edit($id)
{
    $product = $this->product->find($id);
    $prices  = $this->price->where('product_id', $id)->findAll();

    return view('backend/products/edit', [
        'product' => $product,
        'prices'  => $prices,
        'categories' => $this->category->findAll(),
        'suppliers'  => $this->supplier->findAll(),
    ]);
}




public function update($id)
{
    $productModel = new \App\Models\ProductModel();

    // validasi input
    $validation = \Config\Services::validation();
    $validation->setRules([
        'name'        => 'required|string',
        'brand'       => 'permit_empty|string',
        'category_id' => 'required|integer',
        'supplier_id' => 'permit_empty|integer',
        'barcode'     => 'permit_empty|string',
        'unit'        => 'permit_empty|string',
        'cost_price'  => 'required|decimal',
        'sell_price'  => 'required|decimal',
        'stock'       => 'required|integer',
        'min_stock'   => 'permit_empty|integer',
        'is_active'   => 'required|in_list[0,1]',
        'description' => 'permit_empty|string',
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->with('error', $validation->listErrors());
    }

    // ambil data produk lama (untuk SKU)
    $product = $productModel->find($id);
    if (!$product) {
        return redirect()->back()->with('error', 'Produk tidak ditemukan');
    }

    // ambil input
    $name        = $this->request->getPost('name');
    $brand       = $this->request->getPost('brand');
    $category_id = $this->request->getPost('category_id');

    // supplier_id → null jika kosong
    $supplier_id = $this->request->getPost('supplier_id');
    if (empty($supplier_id)) {
        $supplier_id = null;
    }

    // siapkan data update (SKU tetap dari DB)
    $data = [
        'sku'         => $product['sku'],
        'name'        => $name,
        'brand'       => $brand,
        'category_id' => $category_id,
        'supplier_id' => $supplier_id,
        'barcode'     => $this->request->getPost('barcode'),
        'unit'        => $this->request->getPost('unit'),
        'cost_price'  => $this->request->getPost('cost_price'),
        'sell_price'  => $this->request->getPost('sell_price'),
        'stock'       => $this->request->getPost('stock'),
        'min_stock'   => $this->request->getPost('min_stock'),
        'is_active'   => $this->request->getPost('is_active'),
        'description' => $this->request->getPost('description'),
        'updated_at'  => date('Y-m-d H:i:s'),
    ];

    // update produk
    $productModel->update($id, $data);

    return redirect()->to('/dashboard/products')->with('success', 'Produk berhasil diperbarui');
}




    public function delete($id)
    {
        $this->product->delete($id);
        model('ProductPriceModel')->where('product_id', $id)->delete();
        return redirect()->to(base_url('dashboard/products'))->with('success', 'Produk berhasil dihapus.');
    }

    // ================= Export / Import =================
    public function export()
{
    $products = $this->product->getJoined()->findAll(); 
    $prices   = model('ProductPriceModel')
                    ->select('product_prices.*, products.name as product_name')
                    ->join('products', 'products.id = product_prices.product_id')
                    ->orderBy('product_prices.product_id', 'ASC')
                    ->findAll();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Produk');

    // ✅ Header
    $sheet->fromArray([[
        'SKU','Nama','Merk','Kategori','Satuan',
        'Harga Beli','Harga Jual','Stok',
        'Unit Grosir','Minimal Qty','Harga Grosir'
    ]], null, 'A1');

    $row = 2;
    foreach ($products as $p) {
        $productPrices = array_filter($prices, fn($pr) => $pr['product_id'] == $p['id']);
        if (!empty($productPrices)) {
            foreach ($productPrices as $pr) {
                $sheet->fromArray([
                    $p['sku'], $p['name'], $p['brand'] ?? '', $p['category_name'] ?? '',
                    $p['unit'], $p['cost_price'], $p['sell_price'], $p['stock'],
                    $pr['unit'], $pr['min_qty'], $pr['price']
                ], null, 'A'.$row);
                $row++;
            }
        } else {
            $sheet->fromArray([
                $p['sku'], $p['name'], $p['brand'] ?? '', $p['category_name'] ?? '',
                $p['unit'], $p['cost_price'], $p['sell_price'], $p['stock'],
                '-', '-', '-'
            ], null, 'A'.$row);
            $row++;
        }
    }

    foreach (range('A', 'K') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    $filename = "AJP_Produk_".date('dmY').".xlsx";
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

            $sku         = trim($row[0] ?? '');
            $name        = trim($row[1] ?? '');
            $brand       = trim($row[2] ?? '');
            $category    = trim($row[3] ?? '');
            $unit        = trim($row[4] ?? '');
            $costPrice   = (float)($row[5] ?? 0);
            $sellPrice   = (float)($row[6] ?? 0);
            $stock       = (int)($row[7] ?? 0);
            $grosirUnit  = trim($row[8] ?? '');
            $minQty      = (int)($row[9] ?? 0);
            $grosirPrice = (float)($row[10] ?? 0);

            // cari ID kategori
            $categoryRow = $this->category->where('name', $category)->first();
            $categoryId  = $categoryRow['id'] ?? null;
            $categoryCode = $categoryRow['code'] ?? 'CAT';

            // generate SKU jika kosong
            if (empty($sku)) {
                // ambil urutan terakhir dari kategori
                $lastProduct = $this->product
                    ->where('category_id', $categoryId)
                    ->like('sku', $categoryCode, 'after')
                    ->orderBy('id', 'DESC')
                    ->first();

                $lastNumber = 0;
                if ($lastProduct && preg_match('/(\d{3})/', $lastProduct['sku'], $matches)) {
                    $lastNumber = (int)$matches[1];
                }

                $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
                $sku = $categoryCode . $newNumber . '-' . strtoupper(str_replace(' ', '', $brand));
            }

            // cek duplikat berdasarkan name+brand+category
            $exists = $this->product
                ->where('name', $name)
                ->where('brand', $brand)
                ->where('category_id', $categoryId)
                ->first();

            if ($exists) {
                $this->product->update($exists['id'], [
                    'sku'         => $sku,
                    'unit'        => $unit,
                    'cost_price'  => $costPrice,
                    'sell_price'  => $sellPrice,
                    'stock'       => $stock,
                    'is_active'   => 1
                ]);
                $productId = $exists['id'];
            } else {
                $this->product->insert([
                    'sku'         => $sku,
                    'name'        => $name,
                    'brand'       => $brand,
                    'category_id' => $categoryId,
                    'unit'        => $unit,
                    'cost_price'  => $costPrice,
                    'sell_price'  => $sellPrice,
                    'stock'       => $stock,
                    'is_active'   => 1
                ]);
                $productId = $this->product->getInsertID();
            }

            // Insert harga grosir jika ada
            if ($minQty > 0 && $grosirPrice > 0) {
                model('ProductPriceModel')->insert([
                    'product_id' => $productId,
                    'unit'       => $grosirUnit,
                    'min_qty'    => $minQty,
                    'price'      => $grosirPrice
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
    $records = $this->stockIn
        ->select('
            stock_in.id, stock_in.product_id, stock_in.supplier_id,
            stock_in.qty, stock_in.cost_price, stock_in.note, stock_in.created_at,
            products.sku, products.name as product_name, products.unit,
            categories.name as category_name,
            suppliers.name as supplier_name
        ')
        ->join('products', 'products.id = stock_in.product_id')
        ->join('categories', 'categories.id = products.category_id', 'left')
        ->join('suppliers', 'suppliers.id = stock_in.supplier_id', 'left')
        ->orderBy('stock_in.created_at', 'DESC')
        ->findAll();

    // ✅ Grouping berdasarkan tanggal (format Y-m-d)
    $grouped = [];
    foreach ($records as $row) {
        $dateKey = date('Y-m-d', strtotime($row['created_at']));
        $grouped[$dateKey][] = $row;
    }

    // ✅ Ambil hanya kategori yang punya produk aktif
    $categories = $this->category
        ->select('categories.id, categories.name, categories.code')
        ->join('products', 'products.category_id = categories.id', 'inner')
        ->where('products.is_active', 1)
        ->groupBy('categories.id, categories.name, categories.code')
        ->orderBy('categories.name', 'ASC')
        ->findAll();

    $data = [
        'title'       => 'Barang Masuk',
        'products'    => $this->product->where('is_active', 1)->findAll(),
        'suppliers'   => $this->supplier->findAll(),
        'categories'  => $categories,
        'stock_group' => $grouped
    ];

    return view('backend/master/products/stock-in', $data);
}


    public function stockInSave()
    {
        $productId  = $this->request->getPost('product_id');
        $newProduct = $this->request->getPost('new_product');
        $supplierId = $this->request->getPost('supplier_id') ?: null;
        $qty        = (int)$this->request->getPost('qty');
        $costPrice  = (float)$this->request->getPost('cost_price');
        $note       = $this->request->getPost('note');

        if ($qty <= 0) {
            return redirect()->back()->with('error', 'Qty wajib diisi.');
        }

        // Jika produk baru dibuat
        if ($newProduct) {
            $this->product->insert([
                'name'        => $newProduct,
                'sku'         => $this->generateSkuByCategory(null), // tanpa kategori
                'brand'       => null,
                'category_id' => null,
                'supplier_id' => $supplierId,
                'stock'       => 0,
                'cost_price'  => $costPrice,
                'sell_price'  => 0,
                'description' => null,
                'is_active'   => 1
            ]);
            $productId = $this->product->getInsertID();
        }

        if (!$productId) {
            return redirect()->back()->with('error', 'Pilih produk atau isi produk baru.');
        }

        // Simpan riwayat barang masuk
        $this->stockIn->insert([
            'product_id'  => $productId,
            'supplier_id' => $supplierId,
            'qty'         => $qty,
            'cost_price'  => $costPrice,
            'note'        => $note,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => null
        ]);

        // Update stok produk
        $product   = $this->product->find($productId);
        $newStock  = $product['stock'] + $qty;

        $this->product->update($productId, [
            'stock'      => $newStock,
            'cost_price' => $costPrice
        ]);

        return redirect()->to(base_url('dashboard/products/stock-in'))
                         ->with('success', 'Barang masuk berhasil ditambahkan.');
    }

    public function stockInEdit($id)
    {
        $stockIn = $this->stockIn->find($id);
        if (!$stockIn) {
            return redirect()->to(base_url('dashboard/products/stock-in'))
                             ->with('error', 'Data tidak ditemukan.');
        }

        return view('backend/master/products/stock-in-edit', [
            'title'     => 'Edit Barang Masuk',
            'stock_in'  => $stockIn,
            'products'  => $this->product->where('is_active', 1)->findAll(),
            'suppliers' => $this->supplier->findAll(),
        ]);
    }

    public function stockInUpdate($id)
    {
        $stockIn = $this->stockIn->find($id);
        if (!$stockIn) {
            return redirect()->to(base_url('dashboard/products/stock-in'))
                             ->with('error', 'Data tidak ditemukan.');
        }

        $qty        = (int)$this->request->getPost('qty');
        $costPrice  = (float)$this->request->getPost('cost_price');
        $supplierId = $this->request->getPost('supplier_id') ?: null;

        if ($qty <= 0) {
            return redirect()->back()->with('error', 'Qty wajib lebih dari 0.');
        }

        $this->stockIn->update($id, [
            'product_id'  => $this->request->getPost('product_id'),
            'supplier_id' => $supplierId,
            'qty'         => $qty,
            'cost_price'  => $costPrice,
            'note'        => $this->request->getPost('note'),
        ]);

        return redirect()->to(base_url('dashboard/products/stock-in'))
                         ->with('success', 'Barang masuk berhasil diupdate.');
    }

    public function stockInDelete($id)
    {
        $stockIn = $this->stockIn->find($id);
        if (!$stockIn) {
            return redirect()->to(base_url('dashboard/products/stock-in'))
                             ->with('error', 'Data tidak ditemukan.');
        }

        $this->stockIn->delete($id);

        return redirect()->to(base_url('dashboard/products/stock-in'))
                         ->with('success', 'Barang masuk berhasil dihapus.');
    }


    // ================= Stok Opname =================
    public function stokOpname()
    {
        $products = $this->product->orderBy('name','ASC')->findAll();

        // ambil histori opname (paginate biar ringan)
        $opnames = $this->opname->select('stock_opnames.*, products.name, products.sku')
                                ->join('products','products.id=stock_opnames.product_id')
                                ->orderBy('stock_opnames.created_at','DESC')
                                ->paginate(10,'opname');

        return view('backend/master/products/stock-opname',[
            'title'    => 'Stok Opname',
            'products' => $products,
            'opnames'  => $opnames,
            'pager'    => $this->opname->pager
        ]);
    }

    public function simpanStokOpname()
    {
        $stocks = $this->request->getPost('stock') ?? [];
        $notes  = $this->request->getPost('note') ?? [];

        foreach ($stocks as $productId => $stockReal) {
            $product = $this->product->find($productId);
            if (!$product) continue;

            $stockSystem = $product['stock'];
            $difference  = (int)$stockReal - (int)$stockSystem;
            $note        = $notes[$productId] ?? null;

            // simpan histori opname
            $this->opname->insert([
                'product_id'   => $productId,
                'stock_system' => $stockSystem,
                'stock_real'   => $stockReal,
                'difference'   => $difference,
                'note'         => $note
            ]);

            // update stok produk sesuai hasil opname
            $this->product->update($productId, ['stock' => $stockReal]);
        }

        return redirect()->to(base_url('dashboard/products/stock-opname'))
                         ->with('success', 'Stok opname berhasil disimpan!');
    }

    public function editOpname($id)
    {
        $data = $this->opname->select('stock_opnames.*, products.name, products.sku')
                             ->join('products','products.id=stock_opnames.product_id')
                             ->where('stock_opnames.id',$id)
                             ->first();
        if (!$data) {
            return redirect()->back()->with('error','Data tidak ditemukan');
        }

        return view('backend/master/products/edit-opname',[
            'title'=>'Edit Stok Opname',
            'opname'=>$data
        ]);
    }

    public function updateOpname($id)
    {
        $data = $this->opname->find($id);
        if (!$data) {
            return redirect()->back()->with('error','Data tidak ditemukan');
        }

        $stockReal = (int)$this->request->getPost('stock_real');
        $difference = $stockReal - (int)$data['stock_system'];

        $this->opname->update($id,[
            'stock_real' => $stockReal,
            'difference' => $difference,
            'note'       => $this->request->getPost('note')
        ]);

        return redirect()->to(base_url('dashboard/products/stock-opname'))
                         ->with('success','Histori opname berhasil diupdate.');
    }

    public function deleteOpname($id)
    {
        $this->opname->delete($id);
        return redirect()->to(base_url('dashboard/products/stock-opname'))
                         ->with('success','Histori opname berhasil dihapus.');
    }

// ================= Utils =================
private function generateSkuByCategory($categoryId, $brand)
{
    $category = $this->category->find($categoryId);

    $categoryCode = $category && !empty($category['code'])
        ? strtoupper($category['code'])
        : 'CAT';

    $brandCode = strtoupper(str_replace(' ', '', $brand)) ?: 'BRAND';

    // Ambil SKU terakhir (bukan berdasarkan ID produk, tapi SKU yang cocok dengan prefix)
    $lastProduct = $this->product
        ->where('category_id', $categoryId)
        ->like('sku', $categoryCode, 'after')
        ->orderBy('id', 'DESC')
        ->first();

    if ($lastProduct && preg_match('/(\d{3})/', $lastProduct['sku'], $matches)) {
        $lastNumber = (int) $matches[1];
        $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    } else {
        $nextNumber = '001';
    }

    return $categoryCode . $nextNumber . '-' . $brandCode;
}


public function saveWholesale()
{
    $productId = $this->request->getPost('product_id');
    $unit      = $this->request->getPost('unit');
    $minQty    = $this->request->getPost('min_qty');
    $price     = $this->request->getPost('price');

    if (!$productId || !$price || !$minQty) {
        return redirect()->back()->with('error', 'Data tidak lengkap.');
    }

    // Cek apakah sudah ada harga grosir untuk produk ini
    $existing = $this->price->where('product_id', $productId)->first();

    if ($existing) {
        // Update
        $this->price->update($existing['id'], [
            'unit'    => $unit,
            'min_qty'=> $minQty,
            'price'   => $price,
        ]);
    } else {
        // Tambah
        $this->price->insert([
            'product_id' => $productId,
            'unit'       => $unit,
            'min_qty'    => $minQty,
            'price'      => $price,
        ]);
    }

    return redirect()->to(base_url('dashboard/products'))->with('success', 'Harga grosir disimpan.');
}




}