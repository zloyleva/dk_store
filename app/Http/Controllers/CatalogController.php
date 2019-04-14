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
            "home" => route("home"),
            "catalog" => route("catalog"),
            "cart" => route("cart"),

            "addToCart" => route("addToCart"),
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
            "categories" => $category->getAll($request),
            "request" => collect($request->except("page")),
            "routes" => collect($this->routes),
        ]);
    }

    public function catalogSlug($slug, Request $request){
        return "catalogSlug";
    }
}
