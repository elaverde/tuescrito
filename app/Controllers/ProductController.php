<?php
namespace App\Controllers;

use App\Models\Product;
use Slim\Http\Request;
use Slim\Http\Response;

class ProductController{
    public function store(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        /**
         * Validamos que el nombre del producto no exista
         */
        $product = Product::where('name', $data['name'])->first();
        if ($product) {
            return $response
                ->withStatus(400)
                ->withJson([
                    'message' => 'A Product with that name already exists.'
                ]);
        }

        
        $product = Product::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'description' => $data['description'],
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
    public function update(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        /**
         * Validamos que el producto exista
         */
        $product = Product::find($id);
        if (!$product) {
            return $response->withJson(['error' => 'Product not found'], 404);
        }
        /**
         * Validamos que el nombre no esté en uso por otro producto
         */
        $existingProduct = Product::where('name', $data['name'])->first();
        if ($existingProduct && $existingProduct->id != $id) {
            return $response->withJson(['error' => 'Name already in use'], 400);
        }
        $product->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return $response->withJson([
            'message' => 'Product updated successfully',
            'product' => $product
        ]);
    }
    public function delete(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        /**
         * Validamos que el producto exista
         */
        $product = Product::find($id);
        if (!$product) {
            return $response->withJson(['error' => 'Product not found'], 404);
        }
    }
    public function index(Request $request, Response $response)
    {
        $products = Product::all();
        return $response->withJson([
            'products' => $products
        ]);
    }
}