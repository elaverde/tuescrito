<?php
declare(strict_types=1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();
    /**
     * Endpoint para crear una producto
     *
     * Datos esperados:
     * - category_id: int id de la categoria (requerido)
     * - name: string nombre del producto (requerido)
     * - description: string descripcion del producto (requerido)
     */
    $app->post('/product', 'App\Controllers\ProductController:store');
    /**
     * Endpoint para actualizar un producto
     *
     * Datos esperados:
     * - category_id: int id de la categoria (requerido)
     * - name: string nombre del producto (requerido)
     * - description: string descripcion del producto (requerido)
     */
    $app->put('/product/{id}', 'App\Controllers\ProductController:update');
    /**
     * Endpoint para eliminar un producto
     */
    $app->delete('/product/{id}', 'App\Controllers\ProductController:delete');
    /**
     * Endpoint para obtener todas las categoria
     */
    $app->get('/products', 'App\Controllers\ProductController:index');

    
};