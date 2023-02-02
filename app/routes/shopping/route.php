<?php
declare(strict_types=1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();
    /**
     * Endpoint para crear una compra
     *
     * Datos esperados:
     * - id_user: integer id del usuario (requerido)
     * - price: float precio total de la compra (requerido)
     */
    $app->post('/shoppings', 'App\Controllers\ShoppingController:store');
    /**
     * Endpoint para actualizar una compra
     *
     * Datos esperados:
     * - id_user: integer id del usuario (requerido)
     * - price: float precio total de la compra (requerido)
     */
    $app->put('/shoppings/{id}', 'App\Controllers\ShoppingController:update');
    /**
     * Endpoint para eliminar una compra
     */
    $app->delete('/shoppings/{id}', 'App\Controllers\ShoppingController:delete');
    /**
     * Endpoint para obtener todas las compras
     */
    $app->get('/shoppings', 'App\Controllers\ShoppingController:index');
};