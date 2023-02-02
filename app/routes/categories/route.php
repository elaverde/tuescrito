<?php
declare(strict_types=1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();
    /**
     * Endpoint para crear una categoria
     *
     * Datos esperados:
     * - name: string nombre de la categoria (requerido)
     * - description: string descripcion de la categoria (requerido)
     */
    $app->post('/categories', 'App\Controllers\CategoriesController:store');
    /**
     * Endpoint para actualizar una categoria
     *
     * Datos esperados:
     * - name: string nombre de la categoria (requerido)
     * - description: string descripcion de la categoria (requerido)
     */
    $app->put('/categories/{id}', 'App\Controllers\CategoriesController:update');
    /**
     * Endpoint para eliminar una categoria
     */
    $app->delete('/categories/{id}', 'App\Controllers\CategoriesController:delete');
    /**
     * Endpoint para obtener todas las categoria
     */
    $app->get('/categories', 'App\Controllers\CategoriesController:index');
};