<?php

namespace App\Controllers\Api;

use App\Entities\Customer;
use App\Models\CustomerModel;
use App\Validation\CustomerValidation;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class CustomersController extends ResourceController
{

    protected $modelName = CustomerModel::class;
    protected $format    = 'json';

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return ResponseInterface
     */
    public function index()
    {
        return $this->respond($this->model->asArray()->findAll());
    }

    /**
     * Return the properties of a resource object
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $customer = $this->model->asArray()->find($id);

        return ($customer !== null) ? $this->respond($customer) : $this->failNotFound();
    }


    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $rules = (new CustomerValidation)->getRules();

        if (!$this->validate($rules)) {

            return $this->failValidationErrors($this->validator->getErrors());
        }

        $request = $this->request->getJSON(assoc: true);

        $customer = new Customer($request);

        $this->model->insert($customer);

        return $this->respondCreated(message: 'Success!');
    }


    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $customer = $this->model->find($id);

        if ($customer === null) {

            $this->failNotFound();
        }


        $request = $this->request->getJSON(assoc: true);

        $customer->fill($request);

        if ($customer->hasChanged()) {

            $this->model->save($customer);
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
        //
    }
}
