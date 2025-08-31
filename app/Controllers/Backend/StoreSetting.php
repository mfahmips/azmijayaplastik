<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\StoreSettingModel;

class StoreSetting extends BaseController
{
    protected $settingModel;

    public function __construct()
    {
        $this->settingModel = new StoreSettingModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Pengaturan Toko',
            'breadcrumb'=> [
                ['label' => 'Dashboard', 'url' => base_url('dashboard')],
                ['label' => 'Pengaturan Toko']
            ],
            'setting'   => $this->settingModel->first()
        ];

        return view('backend/store_settings/index', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        $data = $this->request->getPost([
            'store_name', 'store_owner', 'store_address',
            'store_lat', 'store_lng', 'store_phone',
            'store_country', 'store_province', 'store_city',
            'store_business_type', 'store_stock_method', 'store_currency',
            'store_ppn', 'store_moto'
        ]);

        // Handle logo upload (untuk struk/invoice)
        $logo = $this->request->getFile('logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            $logoName = 'logo_' . time() . '.' . $logo->getExtension();
            $logo->move(FCPATH . 'uploads', $logoName);
            $data['store_logo'] = $logoName;
        }

        // Simpan
        if ($id) {
            $this->settingModel->update($id, $data);
        } else {
            $this->settingModel->insert($data);
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
