<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'iPhone 16 Pro',
                'sku' => 'IPHONE16PRO001',
                'price' => 1200,
                'stock_quantity' => 15,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy S25 Ultra',
                'sku' => 'SGS25ULTRA001',
                'price' => 1150,
                'stock_quantity' => 20,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Google Pixel 10',
                'sku' => 'PIXEL10001',
                'price' => 950,
                'stock_quantity' => 18,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MacBook Pro M4',
                'sku' => 'MBPM4001',
                'price' => 2200,
                'stock_quantity' => 8,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dell XPS 15',
                'sku' => 'DELLXPS15001',
                'price' => 1800,
                'stock_quantity' => 10,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'iPad Air M3',
                'sku' => 'IPADAIRM3001',
                'price' => 750,
                'stock_quantity' => 25,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Apple Watch Series 11',
                'sku' => 'AWS11001',
                'price' => 499,
                'stock_quantity' => 30,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sony WH-1000XM6',
                'sku' => 'SONYXM6001',
                'price' => 399,
                'stock_quantity' => 40,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Logitech MX Master 3S',
                'sku' => 'MXMASTER3S001',
                'price' => 120,
                'stock_quantity' => 50,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Anker 20000mAh Power Bank',
                'sku' => 'ANKERPB200001',
                'price' => 79,
                'stock_quantity' => 60,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}