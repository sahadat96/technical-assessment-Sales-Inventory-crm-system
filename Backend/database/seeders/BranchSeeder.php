<?php

namespace Database\Seeders;

use App\Models\Branches;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        Branches::insert([
            [
                'name' => 'Dhaka Head Office',
                'code' => 'DHK001',
                'address' => 'Motijheel, Dhaka',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chattogram Branch',
                'code' => 'CTG001',
                'address' => 'Agrabad, Chattogram',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Khulna Branch',
                'code' => 'KHL001',
                'address' => 'Sonadanga, Khulna',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rajshahi Branch',
                'code' => 'RAJ001',
                'address' => 'Shaheb Bazar, Rajshahi',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sylhet Branch',
                'code' => 'SYL001',
                'address' => 'Zindabazar, Sylhet',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}