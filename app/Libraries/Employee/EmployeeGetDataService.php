<?php

declare(strict_types=1);

namespace App\Libraries\Employee;

use App\Models\EmployeeModel;
use App\Models\MaintenanceModel;

class EmployeeGetDataService
{

    /**
     * Retrieves paginated records
     *
     * @param integer|null $perPage
     * @param integer|null $page
     * @return array
     */
    public function paginate(?int $perPage = null, ?int $page = null): array
    {

        // Pagina os funcionários
        $employees = model(EmployeeModel::class)->orderBy('id', 'ASC')->groupBy('name')->paginate(perPage: $perPage, page: $page);

        // Verifica se não há funcionários
        if (empty($employees)) {
            return [];
        }

        $this->associateData(employees: $employees);


        return $employees;
    }


    /**
     * Associates the objects that are part of each employee
     *
     * @param array $employees
     * @return void
     */
    private function associateData(array $employees): void
    {
        // Obtém os IDs do funcionarios
        $employeesIds = array_column($employees, 'id');

        // Busca todos as manutenções associadass aos funcionários em uma única consulta
        $maintenances = empty($employeesIds) ? [] : model(MaintenanceModel::class)->whereIn('employee_id', $employeesIds)->findAll();


        foreach ($employees as $employee) {
            // associamos as manutenções que cada funcionário possui
            $employee->maintenances = array_filter($maintenances, function ($maintenance) use ($employee) {
                return $employee->id === $maintenance->employee_id;
            });
        }
    }
}
