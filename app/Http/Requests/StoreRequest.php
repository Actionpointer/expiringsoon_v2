<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'address' => 'required|string',
            'state_id' => 'required|string',
            'city' => 'required|string',
            'email' => 'required|string|unique:users',
            'phone' => 'required|string|unique:users',
            'photo' => 'required|max:1024|image',
            'published' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'state_id.required' => 'The state field is required',
            'city_id.required' => 'The city field is required',
            'photo.max' => 'The photo size must be less than or equal to 1mb',
            'photo.image' => 'The photo must be an image',
        ];
    }
}
