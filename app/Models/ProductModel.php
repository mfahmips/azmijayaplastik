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

    public function getProductsWithWholesale($limit = 10, $offset = 0, $filters = [])
{
    $builder = $this->db->table('products p');
    $builder->select('p.*, c.name as category_name');
    $builder->join('categories c', 'c.id = p.category_id', 'left');

    // join grosir (ambil semua harga)
    $builder->select("(SELECT GROUP_CONCAT(CONCAT(unit, ' min ', min_qty, ': Rp ', FORMAT(price,0)) SEPARATOR '<br>') 
                      FROM product_prices pp WHERE pp.product_id = p.id) as wholesale_prices");

    if (!empty($filters['q'])) {
        $builder->like('p.name', $filters['q']);
    }

    if (!empty($filters['category_id'])) {
        $builder->where('p.category_id', $filters['category_id']);
    }

    $builder->limit($limit, $offset);

    return $builder->get()->getResultArray();
}


}
