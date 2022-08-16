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
        $this->cart->createCart($product);

        return redirect()->back();
    }

    public function checkout()
    {
        return inertia('Cart/Checkout',
            $this->cart->all($this->filter)
        );
    }

    public function pay(): RedirectResponse
    {
        $this->cart->pay();

        return redirect()->route('store.index');
    }

    public function destroy(Cart $cart): RedirectResponse
    {
        $cart->delete();

        return redirect()->back();
    }
}
