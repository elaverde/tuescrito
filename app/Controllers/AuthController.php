<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Admin;
use Slim\Http\Request;
use Slim\Http\Response;

class AuthController
{
    public function loginUser(Request $request, Response $response)
    {
        $email = $request->getParam('email');
        $password = $request->getParam('password');
        $user = User::where('email', $email)->first();    
        if (!$user) {
            return $response->withJson(['error' => 'Email not found'], 404);
        }
        if (md5($password) != $user->password) {
            return $response->withJson(['error' => 'Incorrect password'], 401);
        }
        return $response->withJson(['success' => 'Login successful']);
    }
    public function loginAdmin(Request $request, Response $response){
        $email = $request->getParam('email');
        $password = $request->getParam('password');
        $admin = Admin::where('email', $email)->first();
        if (!$admin) {
            return $response->withJson(['error' => 'Email not found'], 404);
        }
        if (md5($password) != $admin->password) {
            return $response->withJson(['error' => 'Incorrect password'], 401);
        }
        return $response->withJson(['success' => 'Login successful']);
    }
}
