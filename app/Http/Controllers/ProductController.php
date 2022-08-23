<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Product\ProductInterface;
use App\Http\Requests\ProductRequest;
use App\Models\Cart;
use App\Models\Category;
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
            'product' => $this->product->item($slug),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update product details
     *
     * @param Product $product
     * @param ProductRequest $request
     * @return void
     */
    public function update(Product $product, ProductRequest $request)
    {
        $product->update([
            'name' => $request->item_name,
            'price' => $request->item_price,
            'image' => $request->file('item_image') ? $request->file('item_image')->store('photos') : null,
            'category_id' => $request->item_category,
            'description' => $request->item_description,
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
