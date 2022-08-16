<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {
        $filter = request('search');

        return inertia('Cart/Index', [
            'filter' => $filter,
            'total' => Cart::count(),
            'total_price' => Cart::sum('price'),
            'carts' => Cart::with('product')
                ->get()
                ->transform(function ($cart) {
                    return [
                        'id' => $cart->id,
                        'product' => $cart->product->name,
                        'price' => $cart->product->price,
                        'category' => $cart->product->category->name
                    ];
                })
        ]);
    }

    public function store(Product $product): RedirectResponse
    {
        Cart::create([
            'product_id' => $product->id,
            'price' => $product->price,
        ]);

        return redirect()->back();
    }

    public function destroy(Cart $cart): RedirectResponse
    {
        $cart->delete();

        return redirect()->back();
    }
}
