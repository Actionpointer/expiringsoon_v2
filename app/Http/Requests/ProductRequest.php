<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required',
            'stock' => 'required|numeric|gt:1',
            'category_id' => 'required|numeric',
            'tags' => 'nullable',
            'photo' => Rule::requiredIf(!request()->product_id),'image',
            'expiry' => 'required|date|after:today',
            'price' => 'required|numeric',
            'discount120' => 'nullable|lt:price|gt:discount90',
            'discount90' => 'nullable|lt:price|gt:discount60',
            'discount60' => 'nullable|lt:price|gt:discount30',
            'discount30' => 'nullable|lt:price',    
        ];
    }

    public function messages()
    {
        return [
            'discount120.gt' => 'This discount must be greater than 61 to 90 days discount',
            'discount90.gt' => 'This discount must be greater than 31 to 60 days discount',
            'discount60.gt' => 'This discount must be greater than 1 to 31 days discount',
            'lt' => 'This discount price must be less than actual price',
        ];
    }
}
