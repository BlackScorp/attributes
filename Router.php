<?php


final class Router
{
    /**
     * @var Route[]
     */
    private array $routes = [];
    private const SEPARATOR = '::';
    public function register(Route $route): array
    {
        $this->routes[$route->getUrl()]= $route;
        return $this->routes;
    }
    public function handle(Request $request): mixed
    {
        $searchString = $request->getUri() . self::SEPARATOR .$request->getMethod();


        foreach($this->routes as $routeKey => $route){
            $action = $route->getAction();

            $rexEx = sprintf('~^(%s)/?%s(%s)$~i',$routeKey,self::SEPARATOR,$route->getMethods());

            $matches = [];
            if(!preg_match($rexEx,$searchString,$matches)){
                continue;
            }
            $matches = array_filter($matches,function ($key){
                return is_int($key) === false;
            }, ARRAY_FILTER_USE_KEY);

            $matches['request'] = $request;

            return $action(...$matches);
        }
        $message = sprintf('Route %s not found',$request->getUri());
        http_response_code(404);
        throw new RouteNotFoundException($message);
    }
}