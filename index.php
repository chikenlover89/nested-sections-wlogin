<?php

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;

require_once 'vendor/autoload.php';

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function database(): Connection
{
    $connectionParams = [
        'dbname' => $_ENV['DB_DATABASE'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
        'host' => $_ENV['DB_HOST'],
        'driver' => 'pdo_mysql',
    ];

    $connection = DriverManager::getConnection($connectionParams);
    $connection->connect();

    return $connection;
}

function query(): QueryBuilder
{
    return database()->createQueryBuilder();
}

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $namespace = '\App\Controllers\\';

    $r->addRoute('GET', '/', $namespace . 'WelcomeController@index');

    $r->addRoute('GET', '/login', $namespace . 'LoginController@showLoginForm');
    $r->addRoute('GET', '/logout', $namespace . 'LoginController@logout');
    $r->addRoute('POST', '/login', $namespace . 'LoginController@login');

    $r->addRoute('GET', '/sections', $namespace . 'Sections1Controller@show');
    $r->addRoute('POST', '/sections', $namespace . 'Sections1Controller@add');
    $r->addRoute('DELETE', '/sections/{id1}', $namespace . 'Sections1Controller@delete');
    $r->addRoute('GET', '/edit/{id1}', $namespace . 'Sections1Controller@editView');
    $r->addRoute('EDIT', '/edit/{id1}', $namespace . 'Sections1Controller@editSave');

    $r->addRoute('GET', '/sections/{id1}', $namespace . 'Sections2Controller@show');
    $r->addRoute('POST', '/sections/{id1}', $namespace . 'Sections2Controller@add');
    $r->addRoute('DELETE', '/sections/{id1}/{id2}', $namespace . 'Sections2Controller@delete');
    $r->addRoute('GET', '/edit/{id1}/{id2}', $namespace . 'Sections2Controller@editView');
    $r->addRoute('EDIT', '/edit/{id1}/{id2}', $namespace . 'Sections2Controller@editSave');

    $r->addRoute('GET', '/sections/{id1}/{id2}', $namespace . 'Sections3Controller@show');
    $r->addRoute('POST', '/sections/{id1}/{id2}', $namespace . 'Sections3Controller@add');
    $r->addRoute('DELETE', '/sections/{id1}/{id2}/{id3}', $namespace . 'Sections3Controller@delete');
    $r->addRoute('GET', '/edit/{id1}/{id2}/{id3}', $namespace . 'Sections3Controller@editView');
    $r->addRoute('EDIT', '/edit/{id1}/{id2}/{id3}', $namespace . 'Sections3Controller@editSave');

});

// Fetch method and URI from somewhere
$httpMethod = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 PAGE NOT FOUND';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo 'METHOD NOT ALLOWED';
        break;
    case FastRoute\Dispatcher::FOUND:
        [$controller, $method] = explode('@', $routeInfo[1]);
        $vars = $routeInfo[2];
        (new $controller)->$method($vars);

        break;
}


