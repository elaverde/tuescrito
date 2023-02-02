<?php
declare(strict_types=1);

use App\Model\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
return function (App $app) {
    $container = $app->getContainer();
    /**
     * Endpoint para iniciar sesión
     *
     * Datos esperados:
     * - email: Correo electrónico del usuario (requerido)
     * - password: Contraseña del usuario (requerido)
     */
    $app->post('/login/user', 'App\Controllers\AuthController:loginUser');
    /**
     * Endpoint para crear un nuevo usuario administrador
     *
     * Datos esperados:
     * - name: Nombre del usuario (requerido)
     * - last_name: Apellido del usuario (requerido)
     * - email: Correo electrónico del usuario (requerido)
     * - password: Contraseña del usuario (requerido)
     */
    $app->post('/users', \App\Controllers\UserController::class . ':store');
    /**
     * Endpoint para actualizar un usuario administrador
     *
     * Datos esperados:
     * - name: Nombre del usuario (requerido)
     * - last_name: Apellido del usuario (requerido)
     * - email: Correo electrónico del usuario (requerido)
     * - password: Contraseña del usuario (requerido)
     */
    $app->put('/users/{id}', \App\Controllers\UserController::class . ':update');
    /**
     * Endpoint para actualizar la contraseña de un usuario administrador
     *
     * Datos esperados:
     * - password: Contraseña del usuario (requerido)
     */
    $app->put('/users/{id}/password', \App\Controllers\UserController::class . ':updatePassword');

};