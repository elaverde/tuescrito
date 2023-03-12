<?php
declare(strict_types=1);
use App\Model\Admin;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Jenssegers\Blade\Blade;
use  App\Middlewares\SessionMiddleware;
return function (App $app) {
    $blade = new Blade(__DIR__ . '/../../../../resourses/views', __DIR__ . '/../../../../resourses/compiled');
    $container = $app->getContainer();
    $app->group('/admin', function ()  use ($app,$container,$blade)  {
        $app->get('/home', function ($request, $response, $args) use($blade) {
            echo $blade->render('pages.admin.app-home',['path'=>"home"]);
        });
        $app->get('/category', function ($request, $response, $args) use($blade) {
            echo $blade->render('pages.admin.app-categories',['path'=>"category"]);
        });
        $app->get('/product', function ($request, $response, $args) use($blade) {
            echo $blade->render('pages.admin.app-product',['path'=>"product"]);
        });
        $app->get('/admin', function ($request, $response, $args) use($blade) {
            echo $blade->render('pages.admin.app-admin',['path'=>"text"]);
        });
        $app->get('/client', function ($request, $response, $args) use($blade) {
            echo $blade->render('pages.admin.app-user',['path'=>"client"]);
        });
        $app->get('/text', function ($request, $response, $args) use($blade) {
            echo $blade->render('pages.admin.app-text',['path'=>"admin"]);
        });
        $app->get('/sales', function ($request, $response, $args) use($blade) {
            echo $blade->render('pages.admin.app-sales',['path'=>"sales"]);
        });
        $app->get('/profile', function ($request, $response, $args) use($blade) {
            echo $blade->render('pages.admin.app-profile',[
                'path'=>"admin",
                'name' => $_SESSION['user_name'],
                'last_name' =>  $_SESSION['user_last_name'],
                'email' =>  $_SESSION['user_email']
            ]);
        });
        $app->get('/logout', function ($request, $response, $args) use($blade) {
            if ($_SESSION['user_role']=='admin'){
                session_destroy();
                return $response->withRedirect($this->router->pathFor('login-admin'));
            } else {
                session_destroy();
                return $response->withRedirect($this->router->pathFor('login-client'));
            }
            
        });
    })->add(new SessionMiddleware($container,['admin'],'login-admin','admin'));
    $app->get('/admin/login', function ($request, $response, $args) use($blade) {
        echo $blade->render('pages.app-login', [
            'LOGIN' => 'admin',
            'PATH_SESSION' => '../api/v1/login/admin',
            'PATH_RECOVER' => '../api/v1/login/admin/recover',
            'PATH_HOME' => '../admin/home'
        ]);
    })->setName('login-admin');
};