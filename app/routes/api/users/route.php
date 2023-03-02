<?php
declare(strict_types=1);

use App\Model\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
return function (App $app) {
    $container = $app->getContainer();
    $app->group('/api/v1', function ()  use ($app,$container)  {
        /**
         * Endpoint para iniciar sesión
         *
         * Datos esperados:
         * - email: Correo electrónico del usuario (requerido)
         * - password: Contraseña del usuario (requerido)
         */
        $app->post('/login/user', 'App\Controllers\api\AuthApiController:loginUser');
        /**
         * Endpoint para recuperar contraseña
         *
         * Datos esperados:
         * - email: Correo electrónico del administrador (requerido)
         */
        $app->post('/login/users/recover', 'App\Controllers\api\AuthApiController:recoverPasswordUser');
        /**
         * Endpoint para crear un nuevo usuario administrador
         *
         * Datos esperados:
         * - name: Nombre del usuario (requerido)
         * - last_name: Apellido del usuario (requerido)
         * - email: Correo electrónico del usuario (requerido)
         * - password: Contraseña del usuario (requerido)
         */
        $app->post('/user', \App\Controllers\api\UserApiController::class . ':store');
        /**
         * Endpoint para actualizar un usuario administrador
         *
         * Datos esperados:
         * - name: Nombre del usuario (requerido)
         * - last_name: Apellido del usuario (requerido)
         * - email: Correo electrónico del usuario (requerido)
         * - password: Contraseña del usuario (requerido)
         */
        $app->put('/user/{id}', \App\Controllers\api\UserApiController::class . ':update');
        /**
         * Endpoint para eliminar usuario
         * 
         * Datos esperados:
         * - id: id del usuario (requerido)
         */
        $app->delete('/user/{id}', \App\Controllers\api\UserApiController::class . ':delete');

        /**
         * Endpoint para actualizar la contraseña de un usuario 
         *
         * Datos esperados:
         * - password: Contraseña del usuario (requerido)
         */
        $app->get('/users', \App\Controllers\api\UserApiController::class . ':index');
        /**
         * Endpoint para actualizar la información del usuario logueado
         * 
         * Datos esperados:
         * - name: Nombre del usuario (requerido)
         * - last_name: Apellido del usuario (requerido)
         * - email: Correo electrónico del usuario (requerido)
         */
        $app->put('/profile/user/info', \App\Controllers\api\UserApiController::class . ':updateInfo');
        /**
         * Endpoint para actualizar la contraseña del usuario logueado
         * 
         * Datos esperados:
         * - password: Contraseña del usuario (requerido)
         */
        $app->put('/profile/user/password', \App\Controllers\api\UserApiController::class . ':updatePasswordInfo');
        /**
         * Endpoint para actualizar la imagen del usuario logueado
         * 
         * Datos esperados:
         * - image: Imagen del usuario (requerido)
         */
        $app->post('/profile/user/photo', \App\Controllers\api\UserApiController::class . ':updatePhotoInfo');
    });

};