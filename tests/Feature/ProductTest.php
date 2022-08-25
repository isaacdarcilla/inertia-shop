<?php

use App\Models\Cart;
use App\Models\Product;

test('can render store page', function () {
    $response = $this->get('/');
    $products = Product::all();

    expect($products)->toBeObject();
    $response->assertStatus(200);
});

test('can render cart page', function () {
    $response = $this->get('/');
    $carts = Cart::all();

    expect($carts)->toBeObject();
    $response->assertStatus(200);
});

test('can store new product', function () {
    $this->withoutMiddleware();

    $response = $this->post('/product/store', [
        'item_category' => 1,
        'item_name' => 'Test Product',
        'item_description' => 'Test Description',
        'item_price' => 51,
    ]);

    $response->assertStatus(302);

    $product = Product::first();

    expect(Product::count())->toEqual(1)
        ->and($product->name)->toBe('Test Product')
        ->and($product->description)->toBe('Test Description')
        ->and($product->price)->toBe('51');

    $response->assertRedirect(route('product.index'));
})->tap(function () {
    $this->artisan('migrate:refresh');
});
