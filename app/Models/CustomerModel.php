<?php

namespace App\Models;

use App\Entities\Customer;
use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table            = 'customers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Customer::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'email',
        'phone',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /** @inheritDoc */
    public function paginate(?int $perPage = null, string $group = 'default', ?int $page = null, int $segment = 0)
    {

        $customers = parent::paginate(perPage: $perPage, group: $group, page: $page, segment: $segment);

        if (empty($customers)) {

            return [];
        }

        $cars = model(CarModel::class)->whereIn('customer_id', array_column($customers, 'id'))->findAll();


        foreach ($customers as $customer) {

            foreach ($cars as $car) {

                if ($customer->id === $car->customer_id) {

                    $customer->cars[] = $car;
                }
            }
        }


        return $customers;
    }
}
