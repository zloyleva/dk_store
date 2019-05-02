<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @param int $id
     * @param string $slug
     * @param Product $product
     * @return View
     */
    public function show(int $id, string $slug, Product $product):View
    {
        return view('product.show', [
            "routes" => collect($this->routes),
            'product' => $product->findProduct($id, $slug)->firstOrFail(),
        ]);
    }
}
