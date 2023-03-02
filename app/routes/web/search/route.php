<?php
declare(strict_types=1);
use App\Model\Admin;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Jenssegers\Blade\Blade;
use App\Controllers\web\SearchWebController;
use App\Middlewares\BuyMiddleware;
use  App\Middlewares\SessionMiddleware;
return function (App $app) {
    $blade = new Blade(__DIR__ . '/../../../../resourses/views', __DIR__ . '/../../../../resourses/compiled');
    $container = $app->getContainer();
    
    $app->get('/', '\App\Controllers\web\SearchWebController:getSearch');

    $app->get('/buy/{id}','\App\Controllers\web\SearchWebController:getBuy')
        ->add(new SessionMiddleware($container,['user'],'login-client','user'))
        ->add(new BuyMiddleware($container));

    $app->get('/user/login', function ($request, $response, $args) use($blade) {
        //verificamos si existe la variable de sesion ID_BUY
        if (isset($_SESSION['ID_BUY'])){
            //si existe la variable de sesion vamos a la compra
            $PATH_HOME = '../buy/'.$_SESSION['ID_BUY'];
            
        } else {
            //si no existe la variable de sesion ID_BUY vamos perfil
            $PATH_HOME = '../user/buys';
        }

        echo $blade->render('pages.app-login', [
            'LOGIN' => 'user',
            'PATH_SESSION' => '../api/v1/login/user',
            'PATH_RECOVER' => '../api/v1/login/recover',
            'PATH_HOME' => $PATH_HOME
        ]);
    })->setName('login-client');

    $app->group('/user', function ()  use ($app,$container,$blade)  {
       
        $app->get('/buys','\App\Controllers\web\SearchWebController:getBuys');
        
        $app->get('/profile', function ($request, $response, $args) use($blade) {
            echo $blade->render('pages.user.app-profile',[
                'path'=>"profile",
                'name' => $_SESSION['user_name'],
                'last_name' =>  $_SESSION['user_last_name'],
                'email' =>  $_SESSION['user_email']
            ]);
        });
        $app->get('/logout', function ($request, $response, $args) use($blade) {
            session_destroy();
            return $response->withRedirect($this->router->pathFor('login-client'));
        });
    })->add(new SessionMiddleware($container,['user'],'login-client','user'));


};