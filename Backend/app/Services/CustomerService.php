<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

class CustomerService
{
    public function purchaseHistory(int $customerId): Customer
    {
        return Customer::with([
            'sales.saleItems.product'
        ])
        ->findOrFail($customerId);
    }

    public function lostCustomers(int $days = 90): Collection
    {
        return Customer::with([
                'sales' => function ($query) {
                    $query->latest('sold_at');
                }
            ])
            ->whereDoesntHave('sales', function ($query) use ($days) {
                $query->where('sold_at', '>=', now()->subDays($days));
            })
            ->get();
    }
}