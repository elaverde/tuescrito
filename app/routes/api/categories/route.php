<?php
declare(strict_types=1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();
    $app->group('/api/v1', function ()  use ($app,$container)  {
        /**
         * Endpoint para crear una categoria
         *
         * Datos esperados:
         * - name: string nombre de la categoria (requerido)
         * - description: string descripcion de la categoria (requerido)
         */
        $app->post('/category', 'App\Controllers\api\CategoriesApiController:store');
        /**
         * Endpoint para actualizar una categoria
         *
         * Datos esperados:
         * - name: string nombre de la categoria (requerido)
         * - description: string descripcion de la categoria (requerido)
         */
        $app->put('/category/{id}', 'App\Controllers\api\CategoriesApiController:update');
        /**
         * Endpoint para eliminar una categoria
         */
        $app->delete('/category/{id}', 'App\Controllers\api\CategoriesApiController:delete');
        /**
         * Endpoint para obtener todas las categoria
         */
        $app->get('/categories', 'App\Controllers\api\CategoriesApiController:index');
    });

    
};