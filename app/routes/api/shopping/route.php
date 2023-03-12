<?php
declare(strict_types=1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();
    $app->group('/api/v1', function ()  use ($app,$container)  {
        /**
         * Endpoint para crear una compra
         *
         * Datos esperados:
         * - user_id: integer id del usuario (requerido)
         * - price: float precio total de la compra (requerido)
         */
        $app->post('/shoppings', 'App\Controllers\api\ShoppingApiController:store');
        /**
         * Endpoint para actualizar una compra
         *
         * Datos esperados:
         * - user_id: integer id del usuario (requerido)
         * - price: float precio total de la compra (requerido)
         */
        $app->put('/shoppings/{id}', 'App\Controllers\api\ShoppingApiController:update');
        /**
         * Endpoint para eliminar una compra
         */
        $app->delete('/shoppings/{id}', 'App\Controllers\api\ShoppingApiController:delete');
        /**
         * Endpoint para obtener todas las compras
         */
        $app->get('/shoppings', 'App\Controllers\api\ShoppingApiController:index');
        /**
         * Endpoint para guardar las visualisacion de la notificacion
         */
        $app->post('/shoppings/notifications', 'App\Controllers\api\ShoppingApiController:storeNotification');
        /**
         * Endpoint para obtener el resumen de una compra
         */
        $app->get('/shoppings/resumen', 'App\Controllers\api\ShoppingApiController:getSalesNotification');

        /**
         * Endpoint para obtener compras sin despacho
         */
        $app->get('/shoppings/nodispatch', 'App\Controllers\api\ShoppingApiController:getSalesNotDispatch');
    });
};