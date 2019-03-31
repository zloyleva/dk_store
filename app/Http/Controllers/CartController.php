<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function show(CartItem $cartItem){
        return $cartItem->getCurrentUserCart();
    }

    public function addToCart(Request $request, CartItem $cartItem):?CartItem
    {
        if(auth()->check()){
            $user = auth()->user();
            return $cartItem->addToCart([
                "user_id" => auth()->user()->id,
                "product_id" => $request->product_id,
            ]);
        }
        return null;
    }
}
