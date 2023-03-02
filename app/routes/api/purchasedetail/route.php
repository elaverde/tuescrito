<?php
declare(strict_types=1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();
    $app->group('/api/v1', function ()  use ($app,$container)  {
        /**
         * Endpoint para crear detalle de la compra
         *
         * Datos esperados:
         * - shopping_id: integer id de la compra (requerido)
         * - product_id: integer id del producto (requerido)
         * - quantity: integer cantidad del producto (requerido)
         * - price: float precio del producto (requerido)
         */
        $app->post('/purchasedetails', 'App\Controllers\api\PurchaseDetailsApiController:store');
        /**
         * Endpoint para actualizar detalle de la compra
         *
         * Datos esperados:
         * - shopping_id: integer id de la compra (requerido)
         * - product_id: integer id del producto (requerido)
         * - quantity: integer cantidad del producto (requerido)
         * - price: float precio del producto (requerido)
         */
        $app->put('/purchasedetails/{id}', 'App\Controllers\api\PurchaseDetailsApiController:update');
        /**
         * Endpoint para eliminar detalle de la compra
         */
        $app->delete('/purchasedetails/{id}', 'App\Controllers\api\PurchaseDetailsApiController:delete');
        /**
         * Endpoint para obtener todos los detalles de la compra
         */
        $app->get('/purchasedetails', 'App\Controllers\api\PurchaseDetailsApiController:index');
    });
};