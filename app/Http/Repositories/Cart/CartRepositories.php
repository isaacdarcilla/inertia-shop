<?php

namespace App\Http\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;

class CartRepositories implements CartInterface
{
    public function all($filter): array
    {
        return [
            'filter' => $filter,
            'total' => Cart::checkoutAt()->count(),
            'total_price' => Cart::checkoutAt()->sum('price'),
            'carts' => Cart::with('product')
                ->checkoutAt()
                ->get()
                ->transform(function ($cart) {
                    return [
                        'id' => $cart->id,
                        'product' => $cart->product->name,
                        'price' => $cart->product->price,
                        'category' => $cart->product->category->name
                    ];
                })
        ];
    }

    public function createCart(Product $product)
    {
        return Cart::create([
            'product_id' => $product->id,
            'price' => $product->price,
        ]);
    }

    public function pay(): int
    {
        return Cart::query()->update(['checkout_at' => now()]);
    }
}
