<?php

namespace App\Models;

use App\Entities\Maintenance;

class MaintenanceModel extends ApiModel
{

    protected $table            = 'maintenance';
    protected $returnType       = Maintenance::class;
    protected $allowedFields    = [
        'car_id',
        'employee_id',
        'check_in',
        'check_out',
    ];
    
    public function find($id = null): Maintenance|null
    {
        $maintenance = parent::find($id);

        if ($maintenance !== null) {

            $maintenance->car = model(CarModel::class)->where('id', $maintenance->car_id)->first(); //! com o find o model recupera novamente o registro atual ($this)
            $maintenance->customer = model(CustomerModel::class)->where('id', $maintenance->car->id)->first(); //! com o find o model recupera novamente o registro atual ($this)
            
            //! recuperar os serviços
        }

        return $maintenance;
    }
}
