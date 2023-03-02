<?php 
namespace App\Middlewares;
use Slim\Routing\RouteContext;
class SessionMiddleware
{
    private $roles=[];
    protected $container;
    private $pathlogin;
    private $user_role;
    public function __construct($container,$roles, $pathlogin,$user_role)
    {
        $this->container = $container;
        $this->roles=$roles;
        $this->pathlogin=$pathlogin;
        $this->user_role=$user_role;
    }
    public function __invoke($request, $response, $next)
    {
        $router = $this->container->get('router');
        // Verificar si la sesión está activa
        if (!isset($_SESSION['user_id']) ) {
            // Redirigir al usuario a la página de inicio de sesión
            return $response->withRedirect($router->pathFor($this->pathlogin));
        }       
        //verificamos el rol del usuario deb concidir con el de contructor para que no acceda a las rutas de otro rol
        if($_SESSION['user_role']!=$this->user_role){
            return $response->withRedirect($router->pathFor($this->pathlogin));
        }
        //recorremos el array de roles para saber tiene permiso
        foreach ($this->roles as $role) {
            if($_SESSION['user_role']==$role){
                $response = $next($request, $response);
                return $response;
            }
        }
        return $response->withRedirect($router->pathFor($this->pathlogin));
        return $response;
    }
}