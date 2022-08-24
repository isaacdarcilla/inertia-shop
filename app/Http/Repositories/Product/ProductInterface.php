<?php

namespace App\Http\Repositories\Product;

use App\Models\Product;

interface ProductInterface
{
    /**
     * Get all product interface
     *
     * @param $filter
     * @return mixed
     */
    public function all($filter);

    /**
     * Return product details
     *
     * @param $slug
     * @return mixed
     */
    public function item($slug);

    /**
     * Create new product
     *
     * @param $request
     * @return mixed
     */
    public function createProduct($request);

    /**
     * Update product
     *
     * @param Product $product
     * @param $request
     * @return mixed
     */
    public function updateProduct(Product $product, $request);
}
