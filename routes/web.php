<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
*/

Route::get('/', function () {
    return view('welcome');
})->name("home");

Route::prefix("catalog")->group(function(){
    Route::get('/',"CatalogController@index")->name("catalog");
    Route::get('/{slug}',"CatalogController@catalogSlug")->name("catalogSlug")->where('slug','[A-Za-z0-9-]+');
});

Route::prefix("cart")->group(function(){
    Route::get('/',"CartController@show")->name("cart");

    Route::post('/add',"CartController@addToCart")->name("addToCart");
    Route::post('/set',"CartController@setItemCountInCart")->name("setItemCountInCart");
});

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// Temp routes
Route::get('/price', 'PageController@readPrice')->name('readPrice');
