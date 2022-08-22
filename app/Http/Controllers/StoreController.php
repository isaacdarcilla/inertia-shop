<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Product\ProductInterface;
use Inertia\Response;
use Inertia\ResponseFactory;

class StoreController extends Controller
{
    protected $filter;
    protected $product;

    /**
     * Invoke product repositories
     *
     * @param ProductInterface $product
     */
    public function __construct(ProductInterface $product)
    {
        $this->filter = request('search');
        $this->product = $product;
    }

    /**
     * Return products to stores page
     *
     * @return Response|ResponseFactory
     */
    public function index()
    {
        return inertia('Store/Index',
            $this->product->all($this->filter)
        );
    }
}
