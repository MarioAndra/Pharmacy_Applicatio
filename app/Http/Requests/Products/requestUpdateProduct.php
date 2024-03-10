<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class requestUpdateProduct extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'nullable|min:2|max:15',
            'price'=>'nullable|numeric|min:100',
            'category_id'=>'nullable',
            'user_id'=>'nullable',
            'images' => 'nullable|array|min:2',
            'images.*' => 'nullable|image|mimes:jpg,png,gif|max:2765|dimensions:max_width=3840,max_height=2160'
        ];
    }
}
