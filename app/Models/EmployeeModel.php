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


    public function find($id = null): Employee|null
    {

        $employee = parent::find($id);

        if ($employee !== null) {

            $employee->maintenance = model(MaintenanceModel::class)->where('employee_id', $employee->id)->findAll();
        }

        return $employee;
    }
}
