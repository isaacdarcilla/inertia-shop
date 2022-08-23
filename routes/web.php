<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StoreController::class, 'index'])->name('store.index');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/post/{product}', [CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/destroy/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/update', [CartController::class, 'pay'])->name('cart.pay');

Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{slug}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/update/{product}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/destroy/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
