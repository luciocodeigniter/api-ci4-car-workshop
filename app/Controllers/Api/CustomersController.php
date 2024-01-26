<?php

namespace App\Controllers\Api;

use App\Entities\Customer;
use App\Libraries\Customer\CustomerGetDataService;
use App\Models\CustomerModel;
use App\Validation\CustomerValidation;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class CustomersController extends ResourceController
{

    protected $modelName = CustomerModel::class;
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


        $customers = (new CustomerGetDataService)->paginate(perPage: $perPage, page: $page);


        return $this->respond($customers);
    }

    /**
     * Return the properties of a resource object
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $customer = $this->model->find($id);

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

            return $this->failNotFound();
        }

        $rules = (new CustomerValidation)->getRules(id: $customer->id);

        if (!$this->validate($rules)) {

            return $this->failValidationErrors($this->validator->getErrors());
        }


        // transformamos o JSON em array associativo
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
        
        $customer = $this->model->find($id);

        if ($customer === null) {

            return $this->failNotFound();
        }

        $this->model->delete($id);

        return $this->respondDeleted(message: 'Success!');
    }
}
