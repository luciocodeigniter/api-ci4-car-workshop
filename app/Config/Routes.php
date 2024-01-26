<?php

use App\Controllers\Api\AdressesController;
use App\Controllers\Api\CarsController;
use App\Controllers\Api\CustomersController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->group('api', static function ($routes) {
    $routes->resource('customers', ['namespace' => '', 'controller' => CustomersController::class, 'except' => 'new,edit', 'placeholder' => '(:num)']);
    $routes->resource('cars', ['namespace' => '', 'controller' => CarsController::class, 'except' => 'new,edit', 'placeholder' => '(:num)']);
    $routes->resource('adresses', ['namespace' => '', 'controller' => AdressesController::class, 'except' => 'new,edit', 'placeholder' => '(:num)']);
});
