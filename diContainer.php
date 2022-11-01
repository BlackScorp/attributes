<?php
$container = [];


$container[IndexController::class] = function () {
    return new IndexController();
};
$container[ProfileController::class] = function () {
    return new ProfileController();
};
$container[Router::class] = function () use ($container) {
    $router = new Router();

    foreach($container as $className => $service){
        $reflectionClass = new ReflectionClass($className);
        $methods = $reflectionClass->getMethods();
        foreach($methods as $method){
            $attributes = $method->getAttributes(Route::class);
            foreach($attributes as $attribute){
                /** @var Route $route */
                $route = $attribute->newInstance();
                $route->setAction([$service(),$method->getName()]);

                $router->register($route);
            }
        }
    }

    return $router;
};

return $container;