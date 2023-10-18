<?php

use App\Models\Product;

describe("Test Product", function () {
    it('check product api and it response', function () {
        $response = $this->get('api/products');
        $response->assertStatus(200);
;        expect($response->json())->toBeArray();
    });

    it('can create a product using a factory', function () {
        $product = $this->createProduct();
        dump($product);
        // Make assertions about the product creation
        expect($product)->toBeInstanceOf(Product::class);
        expect($product->name)->not->toBeEmpty()->toBeString();
        expect($product->price)->not->toBeEmpty();
        expect($product->id)->not->toBeNull();
    });

    test('it can create a product via API', function () {
        $productData = [
            'name' => 'New',
            'price' => 19.99,
        ];

        $response =  $this->post('/api/products', $productData);

        // Assert that the response indicates a successful creation
        $response->assertStatus(201);

        // Assert that the product exists in the database
        expect(Product::where('name', 'New')->exists())->toBeTrue();
    });

    it('can show individual product by ID', function () {
        $productData = [
            'name' => 'New121',
            'price' => 19.99,
        ];

        $response =  $this->post('/api/products', $productData);
        $response->assertStatus(201);
        $response1 = $this->get("api/products/1");
        $response1->assertStatus(200);
    });
})->skip();
