<?php
namespace App\Controllers;

use App\Models\Texts;
use Slim\Http\Request;
use Slim\Http\Response;

class TextsController{
    public function store(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $texts = Texts::create([
            'id_product' => $data['id_product'],
            'id_admin' => $data['id_admin'],
            'title' => $data['title'],
            'template' => $data['template'],
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
        $texts = Texts::find($id);
        $texts->update([
            'id_product' => $data['id_product'],
            'id_admin' => $data['id_admin'],
            'title' => $data['title'],
            'template' => $data['template'],
            'description' => $data['description'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return $response->withStatus(200);
    }
    public function delete(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        $texts = Texts::find($id);
        $texts->delete();
        return $response->withStatus(200);
    }
    public function index(Request $request, Response $response)
    {
        $texts = Texts::all();
        return $response->withJson($texts);
    }
}