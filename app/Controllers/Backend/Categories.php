<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Categories extends BaseController
{
    protected $category;
    protected $product;

    public function __construct()
    {
        $this->category = new CategoryModel();
        $this->product  = new ProductModel();
    }

    public function index()
    {
        $q        = trim($this->request->getGet('q') ?? '');
        $perPage  = 8;

        $builder = $this->category->where('type', 'category')->orderBy('id', 'ASC');

        if ($q !== '') {
            $builder->groupStart()
                ->like('name', $q)
                ->orLike('code', $q)
            ->groupEnd();
        }

        $categories = $builder->paginate($perPage, 'cat');
        $pager      = $this->category->pager;
        $no         = 1 + ($pager->getCurrentPage('cat') - 1) * $perPage;

        return view('backend/master/categories/index', [
            'title'      => 'Data Kategori',
            'categories' => $categories,
            'pager'      => $pager,
            'q'          => $q,
            'per_page'   => $perPage,
            'no'         => $no,
        ]);
    }

    public function store()
    {
        $data = $this->request->getPost();

        if (empty($data['code']) && !empty($data['name'])) {
            $data['code'] = url_title($data['name'], '-', true);
        }

        $data['type'] = 'category'; // default type
        $allowedFields = ['name', 'code', 'is_active', 'type'];
        $insertData = array_intersect_key($data, array_flip($allowedFields));

        if (empty($insertData)) {
            return redirect()->back()->withInput()->with('error', 'Data tidak valid.');
        }

        $this->category->insert($insertData);

        return redirect()->to(base_url('dashboard/categories'))->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update($id)
    {
        $data = $this->request->getPost();

        if (empty($data['code']) && !empty($data['name'])) {
            $data['code'] = url_title($data['name'], '-', true);
        }

        $data['type'] = 'category';
        $allowedFields = ['name', 'code', 'is_active', 'type'];
        $updateData = array_intersect_key($data, array_flip($allowedFields));

        if (empty($updateData)) {
            return redirect()->back()->withInput()->with('error', 'Tidak ada data untuk disimpan.');
        }

        $this->category->update($id, $updateData);

        return redirect()->to(base_url('dashboard/categories'))->with('success', 'Kategori berhasil diupdate.');
    }

    public function delete($id)
    {
        $productCount = $this->product->where('category_id', $id)->countAllResults();

        if ($productCount > 0) {
            return redirect()->back()->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh produk.');
        }

        $this->category->delete($id);

        return redirect()->to(base_url('dashboard/categories'))->with('success', 'Kategori berhasil dihapus.');
    }

    public function export()
    {
        $categories = $this->category->where('type', 'category')->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray(['Kode', 'Nama', 'Status Aktif'], null, 'A1');
        $row = 2;

        foreach ($categories as $c) {
            $sheet->fromArray(
                [$c['code'], $c['name'], $c['is_active'] ? 'Aktif' : 'Nonaktif'],
                null,
                'A' . $row++
            );
        }

        $filename = 'AJP_Kategori_' . date('dmY') . '.xlsx';

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

                $code = trim($row[0] ?? '');
                $name = trim($row[1] ?? '');

                if (!$name) continue;

                $existing = $this->category
                    ->where('name', $name)
                    ->where('type', 'category')
                    ->first();

                $data = [
                    'code'      => $code ?: url_title($name, '-', true),
                    'name'      => $name,
                    'is_active' => 1,
                    'type'      => 'category'
                ];

                if ($existing) {
                    $this->category->update($existing['id'], $data);
                } else {
                    $this->category->insert($data);
                }
            }

            return redirect()->to(base_url('dashboard/categories'))->with('success', 'Import berhasil!');
        }

        return redirect()->back()->with('error', 'File tidak valid.');
    }
}
