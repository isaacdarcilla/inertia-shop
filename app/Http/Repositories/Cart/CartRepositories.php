<?php

namespace App\Http\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;

class CartRepositories implements CartInterface
{
    /**
     * Return all in carts
     *
     * @param $filter
     * @return array
     */
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

    /**
     * Create a cart
     *
     * @param Product $product
     * @return mixed
     */
    public function createCart(Product $product)
    {
        return Cart::create([
            'user_id' => 1,
            'product_id' => $product->id,
            'price' => $product->price,
        ]);
    }

    /**
     * Process payment and remove all in carts
     *
     * @return float
     */
    public function pay(): float
    {
        return Cart::query()->update(['checkout_at' => now()]);
    }
}
