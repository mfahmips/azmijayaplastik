<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriesModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;
    protected $returnType       = 'array';

    protected $allowedFields    = [
        'parent_id',
        'name',
        'slug',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $validationRules = [
        'name' => 'required|min_length[2]',
        'slug' => 'required|min_length[2]|is_unique[categories.slug,id,{id}]',
    ];

    // ========== Helper Methods ==========

    /**
     * Ambil semua kategori root (tanpa parent).
     */
    public function getRoots(): array
    {
        return $this->where('parent_id', null)
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }

    /**
     * Ambil anak kategori dari parent tertentu.
     */
    public function getChildren(int $parentId): array
    {
        return $this->where('parent_id', $parentId)
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }

    /**
     * Cari kategori berdasarkan slug.
     */
    public function findBySlug(string $slug): ?array
    {
        return $this->where('slug', $slug)->first();
    }

    /**
     * Ambil struktur tree kategori (root + children satu level).
     * Cocok untuk sidebar atau dropdown.
     */
    public function getTree(): array
    {
        $roots = $this->getRoots();

        foreach ($roots as &$root) {
            $root['children'] = $this->getChildren((int) $root['id']);
        }

        return $roots;
    }

    /**
     * Buat breadcrumb berdasarkan category ID.
     * Mengembalikan urutan dari root → child.
     */
    public function breadcrumbs(int $categoryId): array
    {
        $trail = [];
        $current = $this->find($categoryId);

        while ($current) {
            array_unshift($trail, $current);
            $current = $current['parent_id']
                ? $this->find((int) $current['parent_id'])
                : null;
        }

        return $trail;
    }
}
