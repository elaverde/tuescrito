<?php
declare(strict_types=1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();
    /**
     * Endpoint para crear un texto
     *
     * Datos esperados:
     * - id_product: integer id del producto (requerido)
     * - id_admin: integer id del administrador creador (requerido)
     * - title: string titulo del texto (requerido)
     * - template: string contenido del texto (requerido)
     * - description: string descripcion del texto (opcional)
     */
    $app->post('/texts', 'App\Controllers\TextsController:store');
    /**
     * Endpoint para actualizar un texto
     *
     * Datos esperados:
     * - id_product: integer id del producto (requerido)
     * - id_admin: integer id del administrador creador (requerido)
     * - title: string titulo del texto (requerido)
     * - template: string contenido del texto (requerido)
     * - description: string descripcion del texto (opcional)
     */
    $app->put('/texts/{id}', 'App\Controllers\TextsController:update');
    /**
     * Endpoint para eliminar un texto
     */
    $app->delete('/texts/{id}', 'App\Controllers\TextsController:delete');
    /**
     * Endpoint para obtener todos los textos
     */
    $app->get('/texts', 'App\Controllers\TextsController:index');
};