<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\CustomerCampaign;
use App\Models\CustomerAssignment;
use App\Jobs\SendPromotionJob;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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

    public function send(array $data): CustomerCampaign
    {
        $campaign = DB::transaction(function () use ($data) {

            return CustomerCampaign::create([

                'customer_id' => $data['customer_id'],
                'user_id' => Auth::id(),
                'channel' => $data['channel'],
                'subject' => $data['subject'],
                'message' => $data['message'],
                'status' => 'pending',

            ]);

        });

        SendPromotionJob::dispatch($campaign);

        return $campaign->fresh();
    }

    public function customerAssignment(array $data): CustomerAssignment
    {
        $customer = Customer::with('sales')->findOrFail(
            $data['customer_id']
        );

        $lastPurchase = $customer
            ->sales()
            ->latest('sold_at')
            ->first();

        if (
            $lastPurchase &&
            $lastPurchase->sold_at >= now()->subDays(90)
        ) {
            throw ValidationException::withMessages([

                'customer'=>[
                    'Customer is still active.'
                ]

            ]);
        }

        $alreadyAssigned = CustomerAssignment::where(

            'customer_id',
            $customer->id

        )
        ->where(

            'status',
            'assigned'

        )
        ->exists();

        if($alreadyAssigned){

            throw ValidationException::withMessages([

                'customer'=>[
                    'Customer is already assigned.'
                ]

            ]);

        }

        return CustomerAssignment::create([

            'customer_id'=>$customer->id,
            'user_id'=>$data['user_id'],
            'assigned_at'=>now(),
            'status'=>'assigned'
        ]);
    }
}