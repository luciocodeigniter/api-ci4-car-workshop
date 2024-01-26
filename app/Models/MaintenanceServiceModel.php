<?php

namespace App\Models;

use App\Entities\MaintenanceService;
use App\Entities\Service;

class MaintenanceServiceModel extends ApiModel
{

    protected $table            = 'maintenance_services';
    protected $returnType       = MaintenanceService::class;
    protected $allowedFields    = [
        'maintenance_id',
        'service_id',
        'quantity',
    ];


    /**
     * Retrieves the services associated with $maintenanceId, which can be a single identifier or array of identifiers
     *
     * @param integer|array $maintenanceId
     * @return array
     */
    public function getServices(int|array $maintenanceId): array
    {
        $builder = $this;
        $builder->join('services', 'services.id = maintenance_services.service_id');

        (is_array($maintenanceId)) ? $builder->whereIn('maintenance_services.maintenance_id', $maintenanceId) : $builder->where('maintenance_services.maintenance_id', $maintenanceId);

        $builder->groupBy('services.name');
        $builder->orderBy('name', 'ASC');
        return $builder->asObject(Service::class)->findAll();
    }
}
