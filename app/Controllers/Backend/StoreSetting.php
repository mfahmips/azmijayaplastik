<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\StoreSettingModel;

class StoreSetting extends BaseController
{
    protected $storeModel;

    public function __construct()
    {
        $this->storeModel = new StoreSettingModel();
    }

    public function index()
    {
        $store = $this->storeModel->first();

        // Jika belum ada data, insert default agar form tetap bisa jalan
        if (!$store) {
            $this->storeModel->insert(['store_name' => '']);
            $store = $this->storeModel->first();
        }

        return view('backend/store_settings/index', compact('store'));
    }


    public function update()
{
    $id = $this->request->getPost('id');

    // Validasi ID
    $existing = $this->storeModel->find($id);
    if (!$id || !$existing) {
        return redirect()->back()->with('error', 'ID tidak valid atau tidak ditemukan.');
    }

    // Ambil semua field post
    $data = $this->request->getPost([
        'store_name', 'store_owner', 'store_category', 'store_address',
        'store_description', 'store_phone', 'store_facebook',
        'store_instagram', 'store_tiktok', 'store_website'
    ]);

    // Upload logo jika ada
    $logo = $this->request->getFile('store_logo');
    if ($logo && $logo->isValid() && !$logo->hasMoved()) {
        // Hapus logo lama (jika ada dan file-nya memang ada)
        if (!empty($existing['store_logo']) && file_exists(FCPATH . $existing['store_logo'])) {
            unlink(FCPATH . $existing['store_logo']);
        }

        // Upload logo baru
        $newName = $logo->getRandomName();
        $logo->move('uploads/website/logo', $newName);
        $data['store_logo'] = 'uploads/website/logo/' . $newName;
    }

    // Simpan ke DB
    if ($this->storeModel->update($id, $data)) {
        return redirect()->to('dashboard/store-setting')->with('success', 'Pengaturan berhasil diperbarui.');
    } else {
        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan ke database.');
    }
}



}
