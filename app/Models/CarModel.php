<?php

namespace App\Models;

use App\Entities\Car;

class CarModel extends ApiModel
{

    protected $table            = 'cars';
    protected $returnType       = Car::class;
    protected $allowedFields    = [
        'customer_id',
        'brand',
        'model',
        'color',
    ];
    
    public function find($id = null): Car|null
    {
        $car = parent::find($id);

        if ($car !== null) {

            $car->customer    = model(CustomerModel::class)->where('id', $car->customer_id)->first(); //! com o find o model recupera novamente o registro atual ($this)
            $car->maintenance = model(MaintenanceModel::class)->where('car_id', $car->id)->findAll(); 
        }

        return $car;
    }
}
