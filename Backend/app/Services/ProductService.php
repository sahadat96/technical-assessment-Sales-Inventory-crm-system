<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function create(array $data): Product
    {
        return Product::create([
            'name' => $data['name'],
            'sku' => $data['sku'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'],
            'stock_quantity' => $data['stock_quantity'],
            'is_active' => $data['is_active'] ?? true,
        ]);
    }
}