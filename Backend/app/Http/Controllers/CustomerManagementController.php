<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CustomerPurchaseHistoryResource;
use App\Http\Resources\LostCustomerResource;
use App\Http\Resources\CustomerCampaignResource;
use App\Http\Resources\CustomerAssignmentResource;
use App\Http\Requests\StoreCustomerCampaignRequest;
use App\Http\Requests\StoreCustomerAssignmentRequest;

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

    public function lostCustomers(Request $request): JsonResponse
    {
        $days = (int) $request->input('days', 90);

        $customers = $this->customerService->lostCustomers($days);

        return response()->json([
            'success' => true,
            'message' => 'Lost customers retrieved successfully.',
            'data' => LostCustomerResource::collection($customers),
        ]);
    }

    public function send(StoreCustomerCampaignRequest $request)
    {
        $campaign = $this->customerService->send(
            $request->validated()
        );

        return response()->json([
            'success'=>true,
            'message'=>'Promotion sent successfully.',
            'data'=>new CustomerCampaignResource($campaign)
        ]);
    }

    public function customerAssignment(
        StoreCustomerAssignmentRequest $request
    ): JsonResponse
    {
        $assignment = $this->customerService->customerAssignment(
            $request->validated()
        );

        return response()->json([

            'success'=>true,

            'message'=>'Customer assigned successfully.',

            'data'=>new CustomerAssignmentResource($assignment)

        ],201);
    }
}
