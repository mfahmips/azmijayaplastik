<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomersModel extends Model
{
    protected $table            = 'customers';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['name','email','phone','address','note','created_at','updated_at','deleted_at'];

    protected $validationRules = [
        'name'  => 'required|min_length[2]',
        'email' => 'permit_empty|valid_email',
        'phone' => 'permit_empty|min_length[5]',
    ];

    public function search(string $q, int $limit = 20): array
    {
        return $this->groupStart()
                        ->like('name', $q)
                        ->orLike('email', $q)
                        ->orLike('phone', $q)
                    ->groupEnd()
                    ->orderBy('name','ASC')
                    ->findAll($limit);
    }
}
