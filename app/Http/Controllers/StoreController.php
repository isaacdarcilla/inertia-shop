<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Product\ProductInterface;

class StoreController extends Controller
{
    protected $filter;
    protected $product;

    public function __construct(ProductInterface $product)
    {
        $this->filter = request('search');
        $this->product = $product;
    }

    public function index()
    {
        return inertia('Store/Index',
            $this->product->all($this->filter)
        );
    }
}
