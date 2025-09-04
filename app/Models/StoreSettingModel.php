<?php

namespace App\Models;

use CodeIgniter\Model;

class StoreSettingModel extends Model
{
    protected $table      = 'store_settings';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'store_name', 'store_owner', 'store_category', 'store_address',
        'store_logo', 'store_description', 'store_phone',
        'store_facebook', 'store_instagram', 'store_tiktok', 'store_website'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
