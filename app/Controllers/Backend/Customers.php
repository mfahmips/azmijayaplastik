<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Customers extends BaseController
{
    protected $customer;

    public function __construct()
    {
        $this->customer = new CustomerModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pelanggan',
            'customers' => $this->customer->findAll()
        ];
        return view('backend/master/customers/index', $data);
    }

    public function create()
    {
        return view('backend/master/customers/create');
    }

    public function store()
    {
        $this->customer->save($this->request->getPost());
        return redirect()->to(base_url('backend/customers'))->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'customer' => $this->customer->find($id)
        ];
        return view('backend/master/customers/edit', $data);
    }

    public function update($id)
    {
        $this->customer->update($id, $this->request->getPost());
        return redirect()->to(base_url('backend/customers'))->with('success', 'Data berhasil diupdate.');
    }

    public function delete($id)
    {
        $this->customer->delete($id);
        return redirect()->to(base_url('backend/customers'))->with('success', 'Data berhasil dihapus.');
    }

    public function export()
    {
        $customers = $this->customer->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'Kode');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Telepon');
        $sheet->setCellValue('D1', 'Email');
        $sheet->setCellValue('E1', 'Alamat');

        // Data
        $row = 2;
        foreach ($customers as $c) {
            $sheet->setCellValue('A' . $row, $c['code']);
            $sheet->setCellValue('B' . $row, $c['name']);
            $sheet->setCellValue('C' . $row, $c['phone']);
            $sheet->setCellValue('D' . $row, $c['email']);
            $sheet->setCellValue('E' . $row, $c['address']);
            $row++;
        }

        // Output
        $filename = 'DataPelanggan_' . date('Ymd_His') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function import()
    {
        $file = $this->request->getFile('file_excel');
        if ($file && $file->isValid()) {
            $spreadsheet = IOFactory::load($file->getTempName());
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            // Skip header (baris ke-0)
            for ($i = 1; $i < count($sheetData); $i++) {
                $row = $sheetData[$i];
                $this->customer->save([
                    'code'   => $row[0],
                    'name'   => $row[1],
                    'phone'  => $row[2],
                    'email'  => $row[3],
                    'address'=> $row[4]
                ]);
            }

            return redirect()->to(base_url('backend/customers'))->with('success', 'Import berhasil!');
        } else {
            return redirect()->back()->with('error', 'Gagal mengunggah file.');
        }
    }
}
