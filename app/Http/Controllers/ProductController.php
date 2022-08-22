<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Product\ProductInterface;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductController extends Controller
{
    protected $filter;
    protected $product;

    /**
     * Invoke product repositories
     *
     * @param ProductInterface $product
     */
    public function __construct(ProductInterface $product)
    {
        $this->filter = request('search');
        $this->product = $product;
    }

    /**
     * Return products to product page
     *
     * @return Response|ResponseFactory
     */
    public function index()
    {
        return inertia('Product/Index',
            $this->product->all($this->filter)
        );
    }

    /**
     * Get product and return to edit product page
     *
     * @param $slug
     * @return Response|ResponseFactory
     */
    public function edit($slug)
    {
        return inertia('Product/Edit', [
            'total' => Cart::checkoutAt()->count(),
            'product' => Product::where('slug', $slug)
                ->first()
        ]);
    }

    /**
     * Delete product
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->back();
    }
}
