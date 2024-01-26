<?php

declare(strict_types=1);

namespace App\Libraries\Maintenance;

use App\Models\CarModel;
use App\Models\CustomerModel;
use App\Models\EmployeeModel;
use App\Models\MaintenanceModel;
use App\Models\MaintenanceServiceModel;

class MaintenanceGetDataService
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

        // Pagina os manutenções
        $maintenances = model(MaintenanceModel::class)->orderBy('id', 'ASC')->paginate(perPage: $perPage, page: $page);

        // Verifica se não há manutenções
        if (empty($maintenances)) {
            return [];
        }


        $this->associateData(maintenances: $maintenances);


        return $maintenances;
    }


    /**
     * Associates the objects that are part of each maintenance
     *
     * @param array $maintenances
     * @return void
     */
    private function associateData(array $maintenances): void
    {

        // Obtém os IDs das manutenções
        $maintenancesIds = array_column($maintenances, 'id');

        // Obtém os IDs dos carros
        $carsIds = array_column($maintenances, 'car_id');

        // Obtém os IDs dos funcionários
        $employeesIds = array_column($maintenances, 'employee_id');

        // Busca todos os carros associados às manutenções em uma única consulta
        $cars = empty($carsIds) ? [] : model(CarModel::class)->whereIn('id', $carsIds)->findAll();

        // Obtém os IDs dos clientes
        $customerIds = array_column($cars, 'customer_id');

        // Busca todos os clientes associados às manutenções em uma única consulta
        $customers = empty($customerIds) ? [] : model(CustomerModel::class)->whereIn('id', $customerIds)->findAll();

        // Busca todos os funcionarios associados às manutenções em uma única consulta
        $employees = empty($employeesIds) ? [] : model(EmployeeModel::class)->whereIn('id', $employeesIds)->findAll();

        // Busca todos os serviços associados às manutenções em uma única consulta
        $services = empty($maintenancesIds) ? [] : model(MaintenanceServiceModel::class)->getServices(maintenanceId: $maintenancesIds);


        // Itera sobre cada manutenção para associar os clientes, carros, funcionários e serviços
        foreach ($maintenances as &$maintenance) {


            //! associamos os carros
            foreach ($cars as $car) {

                //! associamos os clientes aos carros
                foreach ($customers as $customer) {

                    if ($car->customer_id === $customer->id) {
                        $car->customer = $customer;
                        break; //! um carro só possui um cliente
                    }
                }


                if ($maintenance->car_id === $car->id) {
                    $maintenance->car = $car;
                    break; //! uma manutenção só possui um carro
                }
            }

            //! associamos os funcionários
            foreach ($employees as $employee) {

                if ($maintenance->employee_id === $employee->id) {
                    $maintenance->employee = $employee;
                    break; //! uma manutenção só possui um funcionário
                }
            }


            //! associamos os serviços que cada manutenção possui
            $maintenance->services = array_filter($services, function ($service) use ($maintenance) {
                return $service->maintenance_id === $maintenance->id;
            });
        }
    }
}
