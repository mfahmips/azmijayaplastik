<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;

class Kasir extends BaseController
{
    public function index()
    {
        // contoh data awal untuk tampilan
        $data = [
            'title' => 'Kasir (Point Of Sale)',
            'cart'  => [],   // nanti ganti dari session
            'items' => [],   // nanti ganti dari database (produk)
        ];
        return view('backend/kasir/index', $data);
    }
}
