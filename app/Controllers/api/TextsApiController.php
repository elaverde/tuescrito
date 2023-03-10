<?php
namespace App\Controllers\api;

use App\Models\Texts;
use App\Models\Product;
use App\Controllers\api\ParametersApiController;
use Illuminate\Database\Capsule\Manager as DB;
use Dompdf\Dompdf;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\PDFDocument;

class TextsApiController{
    public function store(Request $request, Response $response)
    {
       /* Creación de un nuevo registro en la base de datos. */
        $data = $request->getParsedBody();
        DB::beginTransaction();
        try{

            //provicional mientras se crea el login
            $data['admin_id'] = 1;
            $texts = Texts::create([
                'product_id' => $data['product_id'],
                'admin_id' => 1,
                'title' => $data['title'],
                'template' => $data['template'],
                'description' => $data['description'],
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            /* Revisamos si vienen palabras clave en el documeto */
            if ($data['values'] != '') {
                $parameters = new ParametersApiController();
                $parametersValues= json_decode($data['values']);
                //guardamos las palabras clave pero revisamos que todas se guarden correctamente
                $success = true;
                $success= $parameters->store($texts->id,$parametersValues);
                if ($success) {
                    DB::commit();
                    return $response->withStatus(201)
                    ->withJson([
                        'message' => 'Text created successfully',
                        'text' => $texts
                    ]);
                } else {
                    DB::rollback();
                    return $response->withStatus(500);
                }


            }else{//si no vienen palabras clave hacemos el coomit y regresamos el status 201
                DB::commit();
                return $response->withStatus(201)
                    ->withJson([
                        'message' => 'Text created successfully',
                        'text' => $texts
                    ]);
            }
        } catch (Exception $e) {
            DB::rollback();
            return $response->withStatus(500);
        }

    }
    public function update(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        DB::beginTransaction();
        try{
            $id = $args['id'];
            $texts = Texts::find($id);
            $texts->update([
                'product_id' => $data['product_id'],
                'admin_id' => 1,
                'title' => $data['title'],
                'template' => $data['template'],
                'description' => $data['description'],
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            // Obtener los parámetros asociados
            $parameters = $texts->parameters;
            // Eliminar los parámetros asociados
            foreach ($parameters as $parameter) {
                $parameter->delete();
            }
            // Guardar los nuevos parámetros
            $parameters = new ParametersApiController();
                $parametersValues= json_decode($data['values']);
                $success= $parameters->store($texts->id,$parametersValues);
            //si es sactifactorio hacemos el commit
            if ($success) {
                DB::commit();
                return $response->withStatus(201)
                        ->withJson([
                            'message' => 'Text created successfully',
                            'text' => $texts
                        ]);
            } else {
                DB::rollback();
                return $response->withStatus(500);
            }
        } catch (Exception $e) {
            DB::rollback();
            return $response->withStatus(500);
        } 
        return $response->withStatus(200);
    }
    public function delete(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        $text = Texts::find($id);
        if (!$text) {
            return $response->withStatus(['message' => 'Text no found'], 404);
        }
        // Obtener los parámetros asociados
        $parameters = $text->parameters;
        // Eliminar los parámetros asociados
        foreach ($parameters as $parameter) {
            $parameter->delete();
        }
        // Eliminar el texto
        $text->delete();
        return $response->withStatus(200);
    }
    public function index(Request $request, Response $response)
    {
        $data = $request->getQueryParams();
        $searh = $data['search'];
        $texts = Texts::withCount('parameters')->where('title','like','%'.$searh.'%');
        /* Verificando si product_id no está vacío si no quiere decir que debemos hacer un filtro*/
        if(!empty($data['product_id_filter'])){
            $texts = $texts->where('product_id',$data['product_id_filter']);
        }
        $page = $data["page"] ?? 1;
        $perPage = 6;
        $texts = $texts->orderBy('id', 'desc')->paginate($perPage, ['*'], 'page', $page);
        foreach ($texts as $text) {
            if ($text->parameters_count > 0) {
                $text->load('parameters');
            }
        }
        return $response->withJson([
            'texts' => $texts
        ], 200);
    }
    public function getTextbyProduct(Request $request, Response $response, $args)
    {
        $productId = $args['id'];
        //traemos los textos y los parameters
        $texts = Texts::where('product_id', $productId)
            ->with('parameters')
            ->get();
        return $response->withJson([
            'texts' => $texts->map(function ($text) {
                return $text;
            }),
        ], 200);
    }
    public function getTextbyCategory(Request $request, Response $response, $args)
    {
        $categoryId = $args['id'];

        $products = Product::where('category_id', $categoryId)
            ->with('category') // Carga la relación de la categoría
            ->get();

        $parameters = $products->flatMap(function ($product) {
            return $product->texts
                ->flatMap(function ($text) {
                    return $text->parameters;
                });
        });

        return $response->withJson([
            'products' => $products->map(function ($product) {
                return $product;
            }),
        ], 200);
    }
    //convertimos texto a pdf
    public function textsToPdf(Request $request, Response $response, $args)
    {
        $id = $args['id'];
        $texts = Texts::find($id);
        if ($texts == null) {
            return $response->withStatus(404) ->withJson([
                'message' => 'Text not found'
            ]);
        }
        $pdfdocument = new PdfDocument();
        $html = $pdfdocument->renderTemplate($texts->template);
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml( $html);
        $dompdf->setPaper('A4','portrait');
        $dompdf->set_option('marginTop', 0);
        $dompdf->set_option('marginBottom', 0);
        $dompdf->set_option('marginLeft', 0);
        $dompdf->set_option('marginRight', 0);
        $dompdf->render();
        $dompdf->stream($texts->title.".pdf", array("Attachment" => false));
        return $response->withStatus(200);
    }
}