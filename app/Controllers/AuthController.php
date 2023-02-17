<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Admin;
use Slim\Http\Request;
use Slim\Http\Response;
use Firebase\JWT\JWT;
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
        if ( !password_verify(($password),  $user->password) ) {
            return $response->withJson(['error' => 'Incorrect password'], 401);
        }
        //creamos las variables de sesssion
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_last_name'] = $user->last_name;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_photo'] = $user->photo;
        $_SESSION['user_role'] = "user";
        $_SESSION['updated_at'] = $user->updated_at;

        return $response->withJson(['success' => 'Login successful']);
    }
    public function loginAdmin(Request $request, Response $response){
        $email = $request->getParam('email');
        $password = $request->getParam('password');
        $admin = Admin::where('email', $email)->first();
        if (!$admin) {
            return $response->withJson(['error' => 'Email not found'], 404);
            
        }
        if ( !password_verify(($password),  $admin->password) ) {
            return $response->withJson(['error' => 'Incorrect password'], 401);
        }
        $_SESSION['user_id'] = $admin->id;
        $_SESSION['user_name'] = $admin->name;
        $_SESSION['user_last_name'] = $admin->last_name;
        $_SESSION['user_email'] = $admin->email;
        $_SESSION['user_photo'] = $admin->photo;
        $_SESSION['user_role'] = "admin";
        $_SESSION['updated_at'] = $admin->updated_at;
        return $response->withJson(['success' => 'Login successful']);
    }
}
