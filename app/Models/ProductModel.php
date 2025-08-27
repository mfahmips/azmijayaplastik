<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields = [
        'sku', 'name', 'category_id', 'supplier_id', 'barcode',
        'unit', 'cost_price', 'sell_price', 'stock', 'min_stock',
        'description', 'is_active'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function getJoined()
    {
        return $this->select('products.*, categories.name AS category_name')
                    ->join('categories', 'categories.id = products.category_id', 'left')
                    ->orderBy('products.id', 'DESC');
    }


}



