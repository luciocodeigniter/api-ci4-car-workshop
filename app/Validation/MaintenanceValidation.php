<?php

namespace App\Validation;

class MaintenanceValidation
{

    /**
     * Rules validation for create and edit Maintenance
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

            'customer_id' => [
                'label'  => 'Customer',
                'rules'  => "required|is_not_unique[customers.id]",
                'errors' => [
                    'is_not_unique' => 'Invalid option.',
                ],
            ],

            'car_id' => [
                'label'  => 'Car',
                'rules'  => "required|is_not_unique[cars.id]",
                'errors' => [
                    'is_not_unique' => 'Invalid option.',
                ],
            ],

            'employee_id' => [
                'label'  => 'Employee',
                'rules'  => "required|is_not_unique[employees.id]",
                'errors' => [
                    'is_not_unique' => 'Invalid option.',
                ],
            ],

            'check_in' => [
                'label'  => 'CheckIn',
                'rules'  => "required|valid_date[Y-m-d H:i:s]",
                'errors' => [
                    'valid_date' => 'Expected format: Y-m-d H:i:s',
                ],
            ],

            'check_out' => [
                'label'  => 'CheckOut',
                'rules'  => "required|valid_date[Y-m-d H:i:s]",
                'errors' => [
                    'valid_date' => 'Expected format: Y-m-d H:i:s',
                ],
            ],
        ];
    }
}
