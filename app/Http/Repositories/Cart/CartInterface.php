<?php

namespace App\Http\Repositories\Cart;

use App\Models\Product;

interface CartInterface
{
    /**
     * Get all carts
     *
     * @param $filter
     * @return mixed
     */
    public function all($filter);

    /**
     * Create cart
     *
     * @param Product $product
     * @return mixed
     */
    public function createCart(Product $product);

    /**
     * Process payment and remove all in carts
     *
     * @return mixed
     */
    public function pay(): float;
}
