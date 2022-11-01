<?php
error_reporting(E_ALL);

require_once __DIR__ . '/Router.php';
require_once __DIR__ . '/Request.php';
require_once __DIR__ . '/RouteNotFoundException.php';
require_once __DIR__ . '/IndexController.php';
require_once __DIR__ . '/ProfileController.php';
require_once __DIR__.'/Route.php';

$container = require_once __DIR__.'/diContainer.php';

$router = $container[Router::class]();

$request = Request::createFromGlobal();

try{
    echo $router->handle($request);
}catch (RouteNotFoundException $exception){
    echo $exception->getMessage();
}
