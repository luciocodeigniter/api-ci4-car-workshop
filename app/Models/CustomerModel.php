<?php

namespace App\Models;

class CustomerModel extends ApiModel
{

    protected $table            = 'customers';
    protected $allowedFields    = [
        'name',
        'email',
        'phone',
    ];

    public function find($id = null): array|null
    {

        $customer = parent::find($id);

        if ($customer !== null) {

            $customer['cars'] = model(CarModel::class)->where('customer_id', $customer['id'])->findAll();
        }


        return $customer;
    }
}
