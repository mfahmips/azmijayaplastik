<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'sku', 'name', 'barcode', 'cost_price', 'sell_price', 'stock',
        'unit', 'category_id', 'is_active', 'created_at', 'updated_at'
    ];

    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function getJoined()
{
    return $this->select('products.*, categories.name AS category_name, suppliers.name AS supplier_name')
                ->join('categories', 'categories.id = products.category_id', 'left')
                ->join('suppliers', 'suppliers.id = products.supplier_id', 'left');
}

}
