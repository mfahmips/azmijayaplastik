<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class ProductsModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'category_id','supplier_id','name','slug','sku','barcode','unit',
        'stock','min_stock','purchase_price','sell_price','price_tier',
        'image','is_active','description','created_at','updated_at','deleted_at'
    ];

    protected $validationRules = [
        'name'        => 'required|min_length[2]',
        'slug'        => 'required|min_length[2]|is_unique[products.slug,id,{id}]',
        'category_id' => 'required|is_natural_no_zero',
        'sell_price'  => 'permit_empty|is_natural',
        'purchase_price' => 'permit_empty|is_natural',
        'stock'       => 'permit_empty|integer',
    ];

    // ===== Tambahan properti dan method untuk dukung pagination dengan custom builder =====
    protected $customBuilder;

    public function setBuilder(BaseBuilder $builder)
    {
        $this->customBuilder = $builder;
        return $this;
    }

    public function builder(?string $table = null): BaseBuilder
    {
        return $this->customBuilder ?? parent::builder($table);
    }


    // ---------- Scopes / Query helpers ----------

    public function scopeActive(): BaseBuilder
    {
        return $this->builder()->where('is_active', 1);
    }

    public function findBySlug(string $slug): ?array
    {
        return $this->where('slug', $slug)->first();
    }

    public function byCategory(int $categoryId, bool $onlyActive = true): array
    {
        $b = $this->builder()->where('category_id', $categoryId);
        if ($onlyActive) $b->where('is_active', 1);
        return $b->orderBy('name','ASC')->get()->getResultArray();
    }

    /**
     * Ambil produk (dengan join nama kategori & supplier) – cocok untuk tabel admin.
     */
    public function withRelations(bool $onlyActive = false): BaseBuilder
    {
        $b = $this->builder()
            ->select('products.*, categories.name AS category_name, categories.slug AS category_slug, suppliers.name AS supplier_name')
            ->join('categories', 'categories.id = products.category_id')
            ->join('suppliers', 'suppliers.id = products.supplier_id', 'left');

        if ($onlyActive) {
            $b->where('products.is_active', 1);
        }

        return $b;
    }

    public function search(string $q, bool $onlyActive = true, int $limit = 30): array
    {
        $b = $this->withRelations($onlyActive);
        $b->groupStart()
            ->like('products.name', $q)
            ->orLike('products.sku', $q)
            ->orLike('products.barcode', $q)
            ->orLike('categories.name', $q)
          ->groupEnd()
          ->orderBy('products.name', 'ASC')
          ->limit($limit);

        return $b->get()->getResultArray();
    }

    // ---------- Stock helpers ----------

    public function increaseStock(int $id, int $qty): bool
    {
        return $this->set('stock', 'stock + ' . (int)$qty, false)
                    ->where('id', $id)
                    ->update();
    }

    public function decreaseStock(int $id, int $qty): bool
    {
        // pastikan tidak minus
        $product = $this->select('id, stock')->find($id);
        if (!$product) return false;
        $new = max(0, (int)$product['stock'] - (int)$qty);

        return $this->update($id, ['stock' => $new]);
    }
}
