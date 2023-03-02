<?php
declare(strict_types=1);

use App\Model\Admin;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
return function (App $app) {
    $container = $app->getContainer();
    $container = $app->getContainer();
    $app->group('/api/v1', function ()  use ($app,$container)  {
        /**
         * Endpoint para iniciar sesión
         *
         * Datos esperados:
         * - email: Correo electrónico del administrador (requerido)
         * - password: Contraseña del administrador (requerido)
         */
        $app->post('/login/admin', 'App\Controllers\api\AuthApiController:loginAdmin');
        /**
         * Endpoint para recuperar contraseña
         *
         * Datos esperados:
         * - email: Correo electrónico del administrador (requerido)
         */
        $app->post('/login/admin/recover', 'App\Controllers\api\AuthApiController:recoverPasswordAdmin');

        /**
         * Endpoint para crear un nuevo administrador administrador
         *
         * Datos esperados:
         * - name: Nombre del administrador (requerido)
         * - last_name: Apellido del administrador (requerido)
         * - email: Correo electrónico del administrador (requerido)
         * - password: Contraseña del administrador (requerido)
         */
        $app->post('/admin', \App\Controllers\api\AdminController::class . ':store');
        /**
         * Endpoint para actualizar un administrador administrador
         *
         * Datos esperados:
         * - name: Nombre del administrador (requerido)
         * - last_name: Apellido del administrador (requerido)
         * - email: Correo electrónico del administrador (requerido)
         * - password: Contraseña del administrador (requerido)
         */
        $app->put('/admin/{id}', \App\Controllers\api\AdminController::class . ':update');
        /**
         * Endpoint para actualizar la contraseña de un administrador administrador
         *
         * Datos esperados:
         * - password: Contraseña del administrador (requerido)
         */
        
        $app->put('/admin/{id}/password', \App\Controllers\api\AdminController::class . ':updatePassword');
        /**
         * Endpoint para eliminar usuario
         * 
         * Datos esperados:
         * - id: id del usuario (requerido)
         */
        $app->delete('/admin/{id}', \App\Controllers\api\AdminController::class . ':delete');
        /**
         * Endpoint para listar los administradores
         */
        $app->get('/admins', \App\Controllers\api\AdminController::class . ':index');
        /**
         * Endpoint para actualizar la información del administrador logueado
         * 
         * Datos esperados:
         * - name: Nombre del administrador (requerido)
         * - last_name: Apellido del administrador (requerido)
         * - email: Correo electrónico del administrador (requerido)
         */
        $app->put('/profile/admin/info', \App\Controllers\api\AdminController::class . ':updateInfo');
        /**
         * Endpoint para actualizar la contraseña del administrador logueado
         * 
         * Datos esperados:
         * - password: Contraseña del administrador (requerido)
         */
        $app->put('/profile/admin/password', \App\Controllers\api\AdminController::class . ':updatePasswordInfo');
        /**
         * Endpoint para actualizar la foto del administrador logueado
         * 
         * Datos esperados:
         * - photo: Foto del administrador (requerido)
         */
        $app->post('/profile/admin/photo', \App\Controllers\api\AdminController::class . ':updatePhotoInfo');

        $app->get('/info', \App\Controllers\api\AdminController::class . ':info');
    });

};