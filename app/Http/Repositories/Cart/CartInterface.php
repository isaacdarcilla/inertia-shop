<?php

namespace App\Http\Repositories\Cart;

use App\Models\Product;

interface CartInterface
{
    public function all($filter);
    public function createCart(Product $product);
    public function pay();
}
