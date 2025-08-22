<?php
namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\CategoriesModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class Categories extends BaseController
{
    protected CategoriesModel $category;

    public function __construct()
    {
        $this->category = new CategoriesModel();
    }

    public function index()
    {
        helper('pagination');

        $q       = trim((string) $this->request->getGet('q'));
        $perPage = (int) ($this->request->getGet('per_page') ?: 15);
        $group   = 'categories';

        $model = $this->category->orderBy('parent_id ASC, name ASC');

        if ($q !== '') {
            $model->groupStart()
                  ->like('name', $q)
                  ->orLike('slug', $q)
                  ->groupEnd();
        }

        $rows  = $model->paginate($perPage, $group);
        $pager = $model->pager;

        $parents = (new CategoriesModel())
                        ->where('parent_id', null)
                        ->orderBy('name')
                        ->findAll();

        return view('backend/master/categories/index', [
            'title'   => 'Kategori',
            'q'       => $q,
            'rows'    => $rows,
            'pager'   => $pager,
            'parents' => $parents,
            'group'   => $group,
        ]);
    }

    public function save($id = null)
    {
        $data = [
            'parent_id'   => $this->request->getPost('parent_id') ?: null,
            'name'        => trim($this->request->getPost('name')),
            'slug'        => trim($this->request->getPost('slug')) ?: url_title($this->request->getPost('name'), '-', true),
            'description' => $this->request->getPost('description') ?: null,
        ];

        if ($id) {
            $this->category->update($id, $data);
        } else {
            $this->category->insert($data);
        }

        return redirect()->to('/dashboard/categories')->with('msg', 'Kategori tersimpan');
    }

    public function delete($id)
    {
        $mCat  = $this->category;
        $mProd = new \App\Models\ProductsModel();

        $childCount = $mCat->where('parent_id', $id)->countAllResults();
        $prodCount  = $mProd->where('category_id', $id)->countAllResults();

        if ($childCount > 0 || $prodCount > 0) {
            return redirect()->back()->with('errors', [
                'delete' => "Kategori tidak bisa dihapus. Ada {$childCount} subkategori dan {$prodCount} produk yang masih terkait."
            ]);
        }

        try {
            $mCat->delete($id, true);
            return redirect()->back()->with('msg', 'Kategori dihapus');
        } catch (\Throwable $e) {
            return redirect()->back()->with('errors', ['delete' => 'Gagal hapus kategori: '.$e->getMessage()]);
        }
    }

    public function export($format = 'xlsx')
    {
        $rows = $this->category->orderBy('parent_id ASC, name ASC')->findAll();
        $s  = new Spreadsheet();
        $ws = $s->getActiveSheet();
        $ws->fromArray(['id','parent_id','name','slug','description','created_at','updated_at'], null, 'A1');
        $r = 2;
        foreach ($rows as $x) {
            $ws->fromArray([
                $x['id'], $x['parent_id'], $x['name'], $x['slug'],
                $x['description'], $x['created_at'] ?? '', $x['updated_at'] ?? ''
            ], null, "A{$r}");
            $r++;
        }
        return $this->download($s, 'categories_'.date('Ymd_His'), $format);
    }

    public function import()
    {
        $file = $this->request->getFile('file');
        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('errors', ['file' => 'File tidak valid']);
        }

        $ext    = strtolower($file->getExtension());
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($ext === 'csv' ? 'Csv' : 'Xlsx');
        if ($reader instanceof \PhpOffice\PhpSpreadsheet\Reader\Csv) {
            $reader->setDelimiter(',')->setEnclosure('"')->setSheetIndex(0);
        }

        $ws   = $reader->load($file->getTempName())->getActiveSheet();
        $rows = $ws->toArray(null, true, true, true);

        $db = \Config\Database::connect();
        $db->transStart();
        $db->query('SET FOREIGN_KEY_CHECKS=0');

        $model = new CategoriesModel();
        $model->protect(false);

        $data = [];
        foreach ($rows as $i => $c) {
            if ($i === 1) continue;
            $name = trim((string)($c['C'] ?? ''));
            if ($name === '') continue;

            $data[] = [
                'id'          => ($c['A'] === '' ? null : (int)$c['A']),
                'parent_id'   => ($c['B'] === '' ? null : (int)$c['B']),
                'name'        => $name,
                'slug'        => trim((string)($c['D'] ?? '')) ?: url_title($name, '-', true),
                'description' => trim((string)($c['E'] ?? '')) ?: null,
            ];
        }

        $roots    = array_filter($data, fn($r) => empty($r['parent_id']));
        $children = array_filter($data, fn($r) => !empty($r['parent_id']));
        $existingIds = array_column($model->select('id')->findAll(), 'id');
        $insertedIds = [];

        foreach ($roots as $r) {
            if (!empty($r['id']) && $model->find($r['id'])) {
                $model->update($r['id'], $r);
                $insertedIds[$r['id']] = true;
            } else {
                $newId = $model->insert($r, true);
                $insertedIds[$newId] = true;
            }
        }

        $pending = array_values($children);
        $guard = 0;

        while (!empty($pending) && $guard < 10) {
            $next = [];
            foreach ($pending as $r) {
                $pid = (int)$r['parent_id'];
                if ($pid && (in_array($pid, $existingIds, true) || isset($insertedIds[$pid]))) {
                    if (!empty($r['id']) && $model->find($r['id'])) {
                        $model->update($r['id'], $r);
                        $insertedIds[$r['id']] = true;
                    } else {
                        $newId = $model->insert($r, true);
                        $insertedIds[$newId] = true;
                    }
                } else {
                    $next[] = $r;
                }
            }
            if (count($next) === count($pending)) {
                foreach ($next as &$r) { $r['parent_id'] = null; }
            }
            $pending = $next;
            $guard++;
        }

        $db->query('SET FOREIGN_KEY_CHECKS=1');
        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('errors', ['import' => 'Import gagal: '.$db->error()['message'] ?? 'unknown']);
        }

        return redirect()->back()->with('msg', 'Import kategori selesai.');
    }

    private function download(Spreadsheet $s, string $name, string $format)
    {
        $format = strtolower($format);
        if ($format === 'csv') {
            $writer = new Csv($s);
            $mime   = 'text/csv';
            $ext    = 'csv';
        } else {
            $writer = new Xlsx($s);
            $mime   = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            $ext    = 'xlsx';
        }

        $tmp = tempnam(sys_get_temp_dir(), 'exp_');
        $writer->save($tmp);

        return $this->response->download("{$name}.{$ext}", file_get_contents($tmp), true)->setContentType($mime);
    }
}
