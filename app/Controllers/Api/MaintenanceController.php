<?php

namespace App\Controllers\Api;

use App\Entities\Maintenance;
use App\Libraries\Maintenance\MaintenanceGetDataService;
use App\Models\MaintenanceModel;
use App\Validation\MaintenanceValidation;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class MaintenanceServicesController extends ResourceController
{

    protected $modelName = MaintenanceModel::class;
    protected $format    = 'json';

    /**
     * Return an array of resource objects, themselves in array format. api/maintenance?perPage=2&page=1
     * 
     *
     * @return ResponseInterface
     */
    public function index()
    {

        $page    = !empty($this->request->getGet('page')) ? (int) $this->request->getGet('page') : null;
        $perPage = !empty($this->request->getGet('perPage')) ? (int) $this->request->getGet('perPage') : null;


        $maintenances = (new MaintenanceGetDataService)->paginate(perPage: $perPage, page: $page);


        return $this->respond($maintenances);
    }

    /**
     * Return the properties of a resource object
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $service = $this->model->find($id);

        return ($service !== null) ? $this->respond($service) : $this->failNotFound();
    }


    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $rules = (new MaintenanceValidation)->getRules();

        if (!$this->validate($rules)) {

            return $this->failValidationErrors($this->validator->getErrors());
        }

        $request = $this->request->getJSON(assoc: true);

        $maintenance = new Maintenance($request);

        $this->model->insert($maintenance);

        return $this->respondCreated(message: 'Success!');
    }


    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {

        $rules = (new MaintenanceValidation)->getRules();

        if (!$this->validate($rules)) {

            return $this->failValidationErrors($this->validator->getErrors());
        }


        $maintenance = $this->model->find($id);

        if ($maintenance === null) {

            return $this->failNotFound();
        }

        // transformamos o JSON em array associativo
        $request = $this->request->getJSON(assoc: true);

        $maintenance->fill($request);

        if ($maintenance->hasChanged()) {

            $this->model->save($maintenance);
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

        $maintenance = $this->model->find($id);

        if ($maintenance === null) {

            return $this->failNotFound();
        }

        $this->model->delete($id);

        return $this->respondDeleted(message: 'Success!');
    }
}
