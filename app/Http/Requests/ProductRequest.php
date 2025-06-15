<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    // protected $stopOnFirstFailure = true;
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
