<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Employee extends Entity
{
    protected $datamap = [];
    protected $dates   = [];
    protected $casts   = [
        'id'          => '?integer',
    ];
}
