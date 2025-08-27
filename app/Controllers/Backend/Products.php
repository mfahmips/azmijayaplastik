<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SupplierModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Products extends BaseController
{
    protected $product, $category, $supplier;

    public function __construct()
    {
        $this->product  = new ProductModel();
        $this->category = new CategoryModel();
        $this->supplier = new SupplierModel();
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
        return redirect()->to(base_url('backend/products'))->with('success', 'Produk berhasil ditambahkan.');
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
        return redirect()->to(base_url('backend/products'))->with('success', 'Produk berhasil diupdate.');
    }

    public function delete($id)
    {
        $this->product->delete($id);
        return redirect()->to(base_url('backend/products'))->with('success', 'Produk berhasil dihapus.');
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
                $this->product->save([
                    'sku'          => $row[0],
                    'name'         => $row[1],
                    'category_id'  => $row[2],
                    'supplier_id'  => $row[3],
                    'cost_price'   => $row[4],
                    'sell_price'   => $row[5],
                    'stock'        => $row[6],
                    'description'  => $row[7],
                ]);
            }

            return redirect()->to(base_url('backend/products'))->with('success', 'Import berhasil!');
        }

        return redirect()->back()->with('error', 'File tidak valid.');
    }
}
