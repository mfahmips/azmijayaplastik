<?php

namespace App\Models;

use CodeIgniter\Model;

class StockOpnameModel extends Model
{
    protected $table            = 'stock_opnames';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'product_id',
        'stock_system',
        'stock_real',
        'difference',
        'note',
        'created_at'
    ];

    protected $useTimestamps = false;
}
