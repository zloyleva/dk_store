<?php

namespace App\Http\Controllers\Traits;

trait Routes{
    protected $routes;

    public function __construct()
    {
        $this->routes = [
            "home" => route("home"),
            "catalog" => route("catalog.index"),
            "cart" => route("cart"),

            "addToCart" => route("addToCart"),
            "setItemCountInCart" => route("setItemCountInCart"),
        ];
    }
}
