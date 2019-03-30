<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request, Category $category, Product $product){
        // Todo create Repository for collect all data to collection
        return view('catalog.index',[
            "products" => $product->getAll($request)
        ]);
    }

    public function catalogSlug($slug, Request $request){
        return "catalogSlug";
    }
}
