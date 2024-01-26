<?php

declare(strict_types=1);

namespace App\Libraries\Employee;

use App\Models\EmployeeModel;

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


        return $employees;
    }
}
