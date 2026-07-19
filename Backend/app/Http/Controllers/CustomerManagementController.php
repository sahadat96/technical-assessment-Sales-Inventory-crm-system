<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CustomerPurchaseHistoryResource;

class CustomerManagementController extends Controller
{
    public function __construct(
        private readonly CustomerService $customerService
    ) {
    }

    public function purchaseHistory(int $customerId): JsonResponse
    {
        $customer = $this->customerService
            ->purchaseHistory($customerId);

        return response()->json([
            'success' => true,
            'message' => 'Purchase history retrieved successfully.',
            'data' => new CustomerPurchaseHistoryResource($customer),
        ]);
    }
}
