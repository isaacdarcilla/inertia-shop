<?php

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

test('can render cart page', function () {
    get(route('cart.index'))->assertStatus(200)->assertSee(['filter', 'total', 'carts', 'total_price'])
        ->assertInertia(function ($page) {
            $page->component('Cart/Index');
        });
});

test('can render checkout page', function () {
    get(route('cart.checkout'))->assertStatus(200)->assertSee(['filter', 'total', 'carts', 'total_price'])
        ->assertInertia(function ($page) {
            $page->component('Cart/Checkout');
        });
});

test('can product added to cart', function () {
    $this->withoutMiddleware();

    $product = Product::factory()->create();

    post(route('cart.store', $product->id))
        ->assertStatus(302)
        ->assertRedirect(route('store.index'));
});

test('can process payment', function () {
    $this->withoutMiddleware();

    $cart = Cart::factory()->create();

    $date = now();
    $cart->update(['checkout_at' => $date]);

    expect($cart->checkout_at)->toBe($date);
});
