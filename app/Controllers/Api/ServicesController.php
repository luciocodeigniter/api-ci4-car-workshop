<?php

namespace App\Controllers\Api;

use App\Entities\Service;
use App\Libraries\Service\ServiceGetDataService;
use App\Models\ServiceModel;
use App\Validation\ServiceValidation;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class ServicesController extends ResourceController
{

    protected $modelName = ServiceModel::class;
    protected $format    = 'json';

    /**
     * Return an array of resource objects, themselves in array format. api/customers?perPage=2&page=1
     * 
     *
     * @return ResponseInterface
     */
    public function index()
    {

        $page    = !empty($this->request->getGet('page')) ? (int) $this->request->getGet('page') : null;
        $perPage = !empty($this->request->getGet('perPage')) ? (int) $this->request->getGet('perPage') : null;


        $services = (new ServiceGetDataService)->paginate(perPage: $perPage, page: $page);


        return $this->respond($services);
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
        $rules = (new ServiceValidation)->getRules();

        if (!$this->validate($rules)) {

            return $this->failValidationErrors($this->validator->getErrors());
        }

        $request = $this->request->getJSON(assoc: true);

        $service = new Service($request);

        $this->model->insert($service);

        return $this->respondCreated(message: 'Success!');
    }


    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {

        $rules = (new ServiceValidation)->getRules();

        if (!$this->validate($rules)) {

            return $this->failValidationErrors($this->validator->getErrors());
        }


        $service = $this->model->find($id);

        if ($service === null) {

            return $this->failNotFound();
        }

        // transformamos o JSON em array associativo
        $request = $this->request->getJSON(assoc: true);

        $service->fill($request);

        if ($service->hasChanged()) {

            $this->model->save($service);
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

        $service = $this->model->find($id);

        if ($service === null) {

            return $this->failNotFound();
        }

        $this->model->delete($id);

        return $this->respondDeleted(message: 'Success!');
    }
}
