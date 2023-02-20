<?php
namespace App\Controllers;

use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ImageStorage;
use Illuminate\Pagination\Paginator;
use App\Models\EmailNotifications;


class UserController
{
    public function store(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $existingUser = User::where('email', $data['email'])->first();
        /**
         * Validamos que el usuario no exista
         */
        if ($existingUser) {
            return $response
                ->withStatus(400)
                ->withJson([
                    'message' => 'A user with that email already exists.'
                ]);
        }
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        $user = User::create([
            'name' =>       $data['name'],
            'last_name' =>  $data['last_name'],
            'email' =>      $data['email'],
            'password' =>   $password,
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'photo' =>      'default.jpg'
        ]);

        $notification = new EmailNotifications();
        $notification->welcomeByEmail(
            $user->name.' '.$user->last_name,
            $user->email,
            $data['password']
        );

        $storage = new ImageStorage('clients');
        $name_file = $storage->storeImage($request, 'photo', $user->id . '.jpg');
        if ($name_file !=null) {
            // Actualizamos el nombre de la imagen en la base de datos
            $user->update([
                'photo' => $name_file
            ]);
        }
        
        return $response->withStatus(201)
        ->withJson([
            'message' => 'user created successfully',
            'user' => $user
        ]);
    }
    public function update(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        /**
         * Validamos que el usuario exista
         */
        $user = User::find($id);
        if (!$user) {
            return $response->withJson(['error' => 'User not found'], 404);
        }
        /**
         * Validamos que el correo electrónico no esté en uso por otro usuario
         */
        $existingUser = User::where('email', $data['email'])->first();
        if ($existingUser && $existingUser->id != $id) {
            return $response->withJson(['error' => 'Email already in use'], 400);
        }
        $user->update([
            'name' =>       $data['name'],
            'last_name' =>  $data['last_name'],
            'email' =>      $data['email'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return $response->withJson($user, 200);
    }
    public function updatePassword(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        /**
         * Validamos que el usuario exista
         */
        $user = User::find($id);
        if (!$user) {
            return $response->withJson(['error' => 'User not found 2'], 404);
        }
        $user->update([
            'password' => md5($data['password']),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return $response->withJson($user, 200);
    }
    public function updateProfile (Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $_SESSION['user_id'];
        /**
         * Validamos que el usuario exista
         */
        $user = User::find($id);
        if (!$user) {
            return $response->withJson(['error' => 'User not found'], 404);
        }
        /**
         * Validamos que el correo electrónico no esté en uso por otro usuario
         */
        $existinguser = User::where('email', $data['email'])->first();
        if ($existinguser && $existinguser->id != $id) {
            return $response->withJson(['error' => 'Email already in use'], 400);
        }
        $user->update([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return $response->withJson($data, 200);
    }
    public function updatePhoto (Request $request, Response $response, $args)
    {
        $id = $_SESSION['user_id'];
        $user = User::find($id);
        if (!$user) {
            return $response->withJson(['error' => 'User not found'], 404);
        }
        $storage = new ImageStorage('clients');
        $name_file = $storage->storeImage($request, 'photo', $user->id . '.jpg');
        if ($name_file !=null) {
            // Actualizamos el nombre de la imagen en la base de datos
            $user->update([
                'photo' => $name_file
            ]);
        }
        return $response->withJson($user, 200);
    }
    public function delete(Request $request, Response $response, $args)
    {
        $id = $args['id'];
        $user = User::find($id);
        if (!$user) {
            return $response->withJson(['error' => 'User not found 3'], 404);
        }
        $user->delete();
        return $response->withJson(['message' => 'User deleted successfully'], 200);
    }
    public function index(Request $request, Response $response, $args) {
        $users = User::all();
        $page = $request->getParam('page') ?? 1;
        $perPage = 6;
        $users = User::orderBy('id', 'desc')->paginate($perPage, ['*'], 'page', $page);
        foreach ($users as $user) {
            if($user->photo == 'default.jpg' or $user->photo == 'none' or $user->photo == 'no-photo.jpg'){
                $user->photo_url = $_ENV['APP_URL']. $_ENV['APP_LOCATION'].'/public/assets/img/default.jpg';
            }else{
                $user->photo_url = $_ENV['APP_URL'].$_ENV['APP_LOCATION'].'/' . $_ENV['APP_STORAGE'] .'/'.'clients' .'/'.  $user->photo;
            }
            unset($user->password); 
        }
        return $response->withJson([
            'users' => $users
        ], 200);
    }
}


