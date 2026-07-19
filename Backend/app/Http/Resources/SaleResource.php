<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoice_no' => $this->invoice_no,
            'customer_id' => $this->customer_id,
            'user_id' => $this->user_id,
            'subtotal' => $this->subtotal,
            'discount' => $this->discount,
            'tax' => $this->tax,
            'total' => $this->total,
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,
            'sold_at' => $this->sold_at,
            'created_at' => $this->created_at,
        ];
    }
}
