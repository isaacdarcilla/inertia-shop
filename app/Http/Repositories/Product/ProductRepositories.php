<?php

namespace App\Http\Repositories\Product;

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
                        'id' => $product->id,
                        'name' => $product->name,
                        'description' => Str::limit($product->description, 100),
                        'slug' => $product->slug,
                        'price' => $product->price,
                        'category' => $product->category->name,
                        'url' => sprintf('%s/%s', '/product', $product->slug),
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
}
