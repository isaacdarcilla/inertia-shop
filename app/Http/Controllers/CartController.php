<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Cart\CartInterface;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    protected $filter;
    protected $cart;

    public function __construct(CartInterface $cart)
    {
        $this->filter = request('search');
        $this->cart = $cart;
    }

    public function index()
    {
        return inertia('Cart/Index',
            $this->cart->all($this->filter)
        );
    }

    public function store(Product $product): RedirectResponse
    {
        Cart::create([
            'product_id' => $product->id,
            'price' => $product->price,
        ]);

        return redirect()->back();
    }

    public function checkout()
    {
        return inertia('Cart/Checkout', [
            'filter' => $this->filter,
            'total' => Cart::checkoutAt()->count(),
            'total_price' => Cart::sum('price'),
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
        ]);
    }

    public function pay(): RedirectResponse
    {
        Cart::query()->update(['checkout_at' => now()]);

        return redirect()->route('store.index');
    }

    public function destroy(Cart $cart): RedirectResponse
    {
        $cart->delete();

        return redirect()->back();
    }
}
