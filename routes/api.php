<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Carts\SaveController;
use App\Http\Controllers\API\Products\IndexController;
use App\Http\Controllers\API\Carts\CartProductController;
use App\Http\Controllers\API\Categories\CategoryProductsController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/** Login */
Route::post('login', [AuthController::class, 'accessToken']);

/** Logout */
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

/** Add Product To Cart */
Route::post('/add/cart', SaveController::class);

/**  Products Routes */
Route::group(['middleware' => 'idLogin'], function () {
    /** All Available Active Produtcs */
    Route::get('products', IndexController::class);

    /** All Available Category Active Produtcs */
    Route::get('category/{id}/products', CategoryProductsController::class);

    /** Cart Produtcs */
    Route::get('cart/products', CartProductController::class);
});


/** Product Routes */
Route::group(['prefix' => 'products', 'middleware' => 'idLogin'], function () {
    /** Products List */
    Route::get('/', App\Http\Controllers\API\Products\IndexController::class);

    /** Save Product */
    Route::post('/', App\Http\Controllers\API\Products\StoreController::class);

    /** Update Product */
    Route::put('/{id}/update', App\Http\Controllers\API\Products\UpdateController::class);

    /** Show Product */
    Route::get('/{id}', App\Http\Controllers\API\Products\ShowController::class);

    /** Delete Product */
    Route::delete('/{id}/destroy', App\Http\Controllers\API\Products\DeleteController::class);
});

/** Category Routes */
Route::group(['prefix' => 'categories', 'middleware' => 'idLogin'], function () {
    /** Save Category */
    Route::get('/', App\Http\Controllers\API\Categories\IndexController::class);

    /** Save Category */
    Route::post('/', App\Http\Controllers\API\Categories\StoreController::class);

    /** Update Category */
    Route::put('/{id}/update', App\Http\Controllers\API\Categories\UpdateController::class);

    /** Show Category */
    Route::get('/{id}', App\Http\Controllers\API\Categories\ShowController::class);

    /** Delete Category */
    Route::delete('/{id}/destroy', App\Http\Controllers\API\Categories\DeleteController::class);
});

/** Brand Routes */
Route::group(['prefix' => 'brands', 'middleware' => 'idLogin'], function () {
    /** Save Brand */
    Route::get('/', App\Http\Controllers\API\Brands\IndexController::class);

    /** Save Brand */
    Route::post('/', App\Http\Controllers\API\Brands\StoreController::class);

    /** Update Brand */
    Route::put('/{id}/update', App\Http\Controllers\API\Brands\UpdateController::class);

    /** Show Brand */
    Route::get('/{id}', App\Http\Controllers\API\Brands\ShowController::class);

    /** Delete Brand */
    Route::delete('/{id}/destroy', App\Http\Controllers\API\Brands\DeleteController::class);
});
