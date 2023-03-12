<?php
namespace App\Controllers\api;

use App\Models\Shopping;
use App\Models\PurchaseDetails;
use App\Models\EmailNotifications;
use Slim\Http\Request;
use Slim\Http\Response;

class ShoppingApiController{
    public function store(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $shopping = Shopping::create([
            'user_id' => $_SESSION['user_id'],
            'price' => $data['price'],
            'view' => 0,
            'send'=>0,
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $data['shopping_id'] = $shopping->id;
        $data['quantity'] = 1;
        $data['price'] = $data['price'] * $data['quantity'];
        $purchaseDetail = new PurchaseApiDetailsController();
        $purchaseDetail->store($data);

        $email = new EmailNotifications();
        $email->ThankPurchaseByEmail($_SESSION['user_name']." ".$_SESSION['user_last_name'],$_SESSION['user_email']);
        return $response->withStatus(201);
    }
    public function storeNotification(Request $request, Response $response){
        $shopping = Shopping::where('view', 0)->update(['view' => 1]);
        return $response->withStatus(201);
    }
    public function changeSendbyId(Request $request, Response $response){
        $data = $request->getParsedBody();
        $shopping = Shopping::where('id', $data['id'])->update(['send' => 1]);
        return $response->withStatus(201);
    }
    public function getSalesNotification(Request $request, Response $response){
        $buys = Shopping::with(['user','purchaseDetails.product'])
            ->where('view', 0)
            ->get();
        
        $countbuys = $buys->count(); // Obtener el total de compras sin vista previa
        return $response->withJson(['buys' => $buys, 'count' => $countbuys]);
    }
    public function getSalesNotDispatch(Request $request, Response $response){
        $buys = Shopping::with(['user','purchaseDetails.product'])
        ->where('send', 0)
        ->get();
        foreach($buys as $buy){
            if($buy->user->photo =='default.jpg' or $buy->user->photo == 'none' or $buy->user->photo == 'no-photo.jpg'){
                $buy->user->photo_url =  $_ENV['APP_URL']. $_ENV['APP_LOCATION'].'/public/assets/img/default.jpg';
            }else{
                $buy->user->photo_url =  $_ENV['APP_URL']. $_ENV['APP_LOCATION'].'/' . $_ENV['APP_STORAGE'] .'/'.'clients' .'/'.$buy->user->photo;
            }
        }
        $countbuys = $buys->count(); // Obtener el total de compras sin vista previa
        return $response->withJson(['buys' => $buys, 'count' => $countbuys]);
    }
    public function index(Request $request, Response $response)
    {
        $shopping = Shopping::all();
        return $response->withJson($shopping);
    }
}