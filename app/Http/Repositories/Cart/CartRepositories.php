<?php

namespace App\Http\Repositories\Cart;

use App\Models\Cart;

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
}
