<?php

require_once __DIR__ . '/../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $routeCollector) {
    \Training\Infrastructure\UI\Controller\Home::addRoutes($routeCollector);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "404 Not Found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo "405 Method Not Allowed";
        break;
    case FastRoute\Dispatcher::FOUND:
        list($controller, $action) = $routeInfo[1];
        $vars = $routeInfo[2];
        try {
            $serviceContainer = \Training\Infrastructure\Service\Container\getContainer();
            $response = (new $controller($serviceContainer))->$action($vars);
        } catch (\Exception $e) {
            $response = $e->getMessage();
        } finally {
            echo $response;
        }

        break;
}