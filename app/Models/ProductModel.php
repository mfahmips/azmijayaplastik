<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';

    protected $allowedFields = [
        'sku',
        'name',
        'brand',
        'barcode',
        'cost_price',
        'sell_price',
        'stock',
        'min_stock',
        'unit',
        'category_id',
        'supplier_id',
        'is_active',
        'description',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Join dengan tabel kategori (alias c) dan supplier (alias s)
     */
    public function getJoined()
    {
        return $this->select('products.*, c.name AS category_name, c.code AS category_code, s.name AS supplier_name')
                    ->join('categories c', 'c.id = products.category_id', 'left')
                    ->join('suppliers s', 's.id = products.supplier_id', 'left');
    }

    public function getLowStockCount($limit = 5)
    {
        return $this->where('stock <=', $limit)->countAllResults();
    }

    public function getBySku($sku)
    {
        return $this->where('sku', $sku)->first();
    }

    public function getPrices($productId)
    {
        return model('ProductPriceModel')
            ->where('product_id', $productId)
            ->orderBy('min_qty', 'ASC')
            ->findAll();
    }
}
