<?php
namespace App\Controllers;

use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

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
        $admin = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => md5($data['password']),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        return $response->withStatus(201)
        ->withJson([
            'message' => 'Admin created successfully',
            'admin' => $admin
        ]);
    }
    public function update(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
      
        /**
         * Validamos que el usuario exista
         */
        $admin = User::find($id);
        if (!$admin) {
            return $response->withJson(['error' => 'User not found'], 404);
        }
        /**
         * Validamos que el correo electrónico no esté en uso por otro usuario
         */
        $existingUser = User::where('email', $data['email'])->first();
        if ($existingUser && $existingUser->id != $id) {
            return $response->withJson(['error' => 'Email already in use'], 400);
        }
        $admin->update([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return $response->withJson($admin, 200);
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
            return $response->withJson(['error' => 'User not found'], 404);
        }
        $user->update([
            'password' => md5($data['password']),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return $response->withJson($user, 200);
    }
}


