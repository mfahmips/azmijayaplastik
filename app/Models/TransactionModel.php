<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table      = 'transactions';
    protected $primaryKey = 'id';

    // Field yang boleh diisi (harus sama dengan nama kolom di DB)
    protected $allowedFields = [
        'date',
        'description',
        'amount',
        'type'
    ];

    // Aktifkan timestamp otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Tambahan rules (opsional)
    protected $validationRules = [
        'date'        => 'required|valid_date',
        'description' => 'required|string',
        'amount'      => 'required|decimal',
        'type'        => 'required|in_list[in,out]'
    ];
}
