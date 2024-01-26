<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Customer extends Entity
{
    protected $datamap = [];
    protected $dates   = [];
    protected $casts   = [
        'id' => '?integer',
    ];
}
