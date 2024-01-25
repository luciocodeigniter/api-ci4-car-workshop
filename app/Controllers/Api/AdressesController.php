<?php

namespace App\Controllers\Api;

use App\Models\AddressModel;
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

        $cars = (new CarGetDataService)->paginate(perPage: $perPage, page: $page);

        return $this->respond($cars);
    }

    /**
     * Return the properties of a resource object
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $car = $this->model->asArray()->find($id);

        return ($car !== null) ? $this->respond($car) : $this->failNotFound();
    }


    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $rules = (new CarValidation)->getRules();

        if (!$this->validate($rules)) {

            return $this->failValidationErrors($this->validator->getErrors());
        }

        $request = $this->request->getJSON(assoc: true);

        $car = new Car($request);

        $this->model->insert($car);

        return $this->respondCreated(message: 'Success!');
    }


    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $car = $this->model->find($id);

        if ($car === null) {

            return $this->failNotFound();
        }


        $request = $this->request->getJSON(assoc: true);

        $car->fill($request);

        if ($car->hasChanged()) {

            $this->model->save($car);
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

        $car = $this->model->find($id);

        if ($car === null) {

            return $this->failNotFound();
        }

        $this->model->delete($id);

        return $this->respondDeleted(message: 'Success!');
    }
}
