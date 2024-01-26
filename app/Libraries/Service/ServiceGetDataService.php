<?php

declare(strict_types=1);

namespace App\Libraries\Service;

use App\Models\ServiceModel;

class ServiceGetDataService
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

        // Pagina os serviços
        $employees = model(ServiceModel::class)->orderBy('id', 'ASC')->groupBy('name')->paginate(perPage: $perPage, page: $page);

        // Verifica se não há serviços
        if (empty($employees)) {
            return [];
        }


        return $employees;
    }
}
