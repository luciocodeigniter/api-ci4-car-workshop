<?php

namespace App\Models;

use App\Entities\Employee;

class EmployeeModel extends ApiModel
{

    protected $table            = 'employees';
    protected $returnType       = Employee::class;
    protected $allowedFields    = [
        'name',
        'skills',
    ];
}
