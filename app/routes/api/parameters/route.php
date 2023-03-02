<?php
declare(strict_types=1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();
    $app->group('/api/v1', function ()  use ($app,$container)  {
        /**
         * Endpoint para crear un parametro
         *
         * Datos esperados:
         * - text_id: integer id del texto plantilla (requerido)
         * - label: string nombre del parametro que se le muesta al cliente (requerido)
         * - simbol_remplace: string simbolo que se remplaza en el texto plantilla (requerido)
         */
        $app->post('/parameters', 'App\Controllers\api\ParametersApiController:store');
        /**
         * Endpoint para actualizar un parametro
         *
         * Datos esperados:
         * - text_id: integer id del texto plantilla (requerido)
         * - label: string nombre del parametro que se le muesta al cliente (requerido)
         * - simbol_remplace: string simbolo que se remplaza en el texto plantilla (requerido)
         */
        $app->put('/parameters/{id}', 'App\Controllers\api\ParametersApiController:update');
        /**
         * Endpoint para eliminar un parametro
         */
        $app->delete('/parameters/{id}', 'App\Controllers\api\ParametersApiController:delete');
        /**
         * Endpoint para obtener todos los parametros
         */
        $app->get('/parameters', 'App\Controllers\api\ParametersApiController:index');
    });
};