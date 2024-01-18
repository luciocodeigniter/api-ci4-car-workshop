<?php

use App\Controllers\Api\CustomersController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->group('api', static function ($routes) {
    $routes->resource('customers', ['namespace' => '', 'controller' => CustomersController::class, 'except' => 'new,edit', 'placeholder' => '(:num)']);
});
