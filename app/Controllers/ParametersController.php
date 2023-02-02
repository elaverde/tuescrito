<?php
namespace App\Controllers;

use App\Models\Parameters;
use Slim\Http\Request;
use Slim\Http\Response;

class ParametersController{
    public function store(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $parameter = Parameters::create([
            'id_shopping' => $data['id_shopping'],
            'id_product' => $data['id_product'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'description' => $data['description'],
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        return $response->withStatus(201)
        ->withJson([
            'message' => 'Parameter created successfully',
            'parameter' => $parameter
        ]);
    }
    public function update(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        /**
         * Validamos que la categoría exista
         */
        $parameter = Parameters::find($id);
        if (!$parameter) {
            return $response->withJson(['error' => 'Parameter not found'], 404);
        }
        $parameter->update([
            'id_shopping' => $data['id_shopping'],
            'id_product' => $data['id_product'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'description' => $data['description'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return $response->withJson([
            'message' => 'Parameter updated successfully',
            'parameter' => $parameter
        ]);
    }
    public function delete(Request $request, Response $response, $args)
    {
        $id = $args['id'];
        /**
         * Validamos que la categoría exista
         */
        $parameter = Parameters::find($id);
        if (!$parameter) {
            return $response->withJson(['error' => 'Parameter not found'], 404);
        }
        $parameter->delete();
        return $response->withJson([
            'message' => 'Parameter deleted successfully',
            'parameter' => $parameter
        ]);
    }
    public function index(Request $request, Response $response)
    {
        $parameters = Parameters::all();
        return $response->withJson([
            'message' => 'Parameters listed successfully',
            'parameters' => $parameters
        ]);
    }
}