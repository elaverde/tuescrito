<?php
declare(strict_types=1);

use App\Model\Admin;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
return function (App $app) {
    $container = $app->getContainer();
    /**
     * Endpoint para iniciar sesión
     *
     * Datos esperados:
     * - email: Correo electrónico del administrador (requerido)
     * - password: Contraseña del administrador (requerido)
     */
    $app->post('/login/admin', 'App\Controllers\AuthController:loginAdmin');
    /**
     * Endpoint para recuperar contraseña
     *
     * Datos esperados:
     * - email: Correo electrónico del administrador (requerido)
     */
    $app->post('/login/admin/recover', 'App\Controllers\AuthController:recoverPasswordAdmin');

    /**
     * Endpoint para crear un nuevo administrador administrador
     *
     * Datos esperados:
     * - name: Nombre del administrador (requerido)
     * - last_name: Apellido del administrador (requerido)
     * - email: Correo electrónico del administrador (requerido)
     * - password: Contraseña del administrador (requerido)
     */
    $app->post('/admin', \App\Controllers\AdminController::class . ':store');
    /**
     * Endpoint para actualizar un administrador administrador
     *
     * Datos esperados:
     * - name: Nombre del administrador (requerido)
     * - last_name: Apellido del administrador (requerido)
     * - email: Correo electrónico del administrador (requerido)
     * - password: Contraseña del administrador (requerido)
     */
    $app->put('/admin/{id}', \App\Controllers\AdminController::class . ':update');
    /**
     * Endpoint para actualizar la contraseña de un administrador administrador
     *
     * Datos esperados:
     * - password: Contraseña del administrador (requerido)
     */
    
    $app->put('/admin/{id}/password', \App\Controllers\AdminController::class . ':updatePassword');
     /**
     * Endpoint para eliminar usuario
     * 
     * Datos esperados:
     * - id: id del usuario (requerido)
     */
    $app->delete('/admin/{id}', \App\Controllers\AdminController::class . ':delete');
    /**
     * Endpoint para listar los administradores
     */
    $app->get('/admins', \App\Controllers\AdminController::class . ':index');
    /**
     * Endpoint para actualizar la información del administrador logueado
     * 
     * Datos esperados:
     * - name: Nombre del administrador (requerido)
     * - last_name: Apellido del administrador (requerido)
     * - email: Correo electrónico del administrador (requerido)
     */
    $app->put('/profile/admin/info', \App\Controllers\AdminController::class . ':updateInfo');
    /**
     * Endpoint para actualizar la contraseña del administrador logueado
     * 
     * Datos esperados:
     * - password: Contraseña del administrador (requerido)
     */
    $app->put('/profile/admin/password', \App\Controllers\AdminController::class . ':updatePasswordInfo');
    /**
     * Endpoint para actualizar la foto del administrador logueado
     * 
     * Datos esperados:
     * - photo: Foto del administrador (requerido)
     */
    $app->post('/profile/admin/photo', \App\Controllers\AdminController::class . ':updatePhotoInfo');

    $app->get('/info', \App\Controllers\AdminController::class . ':info');


};