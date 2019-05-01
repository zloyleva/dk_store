<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    private $routes;

    public function __construct()
    {
        $this->routes = [
            "addToCart" => route("addToCart"),
            "catalog" => route("catalog"),
        ];
    }

    /**
     * @param Request $request
     * @param Category $category
     * @param Product $product
     * @return View
     */
    public function index(Request $request, Category $category, Product $product):View
    {
        // Todo create Repository for collect all data to collection
        // Show only need price for user
        return view('catalog.index',[
            "products" => $product->getAll($request),
            "request" => collect($request->except("page")),
            "routes" => collect($this->routes),
            "categories" => $category->categories()->get(),
        ]);
    }

    public function catalogSlug($slug, Request $request){
        return "catalogSlug";
    }
}
