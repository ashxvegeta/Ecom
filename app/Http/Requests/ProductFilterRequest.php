<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'search'      => 'nullable|string|max:255',
            'category_id' => 'nullable|array',
            'category_id.*' => 'exists:categories,id',  //whatever the array is coming in  category_id  each id is in catagory table or not
            'brand_id'    => 'nullable|array',
            'brand_id.*'  => 'exists:brands,id',
            'max_price'   => 'nullable|numeric|min:0',
            'sort'        => 'nullable|in:price_asc,price_desc,newest',

        ];
    }
}
