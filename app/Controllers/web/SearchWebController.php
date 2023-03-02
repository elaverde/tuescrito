<?php
namespace App\Controllers\web;
use Slim\Http\Request;
use Slim\Http\Response;
use Jenssegers\Blade\Blade;
use App\Models\Categories;
use App\Models\Product;
use App\Models\Shopping;
class SearchWebController
{
    protected $blade;
    
    public function __construct()
    {
        $path = realpath(__DIR__ . "/../../resourses/views");
        $this->blade = new Blade(__DIR__ . '/../../../resourses/views', __DIR__ . '/../../../resourses/compiled');
    }
    public function getSearch(Request $request, Response $response)  {
        $categories = Categories::all();
        return $this->blade->render('pages.search.app-search',[
            'categories' => $categories,
            'path' => $request->getUri()->getBaseUrl()
        ]);
    }
    public function getBuy(Request $request, Response $response, $args)  {
        $id=$args['id'];
        $producs = Product::find($id);
        return $this->blade->render('pages.search.app-buy',[
            'producs' => $producs,
            'path' => $request->getUri()->getBaseUrl()
        ]);
    }
    public function getBuys(Request $request, Response $response)  {

        $buys = Shopping::with('purchaseDetails.product')
        ->where('user_id', $_SESSION['user_id'])
        ->get();
        return $this->blade->render('pages.user.app-buy',[
            'path' => $request->getUri()->getBaseUrl(),
            'buys' => $buys
        ]);
    }
}