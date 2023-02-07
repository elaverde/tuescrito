<?php
namespace App\Controllers;

use App\Models\Admin;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ImageStorage;
use Jsong\MultipartParser\MultipartParser;

class AdminController
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

        $admin = Admin::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => md5($data['password']),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'photo' => 'no-photo.jpg'
        ]);

        
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
    public function updatePassword(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        /**
         * Validamos que el usuario exista
         */
        $Admin = Admin::find($id);
        if (!$Admin) {
            return $response->withJson(['error' => 'Admin not found'], 404);
        }
        $Admin->update([
            'password' => md5($data['password']),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return $response->withJson($Admin, 200);
    }
    public function index(Request $request, Response $response, $args) {
        $admins = Admin::all();
        foreach ($admins as $admin) {
            $admin->photo_url = $_ENV['APP_URL'].$_ENV['APP_LOCATION'].'/' . $_ENV['APP_STORAGE'] .'/'.'admins' .'/'.  $admin->photo;
            unset($admin->password);
        }
        return $response->withJson([
            'admins' => $admins
        ], 200);
    }

}


