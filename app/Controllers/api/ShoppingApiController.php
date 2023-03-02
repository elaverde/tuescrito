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
    public function update(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        $shopping = Shopping::find($id);
        $shopping->update([
            'user_id' => $data['user_id'],
            'price' => $data['price'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
    public function delete(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        $shopping = Shopping::find($id);
        $shopping->delete();
    }
    public function index(Request $request, Response $response)
    {
        $shopping = Shopping::all();
        return $response->withJson($shopping);
    }
}