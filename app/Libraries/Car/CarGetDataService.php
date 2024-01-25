<?php

declare(strict_types=1);

namespace App\Libraries\Car;

use App\Models\CarModel;
use App\Models\CustomerModel;

class CarGetDataService
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

        // Pagina os carros
        $cars = model(CarModel::class)->asArray()->paginate(perPage: $perPage, page: $page);

        // Verifica se não há carros
        if (empty($cars)) {
            return [];
        }

        // Obtém os IDs dos clientes
        $customersIds = array_column($cars, 'customer_id');

        // Busca todos os clientes associados aos carros em uma única consulta
        $customers = empty($customersIds) ? [] : model(CustomerModel::class)->whereIn('id', $customersIds)->findAll();


        // Cria um índice dos clientes usando seus IDs
        $indexedCustomers = [];
        foreach ($customers as $customer) {
            $indexedCustomers[$customer['id']] = $customer;
        }

        // Associa cada carro ao seu cliente correspondente
        foreach ($cars as &$car) {
            $car['customer'] = $indexedCustomers[$car['customer_id']] ?? null;
        }


        return $cars;
    }
}
