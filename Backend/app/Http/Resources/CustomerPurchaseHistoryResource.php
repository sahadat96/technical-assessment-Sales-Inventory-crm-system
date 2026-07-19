<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerPurchaseHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'customer' => [

                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,

            ],

            'purchase_frequency' => $this->sales->count(),

            'last_purchase_date' => optional(
                $this->sales
                    ->sortByDesc('sold_at')
                    ->first()
            )->sold_at,

            'total_spent' => $this->sales->sum('total'),

            'purchase_history' => SaleResource::collection(
                $this->sales
                    ->sortByDesc('sold_at')
                    ->values()
            ),
        ];
   }
}