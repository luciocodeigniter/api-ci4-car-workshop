<?php

declare(strict_types=1);

namespace App\Libraries\Customer;

use App\Models\CarModel;
use App\Models\CustomerModel;

class CustomerGetDataService
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

        // Pagina os clientes
        $customers = model(CustomerModel::class)->asArray()->groupBy('name')->paginate(perPage: $perPage, page: $page);

        // Verifica se não há clientes
        if (empty($customers)) {
            return [];
        }

        // Obtém os IDs dos clientes
        $customerIds = array_column($customers, 'id');

        // Busca todos os carros associados aos clientes em uma única consulta
        $cars = model(CarModel::class)->whereIn('customer_id', $customerIds)->asArray()->paginate(perPage: $perPage, page: $page);

        foreach ($customers as &$customer) {
            $customer['cars'] = array_filter($cars, function($car) use ($customer) {

                // note que quando usamos o seeder, por temos o randomização dos IDS do customers existentes, 
                // alguns customers podem ficar sem carro.
                // isso não ocorre quando o carro é criado pela API
                return $car['customer_id'] === $customer['id'];
            });
        }

        return $customers;
    }
}
