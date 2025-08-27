<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\SupplierModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Suppliers extends BaseController
{
    protected $supplier;

    public function __construct()
    {
        $this->supplier = new SupplierModel();
    }

    public function index()
    {
        $data = [
            'suppliers' => $this->supplier->findAll(),
            'title'     => 'Data Supplier'
        ];
        return view('backend/master/suppliers/index', $data);
    }

    public function create()
    {
        return view('backend/master/suppliers/create');
    }

    public function store()
    {
        $this->supplier->save($this->request->getPost());
        return redirect()->to(base_url('backend/suppliers'))->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'supplier' => $this->supplier->find($id)
        ];
        return view('backend/master/suppliers/edit', $data);
    }

    public function update($id)
    {
        $this->supplier->update($id, $this->request->getPost());
        return redirect()->to(base_url('backend/suppliers'))->with('success', 'Data berhasil diupdate.');
    }

    public function delete($id)
    {
        $this->supplier->delete($id);
        return redirect()->to(base_url('backend/suppliers'))->with('success', 'Data berhasil dihapus.');
    }

    public function export()
    {
        $data = $this->supplier->findAll();
        $sheet = new Spreadsheet();
        $s = $sheet->getActiveSheet();

        $s->fromArray(['Kode', 'Nama', 'Kontak', 'Telepon', 'Email', 'Alamat'], null, 'A1');

        $row = 2;
        foreach ($data as $d) {
            $s->fromArray([
                $d['code'], $d['name'], $d['contact_person'],
                $d['phone'], $d['email'], $d['address']
            ], null, 'A' . $row++);
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"Suppliers_" . date('Ymd_His') . ".xlsx\"");
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
                $this->supplier->save([
                    'code'           => $row[0],
                    'name'           => $row[1],
                    'contact_person' => $row[2],
                    'phone'          => $row[3],
                    'email'          => $row[4],
                    'address'        => $row[5]
                ]);
            }

            return redirect()->to(base_url('backend/suppliers'))->with('success', 'Import berhasil!');
        }

        return redirect()->back()->with('error', 'File tidak valid.');
    }
}
