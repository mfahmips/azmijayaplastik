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
        $q       = trim($this->request->getGet('q') ?? '');
        $perPage = 10;

        $builder = $this->supplier;

        if ($q !== '') {
            $builder->like('name', $q)
                    ->orLike('code', $q)
                    ->orLike('contact_person', $q)
                    ->orLike('phone', $q)
                    ->orLike('email', $q);
        }

        $suppliers = $builder->orderBy('id', 'DESC')->paginate($perPage, 'sup');
        $pager     = $this->supplier->pager;

        $data = [
            'title'     => 'Data Supplier',
            'suppliers' => $suppliers,
            'pager'     => $pager,
            'q'         => $q,
            'per_page'  => $perPage
        ];

        return view('backend/master/suppliers/index', $data);
    }


    public function create()
    {
        return view('backend/master/suppliers/create');
    }

    public function store()
    {
        $post = $this->request->getPost();

        if (empty($post['code'])) {
            $post['code'] = $this->supplier->generateCode();
        }

        $this->supplier->save($post);

        return redirect()->to(base_url('dashboard/suppliers'))
                         ->with('success', 'Data berhasil ditambahkan.');
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
        return redirect()->to(base_url('dashboard/suppliers'))->with('success', 'Data berhasil diupdate.');
    }

    public function delete($id)
    {
        $this->supplier->delete($id);
        return redirect()->to(base_url('dashboard/suppliers'))->with('success', 'Data berhasil dihapus.');
    }

    public function export()
{
    $data = $this->supplier->findAll();
    $sheet = new Spreadsheet();
    $s = $sheet->getActiveSheet();

    // Header sesuai field tabel final
    $s->fromArray(
        ['Kode', 'Nama', 'Kontak', 'Telepon', 'Email', 'Alamat', 'Metode Pembayaran', 'Termin (hari)', 'Rekening', 'Status'],
        null,
        'A1'
    );

    $row = 2;
    foreach ($data as $d) {
        $s->fromArray([
            $d['code'],
            $d['name'],
            $d['contact_person'],
            $d['phone'],
            $d['email'],
            $d['address'],
            ucfirst($d['payment_method']),
            $d['default_terms'],
            $d['bank_account'],
            $d['is_active'] ? 'Aktif' : 'Nonaktif'
        ], null, 'A' . $row++);
    }

    // Auto size kolom
    foreach (range('A', 'J') as $col) {
        $s->getColumnDimension($col)->setAutoSize(true);
    }

    // 🔹 Nama file sesuai format AJP_Suppliers_ddmmyyyy.xlsx
    $today = date('dmY'); // contoh: 09092025
    $filename = "AJP_Suppliers_{$today}.xlsx";

    // Output file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment;filename=\"$filename\"");
    header('Cache-Control: max-age=0');
    (new Xlsx($sheet))->save('php://output');
    exit;
}


    public function import()
    {
        $file = $this->request->getFile('file_excel');
        if ($file && $file->isValid()) {
            $sheet = IOFactory::load($file->getTempName())->getActiveSheet()->toArray();

            // Mulai dari baris kedua (index 1) karena baris pertama header
            for ($i = 1; $i < count($sheet); $i++) {
                $row = $sheet[$i];
                $this->supplier->save([
                    'code'           => $row[0] ?? null,
                    'name'           => $row[1] ?? null,
                    'contact_person' => $row[2] ?? null,
                    'phone'          => $row[3] ?? null,
                    'email'          => $row[4] ?? null,
                    'address'        => $row[5] ?? null,
                    'payment_method' => strtolower($row[6] ?? 'cash'),
                    'default_terms'  => (int) ($row[7] ?? 0),
                    'bank_account'   => $row[8] ?? null,
                    'is_active'      => (strtolower($row[9] ?? 'aktif') === 'aktif') ? 1 : 0
                ]);
            }

            return redirect()->to(base_url('dashboard/suppliers'))->with('success', 'Import berhasil!');
        }

        return redirect()->back()->with('error', 'File tidak valid.');
    }
}
