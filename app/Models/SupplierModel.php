<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table            = 'suppliers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'code',
        'name',
        'contact_person',
        'phone',
        'email',
        'address',
        'payment_method',
        'default_terms',
        'bank_account',
        'is_active'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Generate kode supplier otomatis
     * Format: AJP-SUP-0001
     */
    public function generateCode()
    {
        $last = $this->orderBy('id', 'DESC')->first();

        if ($last && isset($last['code'])) {
            // Ambil angka dari code terakhir
            $lastNumber = (int) preg_replace('/[^0-9]/', '', $last['code']);
            $newNumber  = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return 'AJP-SUP-' . $newNumber;
    }
}
