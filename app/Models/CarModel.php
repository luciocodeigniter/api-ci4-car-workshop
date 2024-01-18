<?php

namespace App\Models;

use App\Entities\Car;
use CodeIgniter\Model;

class CarModel extends Model
{
    protected $table            = 'cars';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Car::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'customer_id',
        'brand',
        'model',
        'color',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
