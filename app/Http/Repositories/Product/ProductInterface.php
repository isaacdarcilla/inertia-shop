<?php

namespace App\Http\Repositories\Product;

interface ProductInterface
{
    /**
     * Get all product interface
     *
     * @param $filter
     * @return mixed
     */
    public function all($filter);
}
