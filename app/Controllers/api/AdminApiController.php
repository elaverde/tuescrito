<?php
namespace App\Controllers\api;

use App\Models\Admin;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ImageStorage;
use App\Models\EmailNotifications;



class AdminApiController
{
    public function store(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $existingAdmin = Admin::where('email', $data['email'])->first();
        /**
         * Validamos que el usuario no exista
         */
        if ($existingAdmin) {
            return $response
                ->withStatus(400)
                ->withJson([
                    'message' => 'A Admin with that email already exists.'
                ]);
        }
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        $admin = Admin::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => $password,
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'photo' => 'no-photo.jpg'
        ]);

        $notification = new EmailNotifications();
        $notification->welcomeByEmail(
            $admin->name.' '.$admin->last_name,
            $admin->email,
            $data['password']
        );
        
        $storage = new ImageStorage('admins');
        $name_file = $storage->storeImage($request, 'photo', $admin->id . '.jpg');
        if ($name_file !=null) {
            // Actualizamos el nombre de la imagen en la base de datos
            $admin->update([
                'photo' => $name_file
            ]);
        }
        
        return $response->withStatus(201)
        ->withJson([
            'message' => 'Admin created successfully',
            'admin' => $admin
        ]);
        $uploadedFiles = $request->getUploadedFiles();


    }
    public function update(Request $request, Response $response, $args)
    {
        
        $data = $request->getParsedBody();
        $id = $args['id'];
        /**
         * Validamos que el usuario exista
         */
        $admin = Admin::find($id);
        if (!$admin) {
            return $response->withJson(['error' => 'Admin not found'], 404);
        }
        /**
         * Validamos que el correo electrónico no esté en uso por otro usuario
         */
        $existingAdmin = Admin::where('email', $data['email'])->first();
        if ($existingAdmin && $existingAdmin->id != $id) {
            return $response->withJson(['error' => 'Email already in use'], 400);
        }
        
        $admin->update([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $storage = new ImageStorage('admins');
        $name_file = $storage->storeImage($request, 'photo', $admin->id . '.jpg');
        if ($name_file !=null) {
            // Actualizamos el nombre de la imagen en la base de datos
            $admin->update([
                'photo' => $name_file
            ]);
        }
        return $response->withJson($data, 200);
    }
    public function updateInfo (Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $_SESSION['user_id'];
        /**
         * Validamos que el usuario exista
         */
        $admin = Admin::find($id);
        if (!$admin) {
            return $response->withJson(['error' => 'Admin not found'], 404);
        }
        /**
         * Validamos que el correo electrónico no esté en uso por otro usuario
         */
        $existingAdmin = Admin::where('email', $data['email'])->first();
        if ($existingAdmin && $existingAdmin->id != $id) {
            return $response->withJson(['error' => 'Email already in use'], 400);
        }
        $admin->update([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $_SESSION['user_name'] = $data['name'];
        $_SESSION['user_last_name'] = $data['last_name'];
        $_SESSION['user_email'] =  $data['email'];
        return $response->withJson($data, 200);
    }
    public function updatePhotoInfo (Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $_SESSION['user_id'];
        $admin = Admin::find($id);
        if (!$admin) {
            return $response->withJson(['error' => 'User not found'], 404);
        }
        $storage = new ImageStorage('admins');
        $name_file = $storage->storeImage($request, 'photo', $admin->id . '.jpg');
        

        if ($name_file !=null) {
            // Actualizamos el nombre de la imagen en la base de datos
            $_SESSION['user_photo'] = $name_file;
            $admin->update([
                'photo' => $name_file,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        return $response->withJson($admin, 200);
    }
    public function updatePasswordInfo(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $_SESSION['user_id'];
        /**
         * Validamos que el usuario exista
         */
        $Admin = Admin::find($id);
        if (!$Admin) {
            return $response->withJson(['error' => 'Admin not found'], 404);
        }
        /**
         * Validamos si el la contraseña antigua es correcta
         */	
        if (!password_verify($data['old_password'], $Admin->password)) {
            return $response->withJson(['error' => 'Old password is incorrect'], 400);
        }
        $password = password_hash($data['new1_password'], PASSWORD_BCRYPT);

        $Admin->update([
            'password' => $password,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return $response->withJson($Admin, 200);
    }
    public function delete(Request $request, Response $response, $args){
        $id = $args['id'];
        $admin = Admin::find($id);
        if (!$admin) {
            return $response->withJson(['error' => 'Admin not found'], 404);
        }
        $admin->delete();
        return $response->withJson(['message' => 'Admin deleted successfully'], 200);
    }
    public function index(Request $request, Response $response, $args) {
        $admins = Admin::all();
        $page = $request->getParam('page') ?? 1;
        $perPage = 6;
        $admins = Admin::orderBy('id', 'desc')->paginate($perPage, ['*'], 'page', $page);
        foreach ($admins as $admin) {
            if($admin->photo == 'default.jpg' or $admin->photo == 'none' or $admin->photo == 'no-photo.jpg'){
                $admin->photo_url = $_ENV['APP_URL']. $_ENV['APP_LOCATION'].'/public/assets/img/default.jpg';
            }else{
                $admin->photo_url = $_ENV['APP_URL'].$_ENV['APP_LOCATION'].'/' . $_ENV['APP_STORAGE'] .'/'.'admins' .'/'.  $admin->photo;
            }
            unset($admin->password);
        }
        return $response->withJson([
            'admins' => $admins
        ], 200);
    }
    
    private $emailProvider;


    public function info(Request $request, Response $response, $args) {
        // En su controlador
        $notification = new EmailNotifications();
        $n= ($notification->welcomeByEmail(
            'Edilson Laverde',
            'edilsonlaverde182@gmail.com',
            'www.edilsonlaverde.com'
        ));
        if ($n) {
            return $response->withJson([
                'message' => 'Email enviado correctamente'
            ], 200);
        }else{
            return $response->withJson([
                'message' => 'Error al enviar el email'
            ], 400);
        }

    }

}


