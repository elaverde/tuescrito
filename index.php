<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
date_default_timezone_set("America/Bogota");
use Illuminate\Database\Capsule\Manager as Capsule;
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



function loadRoutesFromFolder($app, $folder) {
    $files = scandir($folder);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }
        $path = $folder . '/' . $file;
        if (is_file($path) && pathinfo($path, PATHINFO_EXTENSION) === 'php') {
            $routes = require $path;
            $routes($app);
        } elseif (is_dir($path)) {
            loadRoutesFromFolder($app, $path);
        }
    }
}
$folder = __DIR__ . '/app/routes';
loadRoutesFromFolder($app, $folder);
/* Capturar cualquier excepción que pueda ocurrir en la aplicación. */
try {
    //$peakMemoryUsage = memory_get_peak_usage();
    //echo "Pico de memoria utilizada: " . $peakMemoryUsage . " bytes";
    //$memoryUsage = memory_get_usage();
    //echo "Memoria utilizada: " . $memoryUsage . " bytes";
   
    $app->run();
} catch (Exception $e) {
    die(json_encode(array("status" => "failed", "message" => "allowed" . $e)));
}
?>