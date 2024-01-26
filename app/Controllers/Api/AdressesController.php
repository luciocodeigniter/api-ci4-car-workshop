<?php

namespace App\Controllers\Api;

use App\Entities\Address;
use App\Libraries\Address\AddressGetDataService;
use App\Models\AddressModel;
use App\Validation\AddressValidation;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class AdressesController extends ResourceController
{

    protected $modelName = AddressModel::class;
    protected $format    = 'json';

    /**
     * Return an array of resource objects, themselves in array format. api/cars?perPage=2&page=1
     * 
     *
     * @return ResponseInterface
     */
    public function index()
    {

        $page    = !empty($this->request->getGet('page')) ? (int) $this->request->getGet('page') : null;
        $perPage = !empty($this->request->getGet('perPage')) ? (int) $this->request->getGet('perPage') : null;

        $adresses = (new AddressGetDataService)->paginate(perPage: $perPage, page: $page);

        return $this->respond($adresses);
    }

    /**
     * Return the properties of a resource object
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $address = $this->model->find($id);

        return ($address !== null) ? $this->respond($address) : $this->failNotFound();
    }


    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $rules = (new AddressValidation)->getRules();

        if (!$this->validate($rules)) {

            return $this->failValidationErrors($this->validator->getErrors());
        }

        $request = $this->request->getJSON(assoc: true);

        $address = new Address($request);

        $this->model->insert($address);

        return $this->respondCreated(message: 'Success!');
    }


    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {

        $rules = (new AddressValidation)->getRules();

        if (!$this->validate($rules)) {

            return $this->failValidationErrors($this->validator->getErrors());
        }


        $address = $this->model->find($id);

        if ($address === null) {

            return $this->failNotFound();
        }

        $request = $this->request->getJSON(assoc: true);

        $address->fill($request);

        if ($address->hasChanged()) {

            $this->model->save($address);
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

        $address = $this->model->find($id);

        if ($address === null) {

            return $this->failNotFound();
        }

        $this->model->delete($id);

        return $this->respondDeleted(message: 'Success!');
    }
}
