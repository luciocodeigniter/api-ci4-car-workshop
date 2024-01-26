<?php

namespace App\Models;

use App\Entities\Customer;

class CustomerModel extends ApiModel
{

    protected $table            = 'customers';
    protected $returnType       = Customer::class;
    protected $allowedFields    = [
        'name',
        'email',
        'phone',
    ];

    public function find($id = null): Customer|null
    {

        $customer = parent::find($id);

        if ($customer !== null) {

            $customer->cars     = model(CarModel::class)->where('customer_id', $customer->id)->findAll();
            $customer->adresses = model(AddressModel::class)->where('customer_id', $customer->id)->findAll();
        }


        return $customer;
    }
}
