<?php
/**
 * Front Controller
 * 
 * All requests go through this file which bootstraps the application
 * and dispatches to the appropriate controller
 */

// Bootstrap the application
require_once __DIR__ . '/../app/core/bootstrap.php';

// Create the router
$router = new Router();

// Define routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('home', ['controller' => 'Home', 'action' => 'index']);

// Employee routes
$router->add('employees', ['controller' => 'Employee', 'action' => 'index']);
$router->add('employees/add', ['controller' => 'Employee', 'action' => 'add']);
$router->add('employees/edit/{id}', ['controller' => 'Employee', 'action' => 'edit']);
$router->add('employees/delete/{id}', ['controller' => 'Employee', 'action' => 'delete']);
$router->add('employees/toggle-status/{id}', ['controller' => 'Employee', 'action' => 'toggleStatus']);

// Visitor routes
$router->add('visitors/register', ['controller' => 'Visitor', 'action' => 'register']);
$router->add('visitors/records', ['controller' => 'Visitor', 'action' => 'records']);
$router->add('visitors/details/{id}', ['controller' => 'Visitor', 'action' => 'details']);
$router->add('visitors/checkout/{id}', ['controller' => 'Visitor', 'action' => 'checkout']);

// Process the incoming request
$uri = trim($_SERVER['REQUEST_URI'], '/');
$router->dispatch($uri);