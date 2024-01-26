<?php

namespace App\Validation;

class MaintenanceServiceValidation
{

    /**
     * Rules validation for create and edit Maintenance services
     *
     * @return array
     */
    public function getRules(): array
    {

        return [

            'id' => [
                'label'  => 'Id',
                'rules'  => 'permit_empty|is_natural_no_zero',
            ],

            'maintenance_id' => [
                'label'  => 'Naintenance',
                'rules'  => "required|is_not_unique[maintenance.id]",
                'errors' => [
                    'is_not_unique' => 'Invalid option.',
                ],
            ],

            'service_id' => [
                'label'  => 'Service',
                'rules'  => "required|is_not_unique[services.id]",
                'errors' => [
                    'is_not_unique' => 'Invalid option.',
                ],
            ],

            'quantity' => [
                'label'  => 'Quantity',
                'rules'  => "required|is_natural_no_zero",
            ],
        ];
    }
}
