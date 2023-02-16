<?php
namespace App\Shopping;

use App\Models\Shopping;
use Slim\Http\Request;
use Slim\Http\Response;

class ShoppingController{
    public function store(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $shopping = Shopping::create([
            'user_id' => $data['user_id'],
            'price' => $data['price'],
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
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