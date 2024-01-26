<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class MaintenanceService extends Entity
{
    protected $datamap = [];
    protected $dates   = [];
    protected $casts   = [
        'id'             => '?integer',
        'service_id'     => '?integer',
        'maintenance_id' => '?integer',
    ];
}
