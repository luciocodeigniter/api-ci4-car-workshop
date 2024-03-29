<?php

use App\Controllers\Api\AdressesController;
use App\Controllers\Api\CarsController;
use App\Controllers\Api\CustomersController;
use App\Controllers\Api\EmployeesController;
use App\Controllers\Api\LoginController;
use App\Controllers\Api\MaintenanceController;
use App\Controllers\Api\MaintenanceServicesController;
use App\Controllers\Api\RegisterController;
use App\Controllers\Api\ServicesController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->group('api', static function ($routes) {

    $routes->post('register', [RegisterController::class, 'create']);
    $routes->post('login', [LoginController::class, 'create']);

    $routes->group('', ['filter' => 'jwt', 'namespace' => '', 'placeholder' => '(:num)'], static function ($routes) {

        $routes->resource('customers', ['controller' => CustomersController::class, 'except' => 'new,edit']);
        $routes->resource('cars',      ['controller' => CarsController::class,      'except' => 'new,edit']);
        $routes->resource('adresses',  ['controller' => AdressesController::class,  'except' => 'new,edit']);
        $routes->resource('employees', ['controller' => EmployeesController::class, 'except' => 'new,edit']);
        $routes->resource('services',  ['controller' => ServicesController::class,  'except' => 'new,edit']);

        $routes->resource('maintenance',  ['controller' => MaintenanceController::class,  'except' => 'new,edit']);
        $routes->resource('maintenance-services',  ['controller' => MaintenanceServicesController::class,  'except' => 'index,new,edit']);
    });
});
