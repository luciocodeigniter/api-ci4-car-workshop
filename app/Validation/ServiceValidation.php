<?php

namespace App\Validation;

class ServiceValidation
{

    /**
     * Rules validation for create and edit services
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


            'name' => [
                'label'  => 'Name',
                'rules'  => "required|max_length[128]",
            ],

            'price' => [
                'label'  => 'Skills',
                'rules'  => "required",
            ],
        ];
    }
}
