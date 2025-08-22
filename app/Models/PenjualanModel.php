<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table = 'transaksi_penjualan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tanggal', 'total', 'keterangan'];
}
