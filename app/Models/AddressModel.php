<?php

namespace App\Models;

use App\Entities\Address;

class AddressModel extends ApiModel
{

    protected $table            = 'adresses';
    protected $returnType       = Address::class;
    protected $allowedFields    = [
        'customer_id',
        'country',
        'state',
        'city',
        'neighborhood',
        'street',
    ];
    
    public function find($id = null): Address|null
    {
        $address = parent::find($id);

        if ($address !== null) {

            $address->customer = model(CustomerModel::class)->where('id', $address->customer_id)->first(); //! com o find o model recupera novamente o registro atual ($this)
        }

        return $address;
    }
}
