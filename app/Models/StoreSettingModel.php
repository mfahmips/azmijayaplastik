<?php

namespace App\Models;

use CodeIgniter\Model;

class StoreSettingModel extends Model
{
    protected $table            = 'store_settings';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'store_name', 'store_owner', 'store_address',
        'store_lat', 'store_lng', 'store_phone',
        'store_country', 'store_province', 'store_city',
        'store_business_type', 'store_stock_method', 'store_currency',
        'store_ppn', 'store_moto'
    ];

    protected $useTimestamps = true;
}
