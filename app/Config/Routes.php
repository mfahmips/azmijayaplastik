<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->group('dashboard', static function($routes) {
    $routes->get('/', 'Backend\Dashboard::index');
    $routes->get('kasir',    'Backend\Kasir::index');
});