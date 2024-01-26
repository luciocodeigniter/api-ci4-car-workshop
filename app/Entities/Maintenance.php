<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Maintenance extends Entity
{
    protected $datamap = [];
    protected $dates   = [];
    protected $casts   = [
        'id'             => '?integer',
        'car_id'         => '?integer',
        'employee_id'    => '?integer',
        'maintenance_id' => '?integer',
    ];
}
