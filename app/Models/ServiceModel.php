<?php

namespace App\Models;

use App\Entities\Service;

class ServiceModel extends ApiModel
{

    protected $table            = 'services';
    protected $returnType       = Service::class;
    protected $allowedFields    = [
        'name',
        'price',
    ];
}
