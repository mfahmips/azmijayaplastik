<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductPriceModel extends Model
{
    protected $table = 'product_prices';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'product_id',
        'unit',
        'min_qty',
        'price',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
