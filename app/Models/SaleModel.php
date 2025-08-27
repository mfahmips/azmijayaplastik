<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'invoice', 'total_price', 'total_items', 'customer_id',
        'paid', 'change', 'created_at'
    ];
    protected $useTimestamps = false;
}
