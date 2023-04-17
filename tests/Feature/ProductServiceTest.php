<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Services\ProductService;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test add product, it should persist add product and return product object correctly
     */
    public function test_add(): void
    {
        $category = Category::factory()->create();

        $payload = [
            'id' => 'abc',
            'sku' => 'abc',
            'name' => 'test product',
            'price' => 1000,
            'stock' => 1000,
            'category_id' => $category->id,
            'created_at' => 123,
        ];
        
        $product = (new ProductService())->add($payload);

        $this->assertEquals($product->id, $payload['id']);
        $this->assertEquals($product->sku, $payload['sku']);
        $this->assertEquals($product->name, $payload['name']);
        $this->assertEquals($product->price, $payload['price']);
        $this->assertEquals($product->stock, $payload['stock']);
        $this->assertEquals($product->category_id, $payload['category_id']);
        $this->assertEquals($product->created_at, $payload['created_at']);
    }
}
