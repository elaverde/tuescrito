<?php
session_start();
date_default_timezone_set("America/Bogota");
use Illuminate\Database\Capsule\Manager as Capsule;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Views\PhpRenderer;
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
require __DIR__ . '/config.php';

$app = new \Slim\App($config['slim']);

$container = $app->getContainer();
$capsule = new Capsule;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$routes = array("users","admins","categories","parameters","products","purchasedetail","shopping","texts");
foreach ($routes as $route) {
    $file = __DIR__ . '/app/routes/' . $route . '/route.php';
    if (file_exists($file)) {
        $routes = require $file;
        $routes($app);
    }
}

$app->get('/', function ($request, $response, $args) {

    $page="home";
    echo $page;
});

try {
    $app->run();
} catch (Exception $e) {
    die(json_encode(array("status" => "failed", "message" => "allowed" . $e)));
}
?>