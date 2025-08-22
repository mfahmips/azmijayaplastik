<?php
namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\CustomersModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Customers extends BaseController
{
    protected CustomersModel $customer;
    public function __construct()
    {
        $this->customer = new CustomersModel();
    }

    public function index()
    {
        $q = $this->request->getGet('q');
        $builder = $this->customer->orderBy('name', 'ASC');

        if ($q) {
            $builder->groupStart()
                ->like('name', $q)
                ->orLike('email', $q)
                ->orLike('phone', $q)
                ->groupEnd();
        }

        // Gunakan paginate agar $pager tersedia
        $rows = $builder->paginate(10);
        $pager = $this->customer->pager;

        return view('backend/master/customers/index', compact('rows', 'pager', 'q'));
    }

    public function form($id = null)
    {
        $row = $id ? $this->customer->find($id) : null;
        return view('backend/master/customers/form', compact('row'));
    }

    public function save($id = null)
    {
        $data = [
            'name'    => trim($this->request->getPost('name')),
            'email'   => $this->request->getPost('email') ?: null,
            'phone'   => $this->request->getPost('phone') ?: null,
            'address' => $this->request->getPost('address') ?: null,
            'note'    => $this->request->getPost('note') ?: null,
        ];

        if ($id) {
            $this->customer->update($id, $data);
        } else {
            $this->customer->insert($data);
        }

        return redirect()->to('/backend/customers')->with('msg', 'Pelanggan tersimpan');
    }

    public function delete($id)
    {
        $this->customer->delete($id, true);
        return redirect()->back()->with('msg', 'Pelanggan dihapus');
    }

    public function export($format = 'xlsx')
    {
        $rows = $this->customer->orderBy('name', 'ASC')->findAll();
        $s = new Spreadsheet();
        $ws = $s->getActiveSheet();

        $ws->fromArray(['id', 'name', 'email', 'phone', 'address', 'note', 'created_at', 'updated_at'], null, 'A1');

        $r = 2;
        foreach ($rows as $x) {
            $ws->fromArray([
                $x['id'],
                $x['name'],
                $x['email'],
                $x['phone'],
                $x['address'],
                $x['note'],
                $x['created_at'] ?? '',
                $x['updated_at'] ?? ''
            ], null, "A{$r}");
            $r++;
        }

        return $this->download($s, 'customers_' . date('Ymd_His'), $format);
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

        $rows = $reader->load($file->getTempName())->getActiveSheet()->toArray(null, true, true, true);

        $imported = 0;
        $updated = 0;

        foreach ($rows as $i => $c) {
            if ($i === 1) continue; // Skip header
            $name = trim((string)($c['B'] ?? ''));
            if ($name === '') continue;

            $data = [
                'name'    => $name,
                'email'   => trim((string)($c['C'] ?? '')) ?: null,
                'phone'   => trim((string)($c['D'] ?? '')) ?: null,
                'address' => trim((string)($c['E'] ?? '')) ?: null,
                'note'    => trim((string)($c['F'] ?? '')) ?: null
            ];

            $id = (int)($c['A'] ?? 0);
            if ($id && $this->customer->find($id)) {
                $this->customer->update($id, $data);
                $updated++;
            } else {
                $this->customer->insert($data);
                $imported++;
            }
        }

        return redirect()->back()->with('msg', "Import selesai. Tambah: {$imported}, Update: {$updated}");
    }

    private function download(Spreadsheet $s, string $name, string $format)
    {
        $format = strtolower($format);

        if ($format === 'csv') {
            $writer = new Csv($s);
            $mime = 'text/csv';
            $ext = 'csv';
        } else {
            $writer = new Xlsx($s);
            $mime = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            $ext = 'xlsx';
        }

        $tmp = tempnam(sys_get_temp_dir(), 'exp_');
        $writer->save($tmp);

        return $this->response->download("{$name}.{$ext}", file_get_contents($tmp), true)->setContentType($mime);
    }
}
