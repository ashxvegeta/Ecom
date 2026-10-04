<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderRequest extends FormRequest
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
            'first_name'      => ['required', 'string', 'max:100'],
            'last_name'       => ['required', 'string', 'max:100'],
            'email'           => ['required', 'email'],
            'phone'           => ['required', 'string', 'max:20'],
            'address'         => ['required', 'string'],
            'city'            => ['required', 'string', 'max:100'],
            'state'           => ['required', 'string', 'max:100'],
            'pincode'         => ['required', 'string', 'max:10'],
            'payment_method' => ['required', 'in:cod,razorpay'], 
            'shipping_charge' => ['nullable', 'numeric', 'min:0'],
        ];
    }

    public function messages():array
    {
       return [
            'first_name.required' => 'first name required',
            'last_name.required' => 'last name required',
            'email.required' => 'email required',
            'phone.required' => 'phone required',
            'address.required' => 'address required',
            'city.required' => 'city required',
            'state.required' => 'state required',
            'pincode.required' => 'pincode required',
            'payment_method.required' => 'payment method required',
            'shipping_charge.required' => 'shipping charge required',
        ];
    }
}
