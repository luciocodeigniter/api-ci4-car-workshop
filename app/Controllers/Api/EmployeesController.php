<?php

namespace App\Controllers\Api;

use App\Entities\Employee;
use App\Libraries\Employee\EmployeeGetDataService;
use App\Models\EmployeeModel;
use App\Validation\EmployeeValidation;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class EmployeesController extends ResourceController
{

    protected $modelName = EmployeeModel::class;
    protected $format    = 'json';

    /**
     * Return an array of resource objects, themselves in array format. api/emplyees?perPage=2&page=1
     * 
     *
     * @return ResponseInterface
     */
    public function index()
    {
        
        $page    = !empty($this->request->getGet('page')) ? (int) $this->request->getGet('page') : null;
        $perPage = !empty($this->request->getGet('perPage')) ? (int) $this->request->getGet('perPage') : null;


        $employees = (new EmployeeGetDataService)->paginate(perPage: $perPage, page: $page);


        return $this->respond($employees);
    }

    /**
     * Return the properties of a resource object
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $employee = $this->model->find($id);

        return ($employee !== null) ? $this->respond($employee) : $this->failNotFound();
    }


    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $rules = (new EmployeeValidation)->getRules();

        if (!$this->validate($rules)) {

            return $this->failValidationErrors($this->validator->getErrors());
        }

        $request = $this->request->getJSON(assoc: true);

        $employee = new Employee($request);

        $this->model->insert($employee);

        return $this->respondCreated(message: 'Success!');
    }


    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {

        $rules = (new EmployeeValidation)->getRules();

        if (!$this->validate($rules)) {

            return $this->failValidationErrors($this->validator->getErrors());
        }


        $employee = $this->model->find($id);

        if ($employee === null) {

            return $this->failNotFound();
        }

        // transformamos o JSON em array associativo
        $request = $this->request->getJSON(assoc: true);

        $employee->fill($request);

        if ($employee->hasChanged()) {

            $this->model->save($employee);
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
        
        $employee = $this->model->find($id);

        if ($employee === null) {

            return $this->failNotFound();
        }

        $this->model->delete($id);

        return $this->respondDeleted(message: 'Success!');
    }
}
