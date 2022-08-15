<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function index()
    {
        $filter = request('search');

        return inertia('Store/Index', [
            'filter' => $filter,
            'products' => Product::orderByName()
                ->filter(['name', 'description', 'price', 'slug'], $filter ?? '')
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
