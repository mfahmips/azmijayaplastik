<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Categories extends BaseController
{
    protected $category;

    public function __construct()
    {
        $this->category = new CategoryModel();
    }

    public function index()
    {
        $q        = trim($this->request->getGet('q') ?? '');
        $perPage  = 8;
        $builder  = $this->category->orderBy('id', 'ASC');

        if ($q !== '') {
            $builder = $builder->groupStart()
                ->like('name', $q)
                ->orLike('code', $q)
                ->orLike('description', $q)
            ->groupEnd();
        }

        $categories = $builder->paginate($perPage, 'cat');
        $pager      = $this->category->pager;
        $no         = 1 + ($pager->getCurrentPage('cat') - 1) * $perPage;

        if ($this->request->isAJAX()) {
            return view('backend/master/categories/index', [
                'categories' => $categories,
                'pager'      => $pager,
                'q'          => $q,
                'per_page'   => $perPage,
                'no'         => $no,
                'isAjax'     => true, // <- penting
            ]);
        }


        return view('backend/master/categories/index', [
            'categories' => $categories,
            'pager'      => $pager,
            'no'         => $no,
            'q'          => $q,
            'isAjax'     => false // full view
        ]);
    }



   public function create()
    {
        $data = $this->request->getPost([
            'name',
            'code',
            'description',
            'is_active'
        ]);

        if (empty($data)) {
            return redirect()->back()->with('error', 'Form kosong.');
        }

        $model = new \App\Models\CategoryModel();
        if ($model->insert($data)) {
            return redirect()->to('/dashboard/categories')->with('success', 'Kategori berhasil ditambahkan.');
        }

        return redirect()->back()->with('error', 'Gagal menyimpan data.');
    }


    public function store()
    {
        $data = $this->request->getPost();

        // Auto-generate kode jika tidak diisi
        if (empty($data['code']) && !empty($data['name'])) {
            $data['code'] = url_title($data['name'], '-', true);
        }

        // Pastikan field yang diizinkan
        $allowedFields = ['name', 'code', 'parent_id', 'description', 'is_active'];
        $insertData = array_intersect_key($data, array_flip($allowedFields));

        if (empty($insertData)) {
            return redirect()->back()->withInput()->with('error', 'Data tidak valid.');
        }

        $this->category->save($insertData);

        return redirect()->to(base_url('dashboard/categories'))->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'category' => $this->category->find($id)
        ];
        return view('backend/master/categories/edit', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();

        if (empty($data['code']) && !empty($data['name'])) {
            $data['code'] = url_title($data['name'], '-', true);
        }

        $allowedFields = ['name', 'code', 'parent_id', 'description', 'is_active'];
        $updateData = array_intersect_key($data, array_flip($allowedFields));

        if (empty($updateData)) {
            return redirect()->back()->withInput()->with('error', 'Tidak ada data untuk disimpan.');
        }

        $this->category->update($id, $updateData);

        return redirect()->to(base_url('dashboard/categories'))->with('success', 'Kategori berhasil diupdate.');
    }

    public function delete($id)
    {
        if (!$id || !$this->category->find($id)) {
            return redirect()->back()->with('error', 'Data tidak valid.');
        }

        $this->category->delete($id, true);
        return redirect()->to(base_url('dashboard/categories'))->with('success', 'Kategori berhasil dihapus.');
    }


    public function export()
    {
        $categories = $this->category->findAll();
        $sheet = new Spreadsheet();
        $s = $sheet->getActiveSheet();

        $s->fromArray(['Kode', 'Nama', 'Deskripsi'], null, 'A1');
        $row = 2;

        foreach ($categories as $c) {
            $s->fromArray([$c['code'], $c['name'], $c['description']], null, 'A' . $row++);
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"Categories_" . date('Ymd_His') . ".xlsx\"");
        header('Cache-Control: max-age=0');
        (new Xlsx($sheet))->save('php://output');
        exit;
    }

    public function import()
    {
        $file = $this->request->getFile('file_excel');
        if ($file && $file->isValid()) {
            $sheet = IOFactory::load($file->getTempName())->getActiveSheet()->toArray();

            for ($i = 1; $i < count($sheet); $i++) {
                $row = $sheet[$i];
                $this->category->save([
                    'code'        => $row[0],
                    'name'        => $row[1],
                    'description' => $row[2]
                ]);
            }

            return redirect()->to(base_url('dashboard/categories'))->with('success', 'Import berhasil!');
        }

        return redirect()->back()->with('error', 'File tidak valid.');
    }
}
