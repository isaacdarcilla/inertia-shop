<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Cart\CartInterface;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class CartController extends Controller
{
    protected $filter;
    protected $cart;

    /**
     * Invoke cart repositories
     *
     * @param CartInterface $cart
     */
    public function __construct(CartInterface $cart)
    {
        $this->filter = request('search');
        $this->cart = $cart;
    }

    /**
     * Return cart to cart page
     *
     * @return Response|ResponseFactory
     */
    public function index()
    {
        return inertia('Cart/Index',
            $this->cart->all($this->filter)
        );
    }

    /**
     * Create cart using createCart interface
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function store(Product $product): RedirectResponse
    {
        $this->cart->createCart($product);

        return redirect()->back();
    }

    /**
     * Get all in carts and return to check out page
     *
     * @return Response|ResponseFactory
     */
    public function checkout()
    {
        return inertia('Cart/Checkout',
            $this->cart->all($this->filter)
        );
    }

    /**
     * Process payment
     *
     * @return RedirectResponse
     */
    public function pay(): RedirectResponse
    {
        $this->cart->pay();

        return redirect()->route('store.index');
    }

    /**
     * Delete cart
     *
     * @param Cart $cart
     * @return RedirectResponse
     */
    public function destroy(Cart $cart): RedirectResponse
    {
        $cart->delete();

        return redirect()->back();
    }
}
