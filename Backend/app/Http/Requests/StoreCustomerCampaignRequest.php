<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerCampaignRequest extends FormRequest
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
            
            'customer_id'=>[
                'required',
                'exists:customers,id'
            ],

            'channel'=>[
                'required',
                'in:email,sms'
            ],

            'subject'=>[
                'nullable',
                'string',
                'max:255'
            ],

            'message'=>[
                'required',
                'string'
            ],
        ];
    }
}
