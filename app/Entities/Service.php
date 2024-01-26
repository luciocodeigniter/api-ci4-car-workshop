<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Service extends Entity
{
    protected $datamap = [];
    protected $dates   = [];
    protected $casts   = [
        'id'          => '?integer',
    ];
}
