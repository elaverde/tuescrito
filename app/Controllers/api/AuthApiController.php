<?php
namespace App\Controllers\api;

use App\Models\User;
use App\Models\Admin;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\EmailNotifications;
class AuthApiController
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
        $_SESSION['user_phone'] = $user->phone;
        $_SESSION['user_country_code'] = $user->country_code;
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
    public function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
    public function recoverPasswordAdmin(Request $request, Response $response){
        $email = $request->getParam('email');
        $admin = Admin::where('email', $email)->first();
        if (!$admin) {
            return $response->withJson(['error' => 'Email not found'], 404);
        }
        $newPassword = $this->generateRandomString();
        $admin->password = password_hash($newPassword, PASSWORD_DEFAULT);
        $admin->save();
        $notification = new EmailNotifications();
        $notification->RecoverPasswordByEmail(
            $admin->name.' '.$admin->last_name,
            $admin->email,
            $newPassword
        );
        return $response->withJson(['success' => 'Password recovered'],200);
    }
    public function recoverPasswordUser(Request $request, Response $response){
        $email = $request->getParam('email');
        $user = User::where('email', $email)->first();
        if (!$user) {
            return $response->withJson(['error' => 'Email not found'], 404);
        }
        $newPassword = $this->generateRandomString();
        $user->password = password_hash($newPassword, PASSWORD_DEFAULT);
        $user->save();
        $notification = new EmailNotifications();
        $notification->RecoverPasswordByEmail(
            $user->name.' '.$user->last_name,
            $user->email,
            $newPassword
        );
        return $response->withJson(['success' => 'Password recovered'],200);
    }
}
