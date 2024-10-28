
<?php
require  'vendor/autoload.php';
require 'functions.php';
require 'app/Router.php';

$dotenv=Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();
$router->get('/', 'UserController@index');
$router->get('/products', 'ProductController@show');
$router->get('/products/create', 'ProductController@create');
$router->post('/products/create', 'ProductController@store');
$router->get('/products/edit', 'ProductController@edit');
$router->post('/products/update', 'ProductController@update');
$router->post('/products/delete', 'ProductController@delete');

// Dispatch the request
$requestedRoute = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Dispatch the route
$router->dispatch($requestedRoute);


?>