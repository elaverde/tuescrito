<?php
namespace App\Controllers;

use App\Models\PurchaseDetails;
use Slim\Http\Request;
use Slim\Http\Response;

class PurchaseDetailsController{
    public function store(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $purchaseDetail = PurchaseDetails::create([
            'id_shopping' => $data['id_shopping'],
            'id_product' => $data['id_product'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'description' => $data['description'],
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        return $response->withStatus(201);
    }
    public function update(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        $purchasedetail = PurchaseDetails::find($id);
        $purchasedetail->update([
            'id_shopping' => $data['id_shopping'],
            'id_product' => $data['id_product'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'description' => $data['description'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

    }
    public function delete(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        $purchasedetail = PurchaseDetails::find($id);
        $purchasedetail->delete();
        
    }
    public function index(Request $request, Response $response)
    {
        $purchasedetail = PurchaseDetails::all();
        return $response->withJson($purchasedetail);
    }
}