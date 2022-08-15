<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CartController extends Controller
{
    public function store(Product $product)
    {
        dd($product);
    }
}
