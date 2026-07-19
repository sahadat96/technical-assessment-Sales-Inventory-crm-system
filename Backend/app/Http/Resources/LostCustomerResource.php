<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LostCustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lastSale = $this->sales->first();

        return [

            'id' => $this->id,

            'name' => $this->name,

            'email' => $this->email,

            'phone' => $this->phone,

            'purchase_frequency' => $this->sales->count(),

            'last_purchase_date' => optional($lastSale)->sold_at,

            'days_since_last_purchase' => $lastSale
                ? now()->diffInDays($lastSale->sold_at)
                : null,
        ];
    }
}
