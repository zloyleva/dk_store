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

Route::group(['prefix' => 'catalog', 'as' => 'catalog.'], function(){
    Route::get('/',"CatalogController@index")->name("index");
    Route::get('/{slug}',"CatalogController@indexBySlag")->name("indexBySlug")->where('slug','[A-Za-z0-9-]+');
});

Route::group(['prefix' => 'product', 'as' => 'product.'], function(){
    Route::get('/{id}/{slug}',"ProductController@show")->name("show")->where(['id' => '[0-9]+', 'slug' => '[A-Za-z0-9-]+']);
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
