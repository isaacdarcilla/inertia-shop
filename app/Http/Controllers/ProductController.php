<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected $filter;

    public function __construct()
    {
        $this->filter = request('search');
    }

    public function index()
    {
        return inertia('Product/Index', [
            'filter' => $this->filter,
            'total' => Cart::checkoutAt()->count(),
            'products' => Product::orderByName()
                ->filter(['name', 'description', 'price', 'slug'], $this->filter ?? '')
                ->with('category')
                ->paginate(10)
                ->transform(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'description' => Str::limit($product->description, 100),
                        'slug' => $product->slug,
                        'price' => $product->price,
                        'category' => $product->category->name
                    ];
                })
        ]);
    }
}
