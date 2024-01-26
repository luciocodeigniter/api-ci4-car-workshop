<?php

declare(strict_types=1);

namespace App\Libraries\Car;

use App\Models\CarModel;
use App\Models\CustomerModel;
use App\Models\MaintenanceModel;

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
        $cars = model(CarModel::class)->paginate(perPage: $perPage, page: $page);

        // Verifica se não há carros
        if (empty($cars)) {
            return [];
        }


        $this->associateData(cars: $cars);

        return $cars;
    }


    /**
     * Associates the objects that are part of each car
     *
     * @param array $cars
     * @return void
     */
    private function associateData(array $cars): void
    {

        // Obtém os IDs dos carros
        $carsIds = array_column($cars, 'id');

        // Obtém os IDs do clientes
        $customersIds = array_column($cars, 'customer_id');

        // Busca todos os clientes associados aos carros em uma única consulta
        $customers = empty($customersIds) ? [] : model(CustomerModel::class)->whereIn('id', $customersIds)->findAll();

        // Busca todos as manutenções associadass aos carros em uma única consulta
        $maintenances = empty($carsIds) ? [] : model(MaintenanceModel::class)->whereIn('car_id', $carsIds)->findAll();


        // Cria um índice dos clientes usando seus IDs
        $indexedCustomers = [];
        foreach ($customers as $customer) {
            $indexedCustomers[$customer->id] = $customer;
        }

        // Associa cada carro ao seu cliente correspondente
        foreach ($cars as &$car) {

            $car->customer = $indexedCustomers[$car->customer_id] ?? null;

            // associamos as manutenções que cada carro possui
            $car->maintenances = array_filter($maintenances, function ($maintenance) use ($car) {
                return $car->id === $maintenance->car_id;
            });
        }
    }
}
