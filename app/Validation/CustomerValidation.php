<?php

namespace App\Validation;

class CustomerValidation
{

    /**
     * Rules validation for create and edit Customers
     *
     * @param integer|null $id
     * @return array
     */
    public function getRules(?int $id = null): array
    {

        return [

            'id' => [
                'label'  => 'Id',
                'rules'  => 'permit_empty|is_natural_no_zero',
            ],


            'name' => [
                'label'  => 'Name',
                'rules'  => "required|max_length[128]",
            ],

            'email' => [
                'label'  => 'E-mail',
                'rules'  => "required|valid_email|max_length[128]|is_unique[customers.email,id,{$id}]",
                'errors' => [
                    'is_unique'    => 'Already exists. Please choose another one.',
                ],
            ],

            'phone' => [
                'label'  => 'Phone',
                'rules'  => "required|is_unique[customers.phone,id,{$id}]",
                'errors' => [
                    'is_unique'    => 'Already exists. Please choose another one.',
                ],
            ],

        ];
    }
}
