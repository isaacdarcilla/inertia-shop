<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StoreController::class, 'index'])->name('store.index');
Route::post('/cart/post/{product}', [CartController::class, 'store'])->name('cart.post');
