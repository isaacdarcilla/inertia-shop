<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

uses(RefreshDatabase::class);

test('can render store page', function () {
    get(route('store.index'))->assertStatus(200)->assertSee(['filter', 'total', 'products'])
        ->assertInertia(function ($page) {
            $page->component('Store/Index');
        });
});

test('can render create product page', function () {
    get(route('product.create'))->assertStatus(200)->assertSee(['categories', 'total'])
        ->assertInertia(function ($page) {
            $page->component('Product/Create');
        });
});

test('can store new product', function () {
    $this->withoutMiddleware();

    $user = User::factory()->create();
    $category = Category::factory()->create();

    post(route('product.store'), [
        'user_id' => $user->id,
        'item_category' => $category->id,
        'item_name' => 'Test Product',
        'item_description' => 'Test Description',
        'item_price' => 51,
    ])->assertStatus(302)->assertRedirect(route('product.index'));

    expect(Product::count())->toEqual(1)
        ->and(Product::first()->user_id)->toBe($user->id)
        ->and(Product::first()->name)->toBe('Test Product')
        ->and(Product::first()->description)->toBe('Test Description')
        ->and(Product::first()->price)->toBe('51');
});

test('can render edit product page', function () {
    $product = Product::factory()->create();

    get(route('product.edit', $product->slug))->assertStatus(200)->assertSee(['categories', 'total', 'product'])
        ->assertInertia(function ($page) {
            $page->component('Product/Edit');
        });
});

test('can update a product', function () {
    $this->withoutMiddleware();

    $user = User::factory()->create();
    $category = Category::factory()->create();
    $product = Product::factory()->create();

    put(route('product.update', $product->id), [
        'user_id' => $user->id,
        'item_category' => $category->id,
        'item_name' => $product->name,
        'item_description' => $product->description,
        'item_price' => $product->price,
    ])->assertSuccessful();

    expect($product->user_id)->toBe(1)
        ->and($product->name)->toBe($product->name)
        ->and($product->description)->toBe($product->description)
        ->and($product->price)->toBe($product->price);
});

test('can delete a product', function () {
    $this->withoutMiddleware();

    $product = Product::factory()->create();

    delete(route('product.destroy', $product->id))
        ->assertStatus(302)
        ->assertRedirect(route('store.index'));
});
