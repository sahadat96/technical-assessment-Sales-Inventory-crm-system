<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::insert([ 
            [
                'name' => 'Sahadat Hossain',
                'email' => 'sahadat@example.com',
                'phone' => '01710000005',
                'address' => 'Gazipur, Bangladesh',
                'status' => 'active',
                'last_purchase_at' => now(),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Abu Bakar Siddique',
                'email' => 'abu.bakar@example.com',
                'phone' => '01710000007',
                'address' => 'Narayanganj, Bangladesh',
                'status' => 'active',
                'last_purchase_at' => now()->subWeek(),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Md. Rakibul Hasan',
                'email' => 'rakibul.hasan@example.com',
                'phone' => '01710000008',
                'address' => 'Chattogram, Bangladesh',
                'status' => 'inactive',
                'last_purchase_at' => now()->subMonths(2),
                'is_active' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Imran Hossain',
                'email' => 'imran.hossain@example.com',
                'phone' => '01710000009',
                'address' => 'Sylhet, Bangladesh',
                'status' => 'active',
                'last_purchase_at' => now()->subDays(10),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Md. Mahmudul Hasan',
                'email' => 'mahmudul.hasan@example.com',
                'phone' => '01710000010',
                'address' => 'Rajshahi, Bangladesh',
                'status' => 'lost',
                'last_purchase_at' => now()->subMonths(8),
                'is_active' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
