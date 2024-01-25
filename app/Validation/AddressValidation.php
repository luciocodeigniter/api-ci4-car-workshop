<?php

namespace App\Validation;

class AddressValidation
{

    /**
     * Rules validation for create and edit address
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


            'country' => [
                'label'  => 'Country',
                'rules'  => "required|max_length[128]",
            ],

            'state' => [
                'label'  => 'State',
                'rules'  => "required|max_length[128]",
            ],

            'city' => [
                'label'  => 'City',
                'rules'  => "required|max_length[128]",
            ],

            'neighborhood' => [
                'label'  => 'Neighborhood',
                'rules'  => "required|max_length[128]",
            ],

            'street' => [
                'label'  => 'Street',
                'rules'  => "required|max_length[128]",
            ],

        ];
    }
}
