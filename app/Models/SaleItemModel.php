<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleItemModel extends Model
{
    protected $table = 'sale_items';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'sale_id', 'product_id', 'price', 'qty', 'subtotal'
    ];
    protected $useTimestamps = false;
}
