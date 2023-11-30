<?php

use App\Controllers\PortfolioController;
use App\Controllers\TaskController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->set404Override(function() {
    return view('my_errors/not_found');
});

$routes->get('/', 'Home::index', ['as' => 'home']);
// $routes->addRedirect('/about', 'home');
// $routes->group('/home', function($routes) {
    //     $routes->get('about', 'Home::index');
    // });
// $routes->get('/tasks', [TaskController::class, 'index'], ['filter' => 'auth']);
$routes->get('/portfolio', [PortfolioController::class, 'index']);
$routes->match(['get', 'post'], '/portfolio/create', [PortfolioController::class, 'create']);
$routes->match(['get', 'put'], '/portfolio/update/(:num)', [PortfolioController::class, 'update']);
$routes->delete('/portfolio/delete/(:num)', [PortfolioController::class, 'destroy']);