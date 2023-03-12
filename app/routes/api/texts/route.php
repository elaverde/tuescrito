<?php
declare(strict_types=1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();
    $container = $app->getContainer();
    $app->group('/api/v1', function ()  use ($app,$container)  {
        /**
         * Endpoint para crear un texto
         *
         * Datos esperados:
         * - product_id: integer id del producto (requerido)
         * - admin_id: integer id del administrador creador (requerido)
         * - title: string titulo del texto (requerido)
         * - template: string contenido del texto (requerido)
         * - description: string descripcion del texto (opcional)
         */
        $app->post('/texts', 'App\Controllers\api\TextsApiController:store');
        /**
         * Endpoint para actualizar un texto
         *
         * Datos esperados:
         * - product_id: integer id del producto (requerido)
         * - admin_id: integer id del administrador creador (requerido)
         * - title: string titulo del texto (requerido)
         * - template: string contenido del texto (requerido)
         * - description: string descripcion del texto (opcional)
         */
        $app->put('/texts/{id}', 'App\Controllers\api\TextsApiController:update');
        /**
         * Endpoint para eliminar un texto
         */
        $app->delete('/texts/{id}', 'App\Controllers\api\TextsApiController:delete');
        /**
         * Endpoint para obtener todos los textos
         */
        $app->get('/texts', 'App\Controllers\api\TextsApiController:index');

        /**
         * Endpoint para convertir un texto a pdf
         */
        $app->get('/textsToPdf/{id}', 'App\Controllers\api\TextsApiController:textsToPdf');

        /**
         * Endpoint para obtener un texto
         */
        $app->get('/getTextbyCategory/{id}', 'App\Controllers\api\TextsApiController:getTextbyCategory');

        /**
         * Endpoint para obtener un texto
         */
        $app->get('/getTextbyProduct/{id}', 'App\Controllers\api\TextsApiController:getTextbyProduct');
    });
};