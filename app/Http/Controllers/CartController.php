<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    private $routes;

    public function __construct()
    {
        $this->routes = [
            "addToCart" => route("addToCart"),
            "setItemCountInCart" => route("setItemCountInCart"),
        ];
    }

    /**
     * @param CartItem $cartItem
     * @param User $user
     * @return View
     */
    public function show(CartItem $cartItem, User $user):View
    {
        return view('cart.cart', [
            "items" => $cartItem->getCurrentUserCart($user),
            "routes" => collect($this->routes),
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

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CartItem $cartItem
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function setItemCountInCart(Request $request, CartItem $cartItem, User $user):JsonResponse
    {

        $result = $cartItem->setItemCountInCart([
            "user_id" => $user->getUserId(),
            "product_id" => $request->product_id,
            "count" => $request->count,
        ]);

        if($result){
            return response()->json([
                "items" => $cartItem->getCurrentUserCart($user),
            ]);
        }
        return response()->json([
            "error" => "Can't set carts count",
        ],403);
    }
}
