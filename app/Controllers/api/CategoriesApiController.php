<?php
namespace App\Controllers\api;

use App\Models\Categories;
use Slim\Http\Request;
use Slim\Http\Response;

class CategoriesApiController{
    public function store(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $existingCategory = Categories::where('name', $data['name'])->first();
        /**
         * Validamos que la categoría no exista
         */
        if ($existingCategory) {
            return $response
                ->withStatus(400)
                ->withJson([
                    'message' => 'A Category with that name already exists.'
                ]);
        }
        $category = Categories::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        return $response->withStatus(201)
        ->withJson([
            'message' => 'Category created successfully',
            'category' => $category
        ]);
    }
    public function update(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        /**
         * Validamos que la categoría exista
         */
        $category = Categories::find($id);
        if (!$category) {
            return $response->withJson(['error' => 'Category not found'], 404);
        }
        /**
         * Validamos que el nombre no esté en uso por otra categoría
         */
        $existingCategory = Categories::where('name', $data['name'])->first();
        if ($existingCategory && $existingCategory->id != $id) {
            return $response->withJson(['error' => 'Name already in use'], 400);
        }
        $category->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return $response->withJson([
            'message' => 'Category updated successfully',
            'category' => $category
        ]);
    }
    public function delete(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        /**
         * Validamos que la categoría exista
         */
        $category = Categories::find($id);
        if (!$category) {
            return $response->withJson(['error' => 'Category not found'], 404);
        }
        $category->delete();
    }
    public function index(Request $request, Response $response)
    {
        $categories = Categories::all();
        return $response->withJson([
            'categories' => $categories
        ]);
    }
}