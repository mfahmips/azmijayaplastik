<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('backend/index', [
            'title' => 'Dashboard - Azmi Jaya Plastik',
        ]);
    }
}
