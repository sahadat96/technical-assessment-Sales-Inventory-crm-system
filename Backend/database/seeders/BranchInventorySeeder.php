<?php

namespace Database\Seeders;

use App\Models\BranchInventories;
use Illuminate\Database\Seeder;

class BranchInventorySeeder extends Seeder
{
    public function run(): void
    {
        BranchInventories::insert([
            // Dhaka Head Office
            [
                'branch_id' => 1,
                'product_id' => 1,
                'stock_quantity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_id' => 1,
                'product_id' => 2,
                'stock_quantity' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}