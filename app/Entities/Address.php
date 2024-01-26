<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Address extends Entity
{
    protected $datamap = [];
    protected $dates   = [];
    protected $casts   = [
        'id'          => '?integer',
        'customer_id' => '?integer',
    ];
}
