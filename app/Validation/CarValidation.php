<?php

namespace App\Validation;

class CarValidation
{

    /**
     * Rules validation for create and edit cars
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
                'label'  => 'customer_id',
                'rules'  => "required|is_not_unique[customers.id]",
                'errors' => [
                    'is_not_unique' => 'Invalid option.',
                ],
            ],


            'brand' => [
                'label'  => 'Brand',
                'rules'  => "required|max_length[128]",
            ],

            'model' => [
                'label'  => 'Model',
                'rules'  => "required|max_length[128]",
            ],

            'color' => [
                'label'  => 'Color',
                'rules'  => "required|max_length[128]",
            ],

        ];
    }
}
