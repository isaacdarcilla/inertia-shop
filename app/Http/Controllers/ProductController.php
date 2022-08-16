<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Product\ProductInterface;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    protected $filter;
    protected $product;

    public function __construct(ProductInterface $product)
    {
        $this->filter = request('search');
        $this->product = $product;
    }

    public function index()
    {
        return inertia('Product/Index',
            $this->product->all($this->filter)
        );
    }

    public function edit($slug)
    {
        return inertia('Product/Edit', [
            'total' => Cart::checkoutAt()->count(),
            'product' => Product::where('slug', $slug)
                ->first()
        ]);
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->back();
    }
}
