<?php

namespace App\Http\Repositories\Product;

use App\Http\Requests\ProductRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductRepositories implements ProductInterface
{
    /**
     * Return all products
     *
     * @param $filter
     * @return array
     */
    public function all($filter): array
    {
        return [
            'filter' => $filter,
            'total' => Cart::checkoutAt()->count(),
            'products' => Product::orderByName()
                ->filter(['name', 'description', 'price', 'slug'], $filter ?? '') // Macro in AppServiceProvider
                ->with('category')
                ->paginate(10)
                ->transform(function ($product) {
                    return [
                        'id' => $product->id ?? null,
                        'name' => $product->name ?? null,
                        'description' => Str::limit($product->description ?? null, 100),
                        'slug' => $product->slug ?? null,
                        'price' => $product->price ?? null,
                        'category' => $product->category->name ?? null,
                        'url' => sprintf('%s/%s', '/product', $product->slug ?? null),
                    ];
                })
        ];
    }

    /**
     * Return product details
     *
     * @param $slug
     * @return mixed
     */
    public function item($slug)
    {
        return Product::where('slug', $slug)
            ->first();
    }

    /**
     * Create new product
     *
     * @param $request
     * @return void
     */
    public function createProduct($request)
    {
        Product::create([
            'user_id' => 1,
            'name' => $request->item_name,
            'price' => $request->item_price,
            'category_id' => $request->item_category,
            'description' => $request->item_description,
            'slug' => sprintf('%s-%s', Str::slug($request->item_name), rand(1000, 9999))
        ]);
    }

    /**
     * Update product
     *
     * @param Product $product
     * @param $request
     * @return void
     */
    public function updateProduct(Product $product, $request)
    {
        $product->update([
            'name' => $request->item_name,
            'price' => $request->item_price,
            'category_id' => $request->item_category,
            'description' => $request->item_description,
        ]);
    }
}
