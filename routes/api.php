<?php

use App\Http\Controllers\Api\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->prefix('cart')->group(function () {
    Route::post('/add/{product}', [CartController::class, 'add'])->name('api.cart.add');
    Route::post('/wishlist/{product}', [CartController::class, 'toggleWishlist'])->name('api.wishlist.toggle');
    Route::post('/alert/{product}', [CartController::class, 'toggleStockAlert'])->name('api.stock.alert.toggle');
    Route::get('/count', [CartController::class, 'count'])->name('api.cart.count');
});
