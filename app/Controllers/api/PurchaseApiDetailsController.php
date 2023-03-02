<?php
namespace App\Controllers\api;

use App\Models\PurchaseDetails;
use Slim\Http\Request;
use Slim\Http\Response;

class PurchaseApiDetailsController{
    public function store($data)
    {
        $purchaseDetail = PurchaseDetails::create([
            'shopping_id' => $data['shopping_id'],
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return $purchaseDetail;
    }
   
    public function index(Request $request, Response $response)
    {
        $purchasedetail = PurchaseDetails::all();
        return $response->withJson($purchasedetail);
    }
}