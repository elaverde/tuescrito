<?php 
namespace App\Middlewares;
use Slim\Routing\RouteContext;
class BuyMiddleware
{
    protected $container;
    public function __construct($container)
    {
        $this->container = $container;
    }
    public function __invoke($request, $response, $next)
    {
        $route = $request->getAttribute('route');
        $id = $route->getArgument('id');
        // Establecer el id de la compra
        $_SESSION['ID_BUY'] = $id;

        $response = $next($request, $response);
        return $response;
    }
}