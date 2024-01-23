<?php

declare(strict_types=1);

namespace App\Libraries\Customer;

use App\Models\CarModel;
use App\Models\CustomerModel;

class CustomerGetDataService
{

    private CustomerModel $model;

    public function __construct()
    {
        $this->model = model(CustomerModel::class);
    }

    /**
     * Retrieves paginated records
     *
     * @param integer|null $perPage
     * @param integer|null $page
     * @return array
     */
    public function paginate(?int $perPage = null, ?int $page = null): array
    {

        $customers = $this->model->paginate(perPage: $perPage, page: $page);

        if (empty($customers)) {

            return [
                'pager' => null,
                'data'  => [],
            ];
        }

        $cars = model(CarModel::class)->whereIn('customer_id', array_column($customers, 'id'))->findAll();


        foreach ($customers as $customer) {

            foreach ($cars as $car) {

                if ($customer->id === $car->customer_id) {

                    $customer->cars[] = $car;
                }
            }
        }


        return [
            'pager' => $this->model->pager->getDetails(),
            'data'  => $customers,
        ];
    }
}
