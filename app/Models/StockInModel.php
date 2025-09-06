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
        'cost_price',   // ✅ tambahkan harga beli
        'note',
        'created_at'
    ];
    protected $useTimestamps = false;
}
