<?php

namespace App\Controllers\Api;

use App\Entities\MaintenanceService;
use App\Models\MaintenanceServiceModel;
use App\Validation\MaintenanceServiceValidation;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class MaintenanceServicesController extends ResourceController
{

    protected $modelName = MaintenanceServiceModel::class;
    protected $format    = 'json';

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $rules = (new MaintenanceServiceValidation)->getRules();

        if (!$this->validate($rules)) {

            return $this->failValidationErrors($this->validator->getErrors());
        }

        $request = $this->request->getJSON(assoc: true);

        $maintenanceService = new MaintenanceService($request);

        $this->model->insert($maintenanceService);

        return $this->respondCreated(message: 'Success!');
    }


    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {

        $rules = (new MaintenanceServiceValidation)->getRules();

        if (!$this->validate($rules)) {

            return $this->failValidationErrors($this->validator->getErrors());
        }


        $maintenanceService = $this->model->find($id);

        if ($maintenanceService === null) {

            return $this->failNotFound();
        }

        // transformamos o JSON em array associativo
        $request = $this->request->getJSON(assoc: true);

        $maintenanceService->fill($request);

        if ($maintenanceService->hasChanged()) {

            $this->model->save($maintenanceService);
        }

        return $this->respondUpdated(message: 'Success!');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {

        $maintenanceService = $this->model->find($id);

        if ($maintenanceService === null) {

            return $this->failNotFound();
        }

        $this->model->delete($id);

        return $this->respondDeleted(message: 'Success!');
    }
}
