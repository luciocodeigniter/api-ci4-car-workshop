<?php

namespace App\Models;

class CarModel extends ApiModel
{

    protected $table            = 'cars';
    protected $allowedFields    = [
        'customer_id',
        'brand',
        'model',
        'color',
    ];
    
    public function find($id = null): array|null
    {
        $car = parent::find($id);

        if ($car !== null) {

            $car['customer'] = model(CustomerModel::class)->asArray()->find($car['customer_id']);
        }

        return $car;
    }
}
