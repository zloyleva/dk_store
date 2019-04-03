<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{

    /**
     * @param CartItem $cartItem
     * @param User $user
     * @return View
     */
    public function show(CartItem $cartItem, User $user):View
    {
        return view('cart.cart', [
            "items" => $cartItem->getCurrentUserCart($user)
        ]);
    }

    /**
     * @param Request $request
     * @param CartItem $cartItem
     * @param User $user
     * @return CartItem|null
     */
    public function addToCart(Request $request, CartItem $cartItem, User $user):?CartItem
    {
        return $cartItem->addToCart([
            "user_id" => $user->getUserId(),
            "product_id" => $request->product_id,
        ]);
    }
}
