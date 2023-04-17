<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function add($payload): Product
    {
        $product = new Product;
        $product->id = $payload['id'];
        $product->sku = $payload['sku'];
        $product->name = $payload['name'];
        $product->price = $payload['price'];
        $product->stock = $payload['stock'];
        $product->category_id = $payload['category_id'];
        $product->created_at = $payload['created_at'];
        $product->save();

        return $product;
    }
}
