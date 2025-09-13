<?php

namespace App\Models;

use CodeIgniter\Model;

class StockInModel extends Model
{
    protected $table      = 'stock_in';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'product_id',
        'supplier_id',
        'qty',
        'note',
        'cost_price',
        'created_at',
        'updated_at'
    ];

    // ✅ Aktifkan timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
