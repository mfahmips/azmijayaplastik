<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\ProductsModel;
use App\Models\CategoriesModel;
use App\Models\SuppliersModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Products extends BaseController
{
    protected ProductsModel $product;
    protected CategoriesModel $category;
    protected SuppliersModel $supplier;

    public function __construct()
    {
        $this->product  = new ProductsModel();
        $this->category = new CategoriesModel();
        $this->supplier = new SuppliersModel();
    }

    public function index()
    {
        $q = $this->request->getGet('q');
        $category_id = $this->request->getGet('category_id');

        $builder = $this->product->withRelations();

        if ($q) {
            $builder->groupStart()
                ->like('products.name', $q)
                ->orLike('products.sku', $q)
                ->orLike('categories.name', $q)
                ->groupEnd();
        }

        if ($category_id) {
            $builder->where('products.category_id', $category_id);
        }

        $this->product->setBuilder($builder);
        $products = $this->product->paginate(10, 'default');
        $pager = $this->product->pager;

        $categories = $this->category->orderBy('parent_id ASC, name ASC')->findAll();

        return view('backend/master/products/index', compact('products', 'pager', 'q', 'category_id', 'categories'));
    }

    public function form($id = null)
    {
        $row        = $id ? $this->product->find($id) : null;
        $categories = $this->category->orderBy('parent_id ASC, name ASC')->findAll();
        $suppliers  = $this->supplier->orderBy('name')->findAll();

        return view('backend/master/products/form', compact('row', 'categories', 'suppliers'));
    }

    public function save($id = null)
    {
        $name = trim($this->request->getPost('name'));
        $data = [
            'category_id'    => (int) $this->request->getPost('category_id'),
            'supplier_id'    => $this->request->getPost('supplier_id') ?: null,
            'name'           => $name,
            'slug'           => $this->request->getPost('slug') ?: url_title($name, '-', true),
            'sku'            => $this->request->getPost('sku') ?: null,
            'barcode'        => $this->request->getPost('barcode') ?: null,
            'unit'           => $this->request->getPost('unit') ?: 'pcs',
            'stock'          => (int) $this->request->getPost('stock'),
            'min_stock'      => (int) $this->request->getPost('min_stock'),
            'purchase_price' => $this->request->getPost('purchase_price') ?: null,
            'sell_price'     => $this->request->getPost('sell_price') ?: null,
            'price_tier'     => $this->request->getPost('price_tier') ?: null,
            'image'          => $this->request->getPost('image') ?: null,
            'is_active'      => $this->request->getPost('is_active') ? 1 : 0,
            'description'    => $this->request->getPost('description') ?: null,
        ];

        if ($id) {
            $this->product->update($id, $data);
        } else {
            $this->product->insert($data);
        }

        return redirect()->to('/dashboard/products')->with('msg', 'Produk berhasil disimpan');
    }

    public function delete($id)
    {
        $this->product->delete($id, true);
        return redirect()->back()->with('msg', 'Produk berhasil dihapus');
    }

    public function export($format = 'xlsx')
    {
        $rows = $this->product->withRelations()->orderBy('products.name', 'ASC')->get()->getResultArray();
        $s = new Spreadsheet();
        $ws = $s->getActiveSheet();

        $ws->fromArray([
            'id', 'category_id', 'category_name', 'supplier_id', 'supplier_name',
            'name', 'slug', 'sku', 'barcode', 'unit', 'stock', 'min_stock',
            'purchase_price', 'sell_price', 'price_tier(json)', 'image', 'is_active', 'description'
        ], null, 'A1');

        $r = 2;
        foreach ($rows as $x) {
            $ws->fromArray([
                $x['id'], $x['category_id'], $x['category_name'] ?? '', $x['supplier_id'], $x['supplier_name'] ?? '',
                $x['name'], $x['slug'], $x['sku'], $x['barcode'], $x['unit'], $x['stock'], $x['min_stock'],
                $x['purchase_price'], $x['sell_price'], $x['price_tier'], $x['image'], $x['is_active'], $x['description']
            ], null, "A{$r}");
            $r++;
        }

        return $this->download($s, 'products_' . date('Ymd_His'), $format);
    }

    public function import()
    {
        $file = $this->request->getFile('file');
        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('errors', ['file' => 'File tidak valid']);
        }

        $reader = IOFactory::createReader(strtolower($file->getExtension()) === 'csv' ? 'Csv' : 'Xlsx');
        if ($reader instanceof \PhpOffice\PhpSpreadsheet\Reader\Csv) {
            $reader->setDelimiter(',');
        }

        $ws = $reader->load($file->getTempName())->getActiveSheet();
        $rows = $ws->toArray(null, true, true, true);

        $imported = 0;
        $updated  = 0;
        $errors   = [];

        foreach ($rows as $i => $c) {
            if ($i === 1) continue;
            $name = trim((string)($c['F'] ?? ''));
            if ($name === '') continue;

            $categoryId = (int)($c['B'] ?? 0);
            $categoryName = trim((string)($c['C'] ?? ''));
            if ($categoryId <= 0 && $categoryName !== '') {
                $found = $this->category->where('name', $categoryName)->first();
                $categoryId = $found ? (int)$found['id'] : $this->category->insert([
                    'name' => $categoryName,
                    'slug' => url_title($categoryName, '-', true)
                ], true);
            }
            if ($categoryId <= 0) {
                $errors[] = "Baris {$i}: Kategori kosong/tidak ditemukan";
                continue;
            }

            $supplierId = ($c['D'] !== '') ? (int)$c['D'] : 0;
            $supplierName = trim((string)($c['E'] ?? ''));
            if ($supplierId <= 0 && $supplierName !== '') {
                $found = $this->supplier->where('name', $supplierName)->first();
                $supplierId = $found ? (int)$found['id'] : $this->supplier->insert(['name' => $supplierName], true);
            }

            $slug = trim((string)($c['G'] ?? '')) ?: url_title($name, '-', true);

            $data = [
                'category_id'    => $categoryId,
                'supplier_id'    => $supplierId ?: null,
                'name'           => $name,
                'slug'           => $slug,
                'sku'            => trim((string)($c['H'] ?? '')) ?: null,
                'barcode'        => trim((string)($c['I'] ?? '')) ?: null,
                'unit'           => trim((string)($c['J'] ?? '')) ?: 'pcs',
                'stock'          => (int)($c['K'] ?? 0),
                'min_stock'      => (int)($c['L'] ?? 0),
                'purchase_price' => ($c['M'] === '' ? null : (int)$c['M']),
                'sell_price'     => ($c['N'] === '' ? null : (int)$c['N']),
                'price_tier'     => trim((string)($c['O'] ?? '')) ?: null,
                'image'          => trim((string)($c['P'] ?? '')) ?: null,
                'is_active'      => ((string)($c['Q'] ?? '1')) === '0' ? 0 : 1,
                'description'    => trim((string)($c['R'] ?? '')) ?: null,
            ];

            $id = (int)($c['A'] ?? 0);
            if ($id && $this->product->find($id)) {
                $this->product->update($id, $data);
                $updated++;
            } else {
                $this->product->insert($data);
                $imported++;
            }
        }

        $msg = "Import selesai. Tambah: {$imported}, Update: {$updated}";
        if ($errors) {
            $msg .= '. Error: ' . implode(' | ', $errors);
        }

        return redirect()->back()->with('msg', $msg);
    }

    private function download(Spreadsheet $s, string $name, string $format)
    {
        $format = strtolower($format);
        if ($format === 'csv') {
            $w = new Csv($s);
            $mime = 'text/csv';
            $ext  = 'csv';
        } else {
            $w = new Xlsx($s);
            $mime = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            $ext  = 'xlsx';
        }

        $tmp = tempnam(sys_get_temp_dir(), 'exp_');
        $w->save($tmp);

        return $this->response->download("{$name}.{$ext}", file_get_contents($tmp), true)->setContentType($mime);
    }
}
