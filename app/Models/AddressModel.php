<?php

namespace App\Models;

class AddressModel extends ApiModel
{

    protected $table            = 'adresses';
    protected $allowedFields    = [
        'customer_id',
        'country',
        'state',
        'city',
        'neighborhood',
        'street',
    ];
    
    public function find($id = null): array|null
    {
        $address = parent::find($id);

        if ($address !== null) {

            $address['customer'] = model(CustomerModel::class)->asArray()->find($address['customer_id']);
        }

        return $address;
    }
}
