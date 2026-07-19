<?php

namespace App\Services;

use App\Models\Customer;

class CustomerService
{
    public function purchaseHistory(int $customerId): Customer
    {
        return Customer::with([
            'sales.saleItems.product'
        ])
        ->findOrFail($customerId);
    }
}