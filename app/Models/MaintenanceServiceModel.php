<?php

namespace App\Models;

use App\Entities\Maintenance;
use App\Entities\MaintenanceService;

class MaintenanceServiceModel extends ApiModel
{

    protected $table            = 'maintenance_services';
    protected $returnType       = MaintenanceService::class;
    protected $allowedFields    = [
        'service_id',
        'quantity',
    ];
}
