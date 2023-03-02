<?php
declare(strict_types=1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();
    $app->group('/api/v1', function ()  use ($app,$container)  {
        /**
         * Endpoint para crear una producto
         *
         * Datos esperados:
         * - category_id: int id de la categoria (requerido)
         * - name: string nombre del producto (requerido)
         * - description: string descripcion del producto (requerido)
         */
        $app->post('/product', 'App\Controllers\api\ProductApiController:store');
        /**
         * Endpoint para actualizar un producto
         *
         * Datos esperados:
         * - category_id: int id de la categoria (requerido)
         * - name: string nombre del producto (requerido)
         * - description: string descripcion del producto (requerido)
         */
        $app->put('/product/{id}', 'App\Controllers\api\ProductApiController:update');
        /**
         * Endpoint para eliminar un producto
         */
        $app->delete('/product/{id}', 'App\Controllers\api\ProductApiController:delete');
        /**
         * Endpoint para obtener todas las categoria
         */
        $app->get('/products', 'App\Controllers\api\ProductApiController:index');
    });
};