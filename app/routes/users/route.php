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
    $app->post('/user', \App\Controllers\UserController::class . ':store');
    /**
     * Endpoint para actualizar un usuario administrador
     *
     * Datos esperados:
     * - name: Nombre del usuario (requerido)
     * - last_name: Apellido del usuario (requerido)
     * - email: Correo electrónico del usuario (requerido)
     * - password: Contraseña del usuario (requerido)
     */
    $app->put('/user/{id}', \App\Controllers\UserController::class . ':update');
    /**
     * Endpoint para eliminar usuario
     * 
     * Datos esperados:
     * - id: id del usuario (requerido)
     */
    $app->delete('/user/{id}', \App\Controllers\UserController::class . ':delete');

    /**
     * Endpoint para actualizar la contraseña de un usuario administrador
     *
     * Datos esperados:
     * - password: Contraseña del usuario (requerido)
     */
    //$app->put('/user/{id}/password', \App\Controllers\UserController::class . ':updatePassword');
    /**
     * Endpoint para listar los usuarios
     */
    $app->get('/users', \App\Controllers\UserController::class . ':index');

};