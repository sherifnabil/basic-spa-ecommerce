<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);


Route::middleware('verified')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Route::get('{any}', [App\Http\Controllers\HomeController::class, 'userView'])->middleware('auth')->where('any', '.*');
    Route::get('/products', [App\Http\Controllers\HomeController::class, 'userView'])->middleware('auth');
    Route::get('category/{id}/products', [App\Http\Controllers\HomeController::class, 'userView'])->middleware('auth');
    Route::get('cart', [App\Http\Controllers\HomeController::class, 'userView'])->middleware('auth');
    Route::get('admin', [App\Http\Controllers\HomeController::class, 'userView'])->middleware('auth');
    Route::get('categories', [App\Http\Controllers\HomeController::class, 'userView'])->middleware('auth');
    Route::get('create/category', [App\Http\Controllers\HomeController::class, 'userView'])->middleware('auth');
    Route::get('category/{id}/edit', [App\Http\Controllers\HomeController::class, 'userView'])->middleware('auth');
    Route::get('brands', [App\Http\Controllers\HomeController::class, 'userView'])->middleware('auth');
    Route::get('create/brand', [App\Http\Controllers\HomeController::class, 'userView'])->middleware('auth');
    Route::get('brand/{id}/edit', [App\Http\Controllers\HomeController::class, 'userView'])->middleware('auth');
    Route::get('product-list', [App\Http\Controllers\HomeController::class, 'userView'])->middleware('auth');
    Route::get('create/product', [App\Http\Controllers\HomeController::class, 'userView'])->middleware('auth');
    Route::get('product/{id}/edit', [App\Http\Controllers\HomeController::class, 'userView'])->middleware('auth');
});
