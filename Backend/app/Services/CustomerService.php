<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\CustomerCampaign;
use App\Jobs\SendPromotionJob;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


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
}