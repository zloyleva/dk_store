<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function show(CartItem $cartItem, User $user){
        return $cartItem->getCurrentUserCart($user);
    }

    public function addToCart(Request $request, CartItem $cartItem, User $user):?CartItem
    {
        return $cartItem->addToCart([
            "user_id" => $user->getUserId(),
            "product_id" => $request->product_id,
        ]);
    }
}
