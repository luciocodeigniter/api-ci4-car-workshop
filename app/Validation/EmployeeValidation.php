<?php

namespace App\Validation;

class EmployeeValidation
{

    /**
     * Rules validation for create and edit employees
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

            'skills' => [
                'label'  => 'Skills',
                'rules'  => "required|max_length[128]",
            ],
        ];
    }
}
