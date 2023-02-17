<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
date_default_timezone_set("America/Bogota");
use Illuminate\Database\Capsule\Manager as Capsule;
/*
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Views\PhpRenderer;
*/

use Jenssegers\Blade\Blade;


/* Cargando el archivo .env. */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
/* Creación de una nueva instancia del motor de plantillas Blade. */
$blade = new Blade(__DIR__ . '/resourses/views', __DIR__ . '/resourses/compiled');
/**
 * para generar los path de los assets
 * 
 * @param path La ruta al activo, relativa al directorio público.
 * 
 * @return /público/css/estilo.css
 */
use  App\Middlewares\SessionMiddleware;




/* Este es el código que se conecta a la base de datos. */
require __DIR__ . '/config.php';
$app = new \Slim\App($config['slim']);
$container = $app->getContainer();
$capsule = new Capsule;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

/* Una función que se utiliza para generar la ruta de los activos. */
$container = $app->getContainer();

require_once __DIR__ . '/app/helpers/asset_helper.php';
$container['asset'] = function ($c) {
    return function ($path) use ($c) {
        return asset($path);
    };
};
$container['profile_image'] = function ($c) {
    return function ($photo) use ($c) {
        return profile_image($photo);
    };
};

$routes = array("users","admins","categories","parameters","products","purchasedetail","shopping","texts","product");
foreach ($routes as $route) {
    $file = __DIR__ . '/app/routes/' . $route . '/route.php';
    if (file_exists($file)) {
        $routes = require $file;
        $routes($app);
    }
}
$app->get('/admin/login', function ($request, $response, $args) use($blade) {
    echo $blade->render('pages.app-login', [
        'PATH_SESSION' => '../login/admin',
        'PATH_HOME' => '../admin/home'
    ]);
})->setName('login-admin');

$app->get('/user/login', function ($request, $response, $args) use($blade) {
    echo $blade->render('pages.app-login', [
        'PATH_SESSION' => '../login/user',
        'PATH_HOME' => '../user/home'
    ]);
})->setName('login-client');

$app->group('/admin', function ()  use ($app,$container,$blade)  {
    $app->get('/home', function ($request, $response, $args) use($blade) {
        echo $blade->render('pages.app-home');
    });
    $app->get('/category', function ($request, $response, $args) use($blade) {
        echo $blade->render('pages.app-categories');
    });
    $app->get('/product', function ($request, $response, $args) use($blade) {
        echo $blade->render('pages.app-product');
    });
    $app->get('/admin', function ($request, $response, $args) use($blade) {
        echo $blade->render('pages.app-admin');
    });
    $app->get('/client', function ($request, $response, $args) use($blade) {
        echo $blade->render('pages.app-user');
    });
    $app->get('/text', function ($request, $response, $args) use($blade) {
        echo $blade->render('pages.app-text');
    });
    $app->get('/logout', function ($request, $response, $args) use($blade) {
        if ($_SESSION['user_role']=='admin'){
            session_destroy();
            return $response->withRedirect($this->router->pathFor('login-admin'));
        } else {
            session_destroy();
            return $response->withRedirect($this->router->pathFor('login-client'));
        }
        
    });
});

/* Capturar cualquier excepción que pueda ocurrir en la aplicación. */
try {
    $app->run();
} catch (Exception $e) {
    die(json_encode(array("status" => "failed", "message" => "allowed" . $e)));
}
?>