<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{
    protected $table            = 'units';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['name', 'short_name', 'created_at', 'updated_at'];
    protected $useTimestamps    = true;
}
