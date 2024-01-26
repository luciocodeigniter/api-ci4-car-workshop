<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Car extends Entity
{
    protected $datamap = [];
    protected $dates   = [];
    protected $casts   = [
        'id'          => '?integer',
        'customer_id' => '?integer',
    ];
}
