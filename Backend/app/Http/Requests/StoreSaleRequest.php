<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           
            'customer_id' => ['required','exists:customers,id'],

            'payment_method' => [
                'required',
                'in:cash,card,mobile_banking'
            ],

            'payment_status' => [
                'required',
                'in:paid,pending'
            ],

            'discount' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'tax' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'sold_at' => [
                'required',
                'date'
            ],

            'items' => [
                'required',
                'array',
                'min:1'
            ],

            'items.*.product_id' => [
                'required',
                'exists:products,id'
            ],

            'items.*.quantity' => [
                'required',
                'integer',
                'min:1'
            ],
        ];
    }
}
